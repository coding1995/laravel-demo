<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\GoodSort;

use DB;

class GoodsController extends Controller
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
        //读取分类
        // $cates = Cate::select(DB::raw('*, concat(path,",",id) as paths'))->orderBy('paths')->get();
        // var_dump($request->all());
        // var_dump($request->input('pid'))
        //读取所有信息
        $GoodSort = GoodSort::orderBy('id', 'desc')
                ->select(DB::raw('*, concat(path,",",id) as paths'))->orderBy('paths')->where(function($query) use ($request){
                    //获取关键字
                    $keyword = $request->input('name');
                    //检测参数
                    if(!empty($keyword)) {
                        $query->where('name','like','%'.$keyword.'%');
                    }
                })
                ->paginate($request->input('num', 6));
        // dd($GoodSort);
        return view('admin.Goods.index', ['GoodSort'=>$GoodSort, 'request'=>$request, 'value'=>$value]);
    }

    /**
     * 显示一个添加分类的表单
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        $value = $request->session()->get('adminuser');
        if (empty($value)){
            return redirect('admin/login');
        }
        //读取所有分类
               $GoodSort = GoodSort::select(DB::raw('*, concat(path,",",id) as paths'))->orderBy('paths')->get(); 

               foreach ($GoodSort as $key => $v) {
            //判断当前的分类是几级分类
            $tmp = count(explode(',', $v->path)) - 1;
            $prefix = str_repeat('|----', $tmp);
            $v->name = $prefix . $v->name;
        }
        // dd($GoodSort);
        return view('admin.Goods.add', ['GoodSort'=>$GoodSort, 'value'=>$value]);
        
    }

    /**
     * 将分类信息，存入数据库
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //表单验证
        $this->validate($request, [
        'name' => 'required',
        'pid' => 'required',
    ],[
        'name.required'=>'分类名称不能为空！！！',
    ]);
        // dd($request->all());
        $data = $request->all();

        if( $data['pid'] == 0 ){
            //如果是顶级分类，那么父类ID和路径都是0
            //如果不是顶级分类 则pid应该是父级分类的id, path应该是父级分类的path加上父级分类的id
            $data['path'] = '0';
        } else {

            //次级分类
            $info = GoodSort::find($data['pid']);
            $data['path'] = $info->path.','.$info->id;
        }

        $res = GoodSort::get();
        //检查是否重名
        foreach ($res as $key => $v) {
            
            if ( $v->name==$data['name'] and $v->pid==$data['pid'] ) {
                
            return back()->with('info', '该类名已存在！！');

            }
        }
       
        // dd($data);
        //创建模型
        $GoodSort = new GoodSort;
        $GoodSort->name = $data['name'];
        $GoodSort->pid = $data['pid'];
        $GoodSort->path = $data['path'];

        if ( $GoodSort->save() ) {
            
            return redirect('/admin/goods')->with('info', '添加分类成功');
        } else {

            return back()->with('info', '分类添加失败');
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
     * 显示修改表单页面
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
        $GoodSort = GoodSort::findOrFail($id);
        // dd($GoodSort);
        $data = GoodSort::get();
        // dd($data);
        return view('admin.Goods.edit', ['GoodSort'=>$GoodSort, 'data'=>$data, 'value'=>$value]);
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
             //表单验证
        $this->validate($request, [
            'name' => 'required',
            'pid' => 'required',
        ],[
            'name.required'=>'分类名称不能为空！！！',
        ]);
        // dd($id);
        $data = GoodSort::findOrFail($id);
        $data->name = $request->name;
        $data->pid = $request->pid;
        if ( $data->save() ) {
                
                return redirect('/admin/goods')->with('info', '修改分类成功');
            } else {

                return back()->with('info', '修改分类失败');
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
        // dd($id);
        $data = GoodSort::findOrFail($id);
        // dd($data);
        $path = $data->path . ','.$data->id;
        $row = DB::table('good_sorts')->where('path','like',$path.'%')->get();
        // dd($row);
        //判断该分类是否存在子分类
        if ($row) {
            $data = [
                "status"=>3,
                "msg"=>"分类删除失败，有子类！！！",
            ];
            return $data; die;
        }

        //若无子分类
        $res = GoodSort::destroy($id);

        if ( $res ) {        
            $data = [
                "status"=>0,
                "msg"=>"分类删除成功！！！",
            ];
        } else {
            $data = [
                "status"=>1,
                "msg"=>"分类删除失败！！！",
            ];
        }

        return $data;
    }

    /**
     * 获取分类信息
     */
    public static function GetGoodSort()
    {
        $GoodSort = GoodSort::select(DB::raw('*, concat(path,",",id) as paths'))->orderBy('paths')->get();

        foreach ($GoodSort as $key => $value) {
            
            //判断为几级分类
            $tmp = count(explode(',', $value->path)) - 1;
            $prefix = str_repeat('|----', $tmp);
            $value->name = $prefix . $value->name;
        }
        return $GoodSort;
    }
}
