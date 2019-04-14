<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;

Route::rule('/','Index/Index/index');//主页

Route::rule('code$','Index/View/viewCodeList');
Route::rule('code/:id$','Index/View/viewCodeDetail');
Route::rule('blog$','Index/View/viewBlogList');
Route::rule('blog/:id$','Index/View/viewBlogDetail');

Route::rule('codesearch/:type/[:keyword]','Index/View/viewCodeList');

Route::rule('/codeajax/:page/[:type]/[:keyword]','Index/View/viewCodeAjax');//异步加载

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

];


