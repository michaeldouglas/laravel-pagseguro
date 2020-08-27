<?php

namespace laravel\pagseguro\Checkout\Facade;

use laravel\pagseguro\Checkout\CellphoneChargerCheckout;
use laravel\pagseguro\Checkout\CheckoutInterface;
use laravel\pagseguro\Checkout\Metadata\Gamer\GameInfo;
use laravel\pagseguro\Checkout\Metadata\Travel\TravelInfo;
use laravel\pagseguro\Checkout\SimpleCheckout;
use laravel\pagseguro\Checkout\GamerCheckout;
use laravel\pagseguro\Phone\Phone;
use laravel\pagseguro\Phone\PhoneInterface;

/**
 * Checkout Facade Object
 *
 * @category   Checkout
 * @package    Laravel\PagSeguro\Checkout
 *
 * @author     Isaque de Souza <isaquesb@gmail.com>
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
        $isSimple = !($isGamer || $isTravel || $isCharger);
        $this->multiTypeCheck($isGamer, $isTravel, $isCharger, $isSimple);
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
     * @param bool $isSimple
     */
    private function multiTypeCheck($isGamer, $isTravel, $isCharger, $isSimple)
    {
        $counter = ((int)$isGamer) +
            ((int)$isTravel) +
            ((int)$isCharger) +
            ((int)$isSimple);
        if ($counter > 1) {
            throw new \InvalidArgumentException('Two or more checkout types detected');
        }
    }
}
