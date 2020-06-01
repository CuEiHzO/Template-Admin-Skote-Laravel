@extends('backend.layouts.master')

@section('title') Customer (ข้อมูลลูกค้า) @endsection

@section('css')

@endsection

@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Page</h4>
			
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
					<li class="breadcrumb-item"><a href="javascript: void(0);">Front-end</a></li>
                    <li class="breadcrumb-item active">Page</li>
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
				<form action="{{ route('backend.page.page.store') }}" method="POST" autocomplete="off">
			@else
				<form action="{{ route('backend.page.page.update', $sRow->id ) }}" method="POST" autocomplete="off">
				<input name="_method" type="hidden" value="PUT">
			@endif
					{{ csrf_field() }}
					<!--
						<h4 class="card-title">Textual inputs</h4>
						<p class="card-title-desc">
						Here are examples of <code>.form-control</code> applied to each textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.
						</p>
					-->
					
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
						<label for="routes-en-input" class="col-md-2 col-form-label">Routes</label>
						<div class="col-md-10">
							{{-- isset($sRow)?'readonly':'required' --}}
							<input class="form-control" type="text" value="{{ $sRow->routes??'' }}" name="routes" required>
						</div>
					</div>					
					<div class="form-group row">
						<label for="title-en-input" class="col-md-2 col-form-label">Title en</label>
						<div class="col-md-10">
							<input class="form-control" type="text" value="{{ $sRow->title_en??'' }}" name="title_en" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="title-en-input" class="col-md-2 col-form-label">Meta Keywords En</label>
						<div class="col-md-10">
							<input class="form-control" type="text" value="{{ $sRow->meta_keywords_en??'' }}" name="meta_keywords_en" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="title-en-input" class="col-md-2 col-form-label">Meta Description En</label>
						<div class="col-md-10">
							<input class="form-control" type="text" value="{{ $sRow->meta_description_en??'' }}" name="meta_description_en" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="title-en-input" class="col-md-2 col-form-label">Body En</label>
						<div class="col-md-10">
							<input class="form-control" type="text" value="{{ $sRow->body_en??'' }}" name="body_en" required>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Active</label>
						<div class="col-md-10 mt-2">
							<div class="custom-control custom-switch">
								<input type="checkbox" class="custom-control-input" id="customSwitch" name="active" value="Y" {{ (isset($sRow) && $sRow->active=='Y')?'checked':'' }}>
								<label class="custom-control-label" for="customSwitch">ใช้งานปกติ</label>
							</div>
						</div>
					</div>
					
					<div class="form-group mb-0 row">
						<div class="col-md-6">
							<a class="btn btn-secondary btn-sm waves-effect" href="{{ route('backend.page.page.index') }}">
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

@endsection