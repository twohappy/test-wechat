<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use EasyWeChat\Kernel\Messages;

class WeChatController extends Controller {

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
      return "欢迎关注 overtrue！";
    });

    return $app->server->serve();
  }

  public function notice()
  {
    $officialAccount = \EasyWeChat::officialAccount();
    $users = $officialAccount->user->list($nextOpenId = null);
//    dd($users);
    Log::info(json_encode($users));
    $officialAccount->template_message->send([
      'touser'      => 'oaAhC1nJRvC3T2ZF_1NiJisJp_Vo',
      'template_id' => 'PKgrrNma6Z_6zcCGYde9d7DD6-fFBFGc9sIMChFWdvs',
      'url'         => 'https://easywechat.org',
      'data'        => [
        'first'  => '你好',
        'name'   => '浦发银行',
        'target' => '10',
        'latest' => '11.2',
        'time'   => '2018-07-02 12:00:00',
        'remark' => '今天就发一次',
      ],
    ]);

    return $officialAccount->server->serve();
  }
}