<?php

namespace App\Http\Controllers\Admin;

use App\Models\Nav;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NavController extends Controller
{
    protected $redirectAfterAdd = '/admin/nav';

    /**
     * Change display order of Navs
     *
     * @return \Illuminate\Http\Response
     */
    public function changeOrder(Request $request)
    {
        $link = Nav::find($request->id);
        $link->order = $request->order;
        if($link->update()) {
            return [
                'status'=>0,
                'msg'=>'排序修改成功！'
            ];
        } else {
            return [
                'status'=>1,
                'msg'=>'排序修改失败！'
            ];
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Nav::orderBy('order','asc')->get();
        return view('admin.nav.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.nav.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\LinkRequest $request)
    {
        $input = $request->except('_token');
        $link = Nav::create($input);
        if($link) {
            return redirect($this->redirectAfterAdd);
        } else {
            return redirect()->back()->withInput($input)->withErrors('添加出错，请联系管理员！');
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
    public function edit(Request $request, $id)
    {
        $link = Nav::find($id)->toArray();

        $request->session()->flashInput($link);
        return view('admin.nav.edit');
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
        $input = $request->except('_token');

        $link = Nav::find($id);

        if($link) {
            $link->update($input);
            return redirect($this->redirectAfterAdd);
        } else {
            return redirect()->back()->withInput($input)->withErrors('修改失败，请联系管理员');
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
        $ret = Nav::find($id)->delete();
        if($ret) {
            $data = [
                'status'=>0,
                'msg'=>'链接删除成功',
            ];
        } else {
            $data = [
                'status'=>1,
                'msg'=>'链接删除失败，请联系管理员',
            ];
        }
        return $data;
    }
}
