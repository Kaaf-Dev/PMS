<?php

namespace App\Repository;

use App\Models\UserToken;
use App\Repository\mastercardAPI\MasterCardToken;

class saveCardToken
{

    protected $payment_gateway;

    /**
     * @param $payment_gateway
     */
    public function __construct($payment_gateway = 'eslah')
    {
        $this->payment_gateway = $payment_gateway;
    }

    /**
     * @return mixed|string
     */
    public function getPaymentGateway()
    {
        return $this->payment_gateway;
    }

    /**
     * @param mixed|string $payment_gateway
     */
    public function setPaymentGateway($payment_gateway): void
    {
        $this->payment_gateway = $payment_gateway;
    }




    public function storeCreditCard($card_details)
    {
        $rules = [
            'user_id' => 'required',
            'card_name' => 'required',
            'card_number' => 'required', 'regex:/^[0-9]{16}$/',
            'card_month' => 'required', 'regex:/^[0-9]{2}$/',
            'card_year' => 'required', 'regex:/^[0-9]{2}$/',
            'card_cvv' => 'required', 'regex:/^[0-9]{3}$/',
        ];
        $validator = \Validator::make($card_details, $rules, [
            'required' => 'هذا الحقل إجباري',
        ]);

        if (!($validator->fails())) {
            $user_id = $card_details['user_id'] ?? null;
            $card_number = $card_details['card_number'];
            $card_name = $card_details['card_name'] ?? null;
            $card_month = $card_details['card_month'];
            $card_year = $card_details['card_year'];
            $card_cvv = $card_details['card_cvv'];

            $payment_gateway = $this->getPaymentGateway();

            $master_card_token = new MasterCardToken($card_number, $card_name, $card_month, $card_year, $card_cvv, $payment_gateway);
            $master_card_token->tokenize();
            if ($master_card_token->isIsTokenized()) {
                $token = $master_card_token->getCardToken();

                if ($user_id) { // update user card
                    $token = UserToken::updateOrCreate([
                        'user_id' => $user_id,
                        'token' => $token,
                        'cvv' => $card_cvv,
                    ], [
                        'user_id' => $user_id,
                        'token' => $token,
                    ]);
                    return [
                        'status' => true,
                        'msg' => '',
                        'data' => $token,

                    ];
                }
            } else {
                $errorMsg = $master_card_token->getErrorMsg();
                return [
                    'status' => false,
                    'errors' => $validator->getMessageBag()->add('card_number', $errorMsg),
                ];
            }

        } else {
            return [
                'status' => false,
                'errors' => $validator->errors(),
            ];
        }
    }
}
