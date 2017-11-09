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
