<?php

use App\Http\Controllers\Controller;

/**
 * Created by PhpStorm.
 * User: twohappy
 * Date: 2018/7/2
 * Time: 上午10:23
 */
class TestController extends Controller
{
  public function index()
  {
    return phpinfo();
  }
}

