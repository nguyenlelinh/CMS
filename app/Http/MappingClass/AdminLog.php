<?php

namespace App\Http\MappingClass;

class AdminLog
{
    private const PREFIX = 'ADL_';
    private $table = 'admin_log';
    private $db_field = [
        'id' => 'id',
        'name' => 'admin_username',
        'action' => 'action',
        'status' => 'status',
        'cData' => 'created_date',
        'chData' => 'changed_date',
    ];
    public function __construct(){}
    public function __get($key){
        $returnData = $key == 'tenBang'?$this->table:
                      ($key == 'ma'?$this->db_field['id']:
                      ($key == 'ten'?$this->db_field['name']:
                      ($key == 'hdong'?$this->db_field['action']:
                      ($key == 'ngayTao'?$this->db_field['cData']:
                      ($key == 'chinhSua'?$this->db_field['chData']:
                      false)))));
        return ($key == 'tenBang')?$returnData:self::PREFIX.$returnData;
    }
}
