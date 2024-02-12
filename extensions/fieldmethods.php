<?php

if (!function_exists('is_base64_string_s')) {
    // https://stackoverflow.com/a/51877882
    function is_base64_string_s(string $str, $enc = array('UTF-8', 'ASCII'))
    {
        return !(($b = base64_decode($str, TRUE)) === FALSE) && in_array(mb_detect_encoding($b), $enc);
    }
}

return [
    'fromBase64' => function ($field) {
        $value = trim((string) $field->value());
        if (is_base64_string_s($value)) {
            $field->value = base64_decode($value);
        }
        return $field;
    },
];
