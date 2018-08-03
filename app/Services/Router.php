<?php

namespace App\Services;

class Router
{
    static private $pageTitle;

    /**
     * 回傳當前 Route 的 Name
     */
    static public function routeName()
    {
        $route = request()->route();
        return $route ? $route->getName() : null;
    }

    static public function getPageTitle()
    {
        return self::$pageTitle;
    }

    static public function setPageTitle($pageTitle)
    {
        self::$pageTitle = $pageTitle;
    }
}
