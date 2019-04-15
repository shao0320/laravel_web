<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>竞猜结果</title>
</head>
<body style="width:100%;">
<div style="margin:0 auto;">
        <table style="width:100%;border:#dda0dd 1px solid;">
            <tr><td style="text-align:center;width:300px;font-size:25px;">竞猜结果</td></tr>
            <tr><td style="text-align:center;width:300px;">
                    对阵结果：{{$info['team_a']}}
                            <font color="#dd2222">
                            @if($info['result'] == 1)胜
                            @elseif($info['result'] ==2 )平
                            @else 负
                            @endif
                            </font>
                            {{$info['team_b']}}</td></tr>
            <tr><td style="text-align:center;width:300px;">
                    @if(!empty($data))
                    用户竞猜结果：
                        {{$info['team_a']}}
                            <font color="#dd2222">
                                @if($data->user_result == 1)胜
                                @elseif($data->user_result ==2 )平
                                @else 负
                                @endif
                            </font>
                        {{$info['team_b']}}
                </td></tr>
            <tr>
                <td style="text-align:center;width:300px;">
                    结果：
                        @if($data->user_result == $info['result']) 恭喜你，竞猜正确 @else 很抱歉，竞猜错误  @endif
                </td>
            </tr>
            @else
                <tr>
                <td style="text-align:center;width:300px;">
                   抱歉，你没有参加竞猜
                </td>
                </tr>
             @endif
        </table>
</div>
</body>
</html>