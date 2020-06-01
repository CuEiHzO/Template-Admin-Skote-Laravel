@extends('backend.layouts.master')
@section('title') Add/Edit Product @endsection
@section('css')

@endsection
@section('content')
<!-- start page title -->
<div class="row">
	<div class="col-12">
		<div class="page-title-box d-flex align-items-center justify-content-between">
			<h4 class="mb-0 font-size-18">Product</h4>
			<div class="page-title-right">
				<ol class="breadcrumb m-0">
					<li class="breadcrumb-item">Product</li>
					<li class="breadcrumb-item">
						<a href="javascript: void(0);">Product</a>
					</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<!-- end page title -->
@if( empty($sRow) )
	<form action="{{ route('backend.product.product.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
@else
	<form action="{{ route('backend.product.product.update', $sRow->id ) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
		<input name="_method" type="hidden" value="PUT">
@endif
		{{ csrf_field() }}
		<div class="row">
			<div class="col-lg-6">
				<div class="card" style="min-height: 200px;">
					<div class="card-body" style="padding-bottom: 5px;">
						<div class="form-group">
							<label class="control-label">Product name :</label>
							<input type="text" class="form-control" name="name" value="{{ isset($sRow)?$sRow->name:'' }}" required/>
						</div>
						<div class="form-group">
							<label class="control-label">Sub name :</label>
							<input type="text" class="form-control" name="subname" value="{{ isset($sRow)?$sRow->subname:'' }}" required/>
						</div>
						<div class="form-group">
							<label class="control-label">Collection :</label>
							<select class="form-control" name="collection_id">
								@if($sCollection)
								@foreach($sCollection AS $r)
								<option value="{{$r->collection_id}}"  {{ (isset($sRow) && $sRow->collection_id==$r->collection_id)?'selected':'' }}>{{$r->name}}</option>
								@endforeach
								@endif
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="card" style="min-height: 255px;">
					<div class="card-body" style="padding-bottom: 5px;">
						<h4 class="card-title">Categories</h4>
						<div class="form-group">
							<select class="form-control" name="category_id">
								@if($sCategory)
								@foreach($sCategory AS $r)
								<option value="{{$r->category_id}}"  {{ (isset($sRow) && $sRow->category_id==$r->category_id)?'selected':'' }}>{{$r->name}}</option>
								@endforeach
								@endif
							</select>
						</div>
						<div class="row">
							@if($sCategory)
							@foreach($sCategory AS $row)
							@if($row->node)
							@foreach($row->node AS $r)
							@if($r->node)
							<div class="col-lg-6 category cat{{$row->category_id}}" style="display:none">
								<div class="custom-control custom-checkbox mb-3">
									<input type="checkbox" class="custom-control-input" name="category[]" id="categoryCheck{{$r->category_id}}" value="{{$r->category_id}}"  {{ (isset($sRow) && in_array($r->category_id,$sRow->checkboxCategory))?'checked':'' }}>
									<label class="custom-control-label" for="categoryCheck{{$r->category_id}}">{{$r->name}}</label>
								</div>
							</div>
                            @foreach($r->node AS $r2)
							<div class="col-lg-6 category cat{{$row->category_id}}" style="display:none">
								<div class="custom-control custom-checkbox mb-3 ml-4">
									<input type="checkbox" class="custom-control-input" name="category[]" id="categoryCheck{{$r2->category_id}}" value="{{$r2->category_id}}" {{ (isset($sRow) && in_array($r->category_id,$sRow->checkboxCategory))?'checked':'' }}>
									<label class="custom-control-label" for="categoryCheck{{$r2->category_id}}">{{$r2->name}}</label>
								</div>
							</div>
                            @endforeach
							@endif
							@endforeach
							@endif
							@endforeach
							@endif
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="card" style="min-height: 200px;">
					<div class="card-body" style="padding-bottom: 5px;">
						<h4 class="card-title">Concerns</h4>
						<div class="row">
							@if($sConcern)
							@foreach($sConcern AS $r)
							<div class="col-lg-6 category cat{{$r->category_id}}">
								<div class="custom-control custom-checkbox mb-3">
									<input type="checkbox" class="custom-control-input" name="concern[]" id="concernCheck{{$r->concern_id}}" value="{{$r->concern_id}}" {{ (isset($sRow) && in_array($r->concern_id,$sRow->checkboxConcern))?'checked':'' }}>
									<label class="custom-control-label" for="concernCheck{{$r->concern_id}}">{{$r->name}}</label>
								</div>
							</div>
							@endforeach
							@endif
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="card" style="min-height: 200px;">
					<div class="card-body" style="padding-bottom: 5px;">
						<h4 class="card-title">Scents</h4>
						<div class="row">
							@if($sScent)
							@foreach($sScent AS $r)
							<div class="col-lg-6">
								<div class="custom-control custom-checkbox mb-3">
									<input type="checkbox" class="custom-control-input" name="scent[]" id="scentCheck{{$r->scent_id}}" value="{{$r->scent_id}}" {{ (isset($sRow) && in_array($r->scent_id,$sRow->checkboxScent))?'checked':'' }}>
									<label class="custom-control-label" for="scentCheck{{$r->scent_id}}">{{$r->name}}</label>
								</div>
							</div>
							@endforeach
							@endif
						</div>
					</div>
				</div>
			</div>









@if(isset($sRow))
<div class="col-lg-12">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Product size</h4>
      <div style="position: absolute;right: 20px;top: 20px;">
        <a href="#divSize" id="ModalSize" class="btn btn-sm btn-primary" data-toggle="modal">Add Size</a>
      </div>
      <table id="data-table-size" class="table table-bordered dt-responsive" style="width: 100%;"></table>
    </div>
  </div>
</div>

<div class="col-lg-6">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Eyeing</h4>
      <div style="position: absolute;right: 20px;top: 20px;">
        <a href="#divSize" id="ModalSize" class="btn btn-sm btn-primary" data-toggle="modal">Add Eyeing</a>
      </div>
      <table id="data-table-eyeing" class="table table-bordered dt-responsive" style="width: 100%;"></table>
    </div>
  </div>
</div>

<div class="col-lg-3">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Image</h4>
      <div style="position: absolute;right: 20px;top: 20px;">
        <a href="#divImage" id="ModalImage" class="btn btn-sm btn-primary" data-toggle="modal">Add Image</a>
      </div>
      <table id="data-table-image" class="table table-bordered dt-responsive" style="width: 100%;"></table>
    </div>
  </div>
</div>

<div class="col-lg-3">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Instagram </h4>
      <div style="position: absolute;right: 20px;top: 20px;">
        <a href="#divInstagram" id="ModalInstagram" class="btn btn-sm btn-primary" data-toggle="modal">Add Instagram</a>
      </div>
      <table id="data-table-instagram" class="table table-bordered dt-responsive" style="width: 100%;"></table>
    </div>
  </div>
</div>
@endif













			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-lg-4">
								<div class="row form-group">
									<div class="col-md-8 mt-2">
										<div class="custom-control custom-switch">
											<input type="checkbox" class="custom-control-input" id="activeSwitch" name="isActive" value="Y" {{ (isset($sRow) && $sRow->isActive=='N')?'':'checked' }}>
											<label class="custom-control-label" for="activeSwitch">Active</label>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="row form-group">
									<div class="col-md-8 mt-2">
										<div class="custom-control custom-switch">
											<input type="checkbox" class="custom-control-input" id="exclusiveSwitch" name="isExclusive" value="Y" {{ (isset($sRow) && $sRow->isExclusive=='Y')?'checked':'' }}>
											<label class="custom-control-label" for="exclusiveSwitch">Exclusive</label>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="row form-group">
									<div class="col-md-8 mt-2">
										<div class="custom-control custom-switch">
											<input type="checkbox" class="custom-control-input" id="mostloveSwitch" name="isMostLove" value="Y" {{ (isset($sRow) && $sRow->isMostLove=='Y')?'checked':'' }}>
											<label class="custom-control-label" for="mostloveSwitch">Most Love</label>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="row form-group">
									<div class="col-md-8 mt-2">
										<div class="custom-control custom-switch">
											<input type="checkbox" class="custom-control-input" id="himSwitch" name="isHim" value="Y" {{ (isset($sRow) && $sRow->isHim=='Y')?'checked':'' }}>
											<label class="custom-control-label" for="himSwitch">Him</label>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="row form-group">
									<div class="col-md-8 mt-2">
										<div class="custom-control custom-switch">
											<input type="checkbox" class="custom-control-input" id="herSwitch" name="isHer" value="Y" {{ (isset($sRow) && $sRow->isHer=='Y')?'checked':'' }}>
											<label class="custom-control-label" for="herSwitch">Her</label>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="row form-group">
									<div class="col-md-8 mt-2">
										<div class="custom-control custom-switch">
											<input type="checkbox" class="custom-control-input" id="giftSwitch" name="isGift" value="Y" {{ (isset($sRow) && $sRow->isGift=='Y')?'checked':'' }}>
											<label class="custom-control-label" for="giftSwitch">Gift</label>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<label class="control-label">Introduction Topic :</label>
									<input type="text" class="form-control" name="intro_topic" value="{{ isset($sRow)?$sRow->intro_topic:'' }}" required/>
								</div>
								<div class="form-group">
									<label class="control-label">Introduction Detail :</label>
									<textarea name="intro_detail" class="form-control">{{ $sRow->intro_detail??'' }}</textarea>
								</div>

								<div class="form-group">
									<label class="control-label">Benefits :</label>
									<textarea name="benefits" class="form-control">{{ $sRow->benefits??'' }}</textarea>
								</div>
								<div class="form-group">
									<label class="control-label">How to use :</label>
									<textarea name="how_to" class="form-control">{{ $sRow->how_to??'' }}</textarea>
								</div>
								<div class="form-group">
									<label class="control-label">ingredients :</label>
									<textarea name="ingredients" class="form-control">{{ $sRow->ingredients??'' }}</textarea>
								</div>
								<div class="form-group">
									<label class="control-label">Full Detail :</label>
									<textarea name="full_detail" class="form-control">{{ $sRow->full_detail??'' }}</textarea>
								</div>
								<div class="form-group">
									<label class="control-label">Youtube :</label>
									<input type="text" class="form-control" name="youtube" value="{{ isset($sRow)?$sRow->youtube:'' }}"/>
								</div>
								<div class="form-group">
									<label class="control-label">Seo Meta Keywords :</label>
									<input type="text" class="form-control" name="meta_keywords" value="{{ isset($sRow)?$sRow->meta_keywords:'' }}"/>
								</div>
								<div class="form-group">
									<label class="control-label">Seo Meta Description :</label>
									<input type="text" class="form-control" name="meta_description" value="{{ isset($sRow)?$sRow->meta_description:'' }}"/>
								</div>
							</div>
						</div>
						<div class="form-group mb-0 row">
							<div class="col-md-6">
								<a class="btn btn-secondary btn-sm waves-effect" href="{{ route('backend.product.product.index') }}">
									<i class="bx bx-arrow-back font-size-16 align-middle mr-1"></i> ย้อนกลับ
								</a>
							</div>
							<div class="col-md-6 text-right">
								<button type="submit" class="btn btn-primary btn-sm waves-effect">
									<i class="bx bx-save font-size-16 align-middle mr-1"></i> บันทึกข้อมูล
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end col -->
	</div>
	<!-- end row -->
</form>


@if(isset($sRow))
  @include('backend.product.product.inc_size')
  @include('backend.product.product.inc_image')
  @include('backend.product.product.inc_instagram')
@endif

<!-- end row -->
@endsection
@section('script')
<script>
	$(function() {
    CKEDITOR.replace( 'intro_detail' , {allowedContent: true});
    CKEDITOR.replace( 'benefits' , {allowedContent: true});
    CKEDITOR.replace( 'how_to' , {allowedContent: true});
    CKEDITOR.replace( 'ingredients' , {allowedContent: true});
    CKEDITOR.replace( 'full_detail' , {allowedContent: true});

    $('select[name="category_id"]').on('change', function(){
      $('.category').hide();
      $('.cat'+$(this).val()).show();
    });

    $('.category').hide();
    $('.cat'+$('select[name="category_id"]').val()).show();

	});


  function oTableDraw(t){
   if(t=='size') oTableSize.draw(false);
   if(t=='image') oTableImage.draw(false);
   if(t=='eyeing') oTableEyeing.draw(false);
   if(t=='instagram') oTableInstagram.draw(false);
  }
</script>

  @yield('script-inc-size')
  @yield('script-inc-image')
  @yield('script-inc-eyeing')
  @yield('script-inc-instagram')
@endsection
