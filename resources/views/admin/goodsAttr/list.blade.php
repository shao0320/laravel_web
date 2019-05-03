@extends('comment.admin_base')

@section('title','管理后台商品类型')


<!--页面顶部信息-->
@section('pageHeader')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> 商品类型属性 <span>Subtitle goes here...</span></h2>
        <div class="breadcrumb-wrapper">
            <a class="btn btn-sm btn-danger" href="/admin/goods/attr/add">+ 商品类型属性</a>
        </div>
    </div>
@endsection

@section('content')
    <div class="row" id="list">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-primary  mb30">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>商品类型</th>
                        <th>属性名称</th>
                        <th>属性值的录入方式</th>
                        <th>可选值列表</th>
                        <th>状态</th>
                        <th class="col-md-3">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($list))
                    @foreach($list as $key=>$attr)
                    <tr>
                        <td>{{$attr->id}}</td>
                        <td>{{$attr->type_name}}</td>
                        <td>{{$attr->attr_name}}</td>
                        <td>
                            @if($attr->input_type == 1) 手动输入
                            @else 从列表中选值
                            @endif
                        </td>
                        <td>{{$attr->attr_value}}</td>
                        <td>
                            @if($attr->status == 1)正常
                            @else 禁用
                            @endif
                        </td>
                        <td>
                            <a href="/admin/goods/attr/edit/{{$attr->id}}"  class="btn btn-sm btn-success">修改</a>
                            <a class="btn btn-sm btn-warning" href="/admin/goods/attr/del/{{$attr->id}}">删除</a>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                    </tbody>
                </table>
                {{$list->links()}}
            </div><!-- table
            -responsive -->
        </div>
    </div>
    <script src="/js/vue.js"></script>
@endsection