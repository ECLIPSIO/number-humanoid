# number-humanoid
A Class for converting a number to a human readable string with K,M,B,T etc.

## Install
```
composer require eclipsio/number-humanoid
```

## Example
```
<?php

use Eclipsio\NumberHumanoid\Humanoid;

$num = 10200;

$human = new Humanoid($num);

echo $human->out; // 10.20K
echo $human->number; // 10.20
echo $human->expression; // K
```