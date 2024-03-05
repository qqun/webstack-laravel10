<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SiteRequest;
use App\Models\Site;
use App\Models\Category;


class SiteController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Site::orderBy('id','desc')->paginate(10);
        $data = Category::all();
        return view('admin.site.index', compact('data', 'list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list = Category::all();
        $data = getTree($list,'title','id','parent_id',0);
        return view('admin.site.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SiteRequest $request)
    {
        $input = $request->except('_token', '_method');
        $input['created_at'] = now();
        Site::insert($input);
        
        return redirect()->route("admin.site.index")->with("message", "successfully created")->withInput();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $list = Category::all();
        $list = getTree($list,'title','id','parent_id',0);
        $data = Site::find(intval($id));

        return Response()->json(['category'=>$list,'data'=>$data]);

        // return view('admin.site.edit', compact('data', 'list'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SiteRequest $request, string $id)
    {
        $input = $request->except('_token', '_method');
        $res = Site::where('id', $id)->update($input);

        if ($res) {
            return redirect()->route('admin.site.index');
        } else {
            return back()->withError('更新网址失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return parent::deleteData(new Site(), $id);
    }
}
