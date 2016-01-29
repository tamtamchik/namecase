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
        $options = array_merge(self::$options, $options);

        // Do not do anything if string is mixed and lazy option is true.
        if ($options['lazy']) {
            if (self::skipMixed($string)) return $string;
        }

        $local = mb_strtolower($string, self::$encoding);

        // Capitalize
        $local = mb_convert_case($string, MB_CASE_TITLE, self::$encoding);

        if ($options['irish']) {
            $local = self::fixIrish($local);
        }

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
        $firstLetterLower = $string[0] == mb_strtolower($string[0], self::$encoding);
        $allLowerOrUpper  = (mb_strtolower($string, self::$encoding) == $string || mb_strtoupper($string, self::$encoding) == $string);

        return ! ($firstLetterLower || $allLowerOrUpper);
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
                return $matches[1]
                . mb_strtoupper(mb_substr($matches[2], 0, 1, self::$encoding), self::$encoding)
                . mb_substr($matches[2], 1, null, self::$encoding);
            }, $string);

            $exceptions = [
                '\bMacEdo'     => 'Macedo',
                '\bMacEvicius' => 'Macevicius',
                '\bMacHado'    => 'Machado',
                '\bMacHar'     => 'Machar',
                '\bMacHin'     => 'Machin',
                '\bMacHlin'    => 'Machlin',
                '\bMacIas'     => 'Macias',
                '\bMacIulis'   => 'Maciulis',
                '\bMacKie'     => 'Mackie',
                '\bMacKle'     => 'Mackle',
                '\bMacKlin'    => 'Macklin',
                '\bMacKmin'    => 'Mackmin',
                '\bMacQuarie'  => 'Macquarie',
            ];

            // Now fix "Mac" exceptions
            foreach ($exceptions as $pattern => $replacement) {
                $string = mb_ereg_replace($pattern, $replacement, $string);
            }
        }

        return mb_ereg_replace('Macmurdo', 'MacMurdo', $string);
    }
}
