<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentProduct extends Model
{
    protected $fillable = ['agent_id', 'product_id', 'price'];

    public function agents()
    {
        return $this->belongsTo(Agent::class);
    }

    public function products()
    {
        return $this->belongsTo(Product::class);
    }


}
