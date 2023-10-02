<?php

namespace App\Repository\mastercardAPI;

use Illuminate\Support\Facades\Http;

class MasterCardApi
{
    private $api_username, $api_password;

    public function __construct()
    {
        $this->setApiPassword(env('PAYMENT_GATEWAY_MASTERCARD_API_PASSWORD', 'secure'));
        $this->setApiUsername(env('PAYMENT_GATEWAY_MASTERCARD_API_USERNAME', 'username'));
    }

    /**
     * @return mixed
     */
    public function getApiUsername()
    {
        return $this->api_username;
    }

    /**
     * @param mixed $api_username
     */
    public function setApiUsername($api_username): void
    {
        $this->api_username = $api_username;
    }

    /**
     * @return mixed
     */
    public function getApiPassword()
    {
        return $this->api_password;
    }
    /**
     * @param mixed $api_password
     */
    public function setApiPassword($api_password): void
    {
        $this->api_password = $api_password;
    }

    public function executeApi($end_point, $method, $payload, $headers = [])
    {
        $response = Http::withBasicAuth($this->getApiUsername(), $this->getApiPassword())
            ->accept('application/json')
            ->withOptions(['verify' => !(env('APP_ENV', 'local') == 'local')])
            ->$method($end_point, $payload);
        return $response;
    }

    public function tokenize(array $card)
    {
        $end_point = env('PAYMENT_GATEWAY_MASTERCARD_API_BASE_END_POINT', 'localhost') . '/token';
        $method = 'POST';
        $payload = [
            'transaction' => [
                'currency' => 'BHD',
            ],
            'sourceOfFunds' => [
                'type' => 'CARD',
                'provided' => [
                    'card' => [
                        'expiry' => [
                            'month' => $card['card_month'],
                            'year' => $card['card_year'],
                        ],
                        'nameOnCard' => $card['card_name'],
                        'number' => $card['card_no'],
                        'securityCode' => $card['card_cvv'],
                    ],
                ],
            ]
        ];
        return $this->executeApi($end_point, $method, $payload);
    }

    public function transactionPay(array $card, array $order)
    {
        $end_point = env('PAYMENT_GATEWAY_MASTERCARD_API_BASE_END_POINT', 'localhost')
            . '/order/' . $order['transaction_id']
            . '/transaction/' . $order['transaction_id'];
        $method = 'PUT';
        $payload = [
            'apiOperation' => "PAY",
            'order' => [
                'amount' => $order['transaction_amount'],
                'currency' => 'BHD',
            ],
            'sourceOfFunds' => [
                'token' => $card['card_token'],
                'provided' => [
                    'card' => [
                        'securityCode' => $card['card_cvv'],
                    ],
                ],
            ]
        ];
        return $this->executeApi($end_point, $method, $payload);
    }

}
