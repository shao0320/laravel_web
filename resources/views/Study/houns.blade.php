<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>红包页面</title>
</head>
<script src="/css/app.css"></script>
<script src="/js/app.js"></script>
<body>
	<div id="houns">

		<div class="form-group">
	        <label class="col-sm-3 control-label">红包金额</label>
	        <div class="col-sm-6">
	            <input type="text" placeholder="请填写红包金额" class="form-control" name="total_houns"/>
	        </div>
	    </div>
		&nbsp;
		&nbsp;   
	    <div class="form-group">
	        <label class="col-sm-3 control-label">红包金额</label>
	        <div class="col-sm-6">
	            <input type="text" placeholder="请填写红包个数" class="form-control" name="total_nums"/>
	        </div>
	    </div>
		&nbsp;
		&nbsp;
		&nbsp;
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<button class="btn btn-primary btn-danger" v-on:click="addHouns">添加</button>&nbsp;
			</div>
		</div>
		&nbsp;
		&nbsp;
		&nbsp;

		<div>
		<table border="1" cellspacing="0" width="600px">
			<thead>
				<th>ID</th>
				<th>红包总额</th>
				<th>剩余额度</th>
				<th>红包总个数</th>
				<th>红包剩余个数</th>
				<th>操作</th>
			</thead>
			<tbody>
				<tr v-for="houns in getHouns">
					<td>{houns.id}</td>
					<td>{houns.total_houns}</td>
					<td>{houns.left_houns}</td>
					<td>{houns.total_nums}</td>
					<td>{houns.left_nums}</td>
					<td>抢红包</td>
				</tr>
			</tbody>
		</table>
	</div>

	</div>

	
</body>
<script src="/js/vue.min.js"></script>
<script>
	var houns = new Vue({
		// delimiters:['{','}'],
		// el:"#houns",
		// data:{
		// 	getHouns:[]
		// },
		// created:function(){
		// 	this.hounsShow();
		// },
		// methods:{
		// 	hounsShow:function(){
		// 		var that = this;
		// 		$.ajax({
		// 			url:"http://www.lara.com/study/study/getHounsLists",
		// 			type:"post",
		// 			dataType:"josn",
		// 			data:{},
		// 			success:function(res){
		// 				if(res.code == 2000){
		// 					that.getHouns = res.data;
		// 				}
		// 			},
		// 			error:function(e){

		// 			}
		// 		})
		// 	},


		delimiters:['{','}'],
		el:"#houns",
		data:{
			getHouns:[]
		},
		created:function(){
			this.getHounsLists();
		},
		methods:{
			getHounsLists:function(){
				var that = this;
				$.ajax({
					url:"/study/study/getHounsLists",
					type:"post",
					data:{},
					dataType:"json",
					success:function(res){
						if(res.code == 2000){
							that.getHouns=res.data;
						}
					},
					error:function(e){

					}
				});
			},

			addHouns:function(){

				var total_houns = $("input[name=total_houns]").val();
				var total_nums = $("input[name=total_nums]").val();
				var token = $("input[name=_token]").val();
				var that = this;
				
				if(total_houns==""||total_nums==""){
					alert("参数不能为空");
					return false;
				}

				$.ajax({
					url:"/study/study/addHouns",
					type:"post",
					dataType:"json",
					data:{
						total_houns : total_houns,
						total_nums : total_nums,
						token:token
					},
					success:function(res){
						if(res.code == 2000){
							alert(res.msg);
						}
					},
					error:function(e){

					}
				});
			}
		}	

	});
</script>

</html>