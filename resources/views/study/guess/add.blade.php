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
	<form action="/study/guess/doAdd" method="post">
	{{csrf_field()}}
		<table>
			<tr>
				<td align="center">添加竞猜球队</td>
			</tr>
			<tr>
				<td><input type="text" name="team_a"> VS <input type="text" name="team_b"></td>
			</tr>
			<tr>
				<td>竞猜结束时间 <input type="text" name="end_at"></td>
			</tr>
			<tr>
				<td><button class="btn btn-sm btn-danger">添加</button></td>
			</tr>
		</table>
	</form>
	</div>
</body>
</html>