<?php
namespace app\index\controller;

use \think\Controller;
use app\admin\model\ViewCode;

/**
 * 视图模块 
 */
class View extends Base
{
    /*******------ ViewCode beg ------*******/

    /**
    * 代码视图列表
    */
    public function viewCodeList($type='all',$keyword='')
    {
        $list = model('ViewCode')->getList($type,$keyword,$limit=12);
        $typeList = db('type')->select();
        $this->assign(['list'=>$list,'typeList'=>$typeList,'type'=>$type,'keyword'=>$keyword,'view_code'=>1]);
    	return view();
    }

    /*异步加载*/
    public function viewCodeAjax($type='all',$keyword='')
    {
        $list = model('ViewCode')->getListAjax($type,$keyword)->toArray();
        if(!$list || !$list['data']){
            return json(['code'=>201,'msg'=>'no more data']);
        }
        return json(['code'=>200,'data'=>$list,'next_page'=>input('page')+1]);
    }

    /**
     *  viewcode 详情页
     */
    public function viewCodeDetail($id='')
    {
        $list = model('ViewCode')->findByWhere(['id'=>$id]);
        $this->assign('list',$list);
        return view();
    }

    /*******------ ViewCode end ------*******/

    /*******------ ViewBlog beg ------*******/

    /**
    * 博客视图列表
    */
    public function viewBlogList()
    {
        $list = model('ViewBlog')->getList();
        $this->assign('list',$list);
        return view();
    }

    /**
     *  viewblog 详情页
     */
    public function viewBlogDetail($id='')
    {
        $list = model('ViewBlog')->findByWhere(['id'=>$id]);
        $this->assign('list',$list);
        return view();
    }

    /*******------ ViewBlog end ------*******/


}
