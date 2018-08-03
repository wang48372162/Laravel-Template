<?php

namespace App\Services;

/**
 * MenuRoute Menu路由 麵包屑清單
 */
class MenuRoute
{
    /**
     * 路由項目清單
     *
     * @var array
     */
    static private $menu = [];

    /**
     * 麵包屑清單
     *
     * @var array
     */
    static private $breadcrumbList = [];

    /**
     * Menu路由
     *
     * @var array
     */
    static private $menuRoute = [];

    /**
     * 產生麵包屑清單
     *
     * @param string $targetName
     * @return self
     */
    static public function breadcrumbList($targetName)
    {
        self::$menu = config('data.menu');
        if (self::$menu) {
            self::$breadcrumbList = self::breadcrumbListCycle(self::$menu, $targetName);
        }
        return new self;
    }

    /**
     * 麵包屑清單 循環
     *
     * @param array $target
     * @param string $targetName
     * @return array 麵包屑清單
     */
    static private function breadcrumbListCycle($target, $targetName)
    {
        foreach ($target as $item) {
            // 如果當前元素為目標元素 即返回當前元素
            if ($item['name'] === $targetName) {
                // 刪除子元素
                unset($item['children']);
                return [$item];
            }
            // 判斷是否有子元素
            if (isset($item['children'])) {
                // 遞迴循環
                if ($breadAry = self::breadcrumbListCycle($item['children'], $targetName)) {
                    if (is_array($breadAry)) {
                        // 刪除子元素
                        unset($item['children']);
                        // 加入至麵包屑清單陣列
                        array_unshift($breadAry, $item);
                        return $breadAry;
                    }
                }
            }
        }
        return [];
    }

    /**
     * 麵包屑清單的最後一個路由 - 當前Menu路由
     *
     * @param string $routeName
     * @return self
     */
    static public function current($routeName)
    {
        self::breadcrumbList($routeName);
        if (count(self::$breadcrumbList)) {
            self::$menuRoute = end(self::$breadcrumbList);
        }
        return new self;
    }

    /**
     * 麵包屑清單的倒數第2個路由 - 父級Menu路由
     *
     * @param string $routeName
     * @return self
     */
    static public function parent($routeName)
    {
        self::breadcrumbList($routeName);
        $count = count(self::$breadcrumbList);
        if ($count > 1) {
            self::$menuRoute = self::$breadcrumbList[$count - 2];
        } else {
            if (self::$menu) {
                self::$menuRoute = self::$menu[0];
            }
        }
        return new self;
    }

    /**
     * 取得麵包屑清單
     *
     * @return array
     */
    static public function list()
    {
        return self::$breadcrumbList;
    }

    /**
     * 取得Menu路由
     *
     * @return array
     */
    static public function get()
    {
        return self::$menuRoute;
    }

    /**
     * 返回完整路由名稱
     *
     * @param string $routeName
     * @return string
     */
    static public function fullRouteName($routeName)
    {
        self::breadcrumbList($routeName);
        if (count(self::$breadcrumbList)) {
            return array_reduce(self::$breadcrumbList, function ($s1, $s2) {
                return !$s1 ? $s2['name'] : $s1 . '.' . $s2['name'];
            });
        }
        return null;
    }

    /**
     * 返回Menu路由路徑
     *
     * @return string
     */
    static public function path()
    {
        if (count(self::$menuRoute)) {
            $menuRoute = self::$menuRoute;
        } else {
            return '';
        }
        $is = $menuRoute['page'] ?? false;
        $hash = '';
        if (isset($menuRoute['hash'])) {
            $hash = $menuRoute['hash'] ? ('#' . $menuRoute['hash']) : '';
        }
        $params = [];
        if (isset($menuRoute['params'])) {
            // 注意: 當前頁面必須包含目的路由的Params
            foreach ($menuRoute['params'] as $param) {
                $params[$param] = request()->route($param);
            }
        }
        return route(
            self::fullRouteName($menuRoute['name']),
            array_merge($params, self::query_page($is))
        ) . $hash;
    }

    /**
     * 抓本頁面的page Param
     *
     * @param boolean $is
     * @return string
     */
    static public function query_page($is = true)
    {
        $page = request()->query('page');
        if ($page && $page != 1 && $is) {
            return ['page' => $page];
        }
        return [];
    }

    /**
     * page Param 文字
     *
     * @param boolean $is
     * @return string
     */
    static public function query_page_str($is = true)
    {
        if (count(self::query_page($is))) {
            return http_build_query(self::query_page($is));
        }
        return '';
    }
}
