<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MEventsOrdersStatus extends Model
{
    protected $table = 'm_events_orders_status';

    protected $fillable = [
        'events_orders_status_name',
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
        return url('/admin/m-events-orders-statuses/'.$this->getKey());
    }
}
