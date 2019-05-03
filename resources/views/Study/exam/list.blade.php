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
    <table>
        <thead>
            <tr>
                <th>球队</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($list))
                @foreach($list as $v)
                <tr>
                    <td>{{$v['team_a']}} VS {{$v['team_b']}}</td>
                    <td>
                        @if($date > strtotime($v['end_at']))
                            <a href="/study/exam/result?user_id=1&id={{$v['id']}}">查看结果</a>
                            @else
                            <a href="/study/exam/guess?user_id=1&id={{$v['id']}}">竞猜</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</body>
</html>