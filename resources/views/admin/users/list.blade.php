@extends("comment.admin_base")

@section("title","后台管理-用户列表")

	<!-- 页面顶部信息 -->
@section('pageHeader')
<div class="pageheader">
      <h2><i class="fa fa-home"></i> 用户列表 <span>Subtitle goes here...</span></h2>
      <div class="breadcrumb-wrapper">
      </div>
    </div>
@endsection

@section("content")
	<div class="row" id="list">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-success mb30">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>用户名</th>
                        <th>头像</th>
                        <th>是否超管</th>
                        <th>状态</th>
                        <th>操作</th>
                      </tr>
                    </thead>
                    <tbody>
                    	@foreach($list as $user)
                      <tr>
						<td>{{$user->id}}</td>
						<td>{{$user->username}}</td>
						<td><img src="{{$user->image_url}}" alt="" style="width:60px;border:red 1px solid;"></td>
						<td>{{$user->is_super == 1 ? "否" : "是"}}</td>
						<td>{{$user->is_super == 1 ? "正常" : "禁用"}}</td>
						<td>

							<a class="btn btn-sm btn-success" href="{{route('admin.user.edit',['id'=>$user->id])}}">修改</a>&nbsp;&nbsp;
							<a class="btn btn-sm btn-danger" href="{{'/admin/user/del/'.$user->id}}">删除</a>
						</td>
                      </tr>
                      @endforeach
                    </tbody>
                </table>
                {{$list->links()}}
            </div>
        </div>

@endsection