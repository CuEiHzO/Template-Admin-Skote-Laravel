@extends('backend.layouts.master')

@section('title') Add/Edit Category @endsection

@section('css')
@endsection

@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Category {{ empty($sCat)?'':' ('.$sCat->name.')' }}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">Product</li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Category</a></li>
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
				<form action="{{ route('backend.product.category.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
			@else
				<form action="{{ route('backend.product.category.update', $sRow->id ) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
				<input name="_method" type="hidden" value="PUT">
			@endif
				{{ csrf_field() }}

          <div class="col-lg-12">
              <div class="form-group">
                  <label class="control-label">Category name :</label>
                  <input type="text" class="form-control" name="name" value="{{ isset($sRow)?$sRow->name:'' }}" required/>
              </div>

              <div class="form-group">
                  <label class="control-label">Url name <span style="font-size: 10px;color: blue;">Alphanumeric only</span> :</label>
                  <input type="text" class="form-control" name="slug" value="{{ isset($sRow)?$sRow->slug:'' }}" required />
              </div>

              @if( request('category_id')==null )
              <div class="row form-group">
                  <label class="col-md-2 col-form-label">Concerns</label>
                  <div class="col-md-10 mt-2">
                     <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" id="showConcerns" name="isConcerns" value="Y" {{ (isset($sRow) && $sRow->isConcerns=='Y')?'checked':'' }}>
                          <label class="custom-control-label" for="showConcerns">SHOP BY Concerns</label>
                      </div>
                  </div>
              </div>

              <div class="row form-group">
                  <label class="col-md-2 col-form-label">Scents</label>
                  <div class="col-md-10 mt-2">
                     <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" id="showScents" name="isScents" value="Y" {{ (isset($sRow) && $sRow->isScents=='Y')?'checked':'' }}>
                          <label class="custom-control-label" for="showScents">SHOP BY Scents</label>
                      </div>
                  </div>
              </div>

              <div class="row form-group">
                  <label class="col-md-2 col-form-label">Show</label>
                  <div class="col-md-10 mt-2">
                     <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" id="showSwitch" name="isShow" value="Y" {{ (isset($sRow) && $sRow->isShow=='Y')?'checked':'' }}>
                          <label class="custom-control-label" for="showSwitch">Show</label>
                      </div>
                  </div>
              </div>
              <input name="ref" type="hidden" value="0">
              @else
              <input name="ref" type="hidden" value="{{ request('category_id') }}">
              @endif

              <div class="row form-group">
                  <label class="col-md-2 col-form-label">Active</label>
                  <div class="col-md-10 mt-2">
                     <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" id="activeSwitch" name="isActive" value="Y" {{ (isset($sRow) && $sRow->isActive=='Y')?'checked':'' }}>
                          <label class="custom-control-label" for="activeSwitch">Active</label>
                      </div>
                  </div>
              </div>

              @if( request('category_id')==null )
              <div class="form-group">
                  <label class="control-label">Image <span style="font-size: 10px;color: blue;">Size (500px * 500px | jpeg,png,jpg,gif,svg | ขนาดไม่เกิน 2048kb)</span> :</label>
                  <input class="form-control" type="file" name="files" accept="image/*" {{ isset($sRow) && !empty($sRow->thumb)?'':'required' }}  />
                  @if(isset($sRow) && !empty($sRow->thumb))
                    <img src="{{ asset('asset/images/category/'.$sRow->thumb) }} " />
                  @else
                    <img src="{{ asset('backend/images/backend/500x500.png') }} " />
                  @endif
              </div>
              @endif


          </div>


					<div class="form-group mb-0 row">
						<div class="col-md-6">
							<a class="btn btn-secondary btn-sm waves-effect" href="{{ route('backend.product.category.index') }}">
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
	$(document).ready(function(){

	});
</script>
@endsection
