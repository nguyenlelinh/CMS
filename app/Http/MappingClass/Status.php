<?php

namespace App\Http\MappingClass;

class Status
{
    private const PREFIX = 'S_';
    private $table = 'status';

    private $db_field = [
        'ma' => self::PREFIX.'id',
        'ten' => self::PREFIX.'name',
        'slug' => self::PREFIX.'slug',
        'des' => self::PREFIX.'description',
        'op' => self::PREFIX.'order_prioritize',
        'cDate' => self::PREFIX.'created_date',
        'chDate' => self::PREFIX.'changed_date',
    ];
    public function __construct(){}
    public function __get($key){
        $returnData =  $key == 'tenBang'?$this->table:
                      ($key == 'ma'?$this->db_field['ma']:
                      ($key == 'ten'?$this->db_field['ten']:
                      ($key == 'slug'?$this->db_field['slug']:
                      ($key == 'moTa'?$this->db_field['des']:
                      ($key == 'uuTien'?$this->db_field['op']:
                      ($key == 'ngayTao'?$this->db_field['cDate']:
                      ($key == 'chinhSua'?$this->db_field['chDate']:
                      false)))))));
        return $returnData;
        
    }
}
