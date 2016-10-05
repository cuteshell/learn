<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\CommonController;
use App\Models\Category;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoryController extends CommonController
{
    protected $redirectAfterAddCate = '/admin/category';


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

    public static function getTree($data, $pid = 0, &$tree = [], $prefix = '')
    {
        if(is_int($pid)) {
            $pid = (string)$pid;
        }
        foreach($data as $k=>$v) {
            if($v->pid == $pid) {
                $v->name = $prefix.$v->name;
                $tree[] = $v;
                self::getTree($v->children, $v->id, $tree, $prefix.'---');
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
        $categories = Category::where('pid', 0)->get();
        return view('admin.category.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\AddCateRequest $request)
    {
        $input = $request->except('_token');
        $category = Category::create([
            'pid'=>$input['cate_pid'],
            'name'=>$input['cate_name'],
            'title'=>$input['cate_title'],
            'keywords'=>$input['cate_keywords'],
            'description'=>$input['cate_description'],
            'order'=>$input['cate_order'],
        ]);
        if($category) {
            return redirect($this->redirectAfterAddCate);
        }
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
        $fields = Category::find($id);
        $categories = Category::where('pid', 0)->get();

        return view('admin.category.edit',compact('categories', 'fields'));
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
        $category = Category::find($id);
        $input = $request->except('_method', '_token');
        $item = [
            'pid' => $input['cate_pid'],
            'name' => $input['cate_name'],
            'title' => $input['cate_title'],
            'keywords' => $input['cate_keywords'],
            'description' => $input['cate_description'],
            'order' => $input['cate_order']
        ];
        $ret = $category->update($item);
        if($ret) {
            return redirect($this->redirectAfterAddCate);
        } else {
            return redirect()->back()->with('fileds',$item)->withErrors('修改失败，请稍后重试');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::where('pid',$id)->update(['pid'=>0]);
        $ret = Category::find($id)->delete();
        if($ret) {
            $data = [
                'status'=>0,
                'msg'=>'分类删除成功',
            ];
        } else {
            $data = [
                'status'=>1,
                'msg'=>'分类删除失败，请联系管理员',
            ];
        }
        return $data;
    }
}
