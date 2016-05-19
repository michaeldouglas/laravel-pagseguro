<?php

namespace laravel\pagseguro\Platform\Laravel5;

use laravel\pagseguro\Config\Config;
use laravel\pagseguro\Facades\PagSeguro;
use laravel\pagseguro\Credentials\CredentialsInterface;
use laravel\pagseguro\Notification\Notification;
use laravel\pagseguro\Remote\Url\Resolver;
use Illuminate\Routing\Controller;

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
class NotificationController extends Controller
{

    /**
     * Notification Action
     */
    public function notification()
    {
        \App::make('pagseguro'); // Register PagSeguro
        $platform = Config::getPlatform();
        $params = array_merge([
            'notificationCode' => null,
            'notificationType' => null,
        ], $platform->getUrlParameters());
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
     * @param string $notificationCode
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
            $facade = new PagSeguro();
            return $facade->credentials()->get();
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
     * @param Informati
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
