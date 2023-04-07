<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Base\BaseController;
use App\Http\Classes\Validate;
use App\Http\MyModels\Backend\Admin as Model;
use App\Http\MyModels\Backend\AdminRole as RoleModel;
use App\Http\MyModels\Backend\Status as StatusModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Admin extends BaseController
{
    private $model;
    private const VIEW_URL = 'backend/admin/';
    public function __construct()
    {
        parent::__construct();
        $this->model = new Model();
        //Do your magic here
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $query = $this->getDatatableRequest($request);
            $returnData = $this->model->datatable_get($query);
            json($returnData);
        }
        $data = [
            'datatable_config'=> $this->model->datatable,
        ];
        return view(self::VIEW_URL.'index', $data);
    }

    public function deletedList(Request $request)
    {
        if($request->ajax()){
            $query = $this->getDatatableRequest($request);
            $returnData = $this->model->datatable_get($query, TRUE);
            json($returnData);
        }
        $data = [
            'datatable_config'=> $this->model->datatable,
            "bin" => TRUE
        ];
        return view(self::VIEW_URL.'index', $data);
    }

    public function create(Request $request)
    {
        if($request->ajax()){
//            dd($request);
            $admin = $this->validateWhenCreate($request->input());
            $admin[$this->model->FN->matKhau] =  Hash::make('12345678');
            $admin[$this->model->FN->ngayTao] = time();
            $inserted_id = $this->model->insert($admin);
            if($inserted_id){
                $this->ghiLog('Tạo mới tài khoản quản trị '.$admin[$this->model->FN->taiKhoan]);
                sendMessage('Thêm mới thành công', true, '/cms/quan-tri/danh-sach.vsp');
            } else sendMessage('Có lỗi xảy ra, vui lòng thử lại');
        }
        $M_Role = new RoleModel();
        $data = [
            'FN'=>$this->model->FN,
            'RF'=>$M_Role->FN,
            'chuc_danh'=>$M_Role->getByStatus(1),
        ];
//        dd($data);
        return view(self::VIEW_URL.'form', $data);
    }

    public function update(Request $request, $slug, $id)
    {
        if($request->ajax()){
            $admin = $this->validateWhenUpdate($request->input());
            $admin[$this->model->FN->chinhSua] = time();
            $check = $this->model->update($admin, [$this->model->FN->ma=>$id]);
            if($check){
                $this->ghiLog('Chỉnh sửa thông tin tài khoản quản trị '.$request->input($this->model->FN->taiKhoan));
                sendMessage('Cập nhật thành công', true, '/cms/quan-tri/danh-sach.vsp');
            } else sendMessage('Có lỗi xảy ra, vui lòng thử lại');
        }
        $M_Role = new RoleModel();
        $M_Status = new StatusModel();
        $data = [
            'FN'=>$this->model->FN,
            'RF'=>$M_Role->FN,
            'SF'=>$M_Status->FN,
            'chuc_danh'=>$M_Role->getByStatus(1),
            'status'=>$M_Status->getByCondition([$M_Status->FN->ma=>[OP=>'<>',VAL=>3]]),
            'data'=>$this->model->getBySlugAndId($slug, $id, 1)
        ];
        return view(self::VIEW_URL.'form', $data);
    }

    public function login(Request $request)
    {
        if($request->ajax()){

        }
        $data = [];
        return view(self::VIEW_URL.'login', $data);
    }

    public function autoLogin(Request $request)
    {
        if($request->ajax()){

        }
    }

    public function logout()
    {

    }

    public function changePassword()
    {

    }

    public function profile(Request $request)
    {
        if($request->ajax()){

        }
        $data = [];
        return view(self::VIEW_URL.'profile', $data);
    }

    public function delete($id){
        $data = $this->model->getById($id, 1);
        $this->ghiLog('Xoá tài khoản quản trị '.$data->{$this->model->FN->taiKhoan});
        $check = $this->model->soft_delete([$this->model->FN->ma => $id]);
        sendMessage(($check) ? 'Đã xóa' : 'Có lỗi xảy ra, vui lòng thử lại', $check);
    }

    public function restore($id){
        $data = $this->model->getById($id, 1);
        $this->ghiLog('Khôi phục tài khoản quản trị '.$data->{$this->model->FN->taiKhoan});
        $check = $this->model->restore([$this->model->FN->ma => $id]);
        sendMessage(($check) ? 'Đã hồi phục' : 'Có lỗi xảy ra, vui lòng thử lại', $check);
    }

    public function remove($id){
        $data = $this->model->getById($id, 1);
        $this->ghiLog('Xoá vĩnh viễn tài khoản quản trị '.$data->{$this->model->FN->taiKhoan});
        $check = $this->model->hard_delete([$this->model->FN->ma => $id]);
        if($check){
            /**
             * !Xử lý dữ liệu liên quan đến bản ghi vừa xoá (ảnh, tài liệu đã upload...)
             * */
        }
        sendMessage(($check) ? 'Đã xóa' : 'Có lỗi xảy ra, vui lòng thử lại', $check);
    }

    private function validateWhenCreate($input)
    {
        $validate = new Validate();
        $taiKhoan = $input[$this->model->FN->f_taiKhoan];
        $slug = prettyURL($taiKhoan);
        $fullName = $input[$this->model->FN->f_ten];
        $email = $input[$this->model->FN->f_homThu];
        $phone = $input[$this->model->FN->f_sdt];
        $addr = $input[$this->model->FN->f_diaChi];
        $role = $input[$this->model->FN->f_chucDanh];
        $taiKhoan = $validate->validateTaiKhoan($taiKhoan);
        $slug = $validate->validateSlug($slug);
        $email = $validate->validateEmail($email);
        $admin[$this->model->FN->ten] = $validate->validateFullName($fullName);
        $admin[$this->model->FN->sdt] = $validate->validatePhone($phone);
        $admin[$this->model->FN->diaChi] = htmlspecialchars($addr);
        $admin[$this->model->FN->chucDanh] = $validate->validateChucDanh($role);
        $admin[$this->model->FN->taiKhoan] = $validate->checkUniqueTaiKhoan($taiKhoan, new Model());
        $admin[$this->model->FN->slug] = $validate->checkUniqueSlug($slug, new Model());
        $admin[$this->model->FN->homThu] = $validate->checkUniqueEmail($email, new Model());
        return $admin;
    }


    private function validateWhenUpdate($input)
    {
        $validate = new Validate();
        $fullName = $input[$this->model->FN->f_ten];
        $email = $input[$this->model->FN->f_homThu];
        $oEmail = $input[$this->model->FN->f_homThuCu];
        $phone = $input[$this->model->FN->f_sdt];
        $addr = $input[$this->model->FN->f_diaChi];
        $role = $input[$this->model->FN->f_chucDanh];
        $email = $validate->validateEmail($email);
        $admin[$this->model->FN->ten] = $validate->validateFullName($fullName);
        $admin[$this->model->FN->sdt] = $validate->validatePhone($phone);
        $admin[$this->model->FN->diaChi] = htmlspecialchars($addr);
        $admin[$this->model->FN->chucDanh] = $validate->validateChucDanh($role);
        $admin[$this->model->FN->homThu] = $validate->checkUniqueEmail($email, new Model(), $oEmail);
        return $admin;
    }

    private function validateWhenLogin($input)
    {
        $validate = new Validate();
        $taiKhoan = $input[$this->model->FN->f_taiKhoan];
        $matKhau = $input[$this->model->FN->f_matKhau];
        $admin[$this->model->FN->taiKhoan] = $validate->validateTaiKhoan($taiKhoan);
        $admin[$this->model->FN->matKhau] = $validate->validateMatKhau($matKhau);
        return $admin;
    }

    private function validateWhenChangePass($input)
    {

    }
}
