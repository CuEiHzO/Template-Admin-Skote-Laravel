@extends('backend.layouts.master')

@section('title') Blog @endsection

@section('css')

@endsection

@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Blog</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Backend</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Frontend</a></li>
                    <li class="breadcrumb-item active">Blog</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
              @if( empty($sRow) )

              <form action="{{ route('backend.blog.content.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
              @else
              <form action="{{ route('backend.blog.content.update',$sRow->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PUT">
              @endif
                {{ csrf_field() }}

                <div class="mt-4 mt-lg-0">
                  <h5 class="font-size-14 mb-4">Category</h5>
                  @foreach ($category as $k_category => $v_category)
                    <div class="custom-control custom-radio mb-3">
                        <input type="radio" id="customRadio{{$k_category+1}}" name="category_id" class="custom-control-input" value="{{$v_category->id}}" {{ (isset($sRow) && $sRow->category_id==$v_category->id)?'checked':'' }}>
                        <label class="custom-control-label" for="customRadio{{$k_category+1}}">{{$v_category->name_en}}</label>
                    </div>
                  @endforeach
                </div>


                <div class="form-group mt-2">
                    <label class="control-label">Image <sub>Size (570px * 333px | jpeg,png,jpg,gif,svg | ขนาดไม่เกิน 2048kb)</sub> :</label>
                    <input class="form-control" type="file" name="files" accept="image/*" {{ isset($sRow) && !empty($sRow->thumb)?'':'required' }}  />
                    @if(isset($sRow) && !empty($sRow->thumb))
                    <img src="{{ asset('asset/images/content/'.$sRow->thumb) }} " />
                    @else
                    <img src="{{ asset('backend/images/backend/570x333.png') }} " />
                    @endif
                </div>


                <div class="form-group row">
                    <label class="col-md-2 col-form-label">IsLink</label>
                    <div class="col-md-10">
                      <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" id="isLink" name="isLink" value="Y" {{ (isset($sRow) && $sRow->isLink=='Y')?'checked':'' }}>
                          <label class="custom-control-label" for="isLink" id="isLink2">URL</label>
                      </div>
                    </div>
                </div>

                <div class="form-group row isSlug">
                    <label class="col-md-2 col-form-label">URL :</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="slug" value="{{ isset($sRow)?$sRow->slug:'' }}"/>
                    </div>
                </div>

                  <div class="form-group row">
                      <label class="col-md-2 col-form-label">Active</label>
                      <div class="col-md-10">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="isActive" name="isActive" value="Y" {{ (isset($sRow) && $sRow->isActive=='Y')?'checked':'' }}>
                            <label class="custom-control-label" for="isActive">ใช้งานปกติ</label>
                        </div>
                      </div>
                  </div>



                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#t_th" role="tab">
                      <span class="d-none d-sm-block">Th</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#t_en" role="tab">
                      {{-- <span class="d-block d-sm-none"><i class="fas fa-home"></i></span> --}}
                      <span class="d-none d-sm-block">En</span>
                    </a>
                  </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content p-3 text-muted row">
                  <div class="tab-pane active col-lg-12 row" id="t_th" role="tabpanel">

                    <div class="form-group mt-2">
                        <label class="control-label">Title :</label>
                        <input type="text" class="form-control" name="title_locale" value="{{ isset($sRow)?$sRow->title_locale:'' }}" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Brief :</label>
                        <textarea name="brief_locale" class="form-control">{{ $sRow->brief_locale??'' }}</textarea>
                    </div>
                    <div class="form-group isEditer">
                        <label class="control-label">Body :</label>
                        <textarea name="body_locale" class="form-control">{{ $sRow->body_locale??'' }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Meta Keywords :</label>
                        <input type="text" class="form-control" name="meta_keywords_locale" value="{{ isset($sRow)?$sRow->meta_keywords_locale:'' }}"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Meta Description :</label>
                        <input type="text" class="form-control" name="meta_description_locale" value="{{ isset($sRow)?$sRow->meta_description_locale:'' }}"/>
                    </div>

                  </div>
                  <div class="tab-pane col-lg-12 row" id="t_en" role="tabpanel">

                    <div class="form-group mt-2">
                        <label class="control-label">Title :</label>
                        <input type="text" class="form-control" name="title_en" value="{{ isset($sRow)?$sRow->title_en:'' }}" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Brief :</label>
                        <textarea name="brief_en" class="form-control">{{ $sRow->brief_en??'' }}</textarea>
                    </div>
                    <div class="form-group isEditer">
                        <label class="control-label">Body :</label>
                        <textarea name="body_en" class="form-control">{{ $sRow->body_en??'' }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Meta Keywords :</label>
                        <input type="text" class="form-control" name="meta_keywords_en" value="{{ isset($sRow)?$sRow->meta_keywords_en:'' }}"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Meta Description :</label>
                        <input type="text" class="form-control" name="meta_description_en" value="{{ isset($sRow)?$sRow->meta_description_en:'' }}"/>
                    </div>

                  </div>
                </div>


                <div class="form-group mb-0 row">
                    <div class="col-md-6">
                        <a class="btn btn-secondary btn-sm waves-effect" href="{{ route('backend.blog.content.index') }}">
                          <i class="bx bx-arrow-back font-size-16 align-middle mr-1"></i> ย้อนกลับ
                        </a>
                    </div>
                    <div class="col-md-6 text-right">
                        <button type="submit" class="btn btn-primary btn-sm waves-effect">
                          <i class="bx bx-save font-size-16 align-middle mr-1"></i> บันทึกข้อมูล
                        </button>
                    </div>
                </div>

              </form>
            </div>
        </div>
    </div> <!-- end col -->
</div>
<!-- end row -->

@endsection

@section('script')
<script>
  $(function() {
      $(document).ready(function() {
        CKEDITOR.replace( 'body_locale', {allowedContent: true} );
        CKEDITOR.replace( 'body_en', {allowedContent: true} );
        CKEDITOR.replace( 'brief_locale', {allowedContent: true} );
        CKEDITOR.replace( 'brief_en', {allowedContent: true});

        $('input[name="isLink"]').on('change', function(){
            if($(this).is(':checked')){
                $('.isSlug').show();
                $('.isEditer').hide();
            }else{
                $('.isSlug').hide();
                $('.isEditer').show();
            }
        });

        if($('input[name="isLink"]').is(':checked')){
            $('.isSlug').show();
            $('.isEditer').hide();
        }else{
            $('.isSlug').hide();
            $('.isEditer').show();
        }
     });
  });
</script>
@endsection
