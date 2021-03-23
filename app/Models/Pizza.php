<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Pizza extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'prix',
        'url'
    ];

    /**
     * The commands that belong to the pizza.
     */
    public function commands()
    {
        return $this->belongsToMany(Commande::class);
    }
}
