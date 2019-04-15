@extends('comment.admin_base')

@section('title','管理后台广告列表')


<!--页面顶部信息-->
@section('pageHeader')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> 广告列表 <span>Subtitle goes here...</span></h2>
        <div class="breadcrumb-wrapper">
            <a class="btn btn-sm btn-danger" href="/admin/ad/add">+ 添加广告</a>
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
                        <th>广告图片</th>
                        <th>广告位</th>
                        <th>广告名字</th>
                        <th>广告地址</th>
                        <th>开始时间</th>
                        <th>结束时间</th>
                        <th>点击数</th>
                        <th>是否可用</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($list))
                        @foreach($list as $v)
                            <tr>
                                <td>{{$v->id}}</td>
                                <td><img src="{{$v->image_url}}" alt="" style="width:50px;"></td>
                                <td>{{$v->position_name}}</td>
                                <td>{{$v->ad_name}}</td>
                                <td>{{$v->ad_link}}</td>
                                <td>{{$v->start_time}}</td>
                                <td>{{$v->end_time}}</td>
                                <td>{{$v->clicks}}</td>
                                <td>{{$v->status == 1 ? "可用" : "禁用" }}</td>
                                <td>
                                    <a class="btn btn-sm btn-success" href="/admin/ad/edit/{{$v->id}}">编辑</a>
                                    <a class="btn btn-sm btn-danger"  href="/admin/ad/del/{{$v->id}}">删除</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                {{$list->links()}}
            </div><!-- table-responsive -->
        </div>
    </div>
    <script src="/js/vue.js"></script>
@endsection