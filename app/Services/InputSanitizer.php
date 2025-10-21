<?php

namespace App\Services;

class InputSanitizer
{
    /**
     * Strip all HTML tags from input (default)
     */
    public static function sanitizeText(string $value): string
    {
        return trim(strip_tags($value));
    }

    /**
     * Allow a small set of tags (e.g., <b>, <i>, <strong>, <em>, <a>)
     */
    public static function sanitizeHtml(string $value, array $allowed = ['b','i','strong','em','a']): string
    {
        $allowedString = '';
        foreach ($allowed as $tag) {
            $allowedString .= '<' . $tag . '>';
        }

        return trim(strip_tags($value, $allowedString));
    }
}
