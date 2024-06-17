<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TechnologyTag;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class customermodel extends Authenticatable implements AuthenticatableContract
{
    use HasFactory ,Notifiable;
    protected $table = 'customers';

    protected $guarded = [];

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'phone', 'referrer', 'technology','roll_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


    public function technologytags()
    {
        return $this->belongsToMany(TechnologyTag::class , 'customer_technology_tag','customer_id', 'technology_tag_id');
    }

}
