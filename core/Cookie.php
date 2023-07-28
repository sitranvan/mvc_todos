<?php
class Cookie
{
    public static function set($name = '', $value = '', $expires = 0, $path = '/')
    {
        setcookie($name, $value, $expires, $path);
    }
    public static function get($name)
    {
        if (isset($_COOKIE[$name])) {
            return $_COOKIE[$name];
        }
    }
}
