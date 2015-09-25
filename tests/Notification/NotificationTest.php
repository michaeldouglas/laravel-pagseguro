<?php

namespace Tests\Notification;

use \laravel\pagseguro\Notification\Notification;

/**
 * Notification Test
 * @author Isaque de Souza <isaquesb@gmail.com>
 */
class NotificationTest extends \PHPUnit_Framework_TestCase
{

    public function testEmptyNotification()
    {
        $o = new Notification();
        $this->assertEquals([
            'notificationCode' => null,
            'notificationType' => 'transaction',
        ], $o->toArray());
    }

    public function testWithStringCode()
    {
        $o = new Notification('012345678901234567890123456789012345678');
        $this->assertEquals('012345678901234567890123456789012345678', $o->getNotificationCode());
        $this->assertEquals('transaction', $o->getNotificationType());
    }

    public function testWithStringCodeAndStringType()
    {
        $o = new Notification('012345678901234567890123456789012345678', 'transaction');
        $this->assertEquals('012345678901234567890123456789012345678', $o->getNotificationCode());
        $this->assertEquals('transaction', $o->getNotificationType());
    }

    public function testWithArrayCodeOnly()
    {
        $o = new Notification(['notificationCode' => '012345678901234567890123456789012345678']);
        $this->assertEquals('012345678901234567890123456789012345678', $o->getNotificationCode());
        $this->assertEquals('transaction', $o->getNotificationType());
    }

    public function testWithArrayParams()
    {
        $data = [
            'notificationCode' => '012345678901234567890123456789012345678',
            'notificationType' => 'transaction',
        ];
        $o = new Notification($data);
        $this->assertEquals($data, $o->toArray());
        $this->assertEquals($data['notificationCode'], $o->getNotificationCode());
        $this->assertEquals($data['notificationType'], $o->getNotificationType());
    }
}
