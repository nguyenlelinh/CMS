<?php $ver = 0; ?>
@extends(TPL_VIEW_FOLDER.'default_layout')
@push('css')
    <link rel="stylesheet" href="{{ asset(PLUGIN_ASSETS_FOLDER.'datatable/datatables.min.css?ver='.$ver) }}">
@endpush
@push('js')
    <script src="{{ asset(PLUGIN_ASSETS_FOLDER.'datatable/datatables.min.js?ver='.$ver) }}"></script>
    <script>let config = JSON.parse('@json($datatable_config)');</script>
    @include(TPL_VIEW_FOLDER.'_init-datatable')
@endPush
@section('content')
<div class="container-fluid mt-n10">
    <div class="card mb-4">
        <div class="card-header">
            Chức danh quản trị
            <div class="float-right">
                <button class="btn btn-sm btn-blue" title="Thêm mới" onclick="window.location.href = '/cms/quan-tri/them-chuc-danh.vsp'"><i class="fa fa-plus"></i>&nbsp;Thêm mới</button>
                @if (!isset($thungRac))
                    <button class="btn btn-sm btn-yellow" title="Thùng rác" onclick="window.location.href = '/cms/quan-tri/chuc-danh-da-xoa.vsp'"><i class="fa fa-trash"></i>&nbsp;Thùng rác</button>
                @else
                    <button class="btn btn-sm btn-green" title="Về trang danh sách" onclick="window.location.href = '/cms/quan-tri/chuc-danh.vsp'"><i class="fa fa-list"></i>&nbsp;Về trang danh sách</button>
                @endif
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover" id="datatable" width="100%" cellspacing="0">
                {{ csrf_field() }}
                <thead>
                    <tr>
                        <th width="3%">STT</th>
{{--                        <th>Mã chức danh</th>--}}
                        <th>Tên chức danh</th>
                        <th width="10%">Trạng thái</th>
                        <th width="15%">Ngày Tạo</th>
                        <th width="10%">Tương tác</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
