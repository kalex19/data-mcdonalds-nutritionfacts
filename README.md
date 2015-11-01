# McDonalds Nutrition Facts

  + Free, libre and open source data set describing McDonald's Nutrition Facts.
  + Use the [latest stable release][gh_stable] for research.
  + November 2015 Refresh.

## PROJECT SCOPE

+ This project only demonstrates [extraction, transformation and loading](http://en.wikipedia.org/wiki/Extract,_transform,_load) of McDonald's Nutrition Facts data.
+ See [documentation](https://github.com/pffy/data-mcdonalds/tree/master/docs) for ETL process details specific to this project.

## DATA FORMATS


### VERSION 23 (in development)

  + November 2015 Refresh.
  + Source data from October 29, 2015.
  + New Menu Category Structure

|  **CATEGORY** | **CODE** |
|  ------ | ------ |
|  Burgers & Sandwiches | `  BURGERSANDWICH` |
|  Chicken & Fish | `  CHICKENFISH` |
|  Breakfast | `  BREAKFAST` |
|  Salads | `  SALAD` |
|  Snacks and Sides | `  SNACKSIDE` |
|  Beverages | `  BEVERAGE` |
|  McCafe | `  MCCAFE` |
|  Dessert & Shakes | `  DESSERTSHAKE` |
|  Condiments | `  CONDIMENT` |
|  All Day Breakfast | `  ALLDAYBREAKFAST` |

### VERSION 22 (pre-release)

  + Source data from [latest stable version][gh_stable].
  + Partial ETL solution available for this release.
  + No item categories for this release.
  + [Textfiles](https://github.com/pffy/data-mcdonalds/tree/master/textfiles)
  + [Spreadsheet Workbooks](https://github.com/pffy/data-mcdonalds/tree/master/workbooks)


### VERSION 21 (pre-release)

  + Source data from October 13, 2015.
  + No ETL solution available for this release.
  + No item categories for this release.
  + [Textfiles](https://github.com/pffy/data-mcdonalds/tree/master/textfiles)
  + [Spreadsheet Workbooks](https://github.com/pffy/data-mcdonalds/tree/master/workbooks)


### [VERSION 3][gh_stable]

+ Data from May 2015.
+ 412 menu items processed.
+ [Textfiles](https://github.com/pffy/data-mcdonalds/tree/master/textfiles)
+ [Spreadsheet Workbooks](https://github.com/pffy/data-mcdonalds/tree/master/workbooks)
+ [View ETL Solution](https://github.com/pffy/data-mcdonalds/tree/master/docs).


### VERSION 2

+ Data from March 2015.
+ 433 menu items processed.
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
+ [View ETL Solution](https://github.com/pffy/data-mcdonalds/tree/master/docs).


### VERSION 1

+ Data from June 2014.
+ 393 menu items processed.
+ [JSON](https://github.com/pffy/data-mcdonalds/tree/master/json)
  + Stable, serialized data transport.
  + JSON: [JavaScript Object Notation](http://www.json.org/).
  + Very portable and processed by most modern languages.
+ [View ETL Solution](https://github.com/pffy/data-mcdonalds/tree/master/docs).


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

+ [McDonald's USA Nutrition Facts for Popular Menu Items][web_mcdpdf]

## DISCLAIMER

**This project is neither endorsed by nor affliated with any McDonald's®,  McDonald's® stores, McDonald's Corporation, McDonald's franchisees or any other affliated brands or entities. Nutrition information is subject to change without prior notice. Please contact McDonald's® for the latest information.**

[gh_stable]: https://github.com/pffy/data-mcdonalds-nutrition-facts/releases/latest
[web_mcdpdf]: http://nutrition.mcdonalds.com/getnutrition/nutritionfacts.pdf
