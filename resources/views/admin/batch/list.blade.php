@extends('comment.admin_base')

@section('title','管理后台批次列表')


<!--页面顶部信息-->
@section('pageHeader')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> 批次列表 <span>Subtitle goes here...</span></h2>
        <div class="breadcrumb-wrapper">
            <a class="btn btn-sm btn-danger" href="/admin/batch/add">+ 添加批次</a>
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
                        <th>文件路径</th>
                        <th>文件类型</th>
                        <th>文件内容</th>
                        <th>状态</th>
                        <th>备注信息</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(!empty($batch))
                          @foreach($batch as $list)
                            <tr>
                                <td>{{$list['id']}}</td>
                                <td>{{$list['file_path']}}</td>
                                <td>
                                    @if($list['type'] == 1)
                                        发红包
                                    @elseif($list['type'] == 2)
                                        发短信
                                    @else
                                        发邮件
                                    @endif        
                                </td>
                                <td>{{$list['content']}}</td>
                                <td>
                                    @if($list['status'] == 1)
                                        未审核
                                    @elseif($list['status'] == 2)
                                        待发送
                                    @else
                                        已发送
                                    @endif        
                                </td>
                                <td>{{$list['note']}}</td>
                                <td>
                                  @if($list['status'] <= 2)
                                    <a class="btn btn-sm btn-success" href="/admin/batch/doBatch/{{$list->id}}">执行</a>
                                  @endif  
                                </td>
                            </tr>
                          @endforeach  
                        @endif    
                    </tbody>
                </table>
                {{$batch->links()}}
            </div><!-- table-responsive -->
        </div>
    </div>
    <script src="/js/vue.js"></script>
@endsection