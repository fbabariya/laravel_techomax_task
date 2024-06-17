<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnologyTag extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
    ];

    public function customers()
    {
        return $this->belongsToMany(customermodel::class, 'customer_technology_tag','technology_tag_id', 'customer_id');
    }

}
