<?php namespace Tamtamchik\NameCase;

/**
 * Class HTMLEntities.
 */
class HTMLEntities
{
    private const STANDARD_REGEX = '&([A-Za-z][A-Za-z0-9]+|#[0-9]+|#[xX][0-9A-Fa-f]+);';
    private const COMMON_REGEX = '&([aA][mM][pP]|[lL][tT]|[gG][tT]|[qQ][uU][oO][tT])\b';

    /**
     * Keep HTML entities lower-case after name capitalization.
     *
     * @param string $name
     *
     * @return string
     */
    public static function adjust(string $name): string
    {
        $name = mb_ereg_replace_callback(
            self::STANDARD_REGEX,
            function ($matches) {
                return mb_strtolower($matches[0]);
            },
            $name
        );

        return mb_ereg_replace_callback(
            self::COMMON_REGEX,
            function ($matches) {
                return mb_strtolower($matches[0]);
            },
            $name
        );
    }

    /**
     * Strip HTML entities from case checks.
     *
     * @param string $name
     *
     * @return string
     */
    public static function strip(string $name): string
    {
        $name = mb_ereg_replace(
            self::STANDARD_REGEX,
            '',
            $name
        );

        return mb_ereg_replace(
            self::COMMON_REGEX,
            '',
            $name
        );
    }
}
