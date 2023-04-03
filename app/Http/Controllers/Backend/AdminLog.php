<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Base\BaseController;

class AdminLog extends BaseController
{
    private const VIEW_URL = 'backend/admin_log/';
    public function index()
    {
        $data = [
        ];
        return view(self::VIEW_URL.'index', $data);
    }
}
