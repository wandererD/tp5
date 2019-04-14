<?php
namespace app\common\model;

use think\Model;
use traits\model\SoftDelete;

class base extends Model
{
	use SoftDelete;//软删除
	protected static $deleteTime = 'delete_time';
	
	protected $autoWriteTimestamp = true;//自动写入时间戳

	protected function initialize()
	{
		//初始化
	}
}
