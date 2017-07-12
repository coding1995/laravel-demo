<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Attributes;
class AttributesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {   
         $value = $request->session()->get('adminuser');
        if (empty($value)){
            return redirect('admin/login');
        }
        $attributes = attributes::orderBy('id','desc')
                ->where(function($query) use ($request){
                    //获取关键字
                    $keyword = $request->input('name');
                    //检测参数
                    if(!empty($keyword)) {
                        $query->where('name','like','%'.$keyword.'%');
                    }
                })
                ->paginate($request->input('num', 6));

        //分配变量 解析模板
        return view('admin.attributes.index', ['attributes'=>$attributes, 'request'=>$request, 'value'=>$value]);
    }

    /**
     * 显示添加页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create( Request $request )
    {   
         $value = $request->session()->get('adminuser');
        if (empty($value)){
            return redirect('admin/login');
        }
        return view('admin.attributes.add', ['value'=>$value]);
    }

    /**
     * 添加操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:attributes'
            ], [
            'name.required' => '属性名不能为空',
            'name.unique' => '属性名已经存在'
            ]);
        //创建模型
        $attributes = new Attributes;
        $attributes ->name = $request->input('name');
        //插入
        if($attributes->save()) {
            return redirect('/admin/attributes') -> with('info','添加成功');
        }else{
            return back()->with('info','添加失败');
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
     * 显示编辑，修改页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $attributes = Attributes::findOrFail($id);
        return view('admin.Attributes.edit', ['attributes'=>$attributes]);
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
        $data = Attributes::findOrfail($id);
        $data->name = $request->input('name');
        if($data->save()) {
            return redirect('/admin/attributes') -> with('info','更新成功');
        }else{
            return back()->with('info','更新失败');
        }
    }

    /**
     * 删除操作
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Attributes::destroy($id);

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

    //获取属性名
    public static function getAttributes()
    {
        return Attributes::orderBy('id','desc')->get();
    }
}
