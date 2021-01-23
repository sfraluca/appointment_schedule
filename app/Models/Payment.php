<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = ['customer_id', 'product', 'stripe_charge_id', 'paid_out', 'fees_collected', 'refunded'];

    protected $casts = ['refunded' => 'boolean'];

    public function customer()
    {
        return $this->hasOne(Employee::class, 'customer_id');
    }

}
