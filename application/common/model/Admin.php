<?php
namespace app\common\model;

use think\Model;

class Admin extends Model
{
	protected function initialize()
	{
		//初始化
	}

	/*
	*   param $username
	*	return admin_info
	*/
	public function findByUsername($username = '')
	{
		return $this->where(['username'=>$username])->find();
	}

	/*--------获取器-------*/
	// public function getPasswordAttr()
	// {

	// }

}
