<?php

namespace laravel\pagseguro\Notification;

use laravel\pagseguro\Config\Config;
use laravel\pagseguro\Credentials\Credentials;
use laravel\pagseguro\Credentials\CredentialsInterface;
use laravel\pagseguro\Remote\Url\Resolver;

/**
 * Notification Controller
 *
 * @category   Notification
 * @package    Laravel\PagSeguro\Notification
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-15
 *
 * @copyright  Laravel\PagSeguro
 */
class NotificationController
{

    /**
     * Notification Action
     */
    public function notificationAction()
    {
        $platform = Config::getPlatform();
        $params = $platform->getUrlParameters();
        $code = $params['notificationCode'];
        $type = $params['notificationType'];
        if (empty($code) || empty($type)) {
            $platform->abort();
            return;
        }
        $credential = $this->getCredentialsTo($code);
        $notification = new Notification($code, $type);
        $info = $notification->check($credential);
        $this->notify($info);
    }

    /**
     * Get Credential
     * @return CredentialsInterface
     */
    private function getCredentialsTo($notificationCode)
    {
        $resolver = new Resolver();
        $config = $resolver->getRouteConfig('notification');
        $callback = null;
        if (array_key_exists('credential', $config)) {
            $callback = $config['credential'];
        }
        if ($callback === 'default') {
            return new Credentials(Config::get('credentials'));
        }
        if (!is_callable($callback)) {
            throw new \RuntimeException('Credentials is a not valid PHP callback');
        }
        $credentials = call_user_func_array($callback, [$notificationCode]);
        if (!($credentials instanceof CredentialsInterface)
            || !$credentials->isValid()) {
            throw new \RuntimeException('Invalid Credentials');
        }
        return $credentials;
    }

    /**
     * Notification Callback
     */
    private function notify($info)
    {
        $isCallable = false;
        $resolver = new Resolver();
        $config = $resolver->getRouteConfig('notification');
        $callback = null;
        if (array_key_exists('callback', $config)) {
            $callback = $config['callback'];
        }
        if (!is_null($callback) && !($isCallable = is_callable($callback))) {
            throw new \RuntimeException('Callback is a not valid PHP callback');
        }
        if ($isCallable) {
            call_user_func_array($callback, [$info]);
        }
    }
}
