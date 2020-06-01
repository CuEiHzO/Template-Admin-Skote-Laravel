@extends('backend.layouts.master')

@section('title') Add/Edit Master Product @endsection

@section('css')
@endsection

@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Master Product List</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">Master Product</li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Master Product List</a></li>
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
					<form action="{{ route('backend.product.productlist.store') }}" method="POST" autocomplete="off">
				@else
					<form action="{{ route('backend.product.productlist.update', $sRow->id ) }}" method="POST" autocomplete="off">
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
					<!--
					<div class="form-group row">
						<label for="routes-en-input" class="col-md-2 col-form-label">Group</label>
						<div class="col-md-10">
							<input class="form-control" type="text" value="{{ $sRow->group??'' }}" name="group" required>
						</div>
					</div>
					-->
					<br>
					<!-- Tab Menu -->
					<!--
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
					-->
					<!-- Tab panes -->
					<!--
					<div class="tab-content p-3 text-muted">
						<div class="tab-pane active" id="t_th" role="tabpanel">
							<br>
						</div>
					</div>
					-->
					<div class="form-group row">
						<label for="routes-en-input" class="col-md-2 col-form-label">Name</label>
						<div class="col-md-10">
							<input class="form-control" type="text" value="{{ $sRow->name??'' }}" name="name" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="title-en-input" class="col-md-2 col-form-label">Sub Name</label>
						<div class="col-md-10">
							<input class="form-control" type="text" value="{{ $sRow->sub??'' }}" name="sub" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="title-en-input" class="col-md-2 col-form-label">Topic</label>
						<div class="col-md-10">
							<input class="form-control" type="text" value="{{ $sRow->topic??'' }}" name="topic" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="title-en-input" class="col-md-12 col-form-label">Description</label>
						<div class="col-md-12">
							<textarea name="ck_description" class="form-control">{{ $sRow->description??'' }}</textarea>
						</div>
					</div>

					<div class="form-group row">
						<label for="title-en-input" class="col-md-12 col-form-label">About Size</label>
						<label></label>
						<div class="col-md-12">
						<table id="part_list" class="table table-striped table-bordered table-hover product-list-table">
							<thead>
								<tr>
									<th><center>No</center></th>
									<th><center>Serial</center></th>
									<th><center>Size</center></th>
									<th><center>Unit Name</center></th>
									<th><center>Price</center></th>
									<th><center>Qty</center></th>
									<th><center>Del</center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><input type="text" class="form-control text-center" name="s-no[]" value="1" readonly></td>
									<td><input type="text" class="form-control" name="s-serial[]" value=""></td>
									<td><input type="text" class="form-control" name="s-size[]" value=""></td>
									<td><input type="text" class="form-control" name="s-unitname[]" value=""></td>
									<td><input type="number" class="form-control" name="s-price[]" value=""></td>
									<td><input type="number" class="form-control" name="s-qty[]" value=""></td>
									<td>
										<button type="button" class="btn btn-circle btn-danger del_part_list" title="ลบข้อมูลในแถวนี้"><i class="fa fa-trash"></i></button>
									</td>
								</tr>
							</tbody>
						</table>
						<button type="button" id="add_part_list" class="btn btn-circle btn-primary" title="เพิ่มแถวในตารางด้านบน"><i class="fa fa-plus"></i></button>
						</div>
					</div>

					<div class="form-group row">
						<label for="title-en-input" class="col-md-2 col-form-label">Youtube</label>
						<div class="col-md-10">
							<input class="form-control" type="text" value="{{ $sRow->youtube??'' }}" name="youtube">
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
					<br>
					<div class="form-group mb-0 row">
						<div class="col-md-6">
							<a class="btn btn-secondary btn-sm waves-effect" href="{{ route('backend.menu.frontendmenu.index') }}">
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
	CKEDITOR.replace( 'ck_description' , {allowedContent: true});

	//Table Add
	$(document).on('click','#add_part_list',function(){
		var clone_tr = $('table#part_list').find('tbody tr:last').clone(false);
		clone_tr.find('input').val('');
		$('table#part_list').find('tbody').append(clone_tr);

		var no = 1;
		$('table#part_list').find('tbody tr').each(function(){
			$(this).find('td:first input').val(no);
			no++;
		});
	});
	//Table Del
	$(document).on('click','.del_part_list',function(){
		var count_tr = $(this).parents('tbody').find('tr').length;
		if(count_tr == 1) {
			$(this).parents('tr').find('input').not(':eq(0)').val('');
		} else {
			$(this).parents('tr').remove();

			var no = 1;
			$('table#part_list').find('tbody tr').each(function(){
				$(this).find('td:first input').val(no);
				no++;
			});
		}

	});
</script>
@endsection
