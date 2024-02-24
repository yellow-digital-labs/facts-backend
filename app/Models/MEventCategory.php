<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MEventCategory extends Model
{
    protected $fillable = [
        'event_category_name',
        'active',
    
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/m-event-categories/'.$this->getKey());
    }
}
