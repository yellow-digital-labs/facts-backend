<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventsOrder extends Model
{
    protected $fillable = [
        'booking_user_id',
        'event_user_id',
        'event_id',
        'no_of_booking',
        'booking_unit_amount',
        'applicable_tax_amount',
        'booking_total_amount',
        'points_used',
        'booking_payable_amount',
        'status',
    
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
