<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Link;
class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
         $value = $request->session()->get('adminuser');
        if (empty($value)){
            return redirect('admin/login');
        }
        $link = new link;
        $link = $link->get(); 
        return view('admin.Links.index', ['link'=>$link, 'value'=>$value]);
    }

    /**
     * 添加页面显示
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
         $value = $request->session()->get('adminuser');
        if (empty($value)){
            return redirect('admin/login');
        }
        return view('admin.Links.create', ['value'=>$value]);
    }

    /**
     * 执行添加操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        //      $this->validate($request, [
        //     'title' => 'required',
        //     'url' => 'required|active_url',
        //     'contents' => 'required'
        // ],[
        //     'title.required' => '标题不能省略',
        //     'url.required' => 'url地址不能为空',
        //     'url.active_url' => '请输入正确的URL地址',
        //     'contents.required' => '描述不能为空'
        // ]);

        //创建模型
        $link = new Link;
        $link->title = $request->input('title');
        $link->url = $request->input('url');
        $link->contents = $request->input('contents');
        $link->status = $request->input('status');
        $data = $link->get();
        foreach ($data as $key => $value) {
            if ($value->title==$request->input('title')) {
                return back()->with('info', '添加失败，标题名已存在');
            }
        }
        if ($link->save()) {

            return redirect('/admin/link')->with('info', '添加成功');
        } else {

            return back()->withInput()->with('info', '添加失败');
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
    public function edit( Request  $request,$id)
    {   
        $value = $request->session()->get('adminuser');
        if (empty($value)){
            return redirect('admin/login');
        }
        $link = Link::findOrFail($id);
        return view('admin.Links.edit',['link'=>$link,'value'=>$value]);
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
        $link = Link::findOrFail($id);
        $link->title = $request->input('title');
        $link->url = $request->input('url');
        $link->status = $request->input('status');
        $link->contents = $request->input('contents');
        if ($link->save()) {
            return redirect('/admin/link')->with('info', '修改成功');
        } else {
            return back()->with('info', '修改失败');
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
        $res = Link::destroy($id);

        if ( $res ) {        
            $data = [
                "status"=>0,
                "msg"=>"删除成功！！！",
            ];
        } else {
            $data = [
                "status"=>1,
                "msg"=>"删除失败！！！",
            ];
        }

        return $data;
    }
}
