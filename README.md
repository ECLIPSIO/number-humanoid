# number-humanoid
A Class for converting a number to a human readable string with K,M,B,T etc.

## Install
```
composer require eclipsio/number-humanoid
```

## Example Human Readable String
```php
<?php

use Eclipsio\NumberHumanoid\Humanoid;

$num = 10200;

$human = new Humanoid($num);

echo $human->out; // 10.20K
echo $human->number; // 10.20
echo $human->expression; // K
```

## Number to Words
This Class allows to conver a number to words, which supports about quadrillion as well as decimals too.
### How to use
```php
use Eclipsio\NumberHumanoid\NumberToWords;

$num = 71176482.556;
$str = NumberToWords::toWords($num);
echo $str;
```

Output will be
```
seventy one millions one hundred seventy six thousands four hundred eighty two point five five six
```
