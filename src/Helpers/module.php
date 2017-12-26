<?php

if ( ! function_exists('active_link'))
{
    function active_link($path)
    {
        if (request()->path() == $path)
        {
            return 'active';
        }
        return false;
    }
}


if ( ! function_exists('active_uri'))
{
    function active_uri($path)
    {
        if (request()->getRequestUri() == $path or '/'.request()->getRequestUri() == $path)
        {
            return 'active';
        }
        return false;
    }
}

if (!function_exists('active_lang'))
{
    function active_lang($lang)
    {
        if (app()->getLocale() == $lang)
        {
            return 'active';
        }
        return false;
    }
}

if ( ! function_exists('active_link_with_class'))
{
    function active_link_with_class($path, $class)
    {
        if (request()->path() == $path or '/'.request()->path() == $path)
        {
            return $class;
        }
        return false;
    }
}

if ( ! function_exists('active_link_sub'))
{
    function active_link_sub($path)
    {
        if ('/'.request()->segment(1).'/'.request()->segment(2) == $path)
        {
            return 'active';
        }
        return false;
    }
}

if ( ! function_exists('active_link_uri_with_class'))
{
    function active_link_uri_with_class($path, $class)
    {
        if (request()->getRequestUri() == $path)
        {
            return $class;
        }
        return false;
    }
}

if ( ! function_exists('trans_url'))
{
    function trans_url($str, $append_date = false)
    {
        $tr = array(
            "А" => "a", "Б" => "b", "В" => "v", "Г" => "g", "Д" => "d",
            "Е" => "e", "Ё" => "yo", "Ж" => "j", "З" => "z", "И" => "i",
            "Й" => "y", "К" => "k", "Л" => "l", "М" => "m", "Н" => "n",
            "О" => "o", "П" => "p", "Р" => "r", "С" => "s", "Т" => "t",
            "У" => "u", "Ф" => "f", "Х" => "h", "Ц" => "c", "Ч" => "ch",
            "Ш" => "sh", "Щ" => "sch", "Ъ" => "", "Ы" => "yi", "Ь" => "",
            "Э" => "e", "Ю" => "yu", "Я" => "ya", "а" => "a", "б" => "b",
            "в" => "v", "г" => "g", "д" => "d", "е" => "e", "ё" => "yo", "ж" => "j",
            "з" => "z", "и" => "i", "й" => "y", "к" => "k", "л" => "l",
            "м" => "m", "н" => "n", "о" => "o", "п" => "p", "р" => "r",
            "с" => "s", "т" => "t", "у" => "u", "ф" => "f", "х" => "h",
            "ц" => "c", "ч" => "ch", "ш" => "sh", "щ" => "sch", "ъ" => "y",
            "ы" => "y", "ь" => "", "э" => "e", "ю" => "yu", "я" => "ya",
            " " => "-", "." => "", "," => "", "/" => "-", "!" => "", "?" => "", "\"" => "", "'" => "", "%" => "", "["
            => "", "]" => "", "{" => "", "}" => ""
        );

        $str = trim($str);

        if ($append_date) {
            $result = time() . '-' . strtr($str, $tr);
        } else {
            $result = strtr($str, $tr) . '-'. time();
        }

        return $result;
    }
}