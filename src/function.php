<?php

namespace Tamtamchik\NameCase;

if ( ! function_exists('str_name_case')) {
    /**
     * Wrapper for NameCase object to be used as global function.
     *
     * @param string|null $string - string to NameCase.
     * @param array|null $options - options for NameCase.
     *
     * @return string
     */
    function str_name_case(?string $string, ?array $options = []): string
    {
        return Formatter::nameCase($string, $options);
    }
}
