<?php
namespace app\admin\controller;

// use think\Db;

use app\admin\controller\Base as baseController;
use app\common\model\ViewCode as ViewCodeModel;

class View extends baseController
{
	public function _initialize()
	{
		parent::_initialize();
		// $this->request = Request::instance();

        //获取当前控制器
        $action = strtolower(request()->action());
        $this->assign('action',$action);
	}
	

    /****************** viewCode beg *****************/
    //全部数据
    public function viewCodeList() 
    { 
        $list = model('ViewCode')->getList();
        $this->assign('list',$list);
    	return view();
    }

    /*单个view-code 添加*/
    public function viewCodeAdd()
    {
    	if(request()->method() == 'POST'){
            $post = input('post.');
            //简单校验空值，后期补充，使用tp5自带验证器
            $this->postCheck($post);
            $res = model('ViewCode')->saveWithData($post); 
            if($res){
                return json(['code'=>200,'msg'=>'Added successfully!']);
            }  
            return json(['code'=>200,'msg'=>'Added failed!']);
        }else{
            $typeList = db('type')->select();
            $this->assign('typeList',$typeList);
            return view();
        }
    }

    //详情 修改
    public function viewCodeDetail($id='')
    {
        if(request()->method() == 'POST'){
            $post = input('post.');
            $post['id'] = $id;
            //简单校验空值，后期补充，使用tp5自带验证器
            $this->postCheck($post);
            $res = model('ViewCode')->updateWithData($post);
            if($res !== false){
                return json(['code'=>200,'msg'=>'update success！']);
            }else{
                return json(['code'=>201,'msg'=>'update fail!']);
            }
        }else{
            $typeList = db('type')->select();
            $this->assign('typeList',$typeList);
            $list = model('ViewCode')->findByWhere(['id'=>$id]);
            $this->assign('list',$list);
            return view();
        }
    }

    //软删除文章
    public function viewCodeDel($id='')
    {
        if(!$id){
            return json(['code'=>201,'delete failed!']);
        }
        $res = model('ViewCode')->delByID($id);
        if($res){
            return json(['code'=>200,'delete success!']);
        }
        return json(['code'=>201,'delete failed!']);
    }

    /************** viewCode end ******************/

    /************** viewBlog beg ****************/

    //列表页
    public function viewBlogList()
    {
        $list = model('ViewBlog')->getList('id,title,create_time','id desc');
        $this->assign('list',$list);
        return view();
    }

    //单个blog 添加
    public function viewBlogAdd()
    {
        if(request()->method() == 'POST'){
            $post = input('post.');
            $this->postCheck($post);
            // $post['content'] = serialize($post['content']);
            $res = model('ViewBlog')->saveWithData($post);
            if($res){
                return json(['code'=>200,'msg'=>'Added success!']);
            }
            return json(['code'=>200,'msg'=>'Added failed!']);
        }else{
            return view();
        }
    }

    //详情 修改
    public function viewBlogDetail($id)
    {
        if(request()->method() == 'POST'){
            $post = input('post.');
            $this->postCheck($post);
            $res = model('ViewBlog')->viewBlogUpdate($post);
            if($res){
                return json(['code'=>200,'msg'=>'Updated success!']);
            }
            return json(['code'=>201,'msg'=>'Updated failed!']);
        }
        $list = model('ViewBlog')->findByWhere(['id'=>$id]);
        $this->assign('list',$list);
        return view();
    }

    //删除
    public function viewBlogDel($id='')
    {
        //从get方式或者post方式 接受数据
        $id = $id ? $id : input('post.data');
        if(!$id){
            return json(['code'=>201,'delete failed!']);
        }
        $res = model('ViewBlog')->delByID($id);
        if($res){
            return ['code'=>200,'msg'=>'delete success!'];
        }
        return ['code'=>201,'msg'=>'deleted failed!'];
    }

    /************** viewBlog end ****************/

    //文章内容校验
    public function postCheck($data)
    {
        //简单校验空值，后期补充，使用tp5自带验证器
        if(in_array('',$data)){
            return json(['code'=>201,'msg'=>'haved null value']);
        }
    }

}
