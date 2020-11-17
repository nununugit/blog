<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
class RestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $post=Post::all();
        return response()->json([
            'message'=>'ok',
            'data' =>$post,
        ],200,[],JSON_UNESCAPED_UNICODE);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post();
        $post->author = 1;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->comments = 0;
        $post->save();

        return response()->json([
            'message'=>'data is inserted',
            'data' =>'ok',
        ],200,[],JSON_UNESCAPED_UNICODE);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = DB::table('posts')->where('id', $id)-> get();
        return response()->json([
            'message'=>'ok',
            'data' => $post,
        ],200,[],JSON_UNESCAPED_UNICODE);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        Post::where('id', $request->id)
        ->update(['title' => $request->title ,'content' => $request -> content]);

        return response()->json([
            'message'=>'data is updated',
            'data' =>'ok',
        ],200,[],JSON_UNESCAPED_UNICODE);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        Post::where('id',$id)
            ->delete();

        return response()->json([
            'message'=>'data is deleted',
            'data' =>'ok',
        ],200,[],JSON_UNESCAPED_UNICODE);
    }
}
