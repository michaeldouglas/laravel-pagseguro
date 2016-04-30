<?php

namespace laravel\pagseguro\Checkout\Facade;

use laravel\pagseguro\Checkout\CellphoneChargerCheckout;
use laravel\pagseguro\Checkout\CheckoutInterface;
use laravel\pagseguro\Checkout\Metadata\Gamer\GameInfo;
use laravel\pagseguro\Checkout\Metadata\Travel\TravelInfo;
use laravel\pagseguro\Checkout\SimpleCheckout;
use laravel\pagseguro\Checkout\GamerCheckout;
use laravel\pagseguro\Checkout\TransparentCheckout;
use laravel\pagseguro\Phone\Phone;
use laravel\pagseguro\Phone\PhoneInterface;

/**
 * Checkout Facade Object
 *
 * @category   Checkout
 * @package    Laravel\PagSeguro\Checkout
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>,  Eduardo Alves <eduardoalves.info@gmail.com>
 * @since      2016-01-12
 *
 * @copyright  Laravel\PagSeguro
 */
class CheckoutFacade
{

    /**
     * @param array $data
     * @return CheckoutInterface
     */
    public function createFromArray(array $data)
    {
        $isGamer = array_key_exists('game', $data);
        $isTravel = array_key_exists('travel', $data);
        $isCharger = array_key_exists('cellphone_charger', $data);
        $isTransparent = array_key_exists('transparent', $data);
        $isSimple = !($isGamer || $isTravel || $isCharger || $isTransparent);
        $this->multiTypeCheck($isGamer, $isTravel, $isCharger, $isTransparent, $isSimple);
        if ($isGamer) {
            $info = $data['game'];
            unset($data['game']);
            return $this->createGamerCheckout($data, $info);
        } elseif ($isTravel) {
            $info = $data['travel'];
            unset($data['travel']);
            return $this->createTravelCheckout($data, $info);
        } elseif ($isCharger) {
            $info = $data['cellphone_charger'];
            unset($data['cellphone_charger']);
            return $this->createCellPhoneChargerCheckout($data, $info);
        } elseif ($isTransparent) {
            $info = $data['transparent'];
            unset($data['transparent']);
            return $this->createTransparentCheckout($data, $info);
        }
        return $this->createSimpleCheckout($data);
    }

    /**
     * @param array $data
     * @param array|GameInfo $gameInfo Keys:gameName|playerId|timeInGameDays
     * @return GamerCheckout
     */
    public function createGamerCheckout(array $data, $gameInfo)
    {
        if (!($gameInfo instanceof GameInfo)) {
            $gameInfo = new GameInfo($gameInfo);
        }
        $dataFacade = new DataFacade();
        $checkoutData = $dataFacade->ensureInstances($data);
        $checkout = new GamerCheckout($checkoutData);
        $checkout->setInfo($gameInfo);
        return $checkout;
    }

    /**
     * @param array $data
     * @param array
     * @return GamerCheckout
     */
    public function createSimpleCheckout(array $data)
    {
        $dataFacade = new DataFacade();
        $checkoutData = $dataFacade->ensureInstances($data);
        $checkout = new SimpleCheckout($checkoutData);
        return $checkout;
    }

    public function createTransparentCheckout(array $data, $info)
    {
        //Todo: Implement TransparentCheckout
        $dataFacade = new DataFacade();
        $checkoutData = $dataFacade->ensureInstances($info);
        $checkout = new SimpleCheckout($checkoutData);

        $checkout->setPaymentMode('default');
        $checkout->setCreditCard($checkoutData['creditCard']);
        $checkout->setPaymentMethod($checkoutData['paymentMethod']);

        return $checkout;
    }

    /**
     * @param array $data
     * @param array|TravelInfo $travelInfo Keys:passengers|origin|destination
     * @return TravelCheckout
     */
    public function createTravelCheckout(array $data, $travelInfo)
    {
        $facade = new TravelFacade();
        $checkout = $facade->createCheckout($data, $travelInfo);
        return $checkout;
    }

    /**
     * @param array $data
     * @param array|PhoneInterface $phone Keys:areaCode|countryCode|number
     * @return TravelCheckout
     */
    public function createCellPhoneChargerCheckout(array $data, $phone)
    {
        if (!($phone instanceof PhoneInterface)) {
            $phone = Phone::factory($phone);
        }
        $dataFacade = new DataFacade();
        $checkoutData = $dataFacade->ensureInstances($data);
        $checkout = new CellphoneChargerCheckout($checkoutData);
        $checkout->setPhone($phone);
        return $checkout;
    }

    /**
     * @param bool $isGamer
     * @param bool $isTravel
     * @param bool $isCharger
     * @param bool $isTransparent
     * @param bool $isSimple
     */
    private function multiTypeCheck($isGamer, $isTravel, $isCharger, $isTransparent, $isSimple)
    {
        $counter = ((int)$isGamer) +
            ((int)$isTravel) +
            ((int)$isCharger) +
            ((int)$isTransparent) +
            ((int)$isSimple);
        if ($counter > 1) {
            throw new \InvalidArgumentException('Two or more checkout types detected');
        }
    }
}
