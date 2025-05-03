<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmtpAccount extends Model
{
    protected $fillable = [
        'name', 'driver', 'host', 'port', 'encryption', 'username', 'password'
    ];
    public function user()
{
    return $this->belongsTo(\App\Models\User::class);
}

}
