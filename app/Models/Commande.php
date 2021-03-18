<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

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
        return $this->belongsToMany(Pizza::class);
    }
}
