<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>足球竞猜页面</title>
</head>
<body style="width:100%;">
    <div style="margin:0 auto;">
        <form method="post" action="/study/guess/store" >
            <table style="width:100%;border:#dda0dd 1px solid;">
                {{csrf_field()}}
                <tr><td style="text-align:center;width:300px;font-size:25px;">添加竞猜球队</td></tr>
                <tr><td style="text-align:center;width:300px;"><input type="text" name="team_a"> VS <input type="text" name="team_b"></td></tr>
                <tr><td style="text-align:center;width:300px;">竞猜结束时间 <input type="text" name="end_at"></td></tr>
                <tr><td style="text-align:center;width:300px;" ><input type="submit" value="添加"></td></tr>
            </table>
        </form>
    </div>
</body>
</html>