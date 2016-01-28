<?php namespace Tamtamchik\NameCase;

/**
 * Class Formatter.
 */
class Formatter
{
    const DEFAULT_OPTIONS = [
        'lazy'    => true,
        'irish'   => true,
        'spanish' => true,
    ];

    private static function upper($matches)
    {
        return strtoupper($matches[0]);
    }

    private static function lower($matches)
    {
        return strtolower($matches[0]);
    }

    /**
     * @param string $string
     * @param array  $options
     *
     * @return string
     */
    public static function nc($string, array $options = [])
    {
        //$options = array_merge(self::DEFAULT_OPTIONS, $options);
        //
        ////Skip if string is mixed case
        //if ($options['lazy']) {
        //    $firstLetterLower = $string[0] == strtolower($string[0]);
        //    $allLowerOrUpper  = (strtolower($string) == $string || strtoupper($string) == $string);
        //
        //    if ( ! $firstLetterLower || ! $allLowerOrUpper) return $string;
        //}

        $local = strtolower($string);

        // Capitalize
        $local = preg_replace_callback('/\b\w/', function ($matches) {
            return strtoupper($matches[0]);
        }, $local);

        $local = preg_replace_callback('/\'\w\b/', function ($matches) {
            return strtolower($matches[0]);
        }, $local); # Lowercase 's

        return $local;
    }
}
