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
 * name     : mcd31.php
 * version  : 31
 * updated  : 2018-07-08
 * license  : http://unlicense.org/ The Unlicense
 * git      : https://github.com/pffy/data-mcdonalds-nutrition-facts
 *
 */

#derp
echo PHP_EOL;

$str = "";

## input file
$infile = (string)$argv[1];

if(!$infile) 
{
  exit(fn_showhelp());
}

try 
{

  $str = file_get_contents($infile);
    
  if(!$str)
  {
    exit(fn_nothinghere());
  }

} 
catch(Exception $ex) 
{
  var_dump($ex);
  exit("INFILE ERROR! exiting..." 
    . PHP_EOL);
}


## output file details
$date = date("YmdHms");
$date = time();
$outfile = "$infile-converted-$date.csv";
$catfile = "$infile-cats-$date.txt";

## procesing ...
$str = fn_preflight($str);
$str = fn_wingdings($str);
$str = fn_cleanup($str);
$str = fn_cats($str);
$str = fn_poolfilter($str);

$str = str_replace("\f", str_repeat(PHP_EOL, 3), $str);
$str = trim($str);

$catput = $str;

$str = fn_itemize($str);

## finishing... 

try 
{
  file_put_contents($catfile, $catput);
  echo "Saving to $catfile ... " . PHP_EOL;
  file_put_contents($outfile, $str);
  
  echo "Saving to $outfile ... " . PHP_EOL;
  echo "Work done." . PHP_EOL;
} 
catch(Exception $ex) 
{
  var_dump($ex);
  exit("OUTFILE ERROR! exiting..." 
    . PHP_EOL);
}

##
## Functions
##

function fn_itemize($str)
{
  $lines = explode(PHP_EOL, $str);

  $output = "ITEM\tCAL\tFAT\tSFAT\tTFAT\tCHOL\tSALT\tCARB\tFBR\tSGR\tPRO";

  foreach($lines as $line) 
  {
    
    # crawls backwards from the final nutrient value back towards items

    $data = explode(" ", $line);

    # skip lines that don't parse
    if(count($data) < 15)
    {
      continue;
    }

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

  } // foreach

  $output = trim($output);  
  return $output;
}


## herding cats
function fn_cats($str)
{
  //TODO: should be a separate textfile
  $cats = array(
    "burgers",
    "chicken and sandwiches",
    "condiments",
    "mccafé",
    "salads",
    "bevarages",
    "signature crafted",
    "snacks and sides",
    "desserts & snacks",
    "adb muffin",
    "all day breakfast",
    "adb biscuit",
    "mcpick 2 2017",
    "mcpick 2 2017 row 2",
    "mcpick 2 0816",
    "happy meal",
    "happy meal - protein",
    "happy meal - drinks",
    "happy meal - side",
    "mighty kids meal - protein",
    "mighty kids meal - drinks", // missing in 18-0706 source text
    "mighty kids meal - sides"
  );

  # sort cats by length descending
  usort($cats, "bylength_dsc");
  
  $str = "\n" . $str;

  $arr = array();
  foreach($cats as $k=>$c) 
  {
    $bookmark = "--CAT--";
    $str = str_ireplace("\n"
      . addslashes($c). "\n", PHP_EOL . "\f$bookmark" . PHP_EOL, $str);
  }

  return $str;
}




## returns a string where items are ordered on each line
function fn_poolfilter($str)
{
  
  # create a pool of text
  $str = preg_replace('/\n/u', " ", $str);

  # filter the pool
  $str = preg_replace_callback(
    '/([-]|\d{1,2})\s[A-Z]/u',
    function($matches) {
      $m = $matches[0];
      return preg_replace('/\s/u', "|", $m);
    },
    $str
  );

  # place one item per line
  $str = str_replace("|", PHP_EOL, $str);

  return $str;
}

## returns a string with reduced free space
function fn_cleanup($str) 
{
  # reduce free space
  $str = preg_replace('/(\s{2,})/u', " ", $str);

  # remove leading and trailing spaces
  $str = trim($str);
  return $str;
}

## returns a string without wingdings
function fn_wingdings($str) 
{

  $wingdings = array(
    "†",
    "*",
    "+",
    "--",
    "§"
  );

  # remove wingdings
  $str = str_replace($wingdings, "", $str);

  return $str;
}


## returns a string without headers, footers, etc
function fn_preflight($str)
{

  $str = str_replace("1%", "One-percent", $str);

  $str = str_replace("Big Breakfast 2", "Big Breakfast Two", $str);

  $str = str_replace("Filet-OFish", "Filet-O-Fish", $str);  

  # front matter (from the top of the document to the end of the "eat right" disclaimer)
  $parts[] = '/\A.*(\n.*){1,25} diet\./ui';

  # back matter (the other disclaimer, to the end of the document)
  $parts[] = '/Note: Nutrient contributions(.*\n){1,}.*\z/ui';

  # nutrient headers
  $parts[] = '/nutrition facts(.*\n){1,25}.*iron/ui';

  ## replaces parts
  foreach($parts as $p) 
  {
    $str = preg_replace($p, PHP_EOL, $str);
  }

  return $str;
}

## returns message
function fn_nothinghere() 
{
  return "NOTHING HERE! exiting..." . PHP_EOL;
}

## returns message
function fn_showhelp() 
{
  return "EXAMPLE: > php mcd31.php infile.txt" . PHP_EOL;
}

##
## helper functions
##

## sorts ascending
function bylength_asc( $a, $b ) 
{
  return strlen($a)-strlen($b) ;
}

## sorts descending
function bylength_dsc( $a, $b ) 
{
  return strlen($b)-strlen($a) ;
}