<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<style>
	div{
		width:400px;
		margin:0 auto;
		border:1px solid black;
		text-align: center;
	}
</style>
<link rel="stylesheet" href="/js/bootstrap.min.js">
<body>
	<div>
	<form action="/study/guess/doGuess" method="post">
	{{csrf_field()}}
	<input type="hidden" value="{{$user_id}}" name="user_id">
	<input type="hidden" value="{{$info['id']}}" name="team_id">
		<table>
			<tr>
				<td align="center">我要竞猜</td>
			</tr>
			<tr>
				<td>{{$info['team_a']}} VS {{$info['team_b']}}</td>
			</tr>
			<tr>
				<td>
					<input type="radio" name="g_result" value="1">胜
					<input type="radio" name="g_result" value="2">负
					<input type="radio" name="g_result" value="3">平
				</td>
			</tr>
			<tr>
				<td><button class="btn btn-sm btn-danger">添加</button></td>
			</tr>
		</table>
	</form>
	</div>
</body>
</html>