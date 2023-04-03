<?php

namespace App\Http\MappingClass;

use stdClass;

class AdminRole
{
    private const PREFIX = 'ADR_';
    private const VIEW_PREFIX = 'x8fg4xh-';
    private $table = 'admin_role';

    private $db_field = [
        'ma' => self::PREFIX.'id',
        'ten' => self::PREFIX.'name',
        'slug' => self::PREFIX.'slug',
        'perm' => self::PREFIX.'permission',
        'ext' => self::PREFIX.'extend_data',
        'op' => self::PREFIX.'order_prioritize',
        'stt' => self::PREFIX.'status',
        'cDate' => self::PREFIX.'created_date',
        'chDate' => self::PREFIX.'changed_date',
    ];

    private $fe_field=[
        'ma' => self::VIEW_PREFIX.'ma-role',
        'ten' => self::VIEW_PREFIX.'ten-role',
        'slug' => self::VIEW_PREFIX.'duong-dan',
        'perm' => self::VIEW_PREFIX.'quyen-han',
        'ext' => self::VIEW_PREFIX.'mo-rong',
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
                        ($key == 'qh'?$this->db_field['perm']:
                        ($key == 'moRong'?$this->db_field['ext']:
                        ($key == 'uuTien'?$this->db_field['op']:
                        ($key == 'trangThai'?$this->db_field['stt']: //Cần giữ key
                        ($key == 'ngayTao'?$this->db_field['cDate']:  //Cần giữ key
                        ($key == 'chinhSua'?$this->db_field['chDate']:  //Cần giữ key
                        ($key == 'f_ma'?$this->fe_field['ma']:
                        ($key == 'f_ten'?$this->fe_field['ten']:
                        ($key == 'f_slug'?$this->fe_field['slug']:
                        ($key == 'f_qh'?$this->fe_field['perm']:
                        ($key == 'f_moRong'?$this->fe_field['ext']:
                        ($key == 'f_uuTien'?$this->fe_field['op']: 
                        ($key == 'f_trangThai'?$this->fe_field['stt']: 
                        ($key == 'f_ngayTao'?$this->fe_field['cDate']:
                        ($key == 'f_chinhSua'?$this->fe_field['chDate']:
                        false))))))))))))))))));
        return $returnData;
        
    }
}
