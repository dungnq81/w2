<?php

namespace Webhd\Helpers;

class Str
{
    /**
     * @param string $string
     * @return string
     */
    public static function dashCase($string)
    {
        return str_replace('_', '-', static::snakeCase($string));
    }

    /**
     * @param int $length
     * @return string
     */
    public static function random($length = 8)
    {
        $text = base64_encode(wp_generate_password());
        return substr(str_replace(['/', '+', '='], '', $text), 0, $length);
    }

    /**
     * @param string $string
     * @return string
     */
    public static function snakeCase($string)
    {
        if (!ctype_lower($string)) {
            $string = preg_replace('/\s+/u', '', $string);
            $string = preg_replace('/(.)(?=[A-Z])/u', '$1_', $string);
            $string = mb_strtolower($string, 'UTF-8');
        }
        return str_replace('-', '_', $string);
    }
}
