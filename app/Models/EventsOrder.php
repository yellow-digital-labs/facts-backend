<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventsOrder extends Model
{
    protected $fillable = [
    
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/events-orders/'.$this->getKey());
    }
}
