<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $fillable = [
        'id',
        'name'
    ];

    public function loadListWithPager($param = []) {
        $query = DB::table($this->table)
            ->where('status', '=', 1)
            ->select($this->fillable);
        $lists = $query->paginate(10);
        return $lists;
    }

    public function saveNew($params) {
        $data = array_merge($params['cols']);
        $res = DB::table($this->table)->insertGetId($data);
        return $res;
    }

    public function loadOne($id, $params = []) {
        $query = DB::table($this->table)
            ->where('id','=',$id);

        $obj = $query->first();
        return $obj;
    }

    public function saveUpdate($params) {
        if (empty($params['cols']['id'])) {
            Session::push('errors', 'Không xác định bản ghi cập nhập');
        }
        $dataUpdate = [];
        foreach ($params['cols'] as $colName => $val) {
            if ($colName == 'id') continue;
            $dataUpdate[$colName] = (strlen($val) == 0) ? null : $val;
        }
        $res = DB::table($this->table)
            ->where('id', $params['cols']['id'])
            ->update($dataUpdate);
        return $res;
    }
    public function deleteOne($id, $params = []) {

        $res = DB::table($this->table)
            ->where('id','=', $id)
            ->update([
                'status' => 2
            ]);
        return $res;
    }
}
