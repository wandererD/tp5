<?php
namespace app\common\model;

use think\Model;

use app\common\model\Base;
// use traits\model\SoftDelete;

class ViewBlog extends Base
{
	// protected $autoWriteTimestamp = true;

	// use SoftDelete;
	// protected $deleteTime = 'delete_time';

	protected function initialize()
	{
		//初始化
	}

	//获取全部数据
	public function getList($field='*',$order='')
	{
		return $this->order($order)->field($field)->select();
	}

	//获取 n条数据
	public function getListWithLimit($limit='',$order='')
	{
		return $this->limit($limit)->order($order)->select();
	}

	//添加view blog
	public function saveWithData($data='')
	{
		return $this->isUpdate(false)->save($data);
	}

	//条件查询 单条记录
	public function findByWhere($where='')
	{
		return $this->where($where)->find();
	}

	//软删除
	public function delByID($id='')
	{
		return $this->where(['id'=>$id])->delete();
	}

	//批量软删除
	public function delByWhere($where)
	{
		$list = $this->all($where);
		//tp5.0 不能批量软删除
		foreach ($list as $key => $model) {
			$model->delete();
		}
	}

	//更新
	public function viewBlogUpdate($data)
	{	
		return $this->isUpdate(true)->save($data);
	}

	/**************获取器 begin*************/

	// public function getContentAttr($content)
	// {
	// 	return unserialize($content);
	// }

	/**************获取器 end*************/

}
