<?php
namespace app\index\controller;

use app\index\controller\Base;

class Index extends Base
{
    /**
     * 个人博客
     */
    public function index()
    {
        $codeList = model('ViewCode')->getListWithLimit(6,'create_time desc');
        $blogList = model('ViewBlog')->getListWithLimit(3,'create_time desc');
        $this->assign(['codeList'=>$codeList,'blogList'=>$blogList]);
    	return view();
    }

    /**
     * 个人简历 简版
     */
    public function vita() 
    { 
    	return view();
    }

    public function test()
    {
        $this->success();
    }

}
