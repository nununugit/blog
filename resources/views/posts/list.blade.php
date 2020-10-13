
@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>投稿</title>
<link rel="stylesheet"
href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div>
 <h1><a href="/">Laravel Sample Blog</a></h1>
</div>
<table class="table">
<tr>
 <th>著者</th>
 <th>タイトル</th>
 <th>コメント数</th>
 <th>投稿日時</th>
 <th><a href="/post/insert" class="btn btn-primary btn-xs">追加</a></th>
</tr>
@foreach ($posts as $post)
 <tr>
 <td>{{ $post->author }}</td>
 <td><a href="/post/{{ $post->id }}">{{ $post->title }}</a></td>
 <td>{{ $post->comments }}</td>
 <td>{{ date("Y/m/d H:i:s",strtotime($post->created_at)) }}</td>
 <td>
 <a href="/post/{{ $post->id }}/update" class="btn btn-primary btn-xs">編集</a>
<a href="/post/{{ $post->id }}/delete" class="btn btn-danger btn-xs">削除</a>
 </td>
 </tr>
@endforeach
</table>
{!! $posts->links()  !!}
</body>
</html>
    
@endsection
