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
<form action="/study/exam/doGuess" method="post">
    {{csrf_field()}}
    <input type="hidden" name="team_id" value="{{$team_id}}">
    <input type="hidden" name="user_id" value="1">
    <table>
        <tr><td>我要竞猜</td></tr>
        <tr><td>{{$list->team_a}} VS {{$list->team_b}}</td></tr>
        <tr><td>
                <input type="radio" name="user_result" value="1">胜
                <input type="radio" name="user_result" value="2">平
                <input type="radio" name="user_result" value="3">负
            </td></tr>
        <tr><td><input type="submit" value="添加"></td></tr>
    </table>
</form>
</body>
</html>