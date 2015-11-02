# McDonalds Nutrition Facts

  + Free, libre and open source data set describing McDonald's Nutrition Facts.
  + Use the [latest stable release][gh_stable] for research.
  + November 2015 Refresh.

### PROJECT SCOPE

+ This project only demonstrates [extraction, transformation and loading][wiki_etl] of McDonald's Nutrition Facts data.
+ See [documentation][gh_docs] for ETL process details specific to this project.

## DATA FORMATS

### VERSION 26

  + November 2015 Refresh.
  + Source data from October 29, 2015.
  + Uses new menu structure introduced by addition of all day breakfast menu.
  + [Project 25 ETL Solution][gh_docs] adds automatic addition of categories to TSV, JSON or XML export files.
  + [Textfiles][gh_textfiles]
  + [Spreadsheet Workbooks][gh_workbooks]
  + [Android XML][gh_xml]
    + Provides a safe, portable data format for Android apps.
    + Does not require special permissions for read access.
  + [JSON][gh_json]
    + Stable, serialized data transport.
    + JSON: [JavaScript Object Notation][web_json].
    + Very portable and processed by most modern languages.


### [VERSION 23][gh_stable] (STABLE)

  + November 2015 Refresh.
  + Source data from October 29, 2015.
  + [View ETL Solution][gh_docs].
  + [Textfiles][gh_textfiles]
  + [Spreadsheet Workbooks][gh_workbooks]
  + New Menu Category Structure

> NOTE: Table generated in Google Spreadsheets with the [MarkdownTableMaker Add-On][markdownstore].

|  **CATEGORY** | **CODE** |
|  ------ | ------ |
|  Burgers & Sandwiches | `BURGERSANDWICH` |
|  Chicken & Fish | `CHICKENFISH` |
|  Breakfast | `BREAKFAST` |
|  Salads | `SALAD` |
|  Snacks and Sides | `SNACKSIDE` |
|  Beverages | `BEVERAGE` |
|  McCafe | `MCCAFE` |
|  Dessert & Shakes | `DESSERTSHAKE` |
|  Condiments | `CONDIMENT` |
|  All Day Breakfast | `ALLDAYBREAKFAST` |

### VERSION 22 (pre-release)

  + Source data from [latest stable version][gh_stable].
  + Partial ETL solution available for this release.
  + No item categories for this release.
  + [Textfiles][gh_textfiles]
  + [Spreadsheet Workbooks][gh_workbooks]


### VERSION 21 (pre-release)

  + Source data from October 13, 2015.
  + No ETL solution available for this release.
  + No item categories for this release.
  + [Textfiles][gh_textfiles]
  + [Spreadsheet Workbooks][gh_workbooks]


### VERSION 3

+ Data from May 2015.
+ 412 menu items processed.
+ [Textfiles][gh_textfiles]
+ [Spreadsheet Workbooks][gh_workbooks]
+ [View ETL Solution][gh_docs].


### VERSION 2

+ Data from March 2015.
+ 433 menu items processed.
+ [Textfiles][gh_textfiles]
  + Most compatible format.
  + TSV: tab-separated value files.
  + Nicely-formatted on GitHub. You can even search within the file on GitHub.
+ [Spreadsheet Workbooks][gh_workbooks]
  + You can import XLSX or ODS spreadsheets into [Google Drive Sheets][g_sheets].
  + You can also import the spreadsheets into [Zoho Docs Spreadsheets][z_sheets].
  + Open XLSX in [Microsoft Excel][ms_excel].
  + Open ODS in [LibreOffice][web_libre].
+ [SQLite Database][gh_sql]
  + Flexible, self-containted, serverless, zero-config, transactional [SQL database engine](http://www.sqlite.org/).
+ [View ETL Solution][gh_docs].


### VERSION 1

+ Data from June 2014.
+ 393 menu items processed.
+ [View ETL Solution][gh_docs].


### POSSIBLE FORMATS

  + Oracle, MariaDB, SQLite, SQL Server

## MCDONALDS MENU STRUCTURE

  + McDonald's is a quick service restaurant concept designed to provide a fast,
  convenient and rewarding guest experience.

  + McDonald's has optimized its supply chain to offer several healthy
  items for breakfast, lunch and dinner. **Many locations are open 24 hours.**

  + Some menu items are in more than one category.
  

## REFERENCE

+ [McDonald's USA Nutrition Facts for Popular Menu Items][web_mcdpdf]

## DISCLAIMER

**This project is neither endorsed by nor affliated with any McDonald's®,  McDonald's® stores, McDonald's Corporation, McDonald's franchisees or any other affliated brands or entities. Nutrition information is subject to change without prior notice. Please contact McDonald's® for the latest information.**

[gh_stable]: https://github.com/pffy/data-mcdonalds-nutrition-facts/releases/latest
[web_mcdpdf]: http://nutrition.mcdonalds.com/getnutrition/nutritionfacts.pdf
[markdownstore]: https://chrome.google.com/webstore/detail/markdowntablemaker/cofkbgfmijanlcdooemafafokhhaeold


[gh_json]: https://github.com/pffy/data-mcdonalds-nutrition-facts/tree/master/json
[gh_xml]: https://github.com/pffy/data-mcdonalds-nutrition-facts/tree/master/xml
[gh_docs]: https://github.com/pffy/data-mcdonalds-nutrition-facts/tree/master/docs
[gh_textfiles]: https://github.com/pffy/data-mcdonalds-nutrition-facts/tree/master/textfiles
[gh_workbooks]: https://github.com/pffy/data-mcdonalds-nutrition-facts/tree/master/workbooks

[web_json]: http://www.json.org/
[g_sheets]: https://www.google.com/sheets/about/index.html
[z_sheets]: https://www.zoho.com/docs/sheet.html
[web_libre]: https://www.libreoffice.org/download/libreoffice-fresh/
[gh_sql]: https://github.com/pffy/data-mcdonalds-nutrition-facts/tree/master/sql
[ms_excel]: https://products.office.com/en-us/excel
[wiki_etl]: https://en.wikipedia.org/wiki/Extract,_transform,_load
