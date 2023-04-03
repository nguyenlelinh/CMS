@extends(TPL_VIEW_FOLDER.'default_layout')
@push('header_title')
    <div class="page-header-icon"><i data-feather="aperture"></i></div>
    Dashboard
@endpush
@push('breadcrumb')
    <li class="breadcrumb-item"><a href="/cms">Trang chủ</a></li>
    <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
@endpush
@section('content')
<div class="container-fluid mt-n10">
    <div class="card mb-4">
        <div class="card-header">
            Dashboard
        </div>
        <div class="card-body">

            
        </div>
    </div>
</div>
@endsection