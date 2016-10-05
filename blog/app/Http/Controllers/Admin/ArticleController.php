<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    protected $redirectAfterAdd = '/admin/article';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Article::orderBy('id','desc')->paginate(8);
        return view('admin.article.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $topCategories = Category::where('pid',0)->orderBy('order')->get();
        $categories = CategoryController::getTree($topCategories);
        return view('admin.article.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\ArticleRequest $request)
    {
        $input = $request->except('_token','query_string');
        $input['time'] = time();
        $article = Article::create($input);

        if($article) {
            return redirect($this->redirectAfterAdd);
        } else {
            return redirect()->back()->withInput($input)->withErrors("添加文章失败,请联系管理员或稍后再试");
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
    public function edit(Request $request, $id) {

        $topCategories = Category::where('pid',0)->orderBy('order')->get();
        $categories = CategoryController::getTree($topCategories);
        $item = Article::find($id)->toArray();
        $request->session()->flashInput($item);

        return view('admin.article.edit',compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\ArticleRequest $request, $id)
    {
        $input = $request->except('_token','_method');
        $ret = Article::find($id)->update($input);
        if($ret) {
            return redirect($this->redirectAfterAdd);
        } else {
            return redirect()->back()->withInput($input)->withErrors('更新出错，请联系管理员！');
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
        $ret = Article::find($id)->delete();
        if($ret) {
            $data = [
                'status'=>0,
                'msg'=>'文章删除成功',
            ];
        } else {
            $data = [
                'status'=>1,
                'msg'=>'文章删除失败，请联系管理员',
            ];
        }
        return $data;
    }
}
