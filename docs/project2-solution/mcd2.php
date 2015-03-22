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
 * mcd2.php
 * Extracts and formats McDonalds Nutrition Facts data into simple rows/records
 * INFILE: mcd1.txt
 * OUTFILE: mcd2.txt
 *
 * @version 0.2
 * @license http://unlicense.org/ The Unlicense
 * @link https://github.com/pffy/data-mcdonalds
 * @author The Pffy Authors
 *
 * SYSTEM REQUIREMENTS: PHP 5.2.0 or better
 *
 */

$str = trim(file_get_contents("mcd1.txt"));
$outfile = "mcd2.txt";

if(!$str){
  exit("nothing here! exiting.");
}


## STEP 1: MOVE ALL TEXT TO LINE 1, THEN NORMALIZE STYLIZED TEXT

# removal all the line breaks
$str = preg_replace('/\n/u', " ", $str);

# normalize digit-percent to words
$str = str_replace("1%", "One-Percent", $str);

# normalize EQUAL® 0 to EQUAL® ZERO
$str = str_replace("EQUAL® 0", "EQUAL® ZERO", $str);

# normalize all the N/A values to dashes
$str = str_replace("N/A", "-", $str);


## STEP 2: DELIMIT EACH ENTRY BASED ON COMMON STARTING/ENDING PATTERN

# replace the space between a digit/dash and a capital letter with a pipe
$str = preg_replace_callback(
  '/([-]|\d{1,2})\s[A-Z]/u',
  function($matches) {
    $m = $matches[0];
    return preg_replace('/\s/u', "|", $m);
  },
  $str
);

# place one entry per line
$str = str_replace("|", PHP_EOL, $str);


## STEP 3: SPACE CLEANUP

# replace all remaining new lines with a space
$str = preg_replace('/(\s{2,})/u', " ", $str);

exit(file_put_contents($outfile, $str));