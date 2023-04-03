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
    <li class="breadcrumb-item"><a href="javascript:;">Thêm mới</a></li>
@endpush
@push('css')
    <link rel="stylesheet" href="{{ asset(PLUGIN_ASSETS_FOLDER.'select2/select2.min.css?ver='.$ver) }}">
    <link rel="stylesheet" href="{{ asset(PLUGIN_ASSETS_FOLDER.'select2/select2-bootstrap4.min.css?ver='.$ver) }}">
@endpush
@push('js')
    <script src="{{ asset(PLUGIN_ASSETS_FOLDER.'select2/select2.min.js?ver='.$ver) }}"></script>
    <script src="{{ asset(BACKEND_JS.'admin.js?ver='.$ver) }}"></script>
@endPush
@section('content')
<div class="container-fluid mt-n10">
    <div class="card mb-4">
        <div class="card-header">
            {{!isset($data)?'Thêm quản trị viên mới':'Chỉnh sửa thông tin quản trị viên'}}
        </div>
        <div class="card-body">
            <form method="post" id="formQuanTri">
                {{ csrf_field() }}
                {{-- <div class="form-group">
                    <label for="">Ảnh đại diện</label>
                    <input type="file" class="form-control" name="" id="">
                </div> --}}
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <label for="">Tên tài khoản <span class="text-danger">*</span></label>
                            <input class="form-control slug-base" name="{{$FN->f_taiKhoan}}" type="text" value="{{isset($data)?$data->{$FN->taiKhoan}:null}}" placeholder="Vietsoftpro" {{isset($data)?'readonly':''}}>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="">Họ và tên <span class="text-danger">*</span></label>
                            <input class="form-control" name="{{$FN->f_ten}}" type="text" value="{{isset($data)?$data->{$FN->ten}:null}}" placeholder="Nguyễn Văn A">
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="">Số điện thoại</label>
                            <input class="form-control" name="{{$FN->f_sdt}}" type="text" value="{{isset($data)?$data->{$FN->sdt}:null}}" placeholder="+84354567890">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <label for="">Đường dẫn <span class="text-danger">*</span></label>
                            <input class="form-control slug" disabled name="{{$FN->f_slug}}" type="text" value="{{isset($data)?$data->{$FN->slug}:null}}" placeholder="vietsoftpro">
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="">Email <span class="text-danger">*</span></label>
                            <input class="form-control" name="{{$FN->f_homThu}}" type="text" value="{{isset($data)?$data->{$FN->homThu}:null}}" placeholder="email@vietsoftpro.com">
                            @isset($data)
                                <input class="form-control" name="{{$FN->f_homThuCu}}" type="hidden" value="{{isset($data)?$data->{$FN->homThu}:null}}" placeholder="email@vietsoftpro.com">
                            @endisset
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="">Địa chỉ</label>
                            <input class="form-control" name="{{$FN->f_diaChi}}" type="text" value="{{isset($data)?$data->{$FN->diaChi}:null}}" placeholder="17/81, Láng Hạ, Ba Đình, Hà Nội">
                        </div>

                    </div>
                </div>
                {{-- <div class="form-group border-left border-lg rounded border-primary">
                    <div class="input-group">
                        <div class="input-group-prepend form-control js-collap-box">
                            Quyền hạn
                        </div>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-outline-purple js-collap" data-target=".quyen-han"><i class="fas fa-angle-down"></i></button>
                        </div>
                    </div>
                    <div class="quyen-han">
                        <?php if (isset($dsQuyen)) : ?>
                            <table class="table">
                                <thead>
                                    <th>Tên chức năng</th>
                                    <?php foreach ($dsQuyen as $k => $v) : ?>
                                        <th data-id="<?= $k + 2 ?>" class="ten-quyen"><?= $v[TEN] ?></th>
                                    <?php endforeach; ?>
                                </thead>
                                <tbody>
                                    <?php if (isset($chucnang)) : ?>
                                        <?php foreach ($chucnang as $k => $v) : ?>
                                            <?php $temp = json_decode($v["quyenHan"], true) ?>
                                            <tr>
                                                <td><?= $v[TEN] ?></td>
                                                <?php foreach ($dsQuyen as $k1 => $v2) : ?>
                                                    <td>
                                                        <?php if (in_array($v2["maQuyen"], $temp)) : ?>
                                                            <div class="custom-control custom-checkbox">
                                                                <input name="quyen[<?= $v['maChucNang'] ?>][]" value="<?= $v2['maQuyen'] ?>" id="<?= 'ck-' . $v['maChucNang'] . '-' . $v2['maQuyen'] ?>" class="custom-control-input" type="checkbox" <?= (isset($data) && isset($data[QUH][$v['maChucNang']]) && is_array($data[QUH][$v['maChucNang']]) && in_array($v2['maQuyen'], $data[QUH][$v['maChucNang']])) ? "checked" : null ?> <?= ($_SESSION['quantri'][CD] != 1) ? 'onclick="return false;"' : null ?>>
                                                                <label class="custom-control-label" for="<?= 'ck-' . $v['maChucNang'] . '-' . $v2['maQuyen'] ?>"></label>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                <?php endforeach; ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                </div> --}}
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <label for="">Chức danh <span class="text-danger">*</span></label>
                            <select name="{{$FN->f_chucDanh}}" class="select2" data-minimum-results-for-search="Infinity" data-placeholder="---Chọn chức danh---">
                                <option></option>
                                <?php if (isset($chuc_danh)) : ?>
                                    <?php foreach ($chuc_danh as $k => $v) : ?>
                                        <option value="<?= $v->{$RF->ma} ?>" <?= (isset($data) && $data->{$FN->chucDanh} == $v->{$RF->ma}) ? "selected" : null ?>><?= $v->{$RF->ten} ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        @if(isset($data))
                        <div class="col-12 col-md-4">
                            <label for="">Trạng thái</label>
                            <select name="{{$FN->trangThai}}" class="select2" data-minimum-results-for-search="Infinity" data-placeholder="Trạng thái">
                                <option></option>
                                @foreach ($status as $key => $value)
                                    <option value="<?=$value->{$SF->ma}??null?>" {{($value->{$SF->ma} == $data->{$FN->trangThai}) ? 'selected' : ''}}><?=$value->{$SF->ten}??null?></option>
                                @endforeach
                            </select>
                        </div>
                        @else
                        <div class="col-12 col-md-4">
                            @isset($data)
                                <label for="">Mật khẩu</label>
                                <input class="form-control" name="{{$FN->f_matKhau}}" type="password" value="vsp@1234" placeholder="" disabled>
                            @endisset
                        </div>
                        @endif
                    </div>
                </div>
                    {{-- <div class="form-group border-left border-lg rounded border-primary">
                            <div class="input-group">
                                <div class="input-group-prepend form-control js-collap-box">
                                    Đổi mật khẩu
                                </div>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-purple js-collap" data-target=".doi-mat-khau"><i class="fas fa-angle-down"></i></button>
                                </div>
                            </div>
                            <div class="col doi-mat-khau">
                                <div class="row mt-2">
                                    <div class="col-12 col-md-4">
                                        <label for="">Mật khẩu cũ</label>
                                        <input class="form-control" name="{{$FN->f_matKhauCu}}" type="text" value="" placeholder="Mật khẩu hiện tại">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="">Mật khẩu mới</label>
                                        <input class="form-control" name="{{$FN->f_matKhauMoi}}" type="password" value="" placeholder="Mật khẩu muốn thay đổi">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="">Xác nhận mật khẩu</label>
                                        <input class="form-control" name="{{$FN->f_matKhauXacNhan}}" type="password" value="" placeholder="Mật khẩu xác nhận phải giống mật khẩu mới">
                                    </div>
                                </div>
                            </div>
                        </div>            --}}
                
                <div class="action-group">
                    <button type="button" class="btn btn-primary js-btnSubmit">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection