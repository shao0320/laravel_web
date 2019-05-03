<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/images/favicon.png" type="image/png">
    <title>忘记密码页面</title>
    <link href="/rbac/css/style.default.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">

    <script src="/js/app.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/js/html5shiv.js"></script>
    <script src="/js/respond.min.js"></script>
    <![endif]-->

    <script src="/js/bootstrap.min.js"></script>
</head>

<body class="signin">
<section>

    <div class="signinpanel" id="forget">

        <div class="row">
            <div class="col-md-2" >&nbsp;</div>
            <div class="col-md-8" >
                @if(session('msg'))
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session('msg') }}
                    </div>
                @endif
                <div :class="'alert '+error_class" v-if="error_show">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                   
                </div>
                <form id="reset" method="post" action="/admin/forget/save" >
                    {{ csrf_field() }}
                    <h4 class="nomargin">重置密码</h4>
                    <p class="mt5 mb20"></p>
                    <input type="hidden" name="username" value="{{$username}}" readonly>
                    <input type="hidden" name="email" value="{{$email}}" readonly>
                    <input type="password" name="password" class="form-control" placeholder="请输入新密码" />
                    <input type="password" name="confirm_password" class="form-control" placeholder="确认新密码" />

                    <button class="btn btn-primary btn-block login">重置密码</button>

                </form>
                    
            </div><!-- col-sm-5 -->
            <div class="col-md-2" >&nbsp;</div>

        </div><!-- row -->

        <div class="signup-footer" >
            <div class="pull-left" >
                &copy; 2019. 乐知享版权所有
            </div>
        </div>

    </div><!-- signin -->

</section>
<script src="/js/vue.js"></script>
</body>
</html>
