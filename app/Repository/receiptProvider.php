<?php

namespace App\Repository;

use App\Events\ReceiptCreated;
use App\Models\Receipt;
use Carbon\Carbon;

class receiptProvider
{

    public $invoice_id;
    public $transaction_id;
    public $payment_method;
    public $amount;

    public function __construct($invoice_id, $transaction_id, $payment_method, $amount)
    {
        $this->setInvoiceId($invoice_id);
        $this->setTransactionId($transaction_id);
        $this->setPaymentMethod($payment_method);
        $this->setAmount($amount);
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getInvoiceId()
    {
        return $this->invoice_id;
    }

    /**
     * @param mixed $invoice_id
     */
    public function setInvoiceId($invoice_id): void
    {
        $this->invoice_id = $invoice_id;
    }

    /**
     * @return mixed
     */
    public function getTransactionId()
    {
        return $this->transaction_id;
    }

    /**
     * @param mixed $transaction_id
     */
    public function setTransactionId($transaction_id): void
    {
        $this->transaction_id = $transaction_id;
    }

    /**
     * @return mixed
     */
    public function getPaymentMethod()
    {
        return $this->payment_method;
    }

    /**
     * @param mixed $payment_method
     */
    public function setPaymentMethod($payment_method): void
    {
        $this->payment_method = $payment_method;
    }


    public function createReceipt()
    {
        $receipt = new Receipt();
        $receipt->invoice_id = $this->getInvoiceId();
        $receipt->amount = $this->getAmount();
        $receipt->date = Carbon::now();
        $receipt->transaction_id = $this->getTransactionId();
        $receipt->payment_method = $this->getPaymentMethod();
        if ($receipt->save()) {
            event(new ReceiptCreated($receipt));
            return [
                'status' => true,
                'receipt' => $receipt
            ];
        } else {
            return [
                'status' => false,
                'receipt' => []
            ];
        }


    }
}
