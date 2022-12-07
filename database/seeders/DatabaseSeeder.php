<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('roles')->insert([
            [
                'name'=>'Admin',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'Khách hàng',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ]

        ]);

        $arrUsers = [];

        for ($i=0;$i<5;$i++) {
            array_push($arrUsers, [
                'name'=>'ADMIN' .$i,
                'email'=>'admin' .$i. '@gmail.com',
                'password'=>Hash::make('123456'),
                'id_role'=>1,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ]);
        }

        DB::table('users')->insert(
            $arrUsers
        );

        $arrBanners = [];

        for ($i=0;$i<5;$i++) {
            array_push($arrBanners, [
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ]);
        }

        DB::table('banners')->insert(
            $arrBanners
        );

        $arrBills = [];

        for ($i=0; $i<5; $i++) {
            array_push($arrBills, [
                'id_user'=>2,
                'id_product'=>1,
                'tel'=>'098765432'.$i,
                'address'=>'Hà Nội '.$i,
                'quantity'=>$i,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ]);
        }

        DB::table('bills')->insert(
            $arrBills
        );

        $arrCategories = [];

        for ($i=0; $i<5; $i++) {
            array_push($arrCategories, [
                'name'=>'Danh mục '.$i,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ]);
        }

        DB::table('categories')->insert(
            $arrCategories
        );

        $arrPromotions = [];

        for ($i=0; $i<5; $i++) {
            array_push($arrPromotions, [
                'name'=>'Khuyến mãi '.$i,
                'promotion_price'=>100000,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ]);
        }

        DB::table('promotions')->insert(
            $arrPromotions
        );

        $arrProducts = [];

        for ($i=0; $i<5; $i++) {
            array_push($arrProducts, [
                'name'=>'Sản phẩm '.$i,
                'price'=>200000,
                'description'=>'Mô tả sản phẩm 1',
                'id_category'=>2,
                'id_promotion'=>3,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ]);
        }

        DB::table('products')->insert(
            $arrProducts
        );
    }
}
