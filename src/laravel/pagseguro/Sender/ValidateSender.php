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

use laravel\pagseguro\Sender\AbstractValidateSender;

class ValidateSender extends AbstractValidateSender
{
    
    /**
     * Verifica se o CPF do remetente está válido
     * @author Michael Araujo <michaeldouglas010790@gmail.com>
     * @return bool
     */
    public function isValidCPF($value = NULL)
    {
        $er = '/^([0-9]{3})\.?([0-9]{3})\.?([0-9]{3})\-?([0-9]{2})$/';
        $preg = preg_match($er, $value);
        if (!$preg) {
            return false;
        }

        $cpf = str_pad(preg_replace('/[^0-9]/', '', trim($value)), 11, '0', STR_PAD_LEFT);

        if (strlen($cpf) != 11) {
            return false;
        }

        $regex = "/^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/";
        if (preg_match($regex, $cpf)) {
            return false;
        }

        $tcpf = $cpf;
        $b = 0;
        $c = 11;
        for ($i = 0; $i < 11; $i++)
            if ($i < 9)
                $b += ($tcpf[$i] * --$c);

        $x = $b % 11;
        $tcpf[9] = ($x < 2) ? 0 : 11 - $x;

        $b = 0;
        $c = 11;
        for ($y = 0; $y < 10; $y++)
            $b += ($tcpf[$y] * $c--);

        $x = $b % 11;
        $tcpf[10] = ($x < 2) ? 0 : 11 - $x;

        if (($cpf[9] != $tcpf[9]) || ($cpf[10] != $tcpf[10])) {
            return false;
        }
        return true;
    }
    
    /**
     * Verifica se o telefone do remetente está válido
     * @author Michael Araujo <michaeldouglas010790@gmail.com>
     * @return bool
     */
    public function isValidTelephone($areacode = NULL, $number = NULL)
    {
        if((!preg_match('^[0-9]{4}-[0-9]{4}$^', $number)) || !is_int($areacode)){
            return false;
        }
        return true;
    }
    
    /**
     * Verifica se o documento do remetente está válido
     * @author Michael Araujo <michaeldouglas010790@gmail.com>
     * @return bool
     */
    public function isValidDocuments($documents = NULL)
    {
        
    }
    
    /**
     * Verifica se o e-mail do remetente está válido
     * @author Michael Araujo <michaeldouglas010790@gmail.com>
     * @return bool
     */
    public function isValidEmail($email = NULL)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    
    /**
     * Verifica se o nome do remetente está válido
     * @author Michael Araujo <michaeldouglas010790@gmail.com>
     * @return bool
     */
    public function isValidName($name = NULL)
    {
        $value = str_replace("'", "", $name);
        $er = '/^([A-Za-zÁ-ú]{2,})\s([A-Za-zÁ-ú\s]{2,})$/';
        $preg = preg_match($er, $value);
        if (!$preg) {
            return false;
        }
        return true;
    }

}
