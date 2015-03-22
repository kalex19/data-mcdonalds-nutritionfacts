data-mcdonalds
==============

Data set describing McDonald's Nutrition Facts. Updated March 2015.

## PROJECT SCOPE

+ This project only demonstrates [extraction, transformation and loading](http://en.wikipedia.org/wiki/Extract,_transform,_load) of McDonald's Nutrition Facts data.
+ See [documentation](https://github.com/pffy/data-mcdonalds/tree/master/docs) for ETL process details specific to this project.

## DATA FORMATS

### VERSION 2

+ Data from March 2015.
+ 433 menu items. (10% increase since June 2014)
+ [Textfiles](https://github.com/pffy/data-mcdonalds/tree/master/textfiles)
  + Most compatible format.
  + TSV: tab-separated value files.
  + Nicely-formatted on GitHub. You can even search within the file on GitHub.
+ [Spreadsheet Workbooks](https://github.com/pffy/data-mcdonalds/tree/master/workbooks)
  + You can import XLSX or ODS spreadsheets into [Google Drive Sheets](http://www.google.com/sheets/about/index.html).
  + You can also import the spreadsheets into [Zoho Docs Spreadsheets](https://www.zoho.com/docs/online-spreadsheet.html)
  + Open XLSX in [Microsoft Excel](http://office.microsoft.com/en-us/excel/).
  + Open ODS in [LibreOffice](http://www.libreoffice.org/).
+ [SQLite Database](https://github.com/pffy/data-mcdonalds/tree/master/sql)
  + Flexible, self-containted, serverless, zero-config, transactional [SQL database engine](http://www.sqlite.org/).

### VERSION 1


+ Data from June 2014.
+ 393 menu items.
+ [JSON](https://github.com/pffy/data-mcdonalds/tree/master/json)
  + Stable, serialized data transport.
  + JSON: [JavaScript Object Notation](http://www.json.org/).
  + Very portable and processed by most modern languages.

### POSSIBLE FORMATS

+ SQL Server 2008
  + ***Not Planned.***
+ MariaDB
  + ***Not Planned.***
+ Android XML
  + ***Not Planned.***
+ Oracle 11g
  + ***Not Planned.***
+ Oracle 12c
  + ***Not Planned.***
+ Oracle Database In-Memory
  + ***Not Planned.***


## MCDONALDS MENU STRUCTURE

  + McDonald's is a quick service restaurant concept designed to provide a fast,
  convenient and rewarding guest experience.

  + McDonald's has optimized its supply chain to offer several healthy
  items for breakfast, lunch and dinner. **Many locations are open 24 hours.**


#### MCDONALDS USA CATEGORIES

The popular menu items at McDonald's USA are divided into 9 simple categories:

  + Burgers and Sandwiches
  + Chicken and Fish
  + Breakfast
  + Salads
  + Snacks and Sides
  + Beverages
  + McCafe
  + Dessert/Shakes
  + Condiments

```
  BURGERSANDWICH
  CHICKENFISH
  BREAKFAST
  SALAD
  SNACKSIDE
  BEVERAGE
  MCCAFE
  DESSERTSHAKE
  CONDIMENT
```

Some menu items are in more than one category.

## REFERENCE

+ [McDonald's USA Nutrition Facts for Popular Menu Items](http://nutrition.mcdonalds.com/getnutrition/nutritionfacts.pdf) (updated 03-18-2015)

## DISCLAIMER

**This project is neither endorsed by nor affliated with any McDonald's®,  McDonald's® stores, McDonald's Corporation, McDonald's franchisees or any other affliated brands or entities. Nutrition information is subject to change without prior notice. Please contact McDonald's® for the latest information.**

