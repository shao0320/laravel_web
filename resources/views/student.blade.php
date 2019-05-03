<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<link rel="stylesheet" href="/css/app.css">
<body>
	<table border="1 #ddd222 soild" cellspacing="0" width="600px" align="center">
		<thead>
			<th>id</th>
			<th>名称</th>
			<th>编号</th>
		</thead>
		<tbody>
			@foreach($list as $v)
				<tr>
					<td align="center">{{$v->id}}</td>
					<td align="center">{{$v->goods_name}}</td>
					<td align="center">{{$v->goods_sum}}</td>
				</tr>
			@endforeach
		</tbody>
		
			{{$list->links()}}
	
	</table>
</body>
</html>