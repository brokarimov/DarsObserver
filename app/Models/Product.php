<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name'];

    public function agentProducts()
    {
        return $this->belongsToMany(Agent::class, 'agent_products', 'product_id', 'agent_id')->withPivot('price');
    }
}
