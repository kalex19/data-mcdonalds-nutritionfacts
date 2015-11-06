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
 * name     : define.php
 * version  : 29
 * updated  : 2015-11-06
 * license  : http://unlicense.org/ The Unlicense
 * git      : https://github.com/pffy/data-mcdonalds-nutrition-facts
 * notes    : defines constants for pnra3a.php
 *
 */
define("GIT_REPO", "https://github.com/pffy/data-mcdonalds-nutrition-facts");

// xml outfile properties
define("CATXML_TITLE", "Menu Item Categories");
define("CATXML_VARNAME", "categories");
define("SINGLEXML_TITLE", "McDonalds Nutrition Facts");
define("SINGLEXML_VARNAME", "mcdonalds_nutrition");
define("XML_INDENT_ONE", 4);
define("XML_INDENT_TWO", 8);

// infiles
define("INFILE_TSV", "mcd3.txt");
define("INFILE_CAT", "categories-mcdonalds-v29.csv");

// outfiles
define("OUTFILE_TSV", "mcd.tsv");
define("OUTFILE_JSON", "mcd.json");
define("OUTFILE_JSON_PRETTY", "mcd-pretty.json");
define("OUTFILE_XML", "arrays_mcd_single.xml");
define("OUTFILE_XML_SINGLE", "arrays_mcd.xml");


