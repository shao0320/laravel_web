<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="/study/exam/store" method="post">
    {{csrf_field()}}
    <table>
        <tr><td>添加竞猜球队</td></tr>
        <tr><td><input type="text" name="team_a"> VS <input type="text" name="team_b"></td></tr>
        <tr><td>结束竞猜时间：<input type="text" name="end_at"></td></tr>
        <tr><td><input type="submit" value="添加"></td></tr>
    </table>
</form>
</body>
</html>