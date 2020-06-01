<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class InstagramController extends Controller
{
  public function index(Request $request)
  {
    // dd('Banner Slide');
    return view('backend.frontend.instagram.index');
  }

  public function create()
  {
    // dd('Banner Form');
    return view('backend.frontend.instagram.form');
  }

  public function store(Request $request)
  {
    return $this->form();
  }

  public function update(Request $request, $id)
  {
    return $this->form($id);
  }

  public function form($id=NULL)
  {
    // dd(request('image'));
    \DB::beginTransaction();
    try {

        if( $id ){
          $sData = \App\Models\Instagram::findOrFail($id);
        }else{
          $sData = new \App\Models\Instagram;
          $sData->locale_id = \Auth::user()->locale_id;
        }

        $sData->sort        = request('sort');
        $sData->url         = request('url');
        $sData->isActive    = request('isActive')?request('isActive'):'N';
        $sData->save();

        if (request('image')) {
          @unlink('asset/images/instagram/'.$sRow->thumb);
          @unlink('asset/images/instagram/'.$sRow->image);
          $path = 'asset/images/instagram/';
          $sName = str_pad($sData->id, 5, '0', STR_PAD_LEFT);
          $ext = '.' . strtolower(request('image')->getClientOriginalExtension());
          //$image = \Image::make(request('files')->getRealPath());
          $image = \Image::make(request('files')->getPathName());
          $image->resize(500, null, function ($constraint) {
            $constraint->aspectRatio();
          });
          $image->save($path . $sName . $ext);

          $image->resize(240, null, function ($constraint) {
            $constraint->aspectRatio();
          });
          $image->save($path . $sName . '_thumb' . $ext);

          $image->destroy();
          $sData->img = $sName;
          $sData->ext = $ext;
          $sData->save();
      }

      \DB::commit();

      return redirect()->action('Backend\InstagramController@index')->with(['alert'=>\App\Models\Alert::Msg('success')]);
    } catch (\Exception $e) {
      echo $e->getMessage();
      \DB::rollback();
      return redirect()->action('Backend\InstagramController@index')->with(['alert'=>\App\Models\Alert::e($e)]);
    }
  }


  public function edit($id)
  {
    try {
      $sRow = \App\Models\Instagram::findOrFail($id);
      return View('backend.frontend.instagram.form')->with(array('sRow'=>$sRow) );
    } catch (\Exception $e) {
      return redirect()->action('Backend\InstagramController@index')->with(['alert'=>\App\Models\Alert::e($e)]);
    }
  }


  public function destroy($id)
  {
    $sRow = \App\Models\Instagram::where('id',$id)->firstOrFail();
    if( $sRow ){
      @unlink('asset/images/instagram/'.$sRow->thumb);
      @unlink('asset/images/instagram/'.$sRow->image);
      $sRow->forceDelete();
    }
    return response()->json(\App\Models\Alert::Msg('success'));
  }

  public function Datatable(){
      $sTable = \App\Models\Instagram::search()->orderBy('sort', 'asc');
      $sQuery = \DataTables::of($sTable);
      return $sQuery
      ->editColumn('image', function($row) {
          if($row->image != null){
              return '<img src="'.asset('asset/images/instagram').'/'.$row->image.'" width="150px" />';
          }else{
              return '-';
          }
      })
      ->escapeColumns('image')
      ->make(true);
  }
}
