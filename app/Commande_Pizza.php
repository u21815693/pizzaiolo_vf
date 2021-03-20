<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commande_Pizza extends Model
{
    protected $table = 'commande_pizza';
    protected $fillable = [
        'commande_id',
        'pizza_id',
        'qte',
    ];
}
