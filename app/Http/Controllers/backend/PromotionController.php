<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use DB;
use Auth;
use Image;

#use model
use App\Models\Locale;
use App\Models\Alert;
use App\Models\Promotion;

class PromotionController extends Controller
{
    public function index(Request $request)
    {
        return view('backend.frontend.promotion.index');
    }

    public function create()
    {
        return view('backend.frontend.promotion.form');
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
        DB::beginTransaction();
        try {
            if ($id) {
                $sData = Promotion::findOrFail($id);
            } else {
                $sData = new Promotion;
                $sData->locale_id = Auth::user()->locale_id;
            }

            $sData->title_en = request('slug');
            $sData->title_en = request('title_en');
            $sData->title_locale = request('title_locale');
            $sData->meta_keywords_en = request('meta_keywords_en');
            $sData->meta_keywords_locale = request('meta_keywords_locale');
            $sData->meta_description_en = request('meta_description_en');
            $sData->meta_description_locale = request('meta_description_locale');
            $sData->brief_en = request('brief_en');
            $sData->brief_locale = request('brief_locale');
            $sData->body_en = request('body_en');
            $sData->body_locale = request('body_locale');
            $sData->isActive = request('isActive')?request('isActive'):'N';
            $sData->isLink = request('isLink')?request('isLink'):'N';
            if($sData->isLink=='N') {
                $sData->slug = $this->createSlug($sData->title_en);
            }
            $sData->save();

            if (request('files')) {
                @unlink('public/asset/images/promotion/' . $sRow->thumb);
                @unlink('public/asset/images/promotion/' . $sRow->image);
                $path = 'public/asset/images/promotion/';
                $sName = str_pad($sData->id, 5, '0', STR_PAD_LEFT);
                $ext = '.' . strtolower(request('files')->getClientOriginalExtension());
                //$image = \Image::make(request('files')->getRealPath());
                $image = \Image::make(request('files')->getPathName());
                $image->resize(null, 570, function ($constraint) {
                  $constraint->aspectRatio();
                });
                $image->save($path . $sName . $ext);

                $image->resize(null, 200, function ($constraint) {
                  $constraint->aspectRatio();
                });
                $image->save($path . $sName . '_thumb' . $ext);

                $image->destroy();
                $sData->img = $sName;
                $sData->ext = $ext;
                $sData->save();
            }

            DB::commit();

            return redirect()->action('Backend\PromotionController@index')->with(['alert'=>Alert::Msg('success')]);
        } catch (\Exception $e) {
            echo $e->getMessage();
            DB::rollback();
            return redirect()->action('Backend\PromotionController@index')->with(['alert'=>Alert::e($e)]);
        }
    }

    public function edit($id)
    {
        try {
            $sRow = Promotion::findOrFail($id);
            return View('backend.frontend.promotion.form')->with(array('sRow'=>$sRow));
        } catch (\Exception $e) {
            return redirect()->action('Backend\PromotionController@index')->with(['alert'=>Alert::e($e)]);
        }
    }

    public function destroy($id)
    {
        $sRow = Promotion::findOrFail($id);
        if($sRow){
            $sRow->forceDelete();
            @unlink('public/asset/images/promotion/' . $sRow->thumb);
            @unlink('public/asset/images/promotion/' . $sRow->image);
        }
        return response()->json(Alert::Msg('success'));
    }

    public function Datatable(){
        $sTable = Promotion::search()->orderBy('id', 'desc');
        $sQuery = DataTables::of($sTable);
        return $sQuery
        ->editColumn('image', function($row) {
            if($row->image){
                return '<img src="'.asset('public/asset/images/promotion').'/'.$row->image.'" width="500px" />';
            }else{
                return '-';
            }
        })
        ->editColumn('isActive', function($row) {
            return ($row->isActive=='Y'?'ใช้งาน':'ไม่ใช้งาน');
        })
        ->escapeColumns('image')
        ->make(true);
    }

    public function createSlug($title, $id = 0)
    {
        // Normalize the title
        $slug = \Str::slug($title);

        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = $this->getRelatedSlugs($slug, $id);

        // If we haven't used it before then we are all good.
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }

        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }

        throw new \Exception('Can not create a unique slug');
    }

    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Promotion::select('slug')->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
    }
}
