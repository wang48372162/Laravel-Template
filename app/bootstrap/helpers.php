<?php

use Illuminate\Support\Str;

/**
 * 回傳標題
 *
 * @param  string $title
 * @param  string $sub
 * @param  string $join
 * @return string
 */
function title($title, $sub, $join = ' - ')
{
    return $sub ? "$sub$join$title" : $title;
}

/**
 * 回傳主要標題
 *
 * @return string
 */
function main_title()
{
    return config('app.name') . (config('app.slogan') ? (' | ' . config('app.slogan')) : '');
}

/**
 * 替換路由名稱成 Class 名
 *
 * @return string
 */
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

/**
 * 判斷是否為選中的路由
 *
 * @param  string $route
 * @return string
 */
function active($route)
{
    return $route === Route::currentRouteName() ? ' active' : '';
}

/**
 * @param  boolean $isDisabled
 * @return string
 */
function disabled($isDisabled)
{
    return $isDisabled ? ' disabled' : '';
}

/**
 * 將檔案路徑轉換成網址
 *
 * @param  string $url
 * @param  string $default
 * @return string
 */
function file_url($url, $default = null)
{
    if (Str::startsWith($url, ['http://', 'https://'])) {
        return $url;
    }

    if ($url) {
        return Storage::disk(config('admin.upload.disk'))->url($url);
    }

    return $default;
}

/**
 * 改變陣列的順序
 *
 * @param array $array
 * @param array $new_sort_array
 * @return array
 */
function array_new_sort($array, $new_sort_array)
{
    $result = [];

    foreach ($new_sort_array as $index) {
        $result[] = $array[$index];
    }

    return $result;
}
