<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    /**
         * The films that belong to the category.
         */
        public function films()
        {
            return $this->belongsToMany('App\Films','category_film');
        }
}
