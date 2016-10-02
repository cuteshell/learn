<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\CommonController;
use App\Models\Category;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoryController extends CommonController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('pid',0)->orderBy('order')->get();

        $data = $this->getTree($categories);
        return view('admin.category.index')->with('data', $data);
    }

    public function getTree($data, $pid = 0, &$tree = [], $prefix = '')
    {
        if(is_int($pid)) {
            $pid = (string)$pid;
        }
        foreach($data as $k=>$v) {
            if($v->pid == $pid) {
                $v->name = $prefix.$v->name;
                $tree[] = $v;
                $this->getTree($v->children, $v->id, $tree, $prefix.'---');
            }
        }

        return $tree;
    }

    public function changeOrder(Request $request)
    {
        $category = Category::find($request->cate_id);
        $category->order = $request->cate_order;
        if($category->update()) {
            return [
                'status'=>0,
                'msg'=>'分类排序修改成功！'
            ];
        } else {
            return [
                'status'=>1,
                'msg'=>'分类排序修改失败！'
            ];
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
