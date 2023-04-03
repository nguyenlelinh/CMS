<?php
namespace App\Http\Classes;

class Validate
{
    public function validateTaiKhoan($taiKhoan)
    {
        if (!$taiKhoan) sendMessage('Tài khoản không được để trống.');
        elseif(strlen($taiKhoan)<6) sendMessage('Tài khoản phải có tối thiểu 6 ký tự.');
        elseif(strlen($taiKhoan)>132) sendMessage('Tài khoản chỉ có thể chứa 132 ký tự.');
        elseif(!preg_match('/^[a-z\d_]{6,132}$/i', $taiKhoan)) sendMessage('Tài khoản chỉ có thể bao gồm chữ, số cùng dấu gạch dưới.');
        return htmlspecialchars($taiKhoan);
    }

    public function validateMatKhau($matKhau)
    {
        if (!$matKhau) sendMessage('Mật khẩu không được để trống.');
        elseif(strlen($matKhau)<6) sendMessage('Mật khẩu phải có tối thiểu 6 ký tự.');
        // elseif(strlen($matKhau)>132) sendMessage('Mật khẩu chỉ có thể chứa 132 ký tự.');
        return htmlspecialchars($matKhau);
    }

    public function validateSlug($slug)
    {
        if (!$slug) sendMessage('Quá trình render slug xảy ra vấn đề.');
        return $slug;
    }

    public function validateFullName($fullName)
    {
        if (!$fullName) sendMessage('Họ và tên không được để trống.');
        return htmlspecialchars($fullName);
    }

    public function validateChucDanh($role)
    {
        if (!$role) sendMessage('Chức danh không được để trống.');
        return $role;
    }

    public function validateEmail($email)
    {
        if (!$email) sendMessage('Hòm thư không được để trống.');
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) sendMessage('Định dạng hòm thư không hợp lệ.');
        return htmlspecialchars($email);
    }

    public function validatePhone($phone)
    {
        if (!$phone) sendMessage('Số điện thoại không được để trống.');
        $phone = vnPhoneNumberCheck($phone);
        if(!$phone) sendMessage('Định dạng số điện thoại không hợp lệ.');
        return $phone;
    }
    
    public function checkUniqueTaiKhoan($taiKhoan, $model)
    {
        $check = $model->getByCondition([$model->FN->taiKhoan=>$taiKhoan],1);
        if($check) sendMessage('Tài khoản này đã bị người khác sử dụng.');
        return $taiKhoan;
    }

    public function checkUniqueSlug($slug, $model, $oldSlug='')
    {
        if($oldSlug=='' || $oldSlug!=$slug){
            $check = $model->getBySlug([$model->FN->slug=>$slug],1);
            if($check){
                $num = rand(0, 999);
                $slug.="-".$num.time();
            }
        }
        return $slug;
    }

    public function checkUniqueEmail($email, $model, $oldEmail='')
    {
        if($oldEmail=='' || $oldEmail!=$email){
            $check = $model->getByCondition([$model->FN->homThu=>$email],1);
            if($check) sendMessage('Email này đã bị người khác sử dụng.');
        }
        return $email;
    }
}