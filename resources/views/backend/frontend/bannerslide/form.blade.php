@extends('backend.layouts.master')

@section('title') Banner Slide (ข้อมูลแบนเนอร์) @endsection

@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Banner Slide (ข้อมูลแบนเนอร์)</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Backend</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Frontend</a></li>
                    <li class="breadcrumb-item active">Banner Slide (ข้อมูลแบนเนอร์)</li>
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
              <form action="{{ route('backend.frontend.banner.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
              @else
              <form action="{{ route('backend.frontend.banner.update', $sRow->id ) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PUT">
              @endif
                {{ csrf_field() }}

                @if(empty(\Auth::user()->locale_id))
                  <div class="form-group row">
                      <label for="example-email-input" class="col-md-2 col-form-label">Language</label>
                      <div class="col-md-10">
                        <select class="form-control" name="locale_id">
                          @if($sLocale->count())
                            @foreach($sLocale ?? '' AS $r)
                            <option value="{{$r->locale}}" {{ (@$sRow->locale_id==$r->locale)?'selected':'' }}>{{$r->name}}</option>
                            @endforeach
                          @endif
                        </select>
                      </div>
                  </div>
                @endif
                
                <div class="form-group row">
                    <label for="example-text-input" class="col-md-2 col-form-label">Sort</label>
                    <div class="col-md-10">
                        <input class="form-control" type="number" value="{{ $sRow->sort??'' }}" name="sort">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-text-input" class="col-md-2 col-form-label">Link</label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" value="{{ $sRow->url??'' }}" name="url">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-md-2 col-form-label">ALt</label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" value="{{ $sRow->alt??'' }}" name="alt">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-text-input" class="col-md-2 col-form-label">Date Range</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control datetimes" name="daterange" value="{{ isset($sRow)?$sRow->dateFormat('date_start').' - '.$sRow->dateFormat('date_end'):'' }}"  readonly/>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="example-text-input" class="col-md-2 col-form-label">Image <br>*Size (w1600 x h450)</label>
                    <div class="col-md-10">
                        <input class="form-control" type="file" value="{{ $sRow->image??'' }}" name="image">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-text-input" class="col-md-2 col-form-label">Image Mobile<br>*Size (w768 x h768)</label>
                    <div class="col-md-10">
                        <input class="form-control" type="file" value="{{ $sRow->image_mobile??'' }}" name="image_mobile">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Active</label>
                    <div class="col-md-10 mt-2">
                      <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" id="customSwitch" name="isActive" value="Y" {{ (isset($sRow) && $sRow->isActive=='Y')?'checked':'' }}>
                          <label class="custom-control-label" for="customSwitch">ใช้งานปกติ</label>
                      </div>
                    </div>
                </div>

                <div class="form-group mb-0 row">
                    <div class="col-md-6">
                        <a class="btn btn-secondary btn-sm waves-effect" href="{{ route('backend.frontend.banner.index') }}">
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

@section('css')
<link rel="stylesheet" type="text/css" href="{!!asset('backend/libs/daterangepicker/daterangepicker.css')!!}" />
@endsection

@section('script')
<script type="text/javascript" src="{!!asset('backend/libs/daterangepicker/moment.min.js')!!}"></script>
<script type="text/javascript" src="{!!asset('backend/libs/daterangepicker/daterangepicker.js')!!}"></script>
<script>
$(function() {
    $(document).ready(function() {
      $('.datetimes').daterangepicker({
        timePicker: true,
        @if(empty($sRow))
        startDate: moment().startOf('hour'),
        endDate: moment().startOf('hour').add(32, 'hour'),
        @endif
        timePicker24Hour:true,
        locale: {
          format: 'DD/MM/YYYY hh:mm:ss'
        }
      });

      $('select[name="type"]').on('change', function(){
          if($(this).val()=='B'){
              $('.limit').css('visibility', 'hidden');
          }else{
              $('.limit').css('visibility', 'visible');
          }
      });

      if($('select[name="type"]').val()=='B'){
        $('.limit').css('visibility', 'hidden');
      }
   });
});
</script>
@endsection