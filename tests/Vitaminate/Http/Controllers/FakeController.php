<?php

namespace Vitaminate\Tests\Vitaminate\Http\Controllers;

use Vitaminate\Http\Controller;

class FakeController extends Controller
{
    public function create(){}
    public function createWithParameter($param){}
    public function detail(){
        return 'detail action';
    }
}