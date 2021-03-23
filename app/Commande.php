<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Commande extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'user_id',
    ];


    /**
     * Get the user for the user command.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The pizza that belong to the command.
     */
    public function pizzas()
    {
        return $this->belongsToMany(Pizza::class)
            ->select(DB::raw('sum(prix * qte) as total'), 'commande_pizza.id as commande_pizza_id', 'pizzas.id', 'description', 'prix', 'url', 'nom', 'qte')
            ->groupBy('commande_pizza_id','prix','pizza_id', 'description', 'commande_id','url', 'nom', 'qte', 'id');
    }
}
