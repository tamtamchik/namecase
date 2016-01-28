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

    /**
     * @param string $string
     * @param array  $options
     *
     * @return string
     */
    public static function nc($string, array $options = [])
    {
        $options = array_merge(self::$options, $options);

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

        if ($options['irish']) {

            if (mb_ereg_match('\bMac[A-Za-z]{2,}[^aciozj]\b', $local) || mb_ereg_match('\bMc', $local)) {
                $local = mb_ereg_replace_callback('\b(Ma?c)([A-Za-z]+)', function ($matches) {
                    return $matches[1]
                    . mb_strtoupper(mb_substr($matches[2], 0, 1))
                    . mb_substr($matches[2], 1);
                }, $local);

                // Now fix "Mac" exceptions
                $local = mb_ereg_replace('\bMacEdo', 'Macedo', $local);
                $local = mb_ereg_replace('\bMacEvicius', 'Macevicius', $local);
                $local = mb_ereg_replace('\bMacHado', 'Machado', $local);
                $local = mb_ereg_replace('\bMacHar', 'Machar', $local);
                $local = mb_ereg_replace('\bMacHin', 'Machin', $local);
                $local = mb_ereg_replace('\bMacHlin', 'Machlin', $local);
                $local = mb_ereg_replace('\bMacIas', 'Macias', $local);
                $local = mb_ereg_replace('\bMacIulis', 'Maciulis', $local);
                $local = mb_ereg_replace('\bMacKie', 'Mackie', $local);
                $local = mb_ereg_replace('\bMacKle', 'Mackle', $local);
                $local = mb_ereg_replace('\bMacKlin', 'Macklin', $local);
                $local = mb_ereg_replace('\bMacKmin', 'Mackmin', $local);
                $local = mb_ereg_replace('\bMacQuarie', 'Macquarie', $local);
            }
            $local = mb_ereg_replace('Macmurdo', 'MacMurdo', $local);
        }

        return $local;
    }
}
