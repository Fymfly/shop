<?php

namespace App\Http\Controllers\Host;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //输出 hello word!
    public function hello() {

        return 'hello world !';
    }
}
