<?php

namespace App\Http\Controllers;
use App\Post;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function list(){
     $posts = DB::table('posts')->orderBy('created_at', 'desc')->Paginate(10);
     return view('posts.list', ['posts' => $posts]);
    }

    public function insert(){
    return view('posts.insert');
    }
    // フォームに入力されたデータを DB に登録

    public function do_insert(Request $request){

        $request->validate([
            'title' => 'required|string|max:20',
            'content' => 'required|string|min:10|max:140',
        ]);

    $post = new Post();
    $post->author = 1;
    $post->title = $request->title;
    $post->content = $request->content;
    $post->comments = 0;
    $post->save();
    return redirect('/');
    }


    public function show($id){
        if($id === 'insert'){
        return(view('posts.insert'));
        }else{
        $param = DB::table('posts')->where('id', $id)-> get();
        return(view('posts.show',[ 'params' =>$param]));
    }
    }

    public function update($id){
        $value = DB::table('posts')->where('id', $id)->get();
        return view('posts.update',['params' => $value]);
    }

    public function do_update(Request $request){
        Post::where('id', $request->id)
            ->update(['title' => $request->title ,'content' => $request -> content]);
        return redirect('/');

    }

    public function delete($id){
        Post::where('id',$id)
            ->delete();
        return redirect('/');

    }
}
