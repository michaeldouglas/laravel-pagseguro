<?php

namespace laravel\pagseguro\Notification;

use laravel\pagseguro\Complements\DataHydratorTrait;
use laravel\pagseguro\Complements\ValidateTrait;

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

    use DataHydratorTrait, ValidateTrait {
        ValidateTrait::getHidratableVars insteadof DataHydratorTrait;
    }

    /**
     * Constructor
     * @param array|string $data Notification Required Data or String Code
     */
    public function __construct($data = [])
    {
        $args = func_get_args();
        $firstArg = reset($args);
        $data = is_array($firstArg) ? $firstArg : [];
        if (count($args) === 2) {
            $data['notificationCode'] = $firstArg;
            $data['notificationType'] = end($args);
        } elseif (is_string($firstArg)) {
            $data['notificationCode'] = $firstArg;
        }
        if (count($data)) {
            $this->hydrate($data);
        }
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
        if ($type !== 'transaction') {
            throw new \InvalidArgumentException('Unsupported type:' . $type);
        }
        $this->notificationType = $type;
        return $this;
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
