<?php

namespace App\Http\Controllers\Admin;

use App\Models\Config;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ConfigController extends CommonController
{
    protected $redirectAfterAdd = '/admin/config';

    /**
     * Init some member
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Config $config)
    {
        $this->model = $config;
    }

    /**
     * Change all content field.
     *
     * @return \Illuminate\Http\Response
     */
    public function changeContent(Request $request)
    {
        foreach($request->id as $k=>$v) {
            $config = Config::find($v)->update(['content'=>$request->content[$k]]);
        }
        $this->putFile();
        return redirect()->back()->withErrors('配置更新成功！');
    }

    /**
     * save config to file .
     *
     * @return \Illuminate\Http\Response
     */
    public function putFile()
    {
        $path = base_path().'/config/web.php';
        $config = Config::pluck('content', 'name')->toArray();
        $str = '<?php return '.var_export($config, true).';';
        file_put_contents($path, $str);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Config::orderBy('order','asc')->get();
        return view('admin.config.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.config.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\ConfigRequest $request)
    {
        $input = $request->except('_token');
        $config = Config::create($input);
        if($config) {
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
        $config = Config::find($id)->toArray();
        $request->session()->flashInput($config);

        return view('admin.config.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\ConfigRequest $request, $id)
    {
        $input = $request->except('_token');

        $link = Config::find($id);

        if($link) {
            $link->update($input);
            return redirect($this->redirectAfterAdd);
            $this->putFile();
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
        $ret = Config::find($id)->delete();
        if($ret) {
            $data = [
                'status'=>0,
                'msg'=>'链接删除成功',
            ];
            $this->putFile();
        } else {
            $data = [
                'status'=>1,
                'msg'=>'链接删除失败，请联系管理员',
            ];
        }
        return $data;
    }
}
