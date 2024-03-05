<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{

    private $model = null;

    public function __construct()
    {
        $controller = $this->getController($this);
        view()->share('active', $controller);
    }

    public function getController($class)
    {
        $controller = (new \ReflectionClass($class))->getShortName();
        $controller = substr($controller, 0, stripos($controller, 'Controller'));
        return $controller;
    }


    public function deleteData($model, $id)
    {
        $data = [
            "status" => 0,
            "msg" => "成功"
        ];
        
        // 判断是否为有子分类
        if($model->where('parent_id',$id)->exists()) {
          $data = [
            'status' =>2,
            'msg'=>'请先删除当前数据下的所有子数据后重试！'
          ];
        }else{
          if($model->where('id',$id)->delete()){
            $data = [
              'status' => 0,
              'msg' => "删除成功！",
            ];
          }else{
            $data = [
              'status' => 1,
              'msg' => "删除失败，请稍后重试！",
            ];
          }
        }
        return $data;
    }
}
