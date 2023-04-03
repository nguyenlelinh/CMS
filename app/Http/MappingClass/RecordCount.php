<?php

namespace App\Http\MappingClass;

class RecordCount
{
    private const PREFIX = 'RC_';
    private $table = 'record_count';
    private $db_field = [
        'id' => 'id',
        'name' => 'table_name',
        'total' => 'total_rows_count',
        'using' => 'using_rows_count',
        'trash' => 'trash_rows_count',
    ];
    public function __construct(){}
    public function __get($key){
        $returnData = $key == 'tenBang'?$this->table:
                      ($key == 'ma'?$this->db_field['id']:
                      ($key == 'ten'?$this->db_field['name']:
                      ($key == 'tong'?$this->db_field['total']:
                      ($key == 'con'?$this->db_field['using']:
                      ($key == 'xoa'?$this->db_field['trash']:
                      false)))));
        return ($key == 'tenBang')?$returnData:self::PREFIX.$returnData;
    }
}
