# number-humanoid
A Class for converting a number to a human readable string with K,M,B,T etc.

## Example
```
<?php

use Eclipsio\NumberHumanoid\Humanoid;

$num = 10200;

$human = new Humanoid($num);

echo $human->out; // 10.2K
echo $human->number; // 10.2
echo $human->expression; // K
```