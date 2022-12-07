<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'products.id',
        'products.name',
        'products.image',
        'products.price',
        'products.description',
        'products.id_category',
        'products.id_promotion',
        'categories.id as category_id',
        'categories.name as category_name',
        'promotions.promotion_price as promotion_price',
        'promotions.name as promotion_name'
    ];

    public function loadListWithPager($params = []) {
        $query = DB::table($this->table)
            ->join('categories', 'categories.id', '=', 'products.id_category')
            ->join('promotions', 'promotions.id', '=', 'products.id_promotion')
            ->where('products.status','=',1)
            ->select($this->fillable);
        $lists = $query->paginate(10);
        return $lists;
    }
    public function loadListHomeClient($params = []) {
        $query = DB::table($this->table)
            ->join('categories', 'categories.id', '=', 'products.id_category')
            ->join('promotions', 'promotions.id', '=', 'products.id_promotion')
            ->where('products.status','=',1)
            ->select($this->fillable);
        $lists = $query->paginate(6);
        return $lists;
    }

    public function loadProductCategory($id_category, $params = []) {
        $query = DB::table($this->table)
            ->join('categories', 'categories.id', '=', 'products.id_category')
            ->join('promotions', 'promotions.id', '=', 'products.id_promotion')
            ->select($this->fillable)
            ->where('products.status','=',1)
            ->where('products.id_category', '=', $id_category);
        $lists = $query->paginate(6);
        return $lists;
    }
    public function loadCategoryDetail($id, $params = []) {
        $query = DB::table($this->table)
            ->join('categories', 'categories.id', '=', 'products.id_category')
            ->join('promotions', 'promotions.id', '=', 'products.id_promotion')
            ->select($this->fillable)
            ->where('products.status','=',1)
            ->where('products.id_category', '=', $id);
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
            ->join('categories', 'categories.id', '=', 'products.id_category')
            ->join('promotions', 'promotions.id', '=', 'products.id_promotion')
            ->where('products.id','=',$id)
            ->select($this->fillable);

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

    public function loadListSearchProduct($name, $params = []) {
        $query = DB::table($this->table)
            ->join('categories', 'categories.id', '=', 'products.id_category')
            ->join('promotions', 'promotions.id', '=', 'products.id_promotion')
            ->where('products.status','=',1)
            ->where('products.name', 'like', '%'.$name.'%')
            ->select($this->fillable);
        $lists = $query->paginate(10);
        return $lists;
    }

    public function loadFilterProduct($price_min, $price_max, $params = []) {
        $query = DB::table($this->table)
            ->join('categories', 'categories.id', '=', 'products.id_category')
            ->join('promotions', 'promotions.id', '=', 'products.id_promotion')
            ->where('products.status','=',1)
            ->where('products.price', '>=', $price_min)
            ->where('products.price', '<', $price_max)
            ->select($this->fillable);
        $lists = $query->paginate(10);
        return $lists;
    }
}
