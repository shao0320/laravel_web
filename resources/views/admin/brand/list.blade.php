@extends('comment.admin_base')

@section('title','管理后台商品品牌')


<!--页面顶部信息-->
@section('pageHeader')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> 商品品牌 <span>Subtitle goes here...</span></h2>
        <div class="breadcrumb-wrapper">
            <a class="btn btn-sm btn-danger" href="/admin/brand/add">+ 商品品牌</a>
        </div>
    </div>
@endsection

@section('content')
    <div class="row" id="app">
        {{csrf_field()}}
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-primary  mb30">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>品牌名称</th>
                        <th>是否可用</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="brand in getBrandList">
                        <td>{brand.id}</td>
                        <td>{brand.brand_name}</td>
                        <td>
                           <button v-if="brand.status==1" class="btn btn-sm btn-success" @click="updateStatus(brand.id,'status',2)">可用</button>
                            <button v-else="brand.status == 2" class="btn btn-sm btn-black" @click="updateStatus(brand.id,'status',1)">禁用</button>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-warning" v-bind:href="'/admin/brand/edit/'+brand.id">修改</a>&nbsp;
                            <button class="btn btn-sm btn-danger" @click="delRecord(brand.id)">删除</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div><!-- table-responsive -->
        </div>
    </div>
    <script src="/js/vue.min.js"></script>
    <script>
        var app = new Vue({
            el:"#app",
            delimiters:["{","}"],
            data:{
                getBrandList:[]
            },
            created:function(){
              this.getBrand();
            },
            methods:{
                getBrand:function(){
                    var that = this;
                    $.ajax({
                        url:"/admin/brand/getLists",
                        data:{_token:$("input[name=_token]").val()},
                        type:"post",
                        dataType:"json",
                        success:function(res){
                            that.getBrandList = res.data;
                        }
                    });
                },
                delRecord:function(id){
                    var that =this;
                    $.ajax({
                        url:"/admin/brand/del/"+id,
                        data:{},
                        type:"get",
                        dataType:"json",
                        success:function(res){
                            if(res.code == 2000){
                                that.getBrand();
                            }
                        }
                    })
                },
                updateStatus:function(id,key,value){
                    var that = this;
                    $.ajax({
                        url:"/admin/brand/updateStatus",
                        data:{_token:$("input[name=_token]").val(),id:id,key:key,value:value},
                        type:"post",
                        dataType:"json",
                        success:function(res){
                            if(res.code == 2000){
                                that.getBrand();
                            }
                        }
                    });
                }
            }
        })

    </script>
@endsection