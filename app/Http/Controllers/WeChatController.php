<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use EasyWeChat\Kernel\Messages;

class WeChatController extends Controller
{

  /**
   * 处理微信的请求消息
   *
   * @return string
   */
  public function serve()
  {
    Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志
    $officialAccount = EasyWeChat::officialAccount();

    $officialAccount->server->push(function ($message) {
      return "您好！欢迎使用 EasyWeChat!";
    });

//    $response = $officialAccount->server->serve();


    Log::info(json_encode($officialAccount));

    return $officialAccount->server->serve();
  }
}