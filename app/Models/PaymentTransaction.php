<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rules\In;

class PaymentTransaction extends Model
{
    use HasFactory;
    use SoftDeletes;

    const TRANSACTION_STATUS_NEW = 1;
    const TRANSACTION_STATUS_DOWN = 2;
    const TRANSACTION_STATUS_CLOSE = 3;
    const TRANSACTION_STATUS_FAILED = 4;

    protected $table = 'payment_transactions';

    protected $fillable = [
        'trx_id',
        'invoice_id',
        'payment_gateway',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->trx_id) {
                $model->trx_id = $model->getTrxId();
            }
        });
    }

    public function transactions()
    {
        return $this->hasMany(TransactionsDirectPay::class, 'transaction_id', 'id');
    }

    public function Invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function getTrxId()
    {
        $trxs_max_id = (PaymentTransaction::withTrashed()->max('id') ?? 0) + 1;
        $trxs_id = str_pad($trxs_max_id, 7, '0', STR_PAD_LEFT);
        $trxs_id = 'PMS_TRX_' . $trxs_id;
        return $trxs_id;
    }

    public function down()
    {
        $this->status = self::TRANSACTION_STATUS_DOWN;
        return ($this->save());
    }

    public function close()
    {
        $this->status = self::TRANSACTION_STATUS_CLOSE;
        return ($this->save());
    }

    public function failed()
    {
        $this->status = self::TRANSACTION_STATUS_FAILED;
        return ($this->save());
    }
}
