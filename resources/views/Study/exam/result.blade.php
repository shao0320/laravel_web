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
<form action="" method="post">
    {{csrf_field()}}
    <table>
        <tr><td>竞猜结果</td></tr>

        <tr><td>对阵结果：{{$list->team_a}}
                @if($list->result == 1)胜
                @elseif($list->result ==2)平
                @else 负
                @endif
                {{$list->team_b}}</td></tr>
        @if(!empty($result))
        <tr><td>
                你的竞猜：
                    {{$list->team_a}}
                        @if($result->user_result == 1) 胜
                        @elseif($result->user_result ==2)平
                        @else 负
                        @endif
                    {{$list->team_b}}
            </td></tr>
            <tr><td>结果：
                        @if($list->result == $result->user_result) 恭喜你，竞猜正确
                        @else 很抱歉，竞猜错误
                        @endif
                </td></tr>
            @else
                <tr><td>你没有参加竞猜</td></tr>
            @endif
    </table>
</form>
</body>
</html>