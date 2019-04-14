<?php
namespace app\admin\controller;

use think\Controller;

use app\common\model\Admin as AdminModel;

class Login extends Controller
{
	protected static function init()
	{
		$this->AdminModel = new Admin;
	}

    public function index() 
    { 
    	return view('page-login');
    }

    //登陆校验
    public function checkLogin()
    {
    	$data = input('post.');
        //简单校验
    	if(in_array('',$data)){
    		return json(['code'=>201,'msg'=>'The login information cannot be empty']);
    	}
        //验证码校验
        if(!captcha_check($data['captcha'])){
            return json(['code'=>202,'msg'=>'wrong captcha!']);
        };
    	$adminModel = new AdminModel;
    	$admin = $adminModel->findByUsername($data['username']);
    	if($admin && $admin['password'] == md5($data['password'])){
    		session('admin_id',$admin['id']);
    		return json(['code'=>200,'data'=>url('View/viewCodeList'),'msg'=>'login success!jumping...']);
    	}else{
    		return json(['code'=>202,'msg'=>'wrong user name or password !']);
    	}
    }
    
    /***退出***/
    public function logOut()
    {
        session(null);
        $this->redirect('Login/index');
    }

}
