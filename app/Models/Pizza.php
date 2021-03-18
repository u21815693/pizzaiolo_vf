<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'deleted_at',
        
    ];


    /**
     * The commands that belong to the pizza.
     */
    public function commands()
    {
        return $this->belongsToMany(Commande::class);
    }
}
