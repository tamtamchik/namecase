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

    /**
     * @param string $string
     * @param array  $options
     *
     * @return string
     */
    public static function nc($string, array $options = [])
    {
        $options = array_merge(self::DEFAULT_OPTIONS, $options);

        //Skip if string is mixed case
        if ($options['lazy']) {
            $firstLetterLower = $string[0] == mb_strtolower($string[0]);
            $allLowerOrUpper  = (mb_strtolower($string) == $string || mb_strtoupper($string) == $string);

            if ( ! ($firstLetterLower || $allLowerOrUpper)) return $string;
        }

        $local = mb_strtolower($string);

        // Capitalize
        $local = mb_ereg_replace_callback('\b\w', function ($matches) {
            return mb_strtoupper($matches[0]);
        }, $local);

        $local = mb_ereg_replace_callback('\'\w\b', function ($matches) {
            return mb_strtolower($matches[0]);
        }, $local); # Lowercase 's

        return $local;
    }
}
