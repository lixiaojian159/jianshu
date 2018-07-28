<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Auth\Access\AuthorizationException;
use App\Post;
use App\User;
use App\Comment;
use Auth;

class PostController extends Controller
{
    //权限管理(中间件)
    public function __construct(){

        $this->middleware('auth',[ 
            'except' => ['show','index'], //白名单
        ]);
    }

    //文章列表
    public function index(){
        $posts = Post::with('user')->withCount('comments')->orderBy('created_at','desc')->paginate(10);
    	return view('posts.index',compact('posts'));
    }

    //文章详情页
    public function show($id){
        $post = Post::query()->with('user')->find($id);
    	return view('posts.show',compact('post'));
    }

    //创建文章
    public function create(){
    	return view('posts.create');
    }

    //创建文章逻辑
    public function store(Request $request){

        $this->validate($request,[
                'title'   => 'required|string|min:2|max:200',
                'content' => 'required|string|min:2',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();
        $res  = Post::create($data);
        session()->flash('success','文章添加成功');
        return redirect('/posts');
    }

    //编辑文章页面
    public function edit(Post $post){
        
        try{
            $this->authorize('update',$post);
        }catch(AuthorizationException $e) {
           return redirect()->back();
        }
        //$post = Post::with('user')->find($id);
    	return view('posts.edit',compact('post'));
    }

    //编辑文章逻辑
    public function update(Request $request,$id){
        
        $this->authorize('update',$id);
        $this->validate($request,[
                'title'   => 'required|string|max:200',
                'content' => 'required|string|min:2',
        ]);

        $post = Post::find($id);
        $post->title   = $request->get('title');
        $post->content = $request->get('content');
        $post->save();
        session()->flash('success','文章编辑成功。');
    	return redirect("/posts/$id/show");
    }

    //删除文章
    public function delete($id){

        $this->authorize('delete',$id);
        $post = Post::find($id);
        $post->delete();
        session()->flash('success','文章删除成功');
    	return redirect('/posts');
    }

    //测试
    public function test(){
        return view('layouts.default');
    }

    //上传图片
    public function imageUpload(Request $request){

        //$file = $request->file('wangEditorH5File')->store('uploads');
        //接收前台图片信息
        $file = $request->file('wangEditorH5File');
        //获取图片后缀
        $ext  = $file->getClientOriginalExtension();
        //获取图片临时地址
        $realPath = $file->getRealPath();
        //图片重命名
        $newName  = date('Y-m-d-H-i-s').'-'.rand(1000,9999).'.'.$ext;
        //保存图片
        Storage::disk('public')->put($newName,file_get_contents($realPath));
        //图片保存地址
        $path = asset('storage/'.$newName);
        return $path;
    }

    //提交评论逻辑
    public function comment(Request $request,Post $post){

        $this->validate($request,[ 'content' => 'required|min:2' ]);
        
        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->content = $request->get('content');
        //利用的是模型关联 (就不用再写post_id,默认就有,参数是一个对象)
        $post->comments()->save($comment);

        return redirect()->back();
    }

}
