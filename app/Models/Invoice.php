<?php

namespace App\Models;

use App\Helper\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';
    protected $fillable = [
        'user_id',
        'bill_id',
        'invoice_code',
        'status',
        'invoice_url',
        'expiry_date',
        'xendit_id',
        'total',
    ];

    public const ORDERCODE = 'SPP';

    public static function generateCode()
    {
        $dateCode = self::ORDERCODE . '/' . date('Y') . '/' . Helper::integerToRoman(date('m')) . '/' . Helper::integerToRoman(date('d')) . '/';

        $isNotUnique = true;
        $random;

        while ($isNotUnique) {
            $random = rand(100000, 999999);
            $ticket = Invoice::where('invoice_code', '=', $random)->first();
            if (empty($ticket)) {
                $isNotUnique = false;
            }
        }

        return $dateCode . $random;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bill()
    {
        return $this->belongsTo(Bill::class, 'bill_id');
    }
}
