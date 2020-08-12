<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected  $fillable = ['country','state','city','address_line_one','address_line_two','postal_code','client_id'];

    public function client(){
        return $this->belongsTo(Client::class);
    }
}
