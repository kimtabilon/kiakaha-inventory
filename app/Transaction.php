<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'da_number', 'special_discount', 'remarks' ];
    protected $appends  = ['created', 'modified'];

    public function inventories()
    {
        return $this->belongsToMany('App\Inventory')->withTimestamps();
    }
    public function paymentType()
    {
        return $this->belongsTo('App\PaymentType');
    }

    public function getCreatedAttribute()
    {
        // return \Carbon\Carbon::parse($this->created_at)->diffForHumans();
        return \Carbon\Carbon::parse($this->created_at)->toDayDateTimeString();
    }

    public function getModifiedAttribute()
    {
        // return \Carbon\Carbon::parse($this->updated_at)->diffForHumans();
        return \Carbon\Carbon::parse($this->updated_at)->toDayDateTimeString();
    }
}
