<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Receipt extends Model
{
    use HasFactory;
    use SoftDeletes;

    const PAYMENT_METHOD_CASH = 'cash';
    const PAYMENT_METHOD_VISA = 'visa';
    const PAYMENT_METHOD_CHEQUE = 'cheque';
    const PAYMENT_METHOD_BANK = 'bank';
    const PAYMENT_METHOD_BENEFIT = 'benefit';
    const PAYMENT_METHOD_FREE = 'free';

    protected $fillable = [
        'invoice_id',
        'transaction_id',
        'no',
        'amount',
        'date',
        'notes',
        'payment_method',
        'bank_name',
        'cheque_number',
    ];

    protected $dates = [
        'date',
    ];

    public function Invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public static function getPaymentMethodList()
    {
        return [
            SELF::PAYMENT_METHOD_CASH => 'نقدي',
            SELF::PAYMENT_METHOD_VISA => 'فيزا',
            SELF::PAYMENT_METHOD_CHEQUE => 'شيك',
            SELF::PAYMENT_METHOD_BANK => 'تحويل بنكي',
            SELF::PAYMENT_METHOD_BENEFIT => 'بينيفت',
            SELF::PAYMENT_METHOD_FREE => 'فترة مجانية',
        ];
    }


    public static function getPaymentMethodValues()
    {
        return [
            SELF::PAYMENT_METHOD_CASH,
            SELF::PAYMENT_METHOD_VISA,
            SELF::PAYMENT_METHOD_CHEQUE,
            SELF::PAYMENT_METHOD_BANK,
            SELF::PAYMENT_METHOD_BENEFIT,
            SELF::PAYMENT_METHOD_FREE,
        ];
    }

    public function getPaymentMethodStringAttribute()
    {
        $payment_method = $this->payment_method ?? SELF::PAYMENT_METHOD_CASH;
        $payment_method_strings = $this->getPaymentMethodList();
        return $payment_method_strings[$payment_method];
    }

}
