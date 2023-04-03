<?php

namespace App\Http\Controllers\Base;

use App\Http\MyModels\Backend\AdminLog as ALModel;
use App\Http\MappingClass\AdminLog as ALField;
use App\Http\MappingClass\Admin as ADField;
use Illuminate\Routing\Controller as Lara_Controller;

class BaseController extends Lara_Controller
{
    // private static $instance;
    public function __construct()
    {
        // self::$instance =& $this;
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
            ob_start();
        }
    }
    // public static function &get_instance()
	// {
	// 	return self::$instance;
	// }
    public function getDatatableRequest($request): array
    {
        $orders = $request->input('order');
        $limit = $request->input('length');
        $offset = $request->input('start');
        $search = $request->input('search');
        $category = $request->input('category_id');
        $query = [];
        foreach ($orders as $order)
            $query['order'][$order['column']] = $order['dir'];
        $query['limit'] = ($limit>0)?$limit:null;
        $query['offset'] = $offset;
        $query['search'] = $search['value'];
        if(!is_null($category)) $query['category_id'] = $category;
        return $query;
    }

    public function ghiLog($action)
    {
        $Mlog = new ALModel();
        $ALF = new ALField();
        $AF = new ADField();
        $data = [
            // $ALF->ten=>$_SESSION['quantri'][$AF->taiKhoan],
            $ALF->ten=>'a',
            $ALF->hdong=>$action,
            $ALF->ngayTao=>time()
        ];
        $Mlog->insert($data);
    }
}
