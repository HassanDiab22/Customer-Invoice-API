<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'type',
        'email',
        'address',
        'city',
        'state',
        'postal_code',
    ];

    // create one to many relation with invoice 
    public function invoices() {
        return $this->hasMany(Invoice::class);
    } 
}
