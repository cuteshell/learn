<?php

namespace App\Http\Controllers\Admin;

use App\Http\Utils\Code\Code;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;

class CommonController extends Controller
{

    protected $model;

    public function code()
    {
        $code = new Code();

        return $code->make();
    }

    public function changeOrder(Request $request)
    {
        $link = $this->model->find($request->id);
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

    public function upload(Request $request)
    {
        $file = $request->file('Filedata');

        if($file->isValid()) {
            $extension = $file->getClientOriginalExtension();
            if(!in_array($extension, ['png', 'jpg', 'jpeg'])) {
                return [
                    'status'=>1,
                    'msg'=>'只能上传png和jpg格式的图片文件'
                ];
            }
            $newName = date('YmdHis').mt_rand(100,999).'.'.$extension;
            $path = $file->move(base_path().'/public/upload',$newName);
            return [
                'status'=>0,
                'msg'=>'/upload/'.$newName,
            ];
        } else {
            return [
                'status'=>'1',
                'msg'=>'上传文件失败'
            ];
        }
    }
}
