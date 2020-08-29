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
 <h1 class="bg-success"><a href="/">Laravel Sample Blog</a></h1>
</div>

@foreach ($params as $param)
<h4>id:{{ $param -> id}}</h4>
<h1>title:{{ $param -> title}}</h1>
<h2>content: <br>{{ $param -> content }}</h2>
@endforeach

</body>
</html>
