<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\carousel_figures;

use DB;
class CarouselController extends Controller
{
    /**
     * 显示列表页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $value = $request->session()->get('adminuser');
        if (empty($value)){
            return redirect('admin/login');
        }
        $carousel = DB::table('carousel_figures')
                ->orderBy('id','desc')
                ->where(function($query) use ($request){
                    //获取关键字
                    $keyword = $request->input('keyword');
                    //检测参数
                    if(!empty($keyword)) {
                        $query->where('title','like','%'.$keyword.'%');
                    }
                })
                ->paginate(3);
        return view('admin.Carousel.index', compact('value', 'carousel', 'request'));
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
        return view('admin.Carousel.create', compact('value'));
    }

    /**
     * 执行添加操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //表单验证
        $this->validate($request, [

            'title' => 'required|unique:carousel_figures|regex:/[^x00-xff]/',
            'pic'   => 'required'
            ],[
            'title.required' => '标题名不能省略',
            'title.regex' => '请输入汉字',
            'title.unique' => '该标题已存在',
            'pic.required' => '请上传图片'

            ]);
        $carousel_figures = new carousel_figures;
        $carousel_figures->title = $request->input('title');
        if ($request->hasFile('pic')) {
            //文件的存放目录
            $path = './Uploads/'.date('Ymd');
            //获取后缀
            $suffix = $request->file('pic')->getClientOriginalExtension();
            //文件的名称
            $fileName = time().rand(100000, 999999).'.'.$suffix;
            $request->file('pic')->move($path, $fileName);
            $carousel_figures->pic = trim($path.'/'.$fileName,'.');
        }

        //执行插入
        if($carousel_figures->save()) {
            return redirect('/admin/carousel')->with('info', '添加成功');
        }else{
            return back()->with('info', '添加失败');
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
     * 修改页面显示
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request  $request, $id)
    {
        $value = $request->session()->get('adminuser');
        if (empty($value)){
            return redirect('admin/login');
        }

        $carousel = carousel_figures::findOrFail($id);
        return view('admin.Carousel.edit', compact('value', 'carousel'));
    }

    /**
     * 执行更新操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = carousel_figures::findOrFail($id);
        $data->title = $request->input('title');
        $data->status = $request->input('status');
            //处理图片上传
            if($request->hasFile('pic')) {
            //拼接文件夹路径
            $destinationPath = './Upload/'.date('Y-m-d').'/'; //规则 /Upload/20121010/12381902381.jpg
            //拼接文件路径
            $fileName = time().rand(100000, 999999);
            //获取上传文件的后缀
            $suffix = $request->file('pic')->getClientOriginalExtension();
            //文件的完整的名称
            $fullName = $fileName.'.'.$suffix;
            //保存文件
            $request->file('pic')->move($destinationPath, $fullName);
            //拼接文件上传之后的路径  
            $data->pic = trim($destinationPath.$fullName,'.');
        }

        if($data->save()){

            return redirect('/admin/carousel')->with('info', '修改成功');
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
        //创建模型
        $carousel = carousel_figures::findOrFail($id);
        //读取图信息
        $pic = $carousel->pic;
        $path = '.'.$pic;
        if(file_exists($path)) {
            unlink($path);
        }
        $res = carousel_figures::destroy($id);
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
