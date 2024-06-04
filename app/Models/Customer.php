<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

//     protected $fillable = [
//         'name',
//         'email',
//         'phone_number',
//         'address',
//         'id_number',
//     ];
// }
protected $fillable = [
    'name',
    'email',
    'phone_number',
    'address',
    'avatar',
];

protected static function boot()
{
    parent::boot();

    static::creating(function ($customer) {
        $latestCustomer = static::latest('id')->first();
        $nextId = $latestCustomer ? ((int) str_replace('ID', '', $latestCustomer->id_number)) + 1 : 1;
        $customer->id_number = 'ID' . $nextId;
    });
}
}