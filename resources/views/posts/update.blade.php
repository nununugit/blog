<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>編集
</title>
<link rel="stylesheet"
href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div>
 <h1 class="bg-success"><a href="/">Laravel Sample Blog</a></h1>
</div>
<h2>新規投稿</h2>
@foreach ($params as $param)

<form method="POST" action="/post/{{ $param->id }}/update">
 @csrf
 タイトル<br>

 <input name="title" value="{{ $param ->title }}" placeholder="タイトルを入力してください。"><br><br>
 本文<br>
 <textarea cols="50" rows="15" name="content" placeholder="本文を入力してください。">{{ $param ->content }}</textarea><br>
 <input type="hidden" value="{{ $param->id }}">
 <input type="submit" class="btn btn-primary btn-sm" value="送信">

</form>
@endforeach

</body>
</html>
