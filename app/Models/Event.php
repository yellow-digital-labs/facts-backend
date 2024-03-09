<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'user_id',
        'event_categories_id',
        'event_name',
        'event_start_datetime',
        'event_end_datetime',
        'event_description',
        'event_primary_image',
        'event_location',
        'event_contact',
        'event_available_tickets',
        'event_ticket_amount',
        'event_ticket_discount_amount',
        'active',
    
    ];
    
    
    protected $dates = [
        'event_start_datetime',
        'event_end_datetime',
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/events/'.$this->getKey());
    }

    public function MEventCategorys () :BelongsTo {
        return $this->BelongsTo(MEventCategory::class);
    }
}
