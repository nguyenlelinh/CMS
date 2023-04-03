<?php

namespace App\Http\MyModels\Backend;
use App\Http\MyModels\Base\BaseModel;
use App\Http\MappingClass\Status as FieldNames;
use Illuminate\Support\Facades\DB;
class Status extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
        $this->FN = new FieldNames();
        $this->tableInstance = DB::table($this->FN->tenBang);
    }
}
