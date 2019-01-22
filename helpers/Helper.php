<?php

class Helper
{
    public static function getSlug($line)
    {
        $line = strtolower($line);
        $line = str_replace(' ', '-', $line);
        return $line;
    }
}