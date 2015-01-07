<?php

/**
 * Classe responsável pelo objeto de remetente de compra
 *
 * @category   Sender
 * @package    Laravel\PagSeguro\Sender
 *
 * @author     Michael Douglas <michaeldouglas010790@gmail.com>
 * @since      : 03/01/2015
 *
 * @copyright  Laravel\PagSeguro
 */

namespace laravel\pagseguro\Sender;

use laravel\pagseguro\Sender\ValidateSender,
    laravel\pagseguro\Helper\Helper;

class Sender extends ValidateSender
{

    private   $name;
    private   $email;
    private   $numero;
    private   $documents;
    protected $sender;

    public function __construct($sender = null)
    {
        if (!is_null($sender) && is_array($sender)) {
            $this->sender = $sender;
            switch ($this->sender) {
                case isset($this->sender['nome']):
                    $this->setVerifyName();

                case isset($this->sender['email']):
                    $this->email = Helper::setVerifyKeyItem($sender, 'email');

                case (isset($this->sender['codarea']) && isset($this->sender['numero'])):
                    $this->setVerifyPhone();

                case (isset($this->sender['doctipo']) && isset($this->sender['docnum'])):
                    $this->complement = Helper::setVerifyKeyItem($sender, 'complemento');
                    break;

                default:
                    throw new \Exception('Nenhum parametro encontrado!');
            }
        }
    }
    
    /**
     * Verifica se o nome do remetente está válido, se estiver correto seta o nome
     * do remetente
     * @author Michael Araujo <michaeldouglas010790@gmail.com.br>
     * @return Exception
     */
    protected function setVerifyName()
    {
        if ($this->setValidateName($this->sender['nome']) == false) {
            throw new \Exception('Nome do remetente inválido!');
        }
        $this->setName();
    }
    
    /**
     * Seta o nome do remetente
     * @author Michael Araujo <michaeldouglas010790@gmail.com.br>
     * @return object
     */
    private function setName()
    {
        $this->name = Helper::setVerifyKeyItem($this->sender, 'nome');
    }
    
    /**
     * Obtém o nome do remetente
     * @author Michael Araujo <michaeldouglas010790@gmail.com.br>
     * @return object
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Verifica se o telefone do remetente está válido, se estiver chama o método para
     * setar
     * @author Michael Araujo <michaeldouglas010790@gmail.com.br>
     * @return Exception
     */
    private function setVerifyPhone()
    {
        if ($this->setValidateTelephone($this->sender['codarea'], $this->sender['numero']) == false) {
            throw new \Exception('Telefone inválido!');
        }

        $this->setPhone();
    }
    
    /**
     * Seta o telefone do remetente
     * @author Michael Araujo <michaeldouglas010790@gmail.com.br>
     * @return object
     */
    private function setPhone()
    {
        $this->numero = Helper::setVerifyKeyItem($this->sender, 'numero');
    }
    
    /**
     * Obtém o telefone do remetente
     * @author Michael Araujo <michaeldouglas010790@gmail.com.br>
     * @return object
     */
    public function getPhone()
    {
        return $this->numero;
    }

}
