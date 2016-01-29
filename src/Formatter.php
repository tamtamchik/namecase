<?php namespace Tamtamchik\NameCase;

/**
 * Class Formatter.
 */
class Formatter
{
    private static $options = [
        'lazy'    => true,
        'irish'   => true,
        'spanish' => true,
    ];

    private static $encoding = 'UTF-8';

    /**
     * @param string $string
     * @param array  $options
     *
     * @return string
     */
    public static function nc($string, array $options = [])
    {
        $encoding = mb_internal_encoding();

        var_dump($encoding);

        mb_internal_encoding(self::$encoding);

        $options = array_merge(self::$options, $options);

        // Do not do anything if string is mixed and lazy option is true.
        if ($options['lazy']) {
            if (self::skipMixed($string)) return $string;
        }

        $local = mb_strtolower($string);

        // Capitalize
        $local = self::capitalize($local);

        if ($options['irish']) {
            $local = self::fixIrish($local);
        }

        mb_internal_encoding($encoding);

        return $local;
    }

    /**
     * Skip if string is mixed case.
     *
     * @param string $string
     *
     * @return bool
     */
    private static function skipMixed($string)
    {
        $firstLetterLower = $string[0] == mb_strtolower($string[0]);
        $allLowerOrUpper  = (mb_strtolower($string) == $string || mb_strtoupper($string) == $string);

        return ! ($firstLetterLower || $allLowerOrUpper);
    }

    /**
     * Capitalize first letters.
     *
     * @param string $string
     *
     * @return string
     */
    private static function capitalize($string)
    {
        $string = \mb_ereg_replace_callback('\b\w', function ($matches) {
            return mb_strtoupper($matches[0]);
        }, $string);

        // Lowercase 's
        $string = \mb_ereg_replace_callback('\'\w\b', function ($matches) {
            return mb_strtolower($matches[0]);
        }, $string);

        return $string;
    }

    /**
     * Fix Irish names.
     *
     * @param string $string
     *
     * @return string
     */
    private static function fixIrish($string)
    {
        if (mb_ereg_match('\bMac[A-Za-z]{2,}[^aciozj]\b', $string) || mb_ereg_match('\bMc', $string)) {
            $string = \mb_ereg_replace_callback('\b(Ma?c)([A-Za-z]+)', function ($matches) {
                return $matches[1] . mb_strtoupper(mb_substr($matches[2], 0, 1)) . mb_substr($matches[2], 1);
            }, $string);

            // Now fix "Mac" exceptions
            $string = mb_ereg_replace('\bMacEdo', 'Macedo', $string);
            $string = mb_ereg_replace('\bMacEvicius', 'Macevicius', $string);
            $string = mb_ereg_replace('\bMacHado', 'Machado', $string);
            $string = mb_ereg_replace('\bMacHar', 'Machar', $string);
            $string = mb_ereg_replace('\bMacHin', 'Machin', $string);
            $string = mb_ereg_replace('\bMacHlin', 'Machlin', $string);
            $string = mb_ereg_replace('\bMacIas', 'Macias', $string);
            $string = mb_ereg_replace('\bMacIulis', 'Maciulis', $string);
            $string = mb_ereg_replace('\bMacKie', 'Mackie', $string);
            $string = mb_ereg_replace('\bMacKle', 'Mackle', $string);
            $string = mb_ereg_replace('\bMacKlin', 'Macklin', $string);
            $string = mb_ereg_replace('\bMacKmin', 'Mackmin', $string);
            $string = mb_ereg_replace('\bMacQuarie', 'Macquarie', $string);
        }

        return mb_ereg_replace('Macmurdo', 'MacMurdo', $string);
    }
}
