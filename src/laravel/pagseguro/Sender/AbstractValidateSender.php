<?php

/**
 * Classe responsável por declarar quais métodos o validador de remetente deve conter
 *
 * @category   Sender
 * @package    Laravel\PagSeguro\AbstractValidateSender
 *
 * @author     Michael Douglas <michaeldouglas010790@gmail.com>
 * @since      : 03/01/2015
 *
 * @copyright  Laravel\PagSeguro
 */

namespace laravel\pagseguro\Sender;

abstract class AbstractValidateSender
{
    public abstract function setValidateCPF($cpf = NULL);
    public abstract function setValidateName($name = NULL);
    public abstract function setValidateTelephone($areacode = NULL, $number = NULL);
    public abstract function setValidateDocuments($documents = NULL);
    public abstract function setValidateEmail($email = NULL);
}