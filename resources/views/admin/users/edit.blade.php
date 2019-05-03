@extends("comment.admin_base")

@section("title","后台管理-用户修改")

	<!-- 页面顶部信息 -->
@section('pageHeader')
<div class="pageheader">
      <h2><i class="fa fa-home"></i> 用户修改 <span>Subtitle goes here...</span></h2>
      <div class="breadcrumb-wrapper">
        
      </div>
    </div>
@endsection

@section("content")
<div class="contentpanel">
      <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <span id="error_msg"></span>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-btns">
            <a href="" class="panel-close">&times;</a>
            <a href="" class="minimize">&minus;</a>
          </div>

          <h4 class="panel-title">用户编辑表单</h4>
          <p>Individual form controls automatically receive some global styling. All textual elements with <code>.form-control</code> are set to width: 100%; by default. Wrap labels and controls in <code>.form-group</code> for optimum spacing.</p>
        </div>
        <div class="panel-body panel-body-nopadding">

          <form class="form-horizontal form-bordered" action="{{route('admin.user.doEdit')}}" method="post" enctype="multipart/form-data">
            	{{csrf_field()}}
            	<input type="hidden" name="id" value="{{$user->id}}">
             <div class="form-group">
              <label class="col-sm-3 control-label">用户角色</label>
              <div class="col-sm-6">
                <select name="role_id" class="form-bordered" >
                	@if(!empty($roles))
                		@foreach($roles as $role)
                			<option value="{{$role['id']}}" @if($role_id == $role['id'])  selected @endif>{{$role['rolename']}}</option>
                		@endforeach 
                	@endif
               	</select>
              </div>
            </div>
             <div class="form-group">
              <label class="col-sm-3 control-label">用户名称</label>
              <div class="col-sm-6">
                <input type="text" placeholder="用户名称" class="form-control" name="username" value="{{$user->username}}"/>
              </div>
            </div>
             
            
            <div class="form-group">
              <label class="col-sm-3 control-label">用户头像</label>
              <div class="col-sm-6">
                <input type="file" placeholder="用户头像" class="form-control" name="image_url"/>
                <img src="{{$user->image_url}}" style="width:60px;" alt="">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">是否超管</label>
              <div class="col-sm-6">
      					 <div class="radio"><label><input type="radio" value="1" name="is_super" @if($user->is_super == 1)  checked @endif>否</label></div>
      					 <div class="radio"><label><input type="radio"   value="2" name="is_super" @if($user->is_super == 2)  checked @endif>是</label></div>
			         </div>
            </div>
             <div class="form-group">
              <label class="col-sm-3 control-label">用户状态</label>
              <div class="col-sm-6">
					 <div class="radio"><label><input type="radio" value="1" name="status" @if($user->status == 1)  checked @endif>正常</label></div>
					 <div class="radio"><label><input type="radio"   value="2" name="status" @if($user->status == 2)  checked @endif>禁用</label></div>
			  </div>
            </div>
             <div class="panel-footer">
			 <div class="row">
				<div class="col-sm-6 col-sm-offset-3">
				  <button class="btn btn-primary btn-danger" id="btn-save">修改用户</button>&nbsp;
				 
				</div>
			 </div>
			</div><!-- panel-footer -->
          </form>
          
        </div><!-- panel-body -->
        
       
	  </div>
	</div>

	<!-- <script>
		
		$(".alert-danger").hide();
		$("#btn-save").click(function(){

			var name = $("input[name=name]").val();
			var url = $("input[name=url]").val();

			if(name==""||url==""){
				$('#error_msg').text("名字或者url不能为空");
				$(".alert-danger").toggle();
				return false;
			}
		});
		

	</script> -->
@endsection