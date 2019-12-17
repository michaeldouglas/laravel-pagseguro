<?php

namespace laravel\pagseguro\Platform\Laravel5;

use Illuminate\Routing\Controller;
use laravel\pagseguro\Config\Config;
use laravel\pagseguro\Credentials\Credentials as PagSeguroCredentials;
use laravel\pagseguro\Credentials\CredentialsInterface;
use laravel\pagseguro\Notification\Notification;
use laravel\pagseguro\Remote\Url\Resolver;

/**
 * Notification Controller
 *
 * @category   Notification
 * @package    Laravel\PagSeguro\Notification
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2016-01-15
 * @copyright  Laravel\PagSeguro
 */
class NotificationController extends Controller
{
    /**
     * Notification Action
     */
    public function notification()
    {
        $platform = Config::getPlatform();
        $code = \request()->input('notificationCode');
        $type = \request()->input('notificationType');
        if (empty($code) || empty($type)) {
            $platform->abort();
            return;
        }
        $credential = new PagSeguroCredentials(
            \config('laravelpagseguro.credentials.token'),
            \config('laravelpagseguro.credentials.email')
        );
        $notification = new Notification($code, $type);
        $info = $notification->check($credential);
        $this->notify($info);
    }

    /**
     * Notification Callback
     *
     * @param Informati
     */
    private function notify($info)
    {
        $isCallable = false;
        $callback = \config('laravelpagseguro.routes.notification.callback');
        if (!is_null($callback) && !($isCallable = is_callable($callback))) {
            throw new \RuntimeException('Callback is a not valid PHP callback');
        }
        if ($isCallable) {
            call_user_func_array($callback, [$info]);
        }
    }

    /**
     * Get Credential
     *
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
            return new PagSeguroCredentials(
                \config('laravelpagseguro.credentials.token'),
                \config('laravelpagseguro.credentials.email')
            );
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
}
