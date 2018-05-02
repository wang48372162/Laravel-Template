<?php

namespace App\Presenters;

use Illuminate\Http\Request;

class AppPresenter
{
    /**
     * Public function
     */
    /**
     * 從 Request 中取出當前 Route 的 Name
     *
     * @param $request
     * @return Routename
     */
    public function getRoutename($request)
    {
        $routename = $request->route()->getName();
        return $routename;
    }
    /**
     * 回傳網站分頁標題
     *
     * @param String $request
     * @return String 當前語言、分頁的標題
     */
    public function page($request)
    {
        return __('pages.' . $this->getRoutename($request));
    }
    /**
     * 回傳網站全部分頁標題
     *
     * @return Array 當前語言、全部分頁的標題
     */
    public function pages()
    {
        return __('pages');
    }

    /**
     * URL
     */
    /**
     * 回傳網站主標題
     *
     * @return String 網站主標題
     */
    public function getMainTitle()
    {
        return config('app.name');
    }
    /**
     * 回傳完整標題 (分頁標題 + 網站主標題)
     *
     * @param $request
     * @param string $joiner
     * @return String 標題
     */
    public function getTitle($request, $joiner = ' - ')
    {
        $resultTitle = '';
        $title = $this->getRoutename($request);
        if ($title != 'index') {
            $resultTitle = $this->page($request) . $joiner;
        }
        $resultTitle .= $this->getMainTitle();
        return $resultTitle;
    }
}