<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';
    protected $fillable = [
        'user_id',
        'invoice_code',
        'status',
        'invoice_url',
        'expiry_date',
        'xendit_id',
        'total',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
