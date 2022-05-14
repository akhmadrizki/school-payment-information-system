<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    use HasFactory;

    protected $table = 'scholarships';
    protected $fillable = [
        'name',
    ];

    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }
}
