<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MFoodsCategory extends Model
{
    protected $fillable = [
        'food_category_name',
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
        return url('/admin/m-foods-categories/'.$this->getKey());
    }
}
