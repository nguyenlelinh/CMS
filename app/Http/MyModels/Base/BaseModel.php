<?php

namespace App\Http\MyModels\Base;
use Illuminate\Support\Facades\DB;
use App\Http\MappingClass\RecordCount as RCField;
use App\Http\MappingClass\Status as SttField;
use Illuminate\Database\Query\Builder;

class BaseModel
{
    public $selectFields = ['*'];
    public $tableInstance;
    public $FN;
    public $SF;
    public $RCField;

    //? For Datatable Only
    public $order_index = [];
    public $search_col = [];
    public $datatable_btn='datatable_btn';
    public $datatable=[];
    public $btnConfig = [];
    public $delTalbleBtnConfig = [];
    // public
    //? End

	protected $qb_set_ub = [];
	protected $_protect_identifiers	= TRUE;
	protected $_reserved_identifiers	= ['*'];
	protected $_escape_char = '`';

    public function __construct()
    {
        $this->RCField = new RCField();
        $this->SF = new SttField();
    }

    public function datatable_get($querySetting, $isDeletedList=false)
    {
        $totalRows = 0;
        $numRows = 0;
        $q = $this->RCField->con;
        $operator = '<>';
        if($isDeletedList){
            $q = $this->RCField->xoa;
            $operator = '=';
        }
        $countTable = DB::table($this->RCField->tenBang);
        $countTable->where($this->RCField->ten, $this->FN->tenBang);
        $countTable->select($q);
        $row = $countTable->get()->first();
        if(!is_null($row)) $totalRows = $row->{$q};
        $this->tableInstance->select($this->selectFields);
        $this->tableInstance->join($this->SF->tenBang, $this->FN->trangThai, "=", $this->SF->ma);
        $this->tableInstance->where($this->FN->tenBang.'.'.$this->FN->trangThai, $operator, 3);
        if (isset($querySetting['search']) && $querySetting['search'] != '') {
            $this->tableInstance->where(function (Builder $query) use($querySetting){
                foreach ($this->search_col as $k => $col) {
                    if ($k == 0)
                        $query->where($col,'like','%'.$querySetting['search'].'%');
                    else
                    $query->orWhere($col,'like','%'.$querySetting['search'].'%');
                }
            });
        }
        $cloneQuery = clone $this->tableInstance;
        $numRows = $cloneQuery->get()->count();
        if (isset($querySetting['order']) && !empty($querySetting['order']))
            foreach ($querySetting['order'] as $k => $v) {
                if (is_numeric($k) && $this->order_index[$k] != null)
                    $this->tableInstance->orderBy($this->order_index[$k], $v);
            }
        else $this->tableInstance->orderBy($this->FN->ma, "desc");
        if (isset($querySetting['limit']))
            $this->tableInstance->take($querySetting['limit']);
        $offset = 0;
        if (isset($querySetting['offset'])){
            $offset = $querySetting['offset'];
            $this->tableInstance->skip($querySetting['offset']);
        }
        $result = $this->tableInstance->get();
        if ($result && $result->count() > 0)
            $data = [
                'recordsTotal' => $totalRows,
                'recordsFiltered' => $numRows,
                'data' => $this->datatable_format($result, $offset, $isDeletedList),
            ];
        else
            $data = [
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => [],
            ];
        return $data;
    }

    public function datatable_format($data, $offset=0, $isDeletedList=false)
    {
        $returnData = [];
        $v = $this->btnConfig;
        if($isDeletedList) $v = $this->delTalbleBtnConfig;
        foreach ($data as $key => $row) {
            $row->{'index_num'} = $key+$offset+1;
            $row->{'datatable_btn'} = view(TPL_VIEW_FOLDER.'_datatable_button', ['datatable_btn' => $v, 'id' => $row->{$this->FN->ma}, 'slug' => $row->{$this->FN->slug}, 'deletedList'=>$isDeletedList])->render();
            $row->{$this->FN->ma} = view(TPL_VIEW_FOLDER.'_datatable_checkbox', ['field_name' => $this->FN->f_ma, 'id' => $row->{$this->FN->ma}])->render();
            $row->{$this->FN->trangThai} = $row->{$this->SF->ten};
            $row->{$this->FN->ngayTao} = date('d/m/Y', $row->{$this->FN->ngayTao});
            $row->{$this->FN->chinhSua} = date('d/m/Y', $row->{$this->FN->chinhSua});
            $returnData[] = $row;
        }
        return $returnData;
    }

    /**
     ** Chức năng: Lấy dữ liệu theo điều kiện truyền vào
     ** Cú pháp: Model->getByCondition(<điều kiện>, <limit>, <offset>, <thứ tự sắp xếp>)
     ** VD:
     **     $adminModel->getByCondition(['ADM_id'=>1, 'ADM_status'=>2], 1, 0, ['ADM_order_prioritize'=>'ASC']);
     ** Produces được render ra sẽ có dạng:
     **     SELECT * FROM `admin` where `ADM_id` = 1
     **     AND `ADM_status` = 2
     **     ORDER BY ADM_order_prioritize asc
     **     LIMIT 1 OFFSET 0
     * @param array $condition: điều kiện truyền vào, cấu trúc [<tên cột> => <giá trị so sánh>] hoặc [<tên cột> => [OP=><biểu thức so sánh>,VAL=><giá trị so sánh>]]
     * @param int $limit: Số bản ghi lấy ra, nếu thiết lập là 1 sẽ trả về data là mảng một chiều với dữ liệu của bản ghi đó, lớn hơn 1 sẽ trả về mảng hai chiều bao gồm danh sách các bản ghi
     * @param int $offset: Chỉ mục vị trí bắt đầu select trên bảng
     * @param array $order: Thứ tự sắp xếp, cấu trúc [<tên cột> =><kiểu sắp xếp>]
     * @return array/null: Thông tin bản ghi lấy được, nếu như không có trả về null
     */
    public function getByCondition($condition, $limit=0, $offset=0, $order=[])
    {
        // $this->tableInstance->select($this->selectFields);
        // $this->tableInstance->join($this->SF->tenBang, $this->FN->trangThai, "=", $this->SF->ma);
        $this->qb_checkCondition($condition);
        $this->qb_limit_offset($limit, $offset);
        if(!empty($order))
            foreach($order as $k => $v)
                $this->tableInstance->orderBy($k, $v);
        $returnData = $this->tableInstance->get();
        if($limit==1) $returnData = (array) $returnData->first();
        return $returnData;
    }

    /**
     ** Chức năng: Lấy dữ liệu theo slug cùng id
     ** Cú pháp: Model->getBySlugAndId(<slug của bản ghi>, <id bản ghi>, <limit>, <offset>)
     ** VD:
     **     $adminModel->getBySlugAndId('a-b-c', 21, 1, 0);
     ** Produces được render ra sẽ có dạng:
     **     SELECT * FROM `admin` where `ADM_slug` = 'a-b-c'
     **     AND `ADM_id` = 21
     **     LIMIT 1 OFFSET 0
     * @param int $slug: Slug của bản ghi, có thể là một chuỗi hoặc mảng các chuỗi
     * @param int $id: Mã lưu trữ của bản ghi
     * @param int $limit: Số bản ghi lấy ra, nếu thiết lập là 1 sẽ trả về data là mảng một chiều với dữ liệu của bản ghi đó, lớn hơn 1 sẽ trả về mảng hai chiều bao gồm danh sách các bản ghi
     * @param int $offset: Chỉ mục vị trí bắt đầu select trên bảng
     * @return array/null: Thông tin bản ghi lấy được, nếu như không có trả về null
     */
    public function getBySlugAndId($slug, $id, $limit=0, $offset=0)
    {
        return $this->getDataWithMultiAndCondition([
            $this->FN->ma => $id,
            $this->FN->slug => $slug
        ], $limit, $offset);
    }

    /**
     ** Chức năng: Lấy dữ liệu theo id cùng status
     ** Cú pháp: Model->getByIdAndStatus(<id của bản ghi>, <trạng thái>, <limit>, <offset>)
     ** VD:
     **     $adminModel->getByIdAndStatus([1,2,3], 1, 1, 0);
     ** Produces được render ra sẽ có dạng:
     **     SELECT * FROM `admin` where `ADM_id` in (1,2,3)
     **     AND `ADM_status` = 1
     **     LIMIT 1 OFFSET 0
     * @param int $id: Mã lưu trữ của bản ghi, có thể là một số hoặc mảng
     * @param int $status: Trạng thái của bản ghi
     * @param int $limit: Số bản ghi lấy ra, nếu thiết lập là 1 sẽ trả về data là mảng một chiều với dữ liệu của bản ghi đó, lớn hơn 1 sẽ trả về mảng hai chiều bao gồm danh sách các bản ghi
     * @param int $offset: Chỉ mục vị trí bắt đầu select trên bảng
     * @return array/null: Thông tin bản ghi lấy được, nếu như không có trả về null
     */
    public function getByIdAndStatus($id, $status, $limit=0, $offset=0)
    {
        return $this->getDataWithMultiAndCondition([
            $this->FN->ma => $id,
            $this->FN->trangThai => $status
        ], $limit, $offset);
    }

    /**
     ** Chức năng: Lấy dữ liệu theo slug
     ** Cú pháp: Model->getBySlug(<slug của bản ghi>, <limit>, <offset>)
     ** VD:
     **     $adminModel->getBySlug('a-b-c',1,0);
     ** Produces được render ra sẽ có dạng:
     **     SELECT * FROM `admin` where `ADM_slug` = 'a-b-c' LIMIT 1 OFFSET 0
     * @param int $slug: slug của bản ghi
     * @param int $limit: Số bản ghi lấy ra, nếu thiết lập là 1 sẽ trả về data là mảng một chiều với dữ liệu của bản ghi đó, lớn hơn 1 sẽ trả về mảng hai chiều bao gồm danh sách các bản ghi
     * @param int $offset: Chỉ mục vị trí bắt đầu select trên bảng
     * @return array/null: Thông tin bản ghi lấy được, nếu như không có trả về null
     */
    public function getBySlug($slug, $limit=0, $offset=0)
    {
        return $this->getDataWithOneCondition($this->FN->slug, $slug, $limit, $offset);
    }

    /**
     ** Chức năng: Lấy dữ liệu theo status
     ** Cú pháp: Model->getByStatus(<status của bản ghi>, <limit>, <offset>)
     ** VD:
     **     $adminModel->getByStatus(1,1,0);
     ** Produces được render ra sẽ có dạng:
     **     SELECT * FROM `admin` where `ADM_status` = 1 LIMIT 1 OFFSET 0
     * @param int $status: Trạng thái của bản ghi
     * @param int $limit: Số bản ghi lấy ra, nếu thiết lập là 1 sẽ trả về data là mảng một chiều với dữ liệu của bản ghi đó, lớn hơn 1 sẽ trả về mảng hai chiều bao gồm danh sách các bản ghi
     * @param int $offset: Chỉ mục vị trí bắt đầu select trên bảng
     * @return array/null: Thông tin bản ghi lấy được, nếu như không có trả về null
     */
    public function getByStatus($status, $limit=0, $offset=0)
    {
        return $this->getDataWithOneCondition($this->FN->trangThai, $status, $limit, $offset);
    }

    /**
     ** Chức năng: Lấy dữ liệu theo id
     ** Cú pháp: Model->getById(<id bản ghi>, <limit>, <offset>)
     ** VD:
     **     $adminModel->getById(1,1,0);
     ** Produces được render ra sẽ có dạng:
     **     SELECT * FROM `admin` where `ADM_id` = 1 LIMIT 1 OFFSET 0
     * @param int $id: Id bản ghi
     * @param int $limit: Số bản ghi lấy ra, nếu thiết lập là 1 sẽ trả về data là mảng một chiều với dữ liệu của bản ghi đó, lớn hơn 1 sẽ trả về mảng hai chiều bao gồm danh sách các bản ghi
     * @param int $offset: Chỉ mục vị trí bắt đầu select trên bảng
     * @return array/null: Thông tin bản ghi lấy được, nếu như không có trả về null
     */
    public function getById($id, $limit=0, $offset=0)
    {
        return $this->getDataWithOneCondition($this->FN->ma, $id, $limit, $offset);
    }

    /**
     ** Chức năng: Thêm mới một bản ghi
     ** Cú pháp: Model->insert(<dữ liệu bản ghi>)
     ** VD:
     **     $adminModel->insert([
     **       [
     **           'ADM_username'=>'u1',
     **           'ADM_pass'=>'p1',
     **       ],
     **       [
     **           'ADM_username'=>'u2',
     **           'ADM_pass'=>'p2',
     **       ]
     **     ]);
     ** Produces được render ra sẽ có dạng:
     **     INSERT INTO `admin` (`ADM_username`,`ADM_pass`)
     **     VALUES  ('u1', 'p1'),
     **             ('u2', 'p2')
     * @param array $data: Dữ liệu bản ghi muốn thêm
     * @return int/bool: Thêm thành công trả về số dòng tương tác, thất bại trả về false.
     */
    public function insert($data)
    {
        $affected_rows = 0;
        $returnData = [];
        if (isset($data[0])){
            $returnData['affected'] = $this->tableInstance->insertOrIgnore($data);
            $returnData['igrone'] = count($data) - $returnData['affected'];
            $affected_rows = $returnData['affected'];
        }else{
            $returnData = $this->tableInstance->insertGetId($data);
            $affected_rows = 1;
        }
        if($affected_rows>0)
            $this->updateCountTable([$this->RCField->tong, $this->RCField->con], [], $affected_rows);
        return $returnData;
    }

    /**
     ** Chức năng: Xoá vĩnh viễn bản ghi khỏi CSDL.
     ** Cú pháp: Model->hard_delete(<điều kiện where>, <điều kiện or where>)
     ** VD:
     **     $whereCondition = [
     **         "ADM_id"=>[1,2,3]
     **     ];
     **     $adminModel->hard_delete($whereCondition);
     **
     ** Produces được render ra sẽ có dạng:
     **     DELETE FROM `admin`
     **     WHERE `ADM_id` IN (1,2,3)
     **
     ** Trong trường hợp muốn xoá theo điều kiện null, not null hay gì khác, có thể viết thêm hàm mới trong model con.
     **     public function myHardDelete()
     **     {
     **        $adminModel->tableInstance->whereNull('ADM_field');
     **        $this->hard_delete($where, $orWhere);
     **     }
     **
     ** Nếu muốn sửa lên hàm hard_delete, có thể sử dụng kỹ thuật override và chèn điều kiện mới với $this->tableInstance
     **     public function hard_delete($where=[], $orWhere=[])
     **     {
     **        $adminModel->tableInstance->whereNull('ADM_field');
     **        parent::hard_delete($where, $orWhere);
     **     }
     **
     * @param array $where: Điều kiện đi kèm với where
     * @param array $orWhere: Điều kiện đi kèm với orWhere
     * @return int/bool: Xoá thành công trả về số dòng tương tác, xoá thất bại trả về false.
     */
    public function hard_delete($where=[], $orWhere=[])
    {
        $this->qb_checkCondition($where, $orWhere);
        $affected_rows = $this->tableInstance->delete();
        if($affected_rows>0)
            $this->updateCountTable([], [$this->RCField->xoa, $this->RCField->tong], $affected_rows);
        else $affected_rows=FALSE;
        return $affected_rows;
    }

    /**
     ** Chức năng: Cập nhật trạng thái bản ghi về 2 - Tạm ngưng.
     ** Cú pháp: Model->restore(<điều kiện where>, <điều kiện or where>)
     ** VD:
     **     $whereCondition = [
     **         "ADM_id"=>[1,2,3]
     **     ];
     **     $adminModel->restore($whereCondition);
     **
     ** Produces được render ra sẽ có dạng:
     **     UPDATE `admin`
     **     SET `ADM_status` = 2
     **     WHERE `ADM_id` IN (1,2,3)
     **
     ** Trong trường hợp muốn khôi phục theo điều kiện null, not null hay gì khác, có thể viết thêm hàm mới trong model con.
     **     public function myRestore()
     **     {
     **        $adminModel->tableInstance->whereNull('ADM_field');
     **        $this->restore($where, $orWhere);
     **     }
     **
     ** Nếu muốn sửa lên hàm restore, có thể sử dụng kỹ thuật override và chèn điều kiện mới với $this->tableInstance
     **     public function restore($where=[], $orWhere=[])
     **     {
     **        $adminModel->tableInstance->whereNull('ADM_field');
     **        parent::restore($where, $orWhere);
     **     }
     * @param array $where: Điều kiện đi kèm với where
     * @param array $orWhere: Điều kiện đi kèm với orWhere
     * @return int/bool: Update thành công trả về số dòng tương tác, update thất bại trả về false.
     */
    public function restore($where=[], $orWhere=[])
    {
        $affected_rows = $this->update([$this->FN->trangThai=>2, $this->FN->chinhSua=>time()],$where, $orWhere);
        if($affected_rows>0)
            $this->updateCountTable([$this->RCField->con], [$this->RCField->xoa], $affected_rows);
        else $affected_rows=FALSE;
        return $affected_rows;
    }

    /**
     ** Chức năng: Cập nhật trạng thái bản ghi về 3 - Đã Xoá / Ẩn.
     ** Cú pháp: Model->soft_delete(<điều kiện where>, <điều kiện or where>)
     ** VD:
     **     $whereCondition = [
     **         "ADM_id" => [1,2,3]
     **     ];
     **     $adminModel->soft_delete($whereCondition, $orWhereCondition);
     **
     ** Produces được render ra sẽ có dạng:
     **     UPDATE `admin`
     **     SET `ADM_status` = 3
     **     WHERE `ADM_id` IN (1,2,3)
     **
     ** Trong trường hợp muốn xoá theo điều kiện null, not null hay gì khác, có thể viết thêm hàm mới trong model con.
     **     public function mySoftDelete()
     **     {
     **        $adminModel->tableInstance->whereNull('ADM_field');
     **        $this->soft_delete($data, $where, $orWhere);
     **     }
     **
     ** Nếu muốn sửa lên hàm soft_delete, có thể sử dụng kỹ thuật override và chèn điều kiện mới với $this->tableInstance
     **     public function soft_delete($where=[], $orWhere=[])
     **     {
     **        $adminModel->tableInstance->whereNull('ADM_field');
     **        parent::soft_delete($where, $orWhere);
     **     }
     * @param array $where: Điều kiện đi kèm với where
     * @param array $orWhere: Điều kiện đi kèm với orWhere
     * @return int/bool: Update thành công trả về số dòng tương tác, update thất bại trả về false.
     */
    public function soft_delete($where=[], $orWhere=[])
    {
        $affected_rows = $this->update([$this->FN->trangThai=>3, $this->FN->chinhSua=>time()],$where, $orWhere);
        if($affected_rows>0)
            $this->updateCountTable([$this->RCField->xoa], [$this->RCField->con], $affected_rows);
        else $affected_rows=FALSE;
        return $affected_rows;
    }

    /**
     ** Chức năng: Update một dòng với where cùng or where
     ** Cú pháp: Model->update(<dữ liệu update>, <điều kiện where>, <điều kiện or where>)
     ** VD:
     **     $data = [
     **         ADM_username=>'admin1',
     **         ADM_pass=>'pass1'
     **     ];
     **     $whereCondition = [
     **         "ADM_status"=>1,
     **         "ADM_name"=>[
     **             OP=>'like',
     **             VAL=>'%XXX %'
     **         ],
     **         "ADM_id"=>[1,2,3]
     **     ];
     **     $orWhereCondition = [
     **         "ADM_id"=>5
     **     ];
     **     $adminModel->update($data, $whereCondition, $orWhereCondition);
     **
     ** Produces được render ra sẽ có dạng:
     **     UPDATE `admin`
     **     SET `ADM_username` = 'admin1', `ADM_pass` = 'pass1'
     **     WHERE `ADM_status` = 1
     **     AND `ADM_name` like '%XXX %'
     **     AND `ADM_id` in (1, 2, 3)
     **     OR `ADM_id` = 5
     **
     ** Trong trường hợp muốn update theo điều kiện null, not null hay gì khác, có thể viết thêm hàm mới trong model con.
     **     public function myUpdate()
     **     {
     **        $adminModel->tableInstance->whereNull('ADM_field');
     **        $this->update($data, $where, $orWhere);
     **     }
     **
     ** Nếu muốn sửa lên hàm update, có thể sử dụng kỹ thuật override và chèn điều kiện mới với $this->tableInstance
     **     public function update($data, $where, $orWhere)
     **     {
     **        $adminModel->tableInstance->whereNull('ADM_field');
     **        parent::update($data, $where, $orWhere);
     **     }
     * @param array $data: Dữ liệu muốn update
     * @param array $where: Điều kiện đi kèm với where
     * @param array $orWhere: Điều kiện đi kèm với orWhere
     * @return int/bool: Update thành công trả về số dòng tương tác, update thất bại trả về false.
     */
    public function update($data, $where=[], $orWhere=[])
    {
        $this->qb_checkCondition($where, $orWhere);
        $affected_rows = $this->tableInstance->update($data);
        return ($affected_rows>0)?$affected_rows:FALSE;
    }

    /**
     ** Tác dụng: Update nhiều dòng cùng lúc
     ** Cú pháp: Model->update_batch(<dữ liệu update>, <cột so sánh>)
     ** VD:
     **     $data = [
     **         [ADM_id=>1, ADM_username=>'admin1', ADM_pass=>'pass1'],
     **         [ADM_id=>2, ADM_username=>'admin2', ADM_pass=>'pass2'],
     **     ];
     **     AdminModel->update_batch($data,'ADM_id');
     ** Produces được render ra sẽ có dạng:
     **     UPDATE `admin` SET `ADM_username` = CASE
     **     WHEN `ADM_id` = '1' THEN 'admin1'
     **     WHEN `ADM_id` = '2' THEN 'admin2'
     **     ELSE `ADM_username` END,
     **     `ADM_pass` = CASE
     **     WHEN `ADM_id` = '1' THEN 'pass1'
     **     WHEN `ADM_id` = '2' THEN 'pass2'
     **     ELSE `ADM_pass` END
     **     WHERE `ADM_id` IN ('1','2')
     * @param array $data: Dữ liệu update
     * @param string $index: Tên trường dùng so sánh điều kiện update
     * @return int $affected_row: Số dòng đã update
     */
	public function update_batch($data, $index, $batch_size = 100)
	{
        $table = $this->FN->tenBang;
        $this->set_update_batch($data, $index);
		$affected_rows = 0;
		for ($i = 0; $i < count($this->qb_set_ub); $i += $batch_size)
			if ($afRow=DB::update($this->qb_update_batch($this->protect_identifiers($table, TRUE, NULL, FALSE), array_slice($this->qb_set_ub, $i, $batch_size), $index)))
			    $affected_rows += $afRow;
		return $affected_rows;
	}

    //!---------PROTECTED FUNCTION---------
    /**
     ** Tác dụng: Kiểm tra điều kiện truyền vào, build ra query tương ứng
     ** Cách thiết lập điều kiện:
     ** 1. $where = [<tên field> => <giá trị so sánh>]
     **     VD: $where = ['ADM_id' => 1];
     **         => WHERE `ADM_id` = 1
     ** 2. $where = [<tên field> => <mảng giá trị so sánh>]
     **     VD: $where = ['ADM_id' => [1,2,3]];
     **         => WHERE `ADM_id` in (1,2,3)
     ** 3. $where = [<tên field> => [OP => <toán tử so sánh>, VAL => <giá trị so sánh>]]
     **     VD: $where = ['ADM_name'=>[OP=>'like', VAL=>'%text%']];
     **         => WHERE `ADM_name` like '%text%'
     ** 4. [<tên field> => <giá trị so sánh>, <tên field> => <giá trị so sánh>, ...]
     **     VD: $where = [
     **                     'ADM_id' => [1,2,3],
     **                     'ADM_name' => [
     **                         OP =>' like',
     **                         VAL => '%text%'],
     **                     'ADM_status' => 1
     **                  ];
     **         => WHERE `ADM_id` in (1,2,3)
     **            AND WHERE `ADM_name` like '%text%'
     **            AND WHERE `ADM_status` = 1
     *? @constant OP: where_operator - Sử dụng khi muốn so sánh với điều kiện khác "=", giá trị có thể bao gồm ">", ">=", "<", "<=", "like", "not like"
     *? @constant VAL: where_value - Sử dụng khi muốn so sánh với điều kiện khác "=", nội dung bao gồm giá trị muốn so sánh trong điều kiện
     */
    protected function qb_checkCondition($where=[], $orWhere=[])
    {
        if(empty($where) && empty($orWhere)){
            if(empty($this->tableInstance->wheres)) return FALSE;
            else{}
        }else{
            if(is_array($where) && !empty($where)){
                foreach($where as $key=>$value){
                    if(is_array($value)){
                        if(isset($value[OP])) $this->tableInstance->where($key, $value[OP], $value[VAL]);
                        else $this->tableInstance->whereIn($key, $value);
                    } else $this->tableInstance->where($key, $value);
                }
            }
            if(is_array($orWhere) && !empty($orWhere)){
                foreach($orWhere as $key=>$value){
                    if(is_array($value)){
                        if(isset($value[OP])) $this->tableInstance->orWhere($key, $value[OP], $value[VAL]);
                        else $this->tableInstance->orWhereIn($key, $value);
                    } else $this->tableInstance->orWhere($key, $value);
                }
            }
        }
    }

    protected function qb_limit_offset($limit=0, $offset=0)
    {
        if($limit>0) $this->tableInstance->take($limit);
        if($offset>0) $this->tableInstance->skip($offset);
    }

    protected function getDataWithMultiAndCondition($condition, $limit=0, $offset=0)
    {
        // $this->tableInstance->select($this->selectFields);
        // $this->tableInstance->join($this->SF->tenBang, $this->FN->trangThai, "=", $this->SF->ma);
        $this->qb_checkCondition($condition);
        $this->qb_limit_offset($limit, $offset);
        $returnData = $this->tableInstance->get();
        if($limit==1) $returnData = $returnData->first();
        return $returnData;
    }

    protected function getDataWithOneCondition($col, $val, $limit=0, $offset=0)
    {
        // $this->tableInstance->select($this->selectFields);
        // $this->tableInstance->join($this->SF->tenBang, $this->FN->trangThai, "=", $this->SF->ma);
        if(is_array($val))
            $this->tableInstance->whereIn($col, $val);
        else $this->tableInstance->where($col, $val);
        $this->qb_limit_offset($limit, $offset);
        $returnData = $this->tableInstance->get();
        if($limit==1) $returnData = $returnData->first();
        return $returnData;
    }

    protected function updateCountTable($increaseCol=[], $decreaseCol=[], $affected_row=0)
    {
        $bangDem = DB::table($this->RCField->tenBang);
        $bangDem->where($this->RCField->ten, $this->FN->tenBang);
        $updateData = [];
        if(!empty($increaseCol))
            foreach($increaseCol as $col)
                $updateData[$col] = DB::raw($this->protect_identifiers($col, TRUE, NULL, FALSE).' + '.$affected_row);
        if(!empty($decreaseCol))
            foreach($decreaseCol as $col)
                $updateData[$col] = DB::raw($this->protect_identifiers($col, TRUE, NULL, FALSE).' - '.$affected_row);
        $bangDem->update($updateData);
    }

    protected function qb_update_batch($table, $values, $index)
	{
		$ids = [];
		foreach ($values as $key => $val){
			$ids[] = $val[$index]['value'];
			foreach (array_keys($val) as $field)
				if ($field !== $index)
				    $final[$val[$field]['field']][] = 'WHEN '.$val[$index]['field'].' = '.$val[$index]['value'].' THEN '.$val[$field]['value'];
		}
		$cases = '';
		foreach ($final as $k => $v)
			$cases .= $k." = CASE \n".implode("\n", $v)."\n".'ELSE '.$k.' END, ';
		return 'UPDATE '.$table.' SET '.substr($cases, 0, -2).' WHERE '.$val[$index]['field'].' IN('.implode(',', $ids).')';
	}

	protected function _object_to_array_batch($object)
	{
		if (!is_object($object))
			return $object;
		$array = [];
		$out = get_object_vars($object);
		$fields = array_keys($out);
		foreach ($fields as $val)
			if ($val !== '_parent_name'){
				$i = 0;
				foreach ($out[$val] as $data)
					$array[$i++][$val] = $data;
			}
		return $array;
	}

	protected function set_update_batch($key, $index = '', $escape = NULL)
	{
		$key = $this->_object_to_array_batch($key);
		if ( ! is_array($key)){}
		is_bool($escape) OR $escape = $this->_protect_identifiers;
		foreach ($key as $k => $v){
			$clean = array();
			foreach ($v as $k2 => $v2){
				$clean[$k2] = array(
					'field'  => $this->protect_identifiers($k2, FALSE, $escape),
					'value'  => ($escape === FALSE ? $v2 : $this->escape($v2))
				);
			}
			$this->qb_set_ub[] = $clean;
		}
	}

	protected function protect_identifiers($item, $prefix_single = FALSE, $protect_identifiers = NULL, $field_exists = TRUE)
	{
		if (!is_bool($protect_identifiers))
			$protect_identifiers = $this->_protect_identifiers;
		if (is_array($item)){
			$escaped_array = array();
			foreach ($item as $k => $v)
				$escaped_array[$this->protect_identifiers($k)] = $this->protect_identifiers($v, $prefix_single, $protect_identifiers, $field_exists);
			return $escaped_array;
		}
		if (strcspn($item, "()'") !== strlen($item))
			return $item;
		$item = preg_replace('/\s+/', ' ', trim($item));
		if ($offset = strripos($item, ' AS ')){
			$alias = ($protect_identifiers) ? substr($item, $offset, 4).$this->escape_identifiers(substr($item, $offset + 4)) : substr($item, $offset);
			$item = substr($item, 0, $offset);
		} elseif ($offset = strrpos($item, ' ')){
			$alias = ($protect_identifiers) ? ' '.$this->escape_identifiers(substr($item, $offset + 1)) : substr($item, $offset);
			$item = substr($item, 0, $offset);
		} else $alias = '';
		if (strpos($item, '.') !== FALSE){
			if ($protect_identifiers === TRUE)
				$item = $this->escape_identifiers($item);
			return $item.$alias;
		}
		if ($protect_identifiers === TRUE && ! in_array($item, $this->_reserved_identifiers))
			$item = $this->escape_identifiers($item);
		return $item.$alias;
	}

	protected function escape_identifiers($item)
	{
		if ($this->_escape_char === '' OR empty($item) OR in_array($item, $this->_reserved_identifiers)){
			return $item;
		} elseif (is_array($item)){
			foreach ($item as $key => $value)
				$item[$key] = $this->escape_identifiers($value);
			return $item;
		} elseif (ctype_digit($item) OR $item[0] === "'" OR ($this->_escape_char !== '"' && $item[0] === '"') OR strpos($item, '(') !== FALSE)
			return $item;
		static $preg_ec = [];
		if (empty($preg_ec)){
			if (is_array($this->_escape_char)){
				$preg_ec = [
					preg_quote($this->_escape_char[0], '/'),
					preg_quote($this->_escape_char[1], '/'),
					$this->_escape_char[0],
					$this->_escape_char[1]
                ];
			} else {
				$preg_ec[0] = $preg_ec[1] = preg_quote($this->_escape_char, '/');
				$preg_ec[2] = $preg_ec[3] = $this->_escape_char;
			}
		}
		foreach ($this->_reserved_identifiers as $id){
			if (strpos($item, '.'.$id) !== FALSE)
				return preg_replace('/'.$preg_ec[0].'?([^'.$preg_ec[1].'\.]+)'.$preg_ec[1].'?\./i', $preg_ec[2].'$1'.$preg_ec[3].'.', $item);
		}
		return preg_replace('/'.$preg_ec[0].'?([^'.$preg_ec[1].'\.]+)'.$preg_ec[1].'?(\.)?/i', $preg_ec[2].'$1'.$preg_ec[3].'$2', $item);
	}

    protected function escape_str($str)
	{
		if (is_array($str)){
			foreach ($str as $key => $val)
				$str[$key] = $this->escape_str($val);
			return $str;
		}
		$str = str_replace("'", "''", remove_invisible_characters($str, FALSE));
		return $str;
	}

	protected function escape($str)
	{
		if (is_array($str)){
			$str = array_map(array(&$this, 'escape'), $str);
			return $str;
		} elseif (is_string($str) OR (is_object($str) && method_exists($str, '__toString')))
			return "'".$this->escape_str($str)."'";
		elseif (is_bool($str))
			return ($str === FALSE) ? 0 : 1;
		elseif ($str === NULL) return 'NULL';
		return $str;
	}
}
