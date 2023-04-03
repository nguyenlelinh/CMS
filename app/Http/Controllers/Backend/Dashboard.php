<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Base\BaseController;

class Dashboard extends BaseController
{
    private const VIEW_URL = 'backend/dashboard/';
    public function index()
    {
        $data = [
        ];
        return view(self::VIEW_URL.'index', $data);
    }
}
