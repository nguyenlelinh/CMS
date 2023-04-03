<?php

namespace App\Http\MappingClass;

use stdClass;

class Admin
{
    private const PREFIX = 'ADM_';
    private const VIEW_PREFIX = 'x8hdl3xh-';
    private $table = 'admin';

    private $db_field = [
        'ma' => self::PREFIX.'id',
        'ten' => self::PREFIX.'name',
        'slug' => self::PREFIX.'slug',
        'uname' => self::PREFIX.'username',
        'pass' => self::PREFIX.'password',
        'avatar' => self::PREFIX.'avatar',
        'email' => self::PREFIX.'email',
        'addr' => self::PREFIX.'address',
        'phone' => self::PREFIX.'phone',
        'role' => self::PREFIX.'role',
        'ext' => self::PREFIX.'extend_data',
        'pKey' => self::PREFIX.'password_reset_key',
        'op' => self::PREFIX.'order_prioritize',
        'stt' => self::PREFIX.'status',
        'cDate' => self::PREFIX.'created_date',
        'chDate' => self::PREFIX.'changed_date',
    ];

    private $fe_field=[
        'ma' => self::VIEW_PREFIX.'ma-admin',
        'ten' => self::VIEW_PREFIX.'ten-admin',
        'slug' => self::VIEW_PREFIX.'duong-dan',
        'uname' => self::VIEW_PREFIX.'tai-khoan',
        'pass' => self::VIEW_PREFIX.'mat-khau',
        'avatar' => self::VIEW_PREFIX.'anh-dai-dien',
        'email' => self::VIEW_PREFIX.'hom-thu',
        'oEmail' => self::VIEW_PREFIX.'hom-thu-cu',
        'addr' => self::VIEW_PREFIX.'dia-chi',
        'phone' => self::VIEW_PREFIX.'dien-thoai',
        'role' => self::VIEW_PREFIX.'vai-tro',
        'ext' => self::VIEW_PREFIX.'mo-rong',
        'pKey' => self::VIEW_PREFIX.'khoa-reset-mat-khau',
        'op' => self::VIEW_PREFIX.'thu-tu-uu-tien',
        'stt' => self::VIEW_PREFIX.'trang-thai',
        'cDate' => self::VIEW_PREFIX.'ngay-tao',
        'chDate' => self::VIEW_PREFIX.'chinh-sua-lan-cuoi',
    ];

    public function __construct(){}
    public function __get($key){
        $returnData =   $key  == 'tenBang'?$this->table: //Cần giữ key
                        ($key == 'ma'?$this->db_field['ma']: //Cần giữ key
                        ($key == 'ten'?$this->db_field['ten']:
                        ($key == 'slug'?$this->db_field['slug']: //Cần giữ key
                        ($key == 'taiKhoan'?$this->db_field['uname']:
                        ($key == 'matKhau'?$this->db_field['pass']:
                        ($key == 'avt'?$this->db_field['avatar']:
                        ($key == 'homThu'?$this->db_field['email']:
                        ($key == 'diaChi'?$this->db_field['addr']:
                        ($key == 'sdt'?$this->db_field['phone']:
                        ($key == 'chucDanh'?$this->db_field['role']:
                        ($key == 'moRong'?$this->db_field['ext']:
                        ($key == 'pKey'?$this->db_field['pKey']:
                        ($key == 'uuTien'?$this->db_field['op']:
                        ($key == 'trangThai'?$this->db_field['stt']: //Cần giữ key
                        ($key == 'ngayTao'?$this->db_field['cDate']:  //Cần giữ key
                        ($key == 'chinhSua'?$this->db_field['chDate']:  //Cần giữ key
                        ($key == 'f_ma'?$this->fe_field['ma']: //Cần giữ key
                        ($key == 'f_ten'?$this->fe_field['ten']:
                        ($key == 'f_slug'?$this->fe_field['slug']:
                        ($key == 'f_taiKhoan'?$this->fe_field['uname']:
                        ($key == 'f_matKhau'?$this->fe_field['pass']:
                        ($key == 'f_avt'?$this->fe_field['avatar']:
                        ($key == 'f_homThu'?$this->fe_field['email']:
                        ($key == 'f_homThuCu'?$this->fe_field['oEmail']:
                        ($key == 'f_diaChi'?$this->fe_field['addr']:
                        ($key == 'f_sdt'?$this->fe_field['phone']:
                        ($key == 'f_chucDanh'?$this->fe_field['role']:
                        ($key == 'f_moRong'?$this->fe_field['ext']:
                        ($key == 'f_pKey'?$this->fe_field['pKey']:
                        ($key == 'f_uuTien'?$this->fe_field['op']:
                        ($key == 'f_trangThai'?$this->fe_field['stt']:
                        ($key == 'f_ngayTao'?$this->fe_field['cDate']:
                        ($key == 'f_chinhSua'?$this->fe_field['chDate']:
                        false)))))))))))))))))))))))))))))))));
        return $returnData;

    }
}
