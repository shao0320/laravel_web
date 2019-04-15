@extends('comment.admin_base')

@section('title','管理后台文章列表')


<!--页面顶部信息-->
@section('pageHeader')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> 文章列表 <span>Subtitle goes here...</span></h2>
        <div class="breadcrumb-wrapper">
            <a class="btn btn-sm btn-danger" href="/admin/article/article/add">+ 添加新文章</a>
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
                        <th>文章分类</th>
                        <th>文章名称</th>
                        <th>发布时间</th>
                        <th>点击次数</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($list))
                        @foreach($list as $v)
                        <tr>
                            <td>{{$v->id}}</td>
                            <td>{{$v->cate_name}}</td>
                            <td>{{$v->title}}</td>
                            <td>{{$v->publish_at}}</td>
                            <td>{{$v->clicks}}</td>
                            <td>
                                @if($v->status == 1 ) 待审核
                                @elseif($v->status == 2) 审核
                                @else 发布
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-sm btn-success" href="/admin/article/article/edit/{{$v->id}}">编辑</a>
                                <a class="btn btn-sm btn-danger" href="/admin/article/article/del/{{$v->id}}">删除</a>
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