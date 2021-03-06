<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'address', 'phone', 'tel', 'company', 'job_title', 'catch_phrase',
    ];

    public function donor() {               return $this->belongsTo('App\Donor'); } 
    public function profilePhotos() {       return $this->hasMany('App\ProfilePhoto'); } 
    public function secondaryContacts() {   return $this->hasMany('App\SecondaryContact'); } 
}
