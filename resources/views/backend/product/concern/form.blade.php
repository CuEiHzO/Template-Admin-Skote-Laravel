@extends('backend.layouts.master')

@section('title') Add/Edit Concern @endsection

@section('css') 
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('backend/libs/select2/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('backend/libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('backend/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('backend/libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}">
@endsection


@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Concern</h4>
			
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">Product</li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Concern</a></li>
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
				<form action="{{ route('backend.product.concern.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
				@else
				<form action="{{ route('backend.product.concern.update', $sRow->id ) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
					<input name="_method" type="hidden" value="PUT">
					@endif
					{{ csrf_field() }}
						
					<div class="col-lg-12">
						<div class="form-group">
							<label class="control-label">Category :</label>
							<select class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Choose Category" name="category_id[]" >
								@if($sCategory)
								@foreach($sCategory AS $r)
								<option value="{{$r->category_id}}" {{ in_array($r->category_id, isset($sRow)?$sRow->category_id:'') ? 'selected' : '' }} >{{$r->name}}</option>								
								@endforeach
								@endif
							</select>
						</div>
						<div class="form-group">
							<label class="control-label">Concern name :</label>
							<input type="text" class="form-control" name="name" value="{{ isset($sRow)?$sRow->name:'' }}"  />							
						</div>
						
						<div class="form-group">
							<label class="control-label">Url name <span style="font-size: 10px;color: blue;">Alphanumeric only</span> :</label>
							<input type="text" class="form-control" name="slug" value="{{ isset($sRow)?$sRow->slug:'' }}"  />
						</div>
						
						<div class="row form-group">
							<label class="col-md-2 col-form-label">Active</label>
							<div class="col-md-10 mt-2">
								<div class="custom-control custom-switch">
									<input type="checkbox" class="custom-control-input" id="activeSwitch" name="isActive" value="Y" {{ (isset($sRow) && $sRow->isActive=='Y')?'checked':'' }}>
									<label class="custom-control-label" for="activeSwitch">Active</label>
								</div>
							</div>
						</div>
						
					</div>
					
					
					<div class="form-group mb-0 row">
						<div class="col-md-6">
							<a class="btn btn-secondary btn-sm waves-effect" href="{{ route('backend.product.concern.index') }}">
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
	<script src="{{ URL::asset('backend/libs/select2/select2.min.js')}}"></script>
	<script src="{{ URL::asset('backend/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
	<script src="{{ URL::asset('backend/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js')}}"></script>
	<script src="{{ URL::asset('backend/libs/bootstrap-touchspin/bootstrap-touchspin.min.js')}}"></script>
	<script src="{{ URL::asset('backend/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>

	<script src="{{ URL::asset('backend/js/pages/form-advanced.init.js')}}"></script> 
	
	<script>
		$(document).ready(function(){
			
		});
	</script>
@endsection
