<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    //
    private $v;
    public function __construct()
    {
        $this->v = [];
    }

    public function hello() {
        $this->v['hello'] = 'HELLO';

        return view('hello.hello', $this->v);
    }
}
