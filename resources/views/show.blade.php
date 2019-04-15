@extends("comment.base")

@section("title","第一个larevel视图")

@section('sidebar')
    <font style="font-size:30px;color:#ddd222;"> 这是主布局的侧边栏。</font>
@endsection

@section('content')
	<span style="font-size:30px;color:#ddd222;">{{$message}}</span>
		
	@for($i=1;$i<10;$i++)
		{{$i}}
	@endfor
@endsection