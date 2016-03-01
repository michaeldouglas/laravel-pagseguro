<?php

namespace laravel\pagseguro\Notification;

use laravel\pagseguro\Credentials\CredentialsInterface;
use laravel\pagseguro\Transaction\Information\InformationFactory;

/**
 * Notification Interface
 *
 * @category   Notification
 * @package    Laravel\PagSeguro\Notification
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-09-15
 *
 * @copyright  Laravel\PagSeguro
 */
interface NotificationInterface
{

    /**
     * Constructor
     * @param array|string $data Notification Required Data or String Code
     */
    public function __construct($data = []);

    /**
     * Get Notification Code
     * @return string
     */
    public function getNotificationCode();

    /**
     * Set Notification Code
     * @param string $code
     * @return Notification
     */
    public function setNotificationCode($code);

    /**
     * Get Notification Type
     * @return string
     */
    public function getNotificationType();

    /**
     * Set Notification Type
     * @param string $type
     * @return Notification
     */
    public function setNotificationType($type);

    /**
     * Check Information
     * @param CredentialsInterface $credentials
     * @return InformationFactory
     */
    public function check(CredentialsInterface $credentials);

    /**
     * Proxies Data Hydrate
     * @param array $data
     * @return object
     */
    public function hydrate(array $data = []);
}
