@extends('backend.layouts.master')

@section('title') Blog Category @endsection

@section('css')

@endsection

@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Blog Category</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Backend</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Frontend</a></li>
                    <li class="breadcrumb-item active">Blog Category</li>
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
              <form action="{{ route('backend.blog.category.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
              @else
              <form action="{{ route('backend.blog.category.update', $sRow->id ) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
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
                
              
                
                <div class="tab-content p-3 text-muted row">
                    <div class="tab-pane active col-lg-12 row" id="t_th" role="tabpanel">
                      <div class="form-group">
                          <label class="control-label">Name :</label>
                          <input class="form-control" type="text" value="{{ $sRow->name_locale??'' }}" name="name_locale">
                      </div>
                    </div>
                      <div class="tab-pane col-lg-12 row" id="t_en" role="tabpanel">
                        <div class="form-group">
                          <label class="control-label">Name :</label>
                          <input class="form-control" type="text" value="{{ $sRow->name_en??'' }}" name="name">
                        </div>
                      </div>
                  </div>

                  <div class="tab-content p-3 text-muted row">
                    <div class="tab-pane active col-lg-12 row">
                      <div class="form-group">
                          <label class="control-label">Sort :</label>
                          <input class="form-control" type="number" value="{{ $sRow->sort??'' }}" name="sort">
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                      <label class="col-md-2 col-form-label">Active</label>
                      <div class="col-md-10 mt-2">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch" name="active" value="Y" {{ (isset($sRow) && $sRow->isActive=='Y')?'checked':'' }}>
                            <label class="custom-control-label" for="customSwitch">ใช้งานปกติ</label>
                        </div>
                      </div>
                  </div>
                  
                  <div class="form-group mb-0 row">
                      <div class="col-md-6">
                          <a class="btn btn-secondary btn-sm waves-effect" href="{{ route('backend.blog.category.index') }}">
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
