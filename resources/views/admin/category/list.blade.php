@extends('comment.admin_base')

@section('title','管理后台商品分类')


<!--页面顶部信息-->
@section('pageHeader')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> 商品分类 <span>Subtitle goes here...</span></h2>
        <div class="breadcrumb-wrapper">
            <a class="btn btn-sm btn-danger" href="/admin/category/add">+ 商品分类</a>
        </div>
    </div>
@endsection

@section('content')
    {{csrf_field()}}
    <div class="row" id="category_list">

        <div class="col-md-12">
            <div class="table-responsive">
                <p><button v-if="fid > 0" v-on:click="category_list(0)" class="btn btn-sm btn-success">返回</button></p>
                <table class="table table-primary  mb30">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>分类名称</th>
                        <th>是否可用</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr  v-for="category in getCategoryList">
                        <td>{category.id}</td>
                        <td>{category.cate_name}</td>
                        <td>
                            <button v-if="category.status == 1" class="btn btn-sm btn-success">可用</button>
                            <button v-else class="btn btn-sm btn-black">禁用</button>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-success" v-on:click="category_list(category.id)">查看子集</button>
                            <a class="btn btn-sm btn-warning" v-bind:href="'/admin/category/edit/'+category.id">编辑</a>
                            <button class="btn btn-sm btn-danger" v-on:click="delCategory(category.id)">删除</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div><!-- table-responsive -->
        </div>
    </div>
    <script src="/js/vue.min.js"></script>
    <script>
        var category = new Vue({
            el:"#category_list",
            delimiters:["{","}"],
            data:{
                getCategoryList:[],
                fid:0
            },
            created:function(){
                this.category_list();
            },
            methods: {
                category_list: function (fid=0) {
                    var that = this;
                    this.fid=fid;
                    $.ajax({
                        url: "/admin/category/getCategory/"+fid,
                        data: {_token: $("input[name=_token]").val()},
                        type: "post",
                        dataType: "json",
                        success: function (res) {
                            if(res.code == 2000){
                                that.getCategoryList = res.data;
                            }
                        }
                    });
                },
                //删除
                delCategory: function (id) {
                    var that = this;

                    $.ajax({
                        url: "/admin/category/del/"+id,
                        data: {},
                        type: "get",
                        dataType: "json",
                        success: function (res) {
                            if(res.code == 2000){
                                that.category_list(that.fid);
                            }
                        }
                    });
                }
            }
        })
    </script>
@endsection