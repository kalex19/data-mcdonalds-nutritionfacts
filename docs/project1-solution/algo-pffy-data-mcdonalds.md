### START ALGO

+ FIND/REPLACE: `^Burgers\s\&\sSandwiches$` -> `{LEAVE BLANK}`
+ FIND/REPLACE: `^Chicken\s\&\sFish$` -> `{LEAVE BLANK}`
+ FIND/REPLACE: `^Breakfast$` -> `{LEAVE BLANK}`
+ FIND/REPLACE: `^Salads$` -> `{LEAVE BLANK}`
+ FIND/REPLACE: `^Snacks\s\&\sSides$` -> `{LEAVE BLANK}`
+ FIND/REPLACE: `^Beverages$` -> `{LEAVE BLANK}`
+ FIND/REPLACE: `^McCafe$` -> `{LEAVE BLANK}`
+ FIND/REPLACE: `^Desserts/Shakes$` -> `{LEAVE BLANK}`
+ FIND/REPLACE: `^Condiments$` -> `{LEAVE BLANK}`
+ FIND/REPLACE: `nutrition facts(.*\n){1,25}.*iron` -> `{LEAVE BLANK}`
+ FIND/REPLACE: `\A.*(\n.*){1,25} diet.` -> `{LEAVE BLANK}`
+ FIND/REPLACE: `Note: Nutrient contributions(.*\n){1,}.*\z` -> `{LEAVE BLANK}`

+ FIND/REPLACE: `\n{2,}` -> `\n`
+ FIND/REPLACE: `\d{1,5}.*\d{1,5}$` -> `$&\n`
+ FIND/REPLACE: `\n{2}` -> `|`
+ FIND/REPLACE: `\n` -> `{A SINGLE SPACE}`
+ FIND/REPLACE: `\|` -> `\n`

+ FIND: `\d{1,5}\n(ml|fl|piece)`
  + FIND/REPLACE: `\n` -> `{A SINGLE SPACE}`

### END ALGO