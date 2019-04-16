@extends('common.admin_base')

@section('title','管理后台配送方式列表')


<!--页面顶部信息-->
@section('pageHeader')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> 配送方式列表 <span>Subtitle goes here...</span></h2>
        <div class="breadcrumb-wrapper">
            <a class="btn btn-sm btn-danger" href="/admin/shipping/add">+ 配送方式</a>
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
                        <th>配送名称</th>
                        <th>简介</th>
                        <th>配送费</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($list))
                        @foreach($list as $v)
                            <tr>
                                <td>{{$v['id']}}</td>
                                <td>{{$v['shipping_name']}}</td>
                                <td>{{$v['shipping_desc']}}</td>
                                <td>{{$v['fee']}}</td>
                                <td>{{$v['status'] == 1 ? "可用" : "禁用"}}</td>
                                <td>
                                    <a class="btn btn-sm btn-danger" href="/admin/shipping/del/{{$v['id']}}">删除</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div><!-- table-responsive -->
        </div>
    </div>
    <script src="/js/vue.min.js"></script>
@endsection