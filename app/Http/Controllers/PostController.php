<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index() {
//        dd(Auth::user());
//        echo 123;exit;
//        $posts = [
//            ['title' => 'this is title 1'],
//            ['title' => 'this is title 2'],
//            ['title' => 'this is title 3'],
//            ['title' => 'this is title 4'],
//        ];
//        $arr = \Request::all();
//        dd($arr->all());
//        $app = app();
//        $log = $app->make('log');
//        \Log::notice('test', ['data'=>'this is notice log test 3']);
        $posts = Post::orderBy('created_at', 'desc')->paginate(6);
//        return view('post/index', ['posts'=>$posts]);
        return view('post/index', compact('posts'));
    }

    public function show(Post $post) {
        return view('post/show', compact('post'));
    }

    public function create() {
        return view('post/create');
    }

    public function store() {
        // tinker保存数据的方法
        /*$post = new Post();
        $post->title = request('title');
        $post->content = request('content');
        $post->save();*/

        //create方法一
        /*$param = ['title'=>request('title'), 'content'=>request('content')];
        Post::create($param);*/

        //create方法二
        //验证
        $this->validate(request(), [
            'title' => 'required|string|min:5|max:100',
            'content' => 'required|string|min:10',
        ]);

        //逻辑
        $user_id = Auth::id();
        $data = array_merge(request(['title', 'content']), compact('user_id'));
        Post::create($data);

//        dd(request()->all());
        //渲染
        return redirect('/posts');
    }

    public function edit(Post $post) {
        return view('post/edit', compact('post'));
    }

    public function update(Post $post) {
        //验证
        $this->validate(request(), [
            'title' => 'required|string|min:5|max:100',
            'content' => 'required|string|min:10',
        ]);

        $this->authorize('update', $post);

        //逻辑
        $post->title = request('title');
        $post->content = request('content');
        $post->save();

        //渲染
        return redirect('/posts/'.$post->id.'/show');
    }

    public function delete(Post $post) {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect('/posts/');
    }

    //图片上传
    public function imageUpload(Request $request) {
        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('storage/'.$path);
        dd(request()->all());
    }
}