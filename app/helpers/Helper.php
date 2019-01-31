<?php

namespace App\Helpers;

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

    public static function highlightNeedle($str,$search)
    {
        $highlightcolor = "	#FF4500";
        $occurrences = substr_count(strtolower($str), strtolower($search));
        $newstring = $str;
        $match = [];
        
        for ($i=0;$i<$occurrences;$i++) {
            $match[$i] = stripos($str, $search, $i);
            $match[$i] = substr($str, $match[$i], strlen($search));
            $newstring = str_replace($match[$i], '[#]'.$match[$i].'[@]', strip_tags($newstring));
        }
        
        $newstring = str_replace('[#]', '<span style="color: '.$highlightcolor.';">', $newstring);
        $newstring = str_replace('[@]', '</span>', $newstring);
        return $newstring;
    }
}