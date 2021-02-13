<?php


namespace App\Helpers\Filters;


class StringFilter
{
    /**
     * @param string $str
     * @return string
     */
    public function keepNumbersAndLettersOnly(string $str): string
    {
        return preg_replace('/[^A-Za-z0-9]+/u', '', $str);
    }
}
