<?php

namespace Eclipsio\NumberHumanoid;


/**
 * A class to convert a number into human readable short format
 * eg. 1000 -> 1K, 1000000 -> 1M, 1B, 1T etc till 1TI
 * 
 * @package Eclipsio\NumberHumanoid 
 */
class Humanoid
{
    private $num = 0;
	private $precision = 2;

    /**
     * Basic Divisor
     * 
     * @return array
     */
    private static function divisor() 
    {
        return [
            pow(1000, 0) => '', // 1000^0 == 1
            pow(1000, 1) => 'K', // Thousand
            pow(1000, 2) => 'M', // Million
            pow(1000, 3) => 'B', // Billion
            pow(1000, 4) => 'T', // Trillion
            pow(1000, 5) => 'Qa', // Quadrillion
            pow(1000, 6) => 'Qi', // Quintillion
        ];
    } 
        


    /**
     * Advance Level Divisor Expression
     * 
     * @return array
     */
    private static function advance()
    {
        return [
            [
                'start'	=> 1,
                'end'		=> pow(1000,1) - 1,
                'expr'		=> ''
            ],
            [
                'start'	=> pow(1000,1),
                'end'		=> pow(1000,2) - 1,
                'expr'		=> 'K'
            ],
            [
                'start'	=> pow(1000,2),
                'end'		=> pow(1000,3) - 1,
                'expr'		=> 'M'
            ],
            [
                'start'	=> pow(1000,3),
                'end'		=> pow(1000,4) - 1,
                'expr'		=> 'B'
            ],
            [
                'start'	=> pow(1000,4),
                'end'		=> pow(1000,5) - 1,
                'expr'		=> 'T'
            ],
            [
                'start'	=> pow(1000,5),
                'end'		=> pow(1000,6) - 1,
                'expr'		=> 'Qa'
            ],
            [
                'start'	=> pow(1000,6),
                'end'		=> pow(1000,7) - 1,
                'expr'		=> 'Qi'
            ],
        ];
    }

    /**
     * Output for Number
     * @var mixed Number Formatted
     */
	public $number = '';

    /**
     * Range Identifier for Number Like K,M,B..
     * @var string Range Indentifier
     */
    public $expression = '';

    /**
     * String output for Number
     * @var string Number Formatted with Identifier
     */
    public $out = '';

	/**
	 * @param mixed $num Number for convert to symbole
	 * @param int $precision Float Points for Number Format
	 * @return void
	 */
	public function __construct($num, $precision = 2)
	{
		$this->num = $num;
		$this->precision = $precision;
		$this->advanceExpr();
	}

	/**
	 * Calculate Advance Number Notation
	 * @return void
	 */
	private function advanceExpr()
    {
		if(abs($this->num) !== 0)
		{	
			foreach(self::advance() as $exprs){
				$divisor = $exprs['start'];
				$short = $exprs['expr'];
				if(abs($this->num) >= $exprs['start'] AND abs($this->num) <= $exprs['end']){
					break;
				}
			}

			if(($this->num % $divisor) === 0){
				$this->number = (int)$this->num / $divisor;
			} else {
				$this->number = number_format($this->num / $divisor, $this->precision);
			}
			$this->expression = $short;
			$this->out = $this->number . $short;
		} else {
			$this->out = $this->number = $this->num;
		}

	}
}