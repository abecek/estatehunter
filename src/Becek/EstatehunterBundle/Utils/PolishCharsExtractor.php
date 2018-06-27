<?php
/**
 * Created by PhpStorm.
 * User: micha
 * Date: 27.06.2018
 * Time: 00:13
 */

namespace Becek\EstatehunterBundle\Utils;


class PolishCharsExtractor
{
    protected static $polishChars = array( 'Ę', 'Ó', 'Ą', 'Ś', 'Ł', 'Ż', 'Ź', 'Ć', 'Ń', 'ę', 'ó', 'ą',
        'ś', 'ł', 'ż', 'ź', 'ć', 'ń' );

    protected static $equivalentChars = array( 'E', 'O', 'A', 'S', 'L', 'Z', 'Z', 'C', 'N', 'e', 'o', 'a',
        's', 'l', 'z', 'z', 'c', 'n' );


    public static function changePolishChars($string)
    {

        $string = str_replace( self::$polishChars, self::$equivalentChars, $string );
        $string = preg_replace( '#[^a-z0-9]#is', ' ', $string );
        $string = trim( $string );
        $string = preg_replace( '#\s{2,}#', ' ', $string );
        $string = str_replace( ' ', '-', $string );
        $string = strtolower($string);

        return $string;
    }
}