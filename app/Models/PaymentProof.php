<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentProof extends Model
{
    protected $fillable = ['order_id', 'user_id', 'file_path', 'status', 'verified_by', 'verified_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
