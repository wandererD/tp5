<?php
namespace app\admin\controller;

use \think\Controller;
use \think\Request;

class Base extends Controller
{
	public function _initialize()
	{
		// echo '初始化';
		if(!session('admin_id')){
			// echo '<br/>'.'未登录，重定向登录页面';
			$this->redirect(url('Login/index'));
		}
	}

	public function _construct()
	{
		echo 'construct';
	}

	/*
	*	异步上传图片（多张）
	*	返回上传图片路径
	*/
	public function uploadImgs()
	{
		$mark = input('post.mark');//上传文件类型
		$file_ary = request()->file('files');
	    $img_url_ary = array();
	    for($i = 0 ; $i < count($file_ary) ; $i ++){
	       $img_url_ary[$i] = uploadFile($file_ary[$i],$mark);
	    }
	    // var_dump($img_url_ary);die;
	    return json(['code'=>200,'data'=>$img_url_ary,'msg'=>'']);
	}



   
}
