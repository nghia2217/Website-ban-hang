<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Bill extends Model
{
    use HasFactory;

    protected $table = 'bills';
    protected $fillable = [
        'bills.id',
        'users.name as user_name',
        'products.name as product_name',
        'products.price as product_price',
        'products.image as product_image',
        'promotions.promotion_price as promotion_price',
        'bills.tel',
        'bills.address',
        'bills.quantity',
        'bills.id_user',
        'products.id_category as category_id',
        'bills.status'
    ];

    public function saveNew($params) {
        $data = array_merge($params['cols']);
        $res = DB::table($this->table)->insertGetId($data);
        return $res;
    }

    public function loadListWithPager($param = []) {
        $query = DB::table($this->table)
            ->join('users', 'users.id', '=', 'bills.id_user')
            ->join('products', 'products.id', '=', 'bills.id_product')
            ->join('promotions', 'promotions.id', '=', 'products.id_promotion')
            ->select($this->fillable);
        $lists = $query->paginate(10);
        return $lists;
    }

    public function loadOne($id, $params = []) {
        $query = DB::table($this->table)
            ->join('users', 'users.id', '=', 'bills.id_user')
            ->join('products', 'products.id', '=', 'bills.id_product')
            ->join('promotions', 'promotions.id', '=', 'products.id_promotion')
            ->where('bills.id','=',$id)
            ->select($this->fillable);

        $obj = $query->first();
        return $obj;
    }

    public function loadBillClient($user_id, $params = []) {
        $query = DB::table($this->table)
            ->join('users', 'users.id', '=', 'bills.id_user')
            ->join('products', 'products.id', '=', 'bills.id_product')
            ->join('promotions', 'promotions.id', '=', 'products.id_promotion')
            ->where('bills.id_user','=',$user_id)
            ->select($this->fillable);

        $lists = $query->paginate(10);
        return $lists;
    }

    //Sửa
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
