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
 * name     : mcd3.php
 * version  : 26
 * updated  : 2015-11-02
 * license  : http://unlicense.org/ The Unlicense
 * git      : https://github.com/pffy/data-mcdonalds-nutrition-facts
 * notes    : loads mcd2.txt, finishes data and outputs to mcd3.txt
 *
 */
$str = trim(file_get_contents("mcd2.txt"));
$outfile = "mcd3.txt";

if(!$str) {
  exit("nothing here! exiting.");
}

## STEP 1: CONVERT LINES TO AN ARRAY, DELIMITED BY EOL

$lines = explode(PHP_EOL, $str);


## STEP 2: CONVERT LINES INTO TAB-DELIMITED ENTRIES

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


## STEP 3: FINISHING

$output = trim($output);

exit(file_put_contents($outfile, $output));
