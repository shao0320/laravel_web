<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>竞猜列表</title>
</head>
<body >
    <table style="width:400px;">
            <thead style="text-align: center">
                <tr style="height: 36px;line-height: 36px;">
                    <th>球队</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($info))
                    @foreach($info as $v)
                        <tr style="text-align: center;height: 36px;line-height: 36px;">
                            <td>{{$v['team_a']}} VS {{$v['team_b']}}</td>
                            <td>
                                @if(strtotime($v['end_at']) > time())
                                    <a href="/study/guess/guess?id={{$v['id']}}&user_id={{$user_id}}">竞猜</a>
                                @else
                                    <a href="/study/guess/record?id={{$v['id']}}&user_id={{$user_id}}">查看结果</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
    </table>
</body>
</html>