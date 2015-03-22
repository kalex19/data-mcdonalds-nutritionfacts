# NOTES

#### DATA SOURCE
  + `nutritionfacts.pdf` - from http://nutrition.mcdonalds.com/getnutrition/nutritionfacts.pdf

#### DESIGN
  + `algo-pffy-data-mcdonalds.md` - pre-process algorithms for ETL proposed in EVT phase.

#### PROCESS
  + `source-data-mcdonalds-nutrition-facts.txt` - pdf to text data conversion.
  + `pffy-data-mcdonalds-nutrition-facts.txt` - intermediate data dump 1
    + pre-process algorithms refined in DVT phase. this file is the result.
  + `mcd.tsv` - intermediate data dump 2
    + post-process extraction of nutrient data is peformed. this file is the result.
    + categories will be added in MVT phase.
