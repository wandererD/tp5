<?php
namespace app\common\model;


use think\Db;
use think\Model;

use app\common\model\Base;

class ViewCode extends Base
{
	protected function initialize()
	{
		//初始化
	}


	//单个记录获取
	public function findByWhere($where)
	{
		return $this->where($where)->find();
	}

	//获取viwecode数据 所有
	public function getList($type='',$keyword='',$limit=12,$field='c.*,t.type_name',$order='c.create_time desc')
	{
		$where = '1=1';
		if($type && $type != 'all'){
			// $where['c.type'] = $type;
			$where .= ' and c.type = "'.$type.'" ';
		}
		if($keyword){
			$where .= " and c.title like '%".$keyword."%' ";
			// $where = [
			// 	["c.title","like","%".$keyword."%"],
			// ];
		}	
		return $this
				->alias('c')
				->join('type t','c.type = t.id')
				->where($where)
				->field($field)
				->order($order)
				->limit($limit)
				->select();
	}

	//异步获取数据
	public function getListAjax($type='all',$keyword='',$field='c.id,c.title,c.create_time,t.type_name',$order='c.create_time desc')
	{
		$where = '1=1';
		if($type && $type != 'all'){
			$where .= ' and c.type = "'.$type.'" ';
		}
		if($keyword){
			$where .= " and c.title like '%".$keyword."%' ";
		}	
		return $this
				->alias('c')
				->join('type t','c.type = t.id','left')
				->where($where)
				->field($field)
				->order($order)
				->paginate(12,false,['query' => request()->param(), ]);
	}

	//获取 n条数据
	public function getListWithLimit($limit='',$order='')
	{
		return $this->limit($limit)->order($order)->select();
	}

	//添加
	public function saveWithData($data)
	{
		return $this->save($data);
	}

	//更新 显式指定 更新操作
	public function updateWithData($data)
	{
		return $this->isUpdate(true)->save($data);
	}

	//软删除
	public function delByID($id)
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

	/*获取器*/
	public function getImgsAttr($imgs)
	{
		return unserialize($imgs);
	}

}
