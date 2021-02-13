<?php


namespace App\Facades\Helpers\Filters;

use Illuminate\Support\Facades\Facade;

class StringFilter extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return \App\Helpers\Filters\StringFilter::class;
    }

}
