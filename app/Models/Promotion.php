<?php

namespace App\Models;

use App\Models\InitModel;

class Promotion extends InitModel
{
  protected $table = 'ck_frontend_promotion';
  
  public function locale()
  {
    return $this->belongsTo('App\Models\Locale','locale_id','locale');
  }

  public function getImageAttribute()
  {
    return empty($this->img)?null:$this->img . $this->ext;
  }
  
  public function getThumbAttribute()
  {
    return empty($this->img)?null:$this->img . '_thumb' . $this->ext;
  }

  public function getTitleAttribute()
  {
    return $this->LanguageLocale('title');
  }

  public function getBriefAttribute()
  {
    return $this->LanguageLocale('brief');
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
