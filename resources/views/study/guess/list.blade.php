<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<table border="0" width="500px" align="center">
		<tr align="center">
			<td>球队</td>
			<td>操作</td>
		</tr>
		@if(!empty($list))
		@foreach($list as $key => $value)
		<tr align="center">
			<td>{{$value['team_a']}} VS {{$value['team_b']}}</td>
			<td>
				@if(strtotime($value['end_at']) > time())
				<a href="/study/guess/guess?id={{$value['id']}}&user_id={{$user_id}}">竞猜</a>
				@else
				<a href="/study/guess/guess?id={{$value['id']}}&user_id={{$user_id}}">查看结果</a>
				@endif
			</td>
		</tr>
		@endforeach
		@endif
	</table>
</body>
</html>