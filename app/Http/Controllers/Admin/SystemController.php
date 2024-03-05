<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\System;

class SystemController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $system = System::all();
        $title = 'System';
        return view('admin.system', compact('system', 'title'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->except('_token', '_method');
        foreach($input as $key=>$val) {
            System::where('key', $key)
                ->update([
                    'value'=>$val
                ]);
        }
        
        return redirect()->route('admin.system.index')->withSuccess('系统参数设置成功');
    }


}
