<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    //
    private $v;
    public function __construct()
    {
        $this->v = [];
    }

    public function listBanner(Request $request) {
        $banner = new Banner();
        $this->v['banners'] = $banner->loadListWithPager();
        return view('client.home', $this->v);
    }
}
