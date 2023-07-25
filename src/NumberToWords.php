<?php

namespace Eclipsio\NumberHumanoid;

use Exception;

/**
 * A Class to Convert Any Numeric Number into
 * String as per standards.
 * Supports Upto Quadrillion and decimals too.
 * 
 * @method string toWords($number) string for a number
 * @package Eclipsio\NumberHumanoid
 */

class NumberToWords {

    /**
     * Basic Numbers
     * @var array
     */
    protected static $ones = [
        0 => 'zero', 1 => 'one', 2 => 'two', 3 => 'three', 4 => 'four',
        5 => 'five', 6 => 'six', 7 => 'seven', 8 => 'eight', 9 => 'nine'
    ];

    /**
     * Teens Numbers
     * @var array
     */
    protected static $teens = [
        11 => 'eleven', 12 => 'twelve', 13 => 'thirteen', 14 => 'fourteen',
        15 => 'fifteen', 16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen', 19 => 'nineteen'
    ];

    /**
     * Tens Numbers
     * @var array
     */
    protected static $tens = [
        10 => 'ten', 20 => 'twenty', 30 => 'thirty', 40 => 'forty', 50 => 'fifty',
        60 => 'sixty', 70 => 'seventy', 80 => 'eighty', 90 => 'ninety'
    ];

    /**
     * Thousands
     * @var array
     */
    protected static $thousands = [
        1000 => 'thousand', 
        1000000 => 'million', 
        1000000000 => 'billion', 
        1000000000000 => 'trillion', 
        1000000000000000 => 'quadrillion'
    ];


    /**
     * Convert Number to string words
     * Supports upto Quadrillion
     * 
     * @param int|float $number
     * @return throwable|string
     */
    public static function toWords($number) 
    {
        // if(!is_numeric($number)){
        //     throw new Exception("Given argument is not a valid numeric number. $number");
        // }

        if ($number < 0) {
            return "minus " . static::toWords(abs($number));
        }

        $decimalPointPosition = strpos($number, '.');
        if ($decimalPointPosition !== false) {
            $integerPart = substr($number, 0, $decimalPointPosition);
            $decimalPart = substr($number, $decimalPointPosition + 1);

            $result = self::toWords($integerPart);
            $result .= ' point';
            for ($i = 0; $i < strlen($decimalPart); $i++) {
                $result .= ' ' . self::$ones[$decimalPart[$i]];
            }
            return $result;
        }
    
        if ($number < 10) {
            return self::$ones[$number];
        }
    
        if ($number < 20) {
            return self::$teens[$number];
        }

        if ($number < 100) {
            $tensDigit = floor($number / 10) * 10;
            $remainder = $number - $tensDigit;
            return self::$tens[$tensDigit] . (($remainder > 0) ? ' ' . self::$ones[$remainder] : '');
        }
    
        if ($number < 1000) {
            $hundredsDigit = floor($number / 100);
            $remainder = $number - $hundredsDigit * 100;
            return self::$ones[$hundredsDigit] . ' hundred' . (($remainder > 0) ? ' ' . self::toWords($remainder) : ''); // and
        }
        
        $prev = "thousand";
        foreach (self::$thousands as $limit => $unit) {
            if ($number < $limit) {
                $thousandsDigit = floor($number / ($limit / 1000));
                $remainder = $number - $thousandsDigit * ($limit / 1000);
                $unitSuffix = ($thousandsDigit == 1) ? ' ' . $prev : ' ' . $prev . 's';
                return self::toWords($thousandsDigit) . "$unitSuffix" . (($remainder > 0) ? ' '.self::toWords($remainder) : '');
            }
            $prev = $unit;
        }

        
    }

}