<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Db;
    

// 应用公共文件

/*	D_
*	上传文件
*	返回上传路径
*	$file -- 目标文件
*	$filename -- 保存文件名前缀标识
*/
function uploadFile($file,$mark='')
{
     $dir = date('Ymd',time());
     $filename = $mark.'_'.rand(100000,999999).'_'.time();
     $info = $file->move(ROOT_PATH.'public','upload'.DS.'images'.DS.$mark.DS.$dir.DS.$filename);
    // if($info){
    //     echo $info->getExtension(); 
    //     echo $info->getSaveName(); 
    //     echo $info->getFilename(); 
    // }else{
    //     echo $file->getError(); echo '|';
    // }
     // var_dump($info);
    if($info){
        // return ROOT_PATH.$info->getSaveName(); 
        return $info->getSaveName(); 
    }else{
        return $info->getExtension();
    }
}

/* 打印sql
*  $model:指定模型
*/
function sql($model='')
{
    if(!$model){
        echo Db::getLastSql();
    }else{
        echo $model->getLastSql();
    }
    
}

function getMenuActive($str='')
    {
        if(strtolower($str) == request()->action()){
            return 'active';            
        }
    }