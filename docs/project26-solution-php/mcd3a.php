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
 * name     : mcd3a.php
 * version  : 26
 * updated  : 2015-11-02
 * license  : http://unlicense.org/ The Unlicense
 * git      : https://github.com/pffy/data-mcdonalds-nutrition-facts
 * notes    : loads mcd3.txt and cats-mcd.csv to generate outfiles
 *
 */

date_default_timezone_set('America/Los_Angeles');

// infiles
$tsvfile = "mcd3.txt";
$catfile = "categories-mcdonalds-v26.csv";

// outfiles
$oufile_tsv = "mcd.tsv";
$oufile_json = "mcd.json";
$oufile_json_pretty = "mcd-pretty.json";

// Android XML resource should use underscores (_) instead of dashes (-)
$oufile_xml_nocat = "mcd_string_array.xml";
$oufile_xml = "arrays_mcd.xml";

// data
$nutrient_data = trim(file_get_contents($tsvfile));
$category_data = trim(file_get_contents($catfile));

if(!$nutrient_data) {
  exit($tsvfile . " not found." . PHP_EOL);
}

if(!$category_data) {
  exit($catfile . " not found." . PHP_EOL);
}

$data = explode(PHP_EOL, $nutrient_data);
$cats = explode(PHP_EOL, $category_data);

$nutrient_data = null;
$category_data = null;

// TSV headers
$output_tsv_arr[] = $tsv_headers = $data[0] . "\tCATEGORY";

// removes headers, leaves data in zero-based arrays
array_shift($data);
array_shift($cats);

// total items processed
$total = 0;

// outfile arrays
$output_tsv_arr = array();
$output_json_arr = array();
$output_xml_cat = array();
$output_xml_arr = array();

foreach($cats as $catno => $category) {

  // delimits data for each category
  $cat_data = explode(",", $category);

  // data from cats-mcd.csv
  $cat_name     = $cat_data[0]; // category name
  $cat_tag      = $cat_data[1]; // category tag
  $cat_line     = (int)$cat_data[2] - 1; // line item number
  $cat_count    = (int)$cat_data[3]; // number of items in category
  $cat_checksum = (int)$cat_data[4]; // running total

  // grabs TSV slice of data based on category meta data
  $data_slice = array_slice($data, $cat_line, $cat_count);

  $output_xml_cat['catdex'][] = $cat_name;
  $output_xml_cat['category'][$cat_tag]['comment']
    = android_xml_comments($cat_name);
  $output_xml_cat['category'][$cat_tag]['name'] = $cat_name;

  // add the category tag for each item in that TSV data slice
  foreach($data_slice as $k => $item) {

    // add category to TSV row
    $output_tsv_arr[] = $item . "\t" . $cat_tag;

    // parse TSV row, add JSON object with category
    $json_details = json_item($item, $cat_tag);
    $output_json_arr[] = $json_details;

    // build XML line item
    $xml_details = android_xml_item($item);
    $xml_name = $json_details['ITEM'];

    $itemstag = strtolower($cat_tag);
    $detailstag = $itemstag . "_details";

    $output_xml_cat['category'][$cat_tag]['items'][] = $xml_name;
    $output_xml_cat['category'][$cat_tag]['details'][] = $xml_details;
    $output_xml_cat['category'][$cat_tag]['items_name'] = $itemstag;
    $output_xml_cat['category'][$cat_tag]['details_name'] = $detailstag;

    $total++;
  }

  // double check total processed with running totals
  if($total != $cat_checksum) {
    exit("ERR: MISMATCH! in category: " . $cat_name);
  }

}

## FINSHING

// puts categoriezed Android XML string-array into an outfile
file_put_contents($oufile_xml, export_xml($output_xml_cat));

// puts categorized TSV data into an outfile
file_put_contents($oufile_tsv, export_tsv($output_tsv_arr, $tsv_headers));

// puts JSON into an outfile
file_put_contents($oufile_json, export_json($output_json_arr));

// puts pretty JSON into an outfile
file_put_contents($oufile_json_pretty, export_json($output_json_arr, true));

exit();

// returns input text in an XML comment
function android_xml_comments($str) {
  return str_repeat(" ", 4) . "<!-- $str -->";
}

// returns XML string at beginning of XML resource file
function android_xml_start() {

  $now = date(DATE_RSS);

  return join(PHP_EOL, array(
    "<?xml version=\"1.0\" encoding=\"utf-8\"?>",
    "",
    "<!-- Updated: $now -->",
    "<!-- Generated by Project 26 ETL Solution found here: -->",
    "<!-- https://github.com/pffy/data-mcdonalds-nutrition-facts -->",
    "",
    "<resources>",
    "",
    ""
    ));
}

// returns XML string at end of XML resource file
function android_xml_end() {
  return join(PHP_EOL, array(
    "",
    "",
    "</resources>",
    "",
    ""
    ));
}


// returns XML string that starts single string array
function android_xml_stringarray_start($str) {

  // indent 4 spaces
  return str_repeat(" ", 4) .
    "<string-array name=\"$str\">";
}

// returns XML string that ends single string array
function android_xml_stringarray_end() {

  // indent 4 spaces
  return str_repeat(" ", 4) . "</string-array>";
}

// returns Android XML string array item wrapped by CDATA tags
function android_xml_cdata($str) {

  // indent 8 spaces
  $prefix = str_repeat(" ", 8) . "<item><![CDATA[";
  $suffix = "]]></item>";

  return $prefix . $str . $suffix;
}

// returns semicolon-delimited nutrient values
function android_xml_item($item) {

  $values = explode("\t", $item);

  return join(";", array(
    $values[1],
    $values[2],
    $values[3],
    $values[4],
    $values[5],
    $values[6],
    $values[7],
    $values[8],
    $values[9],
    $values[10],
    $values[0],
  ));
}


// returns array of item nutrients with category
function json_item($item, $cat) {

  $values = explode("\t", $item);

  return array(
      'CAL' => $values[1],
      'FAT' => $values[2],
      'SFAT' => $values[3],
      'TFAT' => $values[4],
      'CHOL' => $values[5],
      'SALT' => $values[6],
      'CARB' => $values[7],
      'FBR' => $values[8],
      'SGR' => $values[9],
      'PRO' => $values[10],
      'ITEM' => $values[0],
      'CATEGORY' => $cat
    );
}

// exports xml_cat data to Android XML resource file format
function export_xml($xmldata) {

  $output_xml[] = android_xml_start();
  $output_xml[] = android_xml_comments("Menu Item Categories");
  $output_xml[] = android_xml_stringarray_start("categories");
  $output_xml[] = join(PHP_EOL, array_map(
  'android_xml_cdata', $xmldata['catdex']));
  $output_xml[] = android_xml_stringarray_end();

  foreach($xmldata['category'] as $cat) {

    $output_xml[] = "";
    $output_xml[] = "";

    // comments
    $output_xml[] = android_xml_comments($cat['name']);

    // items
    $output_xml[] = android_xml_stringarray_start($cat['items_name']);
    $output_xml[] = join(PHP_EOL, array_map('android_xml_cdata',
      $cat['items']));
    $output_xml[] = android_xml_stringarray_end();

    // details
    $output_xml[] = android_xml_stringarray_start($cat['details_name']);
      $output_xml[] = join(PHP_EOL, array_map('android_xml_cdata',
      $cat['details']));
    $output_xml[] = android_xml_stringarray_end();
  }

  $output_xml[] = android_xml_end();

  return join(PHP_EOL, $output_xml);
}

// exports data into JSON format
function export_json($arr, $pretty = false) {
  if($pretty) {
    return trim(json_encode($arr, JSON_PRETTY_PRINT));
  }

  return trim(json_encode($arr));
}

// exports data into TSV format
function export_tsv($arr, $headers) {
  return $headers . PHP_EOL . join(PHP_EOL, $arr);
}