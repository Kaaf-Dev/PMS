<?php

namespace App\Repository\mastercardAPI;


class MasterCardToken
{
    private $card_no, $card_name, $card_month, $card_year, $card_brand, $card_cvv, $card_token, $error_msg, $is_tokenized = false;

    public function __construct($card_no, $card_name, $card_month, $card_year, $card_cvv)
    {
        $this->setCardNo($card_no);
        $this->setCardName($card_name);
        $this->setCardMonth($card_month);
        $this->setCardYear($card_year);
        $this->setCardCvv($card_cvv);
    }

    /**
     * @return mixed
     */
    public function getCardNo()
    {
        return $this->card_no;
    }

    /**
     * @param mixed $card_no
     */
    public function setCardNo($card_no): void
    {
        $this->card_no = $card_no;
    }

    /**
     * @return mixed
     */
    public function getCardName()
    {
        return $this->card_name;
    }

    /**
     * @param mixed $card_name
     */
    public function setCardName($card_name): void
    {
        $this->card_name = $card_name;
    }

    /**
     * @return mixed
     */
    public function getCardMonth()
    {
        return $this->card_month;
    }

    /**
     * @param mixed $card_month
     */
    public function setCardMonth($card_month): void
    {
        $this->card_month = $card_month;
    }

    /**
     * @return mixed
     */
    public function getCardYear()
    {
        return $this->card_year;
    }

    /**
     * @param mixed $card_year
     */
    public function setCardYear($card_year): void
    {
        $this->card_year = $card_year;
    }

    /**
     * @return mixed
     */
    public function getCardBrand()
    {
        return $this->card_brand;
    }

    /**
     * @param mixed $card_brand
     */
    public function setCardBrand($card_brand): void
    {
        $this->card_brand = $card_brand;
    }

    /**
     * @return mixed
     */
    public function getCardCvv()
    {
        return $this->card_cvv;
    }

    /**
     * @param mixed $card_cvv
     */
    public function setCardCvv($card_cvv): void
    {
        $this->card_cvv = $card_cvv;
    }

    /**
     * @return mixed
     */
    public function getCardToken()
    {
        return $this->card_token;
    }

    /**
     * @param mixed $card_token
     */
    public function setCardToken($card_token): void
    {
        $this->card_token = $card_token;
    }

    /**
     * @return mixed
     */
    public function getErrorMsg()
    {
        return $this->error_msg;
    }

    /**
     * @param mixed $error_msg
     */
    public function setErrorMsg($error_msg): void
    {
        $this->error_msg = $error_msg;
    }

    public function isIsTokenized(): bool
    {
        return $this->is_tokenized;
    }

    public function setIsTokenized(bool $is_tokenized): void
    {
        $this->is_tokenized = $is_tokenized;
    }

    public function tokenize()
    {
        $masterCardApi = new MasterCardApi();
        $token_response = $masterCardApi->tokenize([
            'card_no' => $this->getCardNo(),
            'card_name' => $this->getCardName(),
            'card_month' => $this->getCardMonth(),
            'card_year' => $this->getCardYear(),
            'card_cvv' => $this->getCardCvv(),
        ]);
        $token_response = $token_response->json();
        if (isset($token_response['result']) and $token_response['result'] === "SUCCESS" and $token_response['status'] === "VALID") {
            if ($token_response['token']) {
                $this->setCardToken($token_response['token']);
                $this->setIsTokenized(true);
            }
        } else {

            $this->setErrorMsg($token_response['error']['explanation']);
        }
        return $this;
    }
}
