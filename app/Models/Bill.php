<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $table = 'bills';
    protected $fillable = [
        'month',
        'year',
        'total',
        'description',
        'grade_id',
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
}
