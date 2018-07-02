<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

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

    $app = app('wechat.official_account');
    $app->server->push(function($message){
      $toName = $message['ToUserName'];
      $fromName = $message['FromUserName'];
      $time = $message['CreateTime'];
      $id = $message['MsgId'];
      $str = "接收方{$toName},发送方{$fromName},时间{$time}，消息ID{$id}";
      return json_encode($message);
    });

    return $app->server->serve();
  }
}