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
    $officialAccount = \EasyWeChat::officialAccount();

    Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

    $message = $officialAccount->server->getMessage();
    Log::info(json_encode($message));

    if ($message['MsgType'] === 'event') {
      if($message['Event'] === 'subscribe'){
        // 用户关注公众号后直接拿到 open_id 和 union_id
        $user = $officialAccount->user->get($message['FromUserName']);
        Log::info($user);
      }
      return null;
    }
    $officialAccount->server->push(function ($message) {
      return 'Message received!';
    });
  }

  public function notice()
  {
    $officialAccount = \EasyWeChat::officialAccount();
    $users = $officialAccount->user->list($nextOpenId = null);
//    dd($users);
    Log::info(json_encode($users));
    $officialAccount->template_message->send([
      'touser'      => 'oaAhC1vaFCNClSBqVPPsDCwQ82jU',
      'template_id' => 'jJX2LFHOPSqm8Zk7lDLNvS07FWnEEJ5EaJnm2OQEPj0',
      'url'         => 'https://baidu.com',
      'data'        => [
        'first'  => '吱吱',
        'keyword1'  => '大佬安排的任务',
        'keyword2'  => '主要内容是打酱油',
        'keyword3'  => '其它的没了',
        'remark'  => '没有用的一个备注。如有问题，自己解决。',
//        'name'   => '浦发银行',
//        'target' => '10',
//        'latest' => '11.2',
//        'time'   => '2018-07-02 12:00:00',
//        'remark' => '今天就发一次',
      ],
    ]);

    return $officialAccount->server->serve();
  }

  public function sendNotice()
  {
    $officialAccount = \EasyWeChat::officialAccount();
    $users = $officialAccount->user->list($nextOpenId = null);
//    dd($users);
    Log::info(json_encode($users));
    $officialAccount->server->push(function ($message) {
    return "您好！欢迎关注我!";
   });

    return $officialAccount->server->serve();
  }
}