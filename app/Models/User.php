<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $fillable = [
        'users.id',
        'users.name',
        'users.image',
        'users.email',
        'users.password',
        'roles.name as role_name'
    ];

    public function loadListWithPager ($param = []) {
        $query = DB::table($this->table)
            ->join('roles', 'roles.id', '=', 'users.id_role')
            ->where('users.status', '=', 1)
            ->select($this->fillable);
        $lists = $query->paginate(10);
        return $lists;
    }

    public function saveNew($params) {
        $data = array_merge($params['cols'],[
            'password'=>Hash::make($params['cols']['password'])
        ]);
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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
