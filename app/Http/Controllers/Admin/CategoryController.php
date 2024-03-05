<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends BaseController
{
    public function __construct()
    {
        // $controller = $this->getController($this);
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Category::all();
        $data = getTree($list,'title','id','parent_id',0);
        // dd($data);
        return view('admin.category.index',['cate'=>'category','data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Category::where('parent_id', 0)->get();
        return view('admin.category.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {

        $input = $request->except('_token', '_method');
        $input['created_at'] = now();
        if(!isset($input['icon']))
            $input['icon'] = '';

        Category::insert($input);

        // return Response()->json([]);
        
        return redirect()->route("admin.category.index")->with("message", "successfully created")->withInput();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $list = Category::where('parent_id', 0)->get();

        $data = Category::find(intval($id));
        return Response()->json(['category'=>$list,'data'=>$data]);

        // return view('admin.category.edit', compact('data', 'list'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $input = $request->except('_token', '_method');
        if(!isset($input['icon']))
            $input['icon'] = '';

        $res = Category::where('id', $id)->update($input);

        if ($res) {
            return redirect()->route('admin.category.index');
        } else {
            return back()->withError('更新分类失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return parent::deleteData(new Category(), $id);
        // $data = [
        //     "status" => 0,
        //     "msg" => "成功"
        // ];
        
        // // 判断是否为有子分类
        // if(Category::where('parent_id',$id)->exists()) {
        //   $data = [
        //     'status' =>2,
        //     'msg'=>'请先删除当前分类下的所有子分类后重试！'
        //   ];
        // }else{
        //   if(Category::where('id',$id)->delete()){
        //     $data = [
        //       'status' => 0,
        //       'msg' => "分类删除成功！",
        //     ];
        //   }else{
        //     $data = [
        //       'status' => 1,
        //       'msg' => "分类删除失败，请稍后重试！",
        //     ];
        //   }
        // }
        // return $data;

    }
}
