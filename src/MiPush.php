<?php

namespace Octopusz\Mipush;

use Octopusz\Push\Builder;
use Octopusz\Push\Sender;
use Octopusz\Push\Constants;

use Octopusz\Push\TargetedMessage;


//include_once(dirname(__FILE__) . '/autoload.php');

class MiPush
{

    public static function sendMessage($secret, $package, $regId, $title, $desc, $payload, $gid, $kid, $pid,$type)
    {

        Constants::setPackage($package);
        Constants::setSecret($secret);
// 常量设置必须在new Sender()方法之前调用
        $sender = new Sender();
        $message1 = new Builder();
        $message1->title($title);  // 通知栏的title
        $message1->description($desc); // 通知栏的descption
        $message1->passThrough(0);  // 这是一条通知栏消息，如果需要透传，把这个参数设置成1,同时去掉title和descption两个参数
        $message1->payload($payload); // 携带的数据，点击后将会通过客户端的receiver中的onReceiveMessage方法传入。
        $message1->extra(Builder::notifyForeground, 1); // 应用在前台是否展示通知，如果不希望应用在前台时候弹出通知，则设置这个参数为0
        $message1->extra('gid', $gid); // 额外参数
        $message1->extra('pid', $pid); // 额外参数
        $message1->extra('type', $type); // 额外参数
        $message1->extra('kid', $kid); // 额外参数
        $message1->notifyId(2); // 通知类型。最多支持0-4 5个取值范围，同样的类型的通知会互相覆盖，不同类型可以在通知栏并存
        $message1->build();
        $targetMessage = new TargetedMessage();
        $targetMessage->setTarget('alias1', TargetedMessage::TARGET_TYPE_REGID); // 设置发送目标。可通过regID,alias和topic三种方式发送
        $targetMessage->setMessage($message1);
        return $sender->send($message1, $regId, $retries = 1)->getRaw();
    }

    public static function sendBBSMessage($secret, $package, $regId, $title, $desc, $payload, $type, $shareUid)
    {
        Constants::setPackage($package);
        Constants::setSecret($secret);
        //常量设置必须在new Sender()方法之前调用
        $sender = new Sender();
        $message1 = new Builder();
        $message1->title($title);
        $message1->description($desc);
        $message1->passThrough(0);
        $message1->payload($payload);
        $message1->extra(Builder::notifyForeground, 1);
        $message1->extra('type', $type);
        $message1->extra('share_uid', $shareUid);
        $message1->notifyId(2);
        $message1->build();
        $targetMessage = new TargetedMessage();
        $targetMessage->setTarget('alias1', TargetedMessage::TARGET_TYPE_REGID);
        $targetMessage->setMessage($message1);
        return $sender->send($message1, $regId, $retries = 1)->getRaw();

    }
    public static function sendTaskNoticeMessage($secret, $package, $regId, $title, $desc, $payload, $type, $taskId)
    {
        Constants::setPackage($package);
        Constants::setSecret($secret);
        //常量设置必须在new Sender()方法之前调用
        $sender = new Sender();
        $message1 = new Builder();
        $message1->title($title);
        $message1->description($desc);
        $message1->passThrough(0);
        $message1->payload($payload);
        $message1->extra(Builder::notifyForeground, 1);
        $message1->extra('type', $type);
        $message1->extra('task_id', $taskId);
        $message1->notifyId(2);
        $message1->build();
        $targetMessage = new TargetedMessage();
        $targetMessage->setTarget('alias1', TargetedMessage::TARGET_TYPE_REGID);
        $targetMessage->setMessage($message1);
        return $sender->send($message1, $regId, $retries = 1)->getRaw();
    }
}


