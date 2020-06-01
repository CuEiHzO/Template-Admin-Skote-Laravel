<?php

namespace App\Models;

use App\Models\InitModel;

class Instagram extends InitModel
{
    protected $table = 'ck_frontend_instagram';
    public function locale()
    {
      return $this->belongsTo('App\Models\Locale','locale_id','locale');
    }



    public function getImageAttribute()
    {
      return (!empty($this->img) ? $this->img.$this->ext : null );
    }
    public function getThumbAttribute()
    {
      return (!empty($this->img) ? $this->img.'_thumb'.$this->ext : null );
    }
  
  
    public function getTitleAttribute()
    {
      return $this->LanguageLocale('title');
    }
  
    public function getMetaKeywordsAttribute()
    {
      return $this->LanguageLocale('meta_keywords');
    }
  
    public function getMetaDescriptionAttribute()
    {
      return $this->LanguageLocale('meta_description');
    }
  
    public function getBodyAttribute()
    {
      return $this->LanguageLocale('body');
    }


}
