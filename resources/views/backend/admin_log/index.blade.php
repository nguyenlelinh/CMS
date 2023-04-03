@extends(TPL_VIEW_FOLDER.'default_layout')
@section('content')
<div class="container-fluid mt-n10">
    <div class="card mb-4">
        <div class="card-header">
            Lịch sử quản trị
            <div class="float-right">
                {{-- <button class="btn btn-sm btn-blue" title="Thêm mới" onclick="window.location.href = '/cms/quan-tri/them-quan-tri-vien.vsp'"><i class="fa fa-plus"></i>&nbsp;Thêm mới</button> --}}
                @if (!isset($thungRac))
                    <button class="btn btn-sm btn-yellow" title="Thùng rác" onclick="window.location.href = '/cms/quan-tri/lich-su-da-xoa.vsp'"><i class="fa fa-trash"></i>&nbsp;Thùng rác</button>
                @else
                    <button class="btn btn-sm btn-green" title="Về trang danh sách" onclick="window.location.href = '/cms/quan-tri/lich-su-quan-tri.vsp'"><i class="fa fa-list"></i>&nbsp;Về trang danh sách</button>
                @endif  
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover" id="datatable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="10%">Mã</th>
                        <th width="20%">Tên quản trị</th>
                        <th width="15%">Tài khoản</th>
                        <th>Hành động</th>
                        <th width="15%">Thời gian</th>
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