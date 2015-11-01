<?php
/*
 * This is free and unencumbered software released into the public domain.
 *
 * Anyone is free to copy, modify, publish, use, compile, sell, or distribute
 * this software, either in source code form or as a compiled binary, for any
 * purpose, commercial or non-commercial, and by any means.
 *
 * In jurisdictions that recognize copyright laws, the author or authors of this
 * software dedicate any and all copyright interest in the software to the
 * public domain. We make this dedication for the benefit of the public at large
 * and to the detriment of our heirs and successors. We intend this dedication
 * to be an overt act of relinquishment in perpetuity of all present and future
 * rights to this software under copyright law.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN
 * ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 * For more information, please refer to <http://unlicense.org/>
 */

/**
 * name     : mcd.php
 * version  : 22
 * updated  : 2015-11-01
 * license  : http://unlicense.org/ The Unlicense
 * git      : https://github.com/pffy/data-mcdonalds-nutrition-facts
 * notes    : ETL conversion from pdf text to TSV
 *
 */

echo "Building..." . PHP_EOL;

$infile = "mcd.txt";
$str = etl_loadfile($infile);

// clean data
$str = etl_clean($str);

// parse data
$str = etl_parse($str);

// finish data
$str = etl_tsv($str);
etl_outfile($str);


// returns parsed data
function etl_parse($str) {
  $str = etl_normalize($str);
  $str = etl_delimit($str);
  $str = etl_vacuum($str);
  return $str;
}

// returns contents of loaded file
function etl_loadfile($filename) {
  $str = trim(file_get_contents($filename));
  if(!$str) {
    etl_exit("Nothing here. Exiting...");
  }

  return $str;
}

// converts parsed data into tsv output
function etl_tsv($str) {

  $lines = explode(PHP_EOL, $str);

  $output = "ITEM\tCAL\tFAT\tSFAT\tTFAT\tCHOL\tSALT\tCARB\tFBR\tSGR\tPRO";

  foreach($lines as $line) {

    # crawls backwards from the final nutrient value back towards items

    $data = explode(" ", $line);

    // pop daily values. not needed
    array_pop($data); # iron
    array_pop($data); # calcium
    array_pop($data); # vitamin c
    array_pop($data); # vitamin a

    $pro = array_pop($data); # protein
    $sgr = array_pop($data); # sugar

    array_pop($data); # dv fbr
    $fbr = array_pop($data); # fiber

    array_pop($data); # dv carbs
    $carb = array_pop($data); # carbs

    array_pop($data); # dv salt
    $salt = array_pop($data); #salt

    array_pop($data); # dv chol
    $chol = array_pop($data); # cholesterol
    $tfat = array_pop($data); # trans fat

    array_pop($data); # dv sfat
    $sfat = array_pop($data); # saturated fat

    array_pop($data); # dv fat
    $fat = array_pop($data); # fat

    array_pop($data); # fatcal
    $cal = array_pop($data); # calories

    # combine the remaining data to form the item name
    $item = implode(" ", $data); # item

    $output .= PHP_EOL . $item

      . "\t" . $cal
      . "\t" . $fat
      . "\t" . $sfat
      . "\t" . $tfat

      . "\t" . $chol
      . "\t" . $salt

      . "\t" . $carb
      . "\t" . $fbr
      . "\t" . $sgr

      . "\t" . $pro;
  }


  return trim($output);
}


// returns string without front or back matter, or data headers
function etl_clean($str) {

  $str = etl_diacritics($str);

  # front matter (from the top of the document to the end of disclaimer)
  $regex_remove[] = '/\A.*(\n.*){1,25} diet\./ui';

  # back matter (the other disclaimer, to the end of the document)
  $regex_remove[] = '/Note: Nutrient contributions(.*\n){1,}.*\z/ui';

  # nutrient headers
  $regex_remove[] = '/nutrition facts(.*\n){1,25}.*iron/ui';

  # category headers
  $regex_remove[] = '/\nBurgers\s\&\sSandwiches\s/u';
  $regex_remove[] = '/\nChicken\s\&\sFish\s/u';
  $regex_remove[] = '/\nSnacks\s\&\sSides\s/u';
  $regex_remove[] = '/\nDesserts\s\&\sShakes\s/u';
  $regex_remove[] = '/\nBreakfast\s/u';
  $regex_remove[] = '/\nBeverages\s/u';
  $regex_remove[] = '/\nMcCafe\s/u';
  $regex_remove[] = '/\nSalads\s/u';
  $regex_remove[] = '/\nCondiments\s/u';

  // for each removal regex, there is a EOL replacement regex
  $regex_newline = array_fill(0, count($regex_remove), PHP_EOL);
  $str = preg_replace($regex_remove, $regex_newline, $str);

  $str = etl_wingdings($str);
  $str = etl_vacuum($str);

  return $str;
}


// returns normalized data
function etl_normalize($str) {

  # removal all the line breaks, create "word pool"
  $str = preg_replace('/\n/u', " ", $str);

  # normalize digit-percent to words
  $str = str_replace("1%", "One-Percent", $str);

  # normalize EQUAL® 0 to EQUAL® ZERO
  $str = str_replace("EQUAL® 0", "EQUAL® ZERO", $str);

  # normalize all the N/A values to dashes
  $str = str_replace("N/A", "-", $str);

  # remove double McCafé (first is the category, remove diacritics)
  $str = str_replace("McCafé McCafé", "McCafé", $str);

  return $str;
}


// returns delimiited data from word pool
function etl_delimit($str) {

  # replace the space between a digit/dash and a capital letter with a pipe
  $str = preg_replace_callback(
    '/([-]|\d{1,2})\s[A-Z]/u',
    function($matches) {
      $m = $matches[0];
      return preg_replace('/\s/u', "|", $m);
    },
    $str
  );

  $str = str_replace("|", PHP_EOL, $str);

  return $str;
}

// returns string after removing wingdings
function etl_wingdings($str) {

  $wingdings = array(
    "†",
    "*",
    "+",
    "--",
    "§"
  );

  $str = str_replace($wingdings, "", $str);
  return $str;
}


// returns string with menu fixes related to diacritics
function etl_diacritics($str) {
 $str = str_replace("CRÃˆME", "CREME", $str);
 return $str;
}


// returns string exactly one space between words
function etl_vacuum($str) {
  return trim(preg_replace('/(\s{2,})/u', " ", $str));
}


// prints outfile; returns nothing.
function etl_outfile($str, $outfile = "mcd.tsv") {
  file_put_contents($outfile, $str);
  etl_exit("Work complete. Exiting...");
}


// exits program, prints reason to screen
function etl_exit($reason = "Exiting... No reason given.") {
  exit($reason . PHP_EOL . PHP_EOL);
}
