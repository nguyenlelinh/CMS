<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Base\BaseController;
use App\Http\MyModels\Backend\AdminRole as RoleModel;
use Illuminate\Http\Request;

class AdminRole extends BaseController
{
    private const VIEW_URL = 'backend/admin_role/';

    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new RoleModel();
        //Do your magic here
    }

    public function index(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
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

}
