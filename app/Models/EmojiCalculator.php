<?php

namespace App\Models;

use function GuzzleHttp\Psr7\str;

/**
 * Class EmojiCalculator
 *
 * @package App\Models
 */
class EmojiCalculator extends Calculator
{
    protected $expression;

    protected $allowedOperators = [
        'times'      => '*',
        'devided by' => '/',
        'plus'       => '+',
        'minus'      => '-'
    ];

    protected $allowedChars = [
        '30'    => '0',
        '31'    => '1',
        '32'    => '2',
        '33'    => '3',
        '34'    => '4',
        '35'    => '5',
        '36'    => '6',
        '37'    => '7',
        '38'    => '8',
        '39'    => '9',
        '2A'    => '*',
        '2D'    => '-',
        '2F'    => '/',
        '2B'    => '+',
        '25'    => '%',
        '28'    => '(',
        '29'    => ')',
        '2716'  => '*',
        '2795'  => '+',
        '2796'  => '-',
        '2797'  => '/',
        '0030'  => '0',
        '0031'  => '1',
        '0032'  => '2',
        '0033'  => '3',
        '0034'  => '4',
        '0035'  => '5',
        '0036'  => '6',
        '0037'  => '7',
        '0038'  => '8',
        '0039'  => '9',
        '1F3B1' => '8',
        '1F51F' => '10',
        '1F4AF' => '100',
    ];

    protected $resultEmoji = [
        '100' => '1F4AF',
        '10'  => '1F51F',
    ];

    protected function getExpressionLength(): ?int
    {
        return mb_strlen($this->expression, 'UTF-8');
    }

    public function uniord($c)
    {
        $ord0 = ord($c[0]);
        if ($ord0>=0   && $ord0<=127)
                return $ord0;

        $ord1 = ord($c[1]);
        if ($ord0>=192 && $ord0<=223)
                return ($ord0-192)*64 + ($ord1-128);

        $ord2 = ord($c[2]);
        if ($ord0>=224 && $ord0<=239)
                return ($ord0-224)*4096 + ($ord1-128)*64 + ($ord2-128);

        $ord3 = ord($c[3]);
        if ($ord0>=240 && $ord0<=247)
                return ($ord0-240)*262144 + ($ord1-128)*4096 + ($ord2-128)*64 + ($ord3-128);

        return false;
    }

    protected function replaceEmoji(): void
    {
        $output = [];
        for($i = 0; $i < $this->getExpressionLength(); $i++) {
            $unicodeHex = strtoupper(dechex($this->uniord(mb_substr($this->expression, $i, 1))));

            if(true === key_exists($unicodeHex, $this->allowedChars)) {
                $output[] = $this->allowedChars[$unicodeHex];
            }
        }

        $this->expression = join('', $output);
    }

    protected function replaceWordOperations(): void
    {
        foreach ($this->allowedOperators as $word => $char) {
            $this->expression = str_replace($word, $char, $this->expression);
        }
    }

    public function calculate(string $input): string
    {
        mb_internal_encoding('UTF-8');

        $this->expression = strip_tags(trim($input));

        $this->replaceWordOperations();
        $this->replaceEmoji();

        $result = (int) eval("return $this->expression;");

        return $this->convertNumberToEmoji($result);
    }

    public function convertNumberToEmoji(?int $number): string
    {
        $string = strval($number);

        foreach ($this->resultEmoji as $value => $emoji) {

            $string = str_replace(
                $value,
                mb_convert_encoding("&#x$emoji;", 'UTF-8', 'HTML-ENTITIES'),
                $string
            );
        }

        return $string;
    }
}
