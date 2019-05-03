<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>用户竞猜页面</title>
</head>
<body style="width:100%;">
<div style="margin:0 auto;">
    <form method="post" action="/study/guess/doGuess" >
        <input type="hidden" name="user_id" value="{{$user_id}}">
        <input type="hidden" name="team_id" value="{{$info['id']}}">
        <table style="width:100%;border:#dda0dd 1px solid;">
            {{csrf_field()}}
            <tr><td style="text-align:center;width:300px;font-size:25px;">我要竞猜</td></tr>
            <tr><td style="text-align:center;width:300px;">{{$info['team_a']}} VS {{$info['team_b']}}</td></tr>
            <tr><td style="text-align:center;width:300px;">
                    <input type="radio" value="1" name="user_result">胜
                    <input type="radio" value="2" name="user_result">平
                    <input type="radio" value="3" name="user_result">负
                </td></tr>
            <tr><td style="text-align:center;width:300px;" ><input type="submit" value="竞猜"></td></tr>
        </table>
    </form>
</div>
</body>
</html>