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

    $app = app('wechat.official_account');
    $app->template_message->send([
      'touser' => 'gh_1ccb4d091daa',
      'template_id' => 'PKgrrNma6Z_6zcCGYde9d7DD6-fFBFGc9sIMChFWdvs',
      'url' => 'https://baidu.com',
      'data' => [
        'first' => '你好',
        'name' => '浦发银行',
        'target' => '10',
        'latest' => '10.5',
        'time' => '2018-07-02 10:08:22',
        'remark' => '优财助手~',
        ],
    ]);

    return $app->server->serve();
  }
}