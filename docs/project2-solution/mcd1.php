<?php

/*
 * This is free and unencumbered software released into the public domain.
 *
 * Anyone is free to copy, modify, publish, use, compile, sell, or distribute this software, either
 * in source code form or as a compiled binary, for any purpose, commercial or non-commercial, and
 * by any means.
 *
 * In jurisdictions that recognize copyright laws, the author or authors of this software dedicate
 * any and all copyright interest in the software to the public domain. We make this dedication for
 * the benefit of the public at large and to the detriment of our heirs and successors. We intend
 * this dedication to be an overt act of relinquishment in perpetuity of all present and future
 * rights to this software under copyright law.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT
 * NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
 * CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 * For more information, please refer to <http://unlicense.org/>
 */

/**
 *
 * mcd1.php
 * Pre-processing of raw text file from McDonalds Nutrition Facts PDF
 * INFILE: mcd.txt
 * OUTFILE: mcd1.txt
 *
 * @version 0.2
 * @license http://unlicense.org/ The Unlicense
 * @link https://github.com/pffy/data-mcdonalds
 * @author The Pffy Authors
 *
 * SYSTEM REQUIREMENTS: PHP 5.2.0 or better
 *
 */



$str = trim(file_get_contents("mcd.txt"));
$outfile = "mcd1.txt";

if(!$str){
  exit("nothing here! exiting.");
}

## STEP 1: REMOVE FRONT AND BACK MATTER, THEN NUTRIENT AND CATEGORY HEADERS

# front matter (from the top of the document to the end of the "eat right" disclaimer)
$regex_newline[] = '/\A.*(\n.*){1,25} diet\./ui';

# back matter (the other disclaimer, to the end of the document)
$regex_newline[] = '/Note: Nutrient contributions(.*\n){1,}.*\z/ui';

# nutrient headers
$regex_newline[] = '/nutrition facts(.*\n){1,25}.*iron/ui';

# category headers
$regex_newline[] = '/\nBurgers\s\&\sSandwiches\s/u';
$regex_newline[] = '/\nChicken\s\&\sFish\s/u';
$regex_newline[] = '/\nSnacks\s\&\sSides\s/u';
$regex_newline[] = '/\nDesserts\s\&\sShakes\s/u';
$regex_newline[] = '/\nBreakfast\s/u';
$regex_newline[] = '/\nBeverages\s/u';
$regex_newline[] = '/\nMcCafe\s/u';
$regex_newline[] = '/\nSalads\s/u';
$regex_newline[] = '/\nCondiments\s/u';

foreach($regex_newline as $rb) {
  $str = preg_replace($rb, PHP_EOL, $str);
}

## STEP 2: REMOVE WINGDINGS

$wingdings = array(
  "†",
  "*",
  "+",
  "--",
  "§"
);

# remove wingdings
$str = str_replace($wingdings, "", $str);

## STEP 3: SPACE CLEANUP

# replace all remaining new lines with a space
$str = preg_replace('/(\s{2,})/u', " ", $str);

# remove leading and trailing spaces
$str = trim($str);

exit(file_put_contents($outfile, $str));