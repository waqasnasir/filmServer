<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    //

    /**
         * The categories that belong to the film.
         */
        public function categories()
        {
            return $this->belongsToMany('App\Category')->withPivot('film_id', 'category')->withTimestamps();;
        }
        public function comments()
        {
             return $this->hasMany('App\Comment');
        }

         public function country()
          {
             return $this->belongsTo('App\Country');
          }

          protected $fillable = ['country_id'];

}
