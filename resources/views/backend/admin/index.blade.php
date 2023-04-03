<?php $ver = 0; ?>
@extends(TPL_VIEW_FOLDER.'default_layout')

@push('header_title')
    <div class="page-header-icon"><i data-feather="briefcase"></i></div>
    Quản trị viên
@endpush

@push('breadcrumb')
    <li class="breadcrumb-item"><a href="/cms">Trang chủ</a></li>
    <li class="breadcrumb-item"><a href="/cms/quan-tri/danh-sach.vsp">Quản trị viên</a></li>
    <li class="breadcrumb-item"><a href="/cms/quan-tri/danh-sach.vsp">Danh sách</a></li>
    @if (isset($bin))
        <li class="breadcrumb-item"><a href="/cms/quan-tri/danh-sach-da-xoa.vsp">Đi tới thùng rác</a></li>
    @endif
@endpush

@push('css')
    <link rel="stylesheet" href="{{ asset(PLUGIN_ASSETS_FOLDER.'datatable/datatables.min.css?ver='.$ver) }}">
@endpush
{{-- Post thêm data cho datatable --}}
@push('customField')
    //data.maDanhMuc = $("select#maDanhMuc").val();
@endpush
{{-- End post thêm data cho datatable --}}
@push('js')
    <script src="{{ asset(PLUGIN_ASSETS_FOLDER.'datatable/datatables.min.js?ver='.$ver) }}"></script>
    <script>let config = JSON.parse('@json($datatable_config)');</script>
    @include(TPL_VIEW_FOLDER.'_init-datatable')
@endPush
@section('content')
<div class="container-fluid mt-n10">
    <div class="card mb-4">
        <div class="card-header">
            Danh sách quản trị viên <?=(isset($bin)?' đã xoá':'')?>
            <div class="float-right">
                <button class="btn btn-sm btn-blue" title="Thêm mới" onclick="window.location.href = '/cms/quan-tri/them-quan-tri-vien.vsp'"><i class="fa fa-plus"></i>&nbsp;Thêm mới</button>
                {{-- <button class="btn btn-sm btn-red" title="Xoá nhiều" onclick="window.location.href = '/cms/quan-tri/xoa.vsp'"><i class="fa fa-times"></i>&nbsp;Xoá nhiều</button> --}}
                @if (!isset($bin))
                    <button class="btn btn-sm btn-yellow" title="Thùng rác" onclick="window.location.href = '/cms/quan-tri/danh-sach-da-xoa.vsp'"><i class="fa fa-trash"></i>&nbsp;Đi tới thùng rác</button>
                @else
                    <button class="btn btn-sm btn-green" title="Về trang danh sách" onclick="window.location.href = '/cms/quan-tri/danh-sach.vsp'"><i class="fa fa-list"></i>&nbsp;Về trang danh sách</button>
                @endif
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover" id="datatable" width="100%" cellspacing="0">
                {{ csrf_field() }}
                <thead>
                    <tr>
                        {{-- <th width="3%">
                            <div class="custom-control custom-checkbox">
                                <input name="checkAll" value="" id="checkAll" class="custom-control-input" type="checkbox">
                                <label class="custom-control-label" for="checkAll"></label>
                            </div>
                        </th> --}}
                        <th width="3%">STT</th>
                        <th>Tên</th>
                        <th>Tài Khoản</th>
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
