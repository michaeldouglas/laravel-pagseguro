<?php

namespace laravel\pagseguro\Transaction\Status;

/**
 * Transaction Status Object
 *
 * @category   Transaction
 * @package    Laravel\PagSeguro\Transaction
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
 * @since      2015-12-10
 *
 * @copyright  Laravel\PagSeguro
 */
class Status implements StatusInterface
{

    /**
     * @var int
     */
    protected $code;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    private $names = [
        self::INITIALIZED => 'Iniciada',
        self::AWAITING_PAYMENT => 'Aguardando pagamento',
        self::REVIEW => 'Em análise',
        self::PAID => 'Paga',
        self::AVAIBLE => 'Disponível',
        self::DISPUTE => 'Em disputa',
        self::RETURNED => 'Devolvida',
        self::CANCELED => 'Cancelada',
        self::SELLER_CHARGEBACK => 'Chargeback',
        self::CONTESTATION => 'Contestada',
    ];

    /**
     * Constructor
     * @param string $code
     */
    public function __construct($code)
    {
        if ($code !== 0 && !filter_var($code, FILTER_VALIDATE_INT)) {
            throw new \InvalidArgumentException('Invalid status code');
        }
        $name = 'Desconhecido';
        if (array_key_exists($code, $this->names)) {
            $name = $this->names[$code];
        }
        $this->code = $code;
        $this->name = $name;
        unset($this->names);
    }

    /**
     * Get Code
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Get Name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * You can release the product / service to the customer
     * @return bool Se Pode liberar o produto/ serviço para o cliente
     */
    public function canDispatch()
    {
        return in_array($this->getCode(), [self::PAID, self::AVAIBLE]);
    }

    /**
     * If the money is already available
     * @return bool Se o dinheiro já esta disponível
     */
    public function isAvaible()
    {
        return $this->getCode() == self::AVAIBLE;
    }

    /**
     * If the transaction is canceled
     * @return bool Se a transação foi cancelada
     */
    public function canceled()
    {
        return $this->getCode() == self::CANCELED;
    }

    /**
     * If the transaction is finished
     * @return bool Se a transação foi encerrada
     */
    public function finished()
    {
        return $this->canceled() || $this->getCode() == self::RETURNED;
    }
}
