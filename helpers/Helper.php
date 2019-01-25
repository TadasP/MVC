<?php

class Helper
{
    public static function getSlug($line)
    {
        $line = strtolower($line);
        $line = str_replace(' ', '-', $line);
        return $line;
    }

    public static function generatePassword($string)
    {
        $password = md5(md5($string.'salt'));
        return $password;
    }
}