<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * 个人设置页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function setting() {
        return view('user.setting');
    }

    /**
     * 个人设置行为
     * @return null
     */
    public function settingStore() {
        return null;
    }
}
