@extends('backend.layouts.master')

@section('title') Add/Edit Menu@endsection

@section('css')

@endsection

@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Menu</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
					<li class="breadcrumb-item"><a href="javascript: void(0);">Menu</a></li>
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
					<form action="{{ route('backend.frontend.menu.store') }}" method="POST" autocomplete="off">
				@else
					<form action="{{ route('backend.frontend.menu.update', $sRow->id ) }}" method="POST" autocomplete="off">
					<input name="_method" type="hidden" value="PUT">
				@endif
				{{ csrf_field() }}

          @if( !request('menu_id') )
              @if( isset($sRow) && $sRow->system=='Lock' )
              <input id="groupMenu" name="group" type="hidden" value="{{ $sRow->group }}">
              @else
    					<div class="form-group row">
    						<label for="routes-en-input" class="col-md-2 col-form-label">Group</label>
    						<div class="col-md-10">
                  <select id="groupMenu" class="form-control" name="group">
                    <option value="Main"  {{ (isset($sRow) && $sRow->group=='Main')?'selected':'' }}>Main Menu</option>
                    @if( request('id') )
                    <option value="Shop"  {{ (isset($sRow) && $sRow->group=='Shop')?'selected':'' }}>Shop Menu</option>
                    @endif
                    <option value="First"  {{ (isset($sRow) && $sRow->group=='First')?'selected':'' }}>PAÑPURI FIRST Menu</option>
                    <option value="FooterLeft"  {{ (isset($sRow) && $sRow->group=='FooterLeft')?'selected':'' }}>Footer Left</option>
                    <option value="FooterRight"  {{ (isset($sRow) && $sRow->group=='FooterRight')?'selected':'' }}>Footer Right</option>
                    <option value="Connect"  {{ (isset($sRow) && $sRow->group=='Connect')?'selected':'' }}>Connect</option>
                  </select>
    						</div>
    					</div>
              @endif
          @else
              @if($sMenu && $sMenu->slug=='shop')
              <input id="groupMenu" name="group" type="hidden" value="Shop">
              @else
              <input id="groupMenu" name="group" type="hidden" value="Main">
              @endif
          @endif


					<div class="form-group row">
						<label for="routes-en-input" class="col-md-2 col-form-label">URL</label>
						<div class="col-md-10">
							<input class="form-control" type="text" name="slug" value="{{ $sRow->slug??'' }}" {{ (isset($sRow) && $sRow->system=='Lock')?'readonly':'' }} re>
						</div>
					</div>

					<div class="form-group row">
						<label for="title-en-input" class="col-md-2 col-form-label">Sort</label>
						<div class="col-md-10">
							<input class="form-control" type="number" value="{{ $sRow->sort??'' }}" name="sort" required>
						</div>
					</div>

          <div class="form-group row">
            <label for="routes-en-input" class="col-md-2 col-form-label">Mode</label>
            <div class="col-md-10">
              <select id="systemMenu" class="form-control" name="system">
                @if($sMenu && $sMenu->slug=='shop')
                <option value="Category" {{ (isset($sRow) && $sRow->system=='Category')?'selected':'' }}>Category</option>
                <option value="Status" {{ (isset($sRow) && $sRow->system=='Status')?'selected':'' }}>Status</option>
                @else
                <option value="Page"  {{ (isset($sRow) && $sRow->system=='Page')?'selected':'' }}>Page Content</option>
                <option value="First"  {{ (isset($sRow) && $sRow->system=='First')?'selected':'' }}>PAÑPURI FIRST Menu</option>
                <option value="Link"  {{ (isset($sRow) && $sRow->system=='Link')?'selected':'' }}>Url Outsource</option>
                <option value="System" {{ (isset($sRow) && $sRow->system=='System')?'selected':'' }}>System in web</option>
                @endif
              </select>
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

					<!-- Tab Menu -->
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
					<div class="tab-content p-3 text-muted">
						<div class="tab-pane active" id="t_th" role="tabpanel">
							<br>
							<div class="form-group row">
								<label for="routes-en-input" class="col-md-2 col-form-label">Name</label>
								<div class="col-md-10">
									<input class="form-control" type="text" value="{{ $sRow->name_locale??'' }}" name="name_locale" required>
								</div>
							</div>
							<div class="form-group row isEditer">
								<label for="title-en-input" class="col-md-2 col-form-label">Title</label>
								<div class="col-md-10">
									<input class="form-control" type="text" value="{{ $sRow->title_locale??'' }}" name="title_locale" required>
								</div>
							</div>
							<div class="form-group row isEditer">
								<label for="title-en-input" class="col-md-12 col-form-label">Body</label>
								<div class="col-md-12">
									<textarea name="body_locale" class="form-control">{{ $sRow->body_locale??'' }}</textarea>
								</div>
							</div>
							<div class="form-group row">
								<label for="title-en-input" class="col-md-2 col-form-label">Meta Keywords</label>
								<div class="col-md-10">
									<input class="form-control" type="text" value="{{ $sRow->meta_keywords_locale??'' }}" name="meta_keywords_locale">
								</div>
							</div>
							<div class="form-group row">
								<label for="title-en-input" class="col-md-2 col-form-label">Meta Description</label>
								<div class="col-md-10">
									<input class="form-control" type="text" value="{{ $sRow->meta_description_locale??'' }}" name="meta_description_locale">
								</div>
							</div>
						</div>
						<div class="tab-pane" id="t_en" role="tabpanel">
							<br>
							<div class="form-group row">
								<label for="routes-en-input" class="col-md-2 col-form-label">Name</label>
								<div class="col-md-10">
									<input class="form-control" type="text" value="{{ $sRow->name_en??'' }}" name="name_en" required>
								</div>
							</div>
							<div class="form-group row isEditer">
								<label for="title-en-input" class="col-md-2 col-form-label">Title</label>
								<div class="col-md-10">
									<input class="form-control" type="text" value="{{ $sRow->title_en??'' }}" name="title_en" required>
								</div>
							</div>
							<div class="form-group row isEditer">
								<label for="title-en-input" class="col-md-12 col-form-label">Body</label>
								<div class="col-md-12">
									<textarea name="body_en" class="form-control">{{ $sRow->body_en??'' }}</textarea>
								</div>
							</div>
							<div class="form-group row">
								<label for="title-en-input" class="col-md-2 col-form-label">Meta Keywords</label>
								<div class="col-md-10">
									<input class="form-control" type="text" value="{{ $sRow->meta_keywords_en??'' }}" name="meta_keywords_en">
								</div>
							</div>
							<div class="form-group row">
								<label for="title-en-input" class="col-md-2 col-form-label">Meta Description</label>
								<div class="col-md-10">
									<input class="form-control" type="text" value="{{ $sRow->meta_description_en??'' }}" name="meta_description_en">
								</div>
							</div>
						</div>
					</div>
					<br>
					<div class="form-group mb-0 row">
						<div class="col-md-6">
							<a class="btn btn-secondary btn-sm waves-effect" href="{{ route('backend.frontend.menu.index') }}">
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
	/* สำหรับ textarea */
	CKEDITOR.replace( 'body_locale', {allowedContent: true, filebrowserUploadUrl: "{{route('backend.frontend.menu.index', ['_token' => csrf_token() ])}}", filebrowserUploadMethod: 'form'} );
	CKEDITOR.replace( 'body_en', {allowedContent: true, filebrowserUploadUrl: "{{route('backend.frontend.menu.index', ['_token' => csrf_token() ])}}", filebrowserUploadMethod: 'form'} );
   

    $('#systemMenu').on('change', function(){
        if($(this).val()=='Page'){
          $('.isEditer').show();
        }else{
          $('.isEditer').hide();
        }
    });

    if( $('#systemMenu').val()=='Page' ){
        $('.isEditer').show();
    }else{
        $('.isEditer').hide();
    }
</script>
@endsection
