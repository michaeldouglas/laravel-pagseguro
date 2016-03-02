<?php

namespace laravel\pagseguro\Notification;

use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorTrait;
use laravel\pagseguro\Complements\DataHydratorTrait\DataHydratorConstructorTrait;
use laravel\pagseguro\Complements\ValidateTrait;
use laravel\pagseguro\Credentials\CredentialsInterface;
use laravel\pagseguro\Remote\Notification as RemoteNotification;
use laravel\pagseguro\Transaction\Information\InformationFactory;

/**
 * Notification Object
 *
 * @category   Notification
 * @package    Laravel\PagSeguro\Notification
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-09-15
 *
 * @copyright  Laravel\PagSeguro
 */
class Notification implements NotificationInterface
{

    /**
     * Notification Code (Código da Notificação)
     * @var string
     */
    protected $notificationCode;

    /**
     * Notification Type (Tipo de Notificação)
     * @var string
     */
    protected $notificationType = 'transaction';

    use DataHydratorTrait, DataHydratorConstructorTrait, ValidateTrait {
        ValidateTrait::getHidratableVars insteadof DataHydratorTrait;
    }

    /**
     * Constructor
     * @param array|string $data Notification Required Data or String Code
     */
    public function __construct($data = [])
    {
        $args = func_get_args();
        $data = null;
        $this->hydrateMagic(
            ['notificationCode', 'notificationType'],
            $args
        );
    }

    /**
     * Get Notification Code
     * @return string
     */
    public function getNotificationCode()
    {
        return $this->notificationCode;
    }

    /**
     * Set Notification Code
     * @param string $code
     * @return Notification
     */
    public function setNotificationCode($code)
    {
        $this->notificationCode = $code;
        return $this;
    }

    /**
     * Get Notification Type
     * @return string
     */
    public function getNotificationType()
    {
        return $this->notificationType;
    }

    /**
     * Set Notification Type
     * @param string $type
     * @return Notification
     */
    public function setNotificationType($type)
    {
        $type = strtolower($type);
        if ($type !== 'transaction') {
            throw new \InvalidArgumentException('Unsupported type:' . $type);
        }
        $this->notificationType = $type;
        return $this;
    }

    /**
     * Check Information
     * @param CredentialsInterface $credentials
     * @return \laravel\pagseguro\Transaction\Information\Information
     */
    public function check(CredentialsInterface $credentials)
    {
        $type = $this->getNotificationType();
        $remote = new RemoteNotification();
        $data = $remote->$type($this->getNotificationCode(), $credentials);
        $factoryBase = '\laravel\pagseguro\%s\Information\InformationFactory';
        $factoryClass = sprintf($factoryBase, ucfirst($type));
        $factory = new $factoryClass($data);
        $information = $factory->getInformation();
        return $information;
    }

    /**
     * Get Validation Rules
     * @return ValidationRules
     */
    public function getValidationRules()
    {
        return new ValidationRules();
    }
}
