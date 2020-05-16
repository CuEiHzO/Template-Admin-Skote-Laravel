<?php

namespace App\Models\Backend;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
  protected $table = 'backend_menu';
  public $timestamps = false;

  public function setMenu($path)
  {

    $setMenu = array();
    $txtMenu = '';
    $pid = array();
    $row = \Cache::remember('Menu-'.\Auth::user()->id, 3600, function() {
      $Menu = Menu::where('active', '<>', 'N')->orderBy('sort', 'asc');
      return $Menu->get();
    });
    if( $row ){
      foreach( $row AS $r ){
        if( !isset($setMenu[$r->ref][$r->id]) )
        {
          $active = '';
          if( substr_count($r->url, '/') == 0 ){
            $active = $r->url==$path?'Y':'N';
          }else{
            $active = substr_count($path, (empty($r->url)?'1':$r->url)) > 0?'Y':'N';
          }
          $setMenu[$r->ref][$r->menu_sort] = (object) [];
          $setMenu[$r->ref][$r->menu_sort]->id    = $r->id;
          $setMenu[$r->ref][$r->menu_sort]->name  = $r->name;
          $setMenu[$r->ref][$r->menu_sort]->link  = $r->url;
          $setMenu[$r->ref][$r->menu_sort]->icon  = $r->icon;
          $setMenu[$r->ref][$r->menu_sort]->active  = $active;
        }
      }
    }

    if( $setMenu[0] ){
      /**
       *---------------------------------------------------------------------------------------------------------------------------------------------------------
       */
      foreach( $setMenu[0] AS $key => $mMenu ){
        $subMenu  = '';
        $subActive  = '';
        if( empty($setMenu[$mMenu->id]) ){
          $txtMenu .= '
                    <li'.(($mMenu->active=="Y")?' class="active"':'').'>
                        <a href="'.asset($mMenu->link).'/">
                            <i class="material-icons">'.$mMenu->icon.'</i>
                            <span class="nav-label">'.$mMenu->name.'</span>
                        </a>
                    </li>';
        }else{
          /**
           *---------------------------------------------------------------------------------------------------------------------------------------------------------
           */
          foreach( $setMenu[$mMenu->id] AS $sMenu ){
            if( empty($setMenu[$sMenu->id]) ){
              $subMenu .= '
                <li'.(($sMenu->active=="Y")?' class="active"':'').'><a href="'.asset($sMenu->link).'/">'.$sMenu->name.'</a></li>';
              if( $sMenu->active=="Y" ) $subActive = ' active';
            }else{
              /**
               *---------------------------------------------------------------------------------------------------------------------------------------------------------
               */
              $subMenu2   = '';
              $subActive2 = '';
              foreach( $setMenu[$sMenu->id] AS $sMenu2 ){
                if( empty($setMenu[$sMenu2->id]) ){
                  $subMenu2 .= '
                    <li'.(($sMenu2->active=="Y")?' class="active"':'').'><a href="'.asset($sMenu2->link).'/">'.$sMenu2->name.'</a></li>';
                  if( $sMenu2->active=="Y" ){
                    $subActive = ' active';
                    $subActive2 = ' active';
                  }
                }else{
                  /**
                   *---------------------------------------------------------------------------------------------------------------------------------------------------------
                   */
                  $subMenu3   = '';
                  $subActive3 = '';
                  foreach( $setMenu[$sMenu2->id] AS $sMenu3 ){
                    $subMenu3 .= '
                      <li'.(($sMenu3->active=="Y")?' class="active"':'').'><a href="'.asset($sMenu3->link).'/">'.$sMenu3->name.'</a></li>';
                    if( $sMenu3->active=="Y" ){
                      $subActive = ' active';
                      $subActive2 = ' active';
                      $subActive3 = ' active';
                    }
                  }

                  $subMenu2 .= '
                  <li class="has-sub'.$subActive3.'">
                    <a href="javascript:;">
                      <b class="caret pull-right"></b>
                      <span>'.$sMenu2->name.'</span>
                    </a>
                    <ul class="sub-menu">'.$subMenu3.'
                    </ul>
                  </li>
                  ';
                }
              }

              $subMenu .= '
              <li class="has-sub'.$subActive2.'">
                <a href="javascript:;">
                  <b class="caret pull-right"></b>
                  <span>'.$sMenu->name.'</span>
                </a>
                <ul class="sub-menu">'.$subMenu2.'
                </ul>
              </li>
              ';
            }
          }


          $txtMenu .= '
          <li class="'.$subActive.'">
            <a href="javascript:;" class="menu-toggle">
                            <i class="material-icons">'.$mMenu->icon.'</i>
                <span class="nav-label">'.$mMenu->name.'</span>
            </a>
            <ul class="sub-menu">'.$subMenu.'
            </ul>
          </li>
          ';
        }
      }
    }

    return $txtMenu;
  }
}
