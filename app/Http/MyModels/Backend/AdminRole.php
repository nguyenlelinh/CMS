<?php

namespace App\Http\MyModels\Backend;
use App\Http\MyModels\Base\BaseModel;
use App\Http\MappingClass\AdminRole as FieldNames;
use Illuminate\Support\Facades\DB;
class AdminRole extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
        $this->FN = new FieldNames();
        $this->tableInstance = DB::table($this->FN->tenBang);
        //? Setting Datatable
            $this->selectFields = [$this->FN->tenBang.'.*', $this->SF->tenBang.'.'.$this->SF->ten];
             $this->order_index = [$this->FN->ma, $this->FN->ten, $this->FN->taiKhoan, $this->FN->trangThai, $this->FN->ngayTao];
             $this->search_col = [$this->FN->ten, $this->FN->taiKhoan];
             $this->btnConfig = [
                 [
                     'btn' => ['class' => 'btn btn-xs btn-green', 'title' => 'Sửa', 'onclick' => 'window.location.href="/cms/quan-tri/sua-quan-tri-vien.vsp/<slug>-<id>"'],
                     'icon' => '<i class="fa fa-pen"></i>',
                 ],
                 [
                     'btn' => ['class' => 'btn btn-xs btn-red', 'title' => 'Chuyển vào thùng rác', 'onclick' => 'global.xoa("/cms/quan-tri/xoa-quan-tri-vien.vsp/<id>")'],
                     'icon' => '<i class="fa fa-trash"></i>',
                 ],
             ];
             $this->delTalbleBtnConfig = [
                 [
                     'btn' => ['class' => 'btn btn-xs btn-green', 'title' => 'Khôi phục', 'onclick' => 'global.khoiPhuc("/cms/quan-tri/khoi-phuc-quan-tri-vien.vsp/<id>")'],
                     'icon' => '<i class="fa fa-undo"></i>',
                 ],
                 [
                     'btn' => ['class' => 'btn btn-xs btn-red', 'title' => 'Xoá', 'onclick' => 'global.huy("/cms/quan-tri/huy-quan-tri-vien.vsp/<id>")'],
                     'icon' => '<i class="fa fa-trash"></i>',
                 ]
             ];
             $this->datatable['target_text'] = 'quản trị viên';
             $this->datatable['columns'] = [
                 ['data' => 'index_num', "orderable" => false, 'searchable' => false],
                 ['data' => $this->FN->slug],
                 ['data' => $this->FN->ten],
                 ['data' => $this->FN->trangThai],
                 ['data' => $this->FN->ngayTao, 'searchable' => false],
                 ['data' => $this->datatable_btn, "orderable" => false]
             ];
        //? End
    }
}
