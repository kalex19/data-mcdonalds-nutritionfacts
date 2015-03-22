# PROJECT 2 SOLUTION

+ Copy and paste PDF text to file called `mcd.txt`.
  + (you can also convert PDF to txt, if you want)
+ Convert the raw text into pre-processed text for data extraction
  + `> php mcd1.php`
  + Expected infile is `mcd.txt`, outfile is `mcd1.txt`
+ Extract and format processed data into rows
  + `> php mcd2.php`
  + Expected infile is `mcd1.txt`, outfile is `mcd2.txt`
+ Transform the rows into a TSV format file
  + `> php mcd3.php`
  + Expected infile is `mcd2.txt`, outfile is `mcd.tsv`