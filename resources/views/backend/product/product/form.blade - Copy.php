@extends('backend.layouts.master')
@section('title') Add/Edit Product @endsection
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
								<br>
								<!-- image -->
								@if(isset($sRow->id))
								<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#imageModal" data-whatever="@mdo">add image</button>								
								<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="imageModalLabel">Add Image</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<form>
													<div class="form-group">
														<label for="recipient-name" class="col-form-label">image:</label>
														<input type="file" name="pro_img" class="form-control">
													</div>													
												</form>
											</div>
											<div class="modal-footer">												
												<button type="button" class="btn btn-sm btn-primary" id="go-image">submit</button>
											</div>
										</div>
									</div>
								</div>								
								<br><br>

								<!-- size -->
								<div class="row">
									<div class="col-md-6 text-left">
										<b>About Size</b>
									</div>
									<div class="col-md-6 text-right">
										<button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#sizeModal" data-whatever="@mdo">											
											<i class="bx bx-add-to-queue font-size-16 align-middle"></i>
										</button>
									</div>
								</div>
								<div class="modal fade" id="sizeModal" tabindex="-1" role="dialog" aria-labelledby="sizeModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="sizeModalLabel">Add Size</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<form>
													<div class="form-group">
														<label for="recipient-name" class="col-form-label">Serial:</label>
														<input type="text" class="form-control" name="serial_size"> 
													</div>
													<div class="form-group">
														<label for="message-text" class="col-form-label">Size:</label>
														<input type="text" class="form-control" name="size_size">
													</div>
													<div class="form-group">
														<label for="message-text" class="col-form-label">Price:</label>
														<input type="text" class="form-control" name="price_size">
													</div>
													<div class="form-group">
														<label for="message-text" class="col-form-label">Unit:</label>
														<input type="text" class="form-control" name="unit_size">
													</div>
												</form>
											</div>
											<div class="modal-footer">												
												<button type="button" class="btn btn-sm btn-primary" id="go-size">submit</button>
											</div>
										</div>
									</div>
								</div>
								<table id="data-table-size" class="table table-bordered dt-responsive" style="width: 100%;"></table>
								<br><br>
								
								<!-- eyeing -->
								<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#eyeingModal" data-whatever="@mdo">add eyeing</button>								
								<div class="modal fade" id="eyeingModal" tabindex="-1" role="dialog" aria-labelledby="eyeingModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="eyeingModalLabel">Add Eyeing</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											
											<div class="modal-body">
												<form>																										
													<div class="form-group mb-0 templating-select">
                                                        <label class="control-label">product : </label>
                                                        <select class="form-control select2-templating" id="product_id" name="product_id">
															<option value="">select</option>
															@if($sProduct)
															@foreach($sProduct AS $r)
															<option value="{{$r->id}}">{{$r->name.' '.$r->subname}}</option>
															@endforeach
															@endif                                                                                                               
                                                        </select>                                                        
                                                    </div>
												</form>
											</div>
											<div class="modal-footer">												
												<button type="button" class="btn btn-sm btn-primary" id="go-eyeing">submit</button>
											</div>
										</div>
									</div>
								</div>
								<br><br>
								
								<!-- ig -->
								<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#igModal" data-whatever="@mdo">add ig</button>								
								<div class="modal fade" id="igModal" tabindex="-1" role="dialog" aria-labelledby="igModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="igModalLabel">Add Ig</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<form>
													<div class="form-group">
														<label for="recipient-name" class="col-form-label">image:</label>
														<input type="file" class="form-control" name="pro_img_ig">
													</div>
													<div class="form-group">
														<label for="message-text" class="col-form-label">link:</label>
														<input type="text" class="form-control" name="link_ig">
													</div>
												</form>
											</div>
											<div class="modal-footer">												
												<button type="button" class="btn btn-sm btn-primary" id="go-ig">submit</button>
											</div>
										</div>
									</div>
								</div>
								<br><br>
								@endif
								
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
<!-- end row -->
@endsection
@section('script')
<script src="{{ URL::asset('backend/libs/select2/select2.min.js')}}"></script>
<script src="{{ URL::asset('backend/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ URL::asset('backend/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{ URL::asset('backend/libs/bootstrap-touchspin/bootstrap-touchspin.min.js')}}"></script>
<script src="{{ URL::asset('backend/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
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
		
		$("#go-image").click(function() {
			event.preventDefault();
			
			// alert( "image" );
			var route  			= '{!!route("backend.product.product.actionimage") !!}';
			var token  			= '{!! csrf_token() !!}';									
			var where_ref_id  	= '{!! isset($sRow)?$sRow->id:'' !!}';			
			
			var input  = $('input[name="pro_img"]');
			var file = input[0].files[0];			
			if(file != undefined) {
				
				formData = new FormData();
				if(!!file.type.match(/image.*/)) {					
					formData.append("where_pro_id", where_ref_id);					
					formData.append("image", file);
					
					var status = '';
					$.ajax({
						url			: route,
						type		: "post",
						data		: formData,
						processData	: false,
						contentType	: false,
						async		: false,
						dataType	: "json",
						success		: function(data){
							note = data.note;
							alert(note);
							// datatable.ajax.reload();
						}
					});
					
				} else {
					alert('กรุณาเลือกเฉพาะไฟล์ภาพเท่านั้นค่ะ');
				}
			} else {				
				alert('กรุณาเลือกไฟล์ภาพก่อนค่ะ');
			}
		});
		
		$("#go-size").click(function() {
			event.preventDefault();
			// alert( "size" );
			
			var route  			= '{!!route("backend.product.product.actionsize") !!}';			
			var where_ref_id  	= '{!! isset($sRow)?$sRow->id:'' !!}';	

			var input_serial_size  	= $('input[name="serial_size"]').val();
			var input_size_size  	= $('input[name="size_size"]').val();
			var input_price_size  	= $('input[name="price_size"]').val();
			var input_unit_size  	= $('input[name="unit_size"]').val();			
			
			formData = new FormData();			
			formData.append("where_pro_id", where_ref_id);					
			formData.append("serial_size", input_serial_size);
			formData.append("size_size", input_size_size);
			formData.append("price_size", input_price_size);
			formData.append("unit_size", input_unit_size);
			
			var status = '';
			$.ajax({
				url			: route,
				type		: "post",
				data		: formData,
				processData	: false,
				contentType	: false,
				async		: false,
				dataType	: "json",
				success		: function(data){
					note = data.note;
					alert(note);					
					oTableSize.ajax.reload();
					$('#sizeModal').modal('toggle');
					$('input[name="serial_size"]').val('');
					$('input[name="size_size"]').val('');
					$('input[name="price_size"]').val('');
					$('input[name="unit_size"]').val('');
				}
			});
		});		
		$("#go-eyeing").click(function() {
			event.preventDefault();
			// alert( "eyeing" );			
			var route  			= '{!!route("backend.product.product.actioneyeing") !!}';			
			var where_ref_id  	= '{!! isset($sRow)?$sRow->id:'' !!}';				
			var product_id  	=  $('#product_id').val();				
			
			formData = new FormData();			
			formData.append("where_pro_id", where_ref_id);					
			formData.append("product_id", product_id);					
			
			var status = '';
			$.ajax({
				url			: route,
				type		: "post",
				data		: formData,
				processData	: false,
				contentType	: false,
				async		: false,
				dataType	: "json",
				success		: function(data){
					note = data.note;
					alert(note);
					// datatable.ajax.reload();
				}
			});
		});
		$("#go-ig").click(function() {
			// alert( "ig" );
			var route  			= '{!!route("backend.product.product.actionig") !!}';
			var token  			= '{!! csrf_token() !!}';									
			var where_ref_id  	= '{!! isset($sRow)?$sRow->id:'' !!}';			
			
			var link_ig = $('input[name="link_ig"]').val();	
			alert(link_ig);
			var input  	= $('input[name="pro_img_ig"]');
			var file 	= input[0].files[0];			
			if(file != undefined) {
				
				formData = new FormData();
				if(!!file.type.match(/image.*/)) {					
					formData.append("where_pro_id", where_ref_id);					
					formData.append("link_ig", link_ig);					
					formData.append("image", file);
					
					var status = '';
					$.ajax({
						url			: route,
						type		: "post",
						data		: formData,
						processData	: false,
						contentType	: false,
						async		: false,
						dataType	: "json",
						success		: function(data){
							note = data.note;
							alert(note);
							// datatable.ajax.reload();
							// oTableSize.draw();							
						}
					});
					
				} else {
					alert('กรุณาเลือกเฉพาะไฟล์ภาพเท่านั้นค่ะ');
				}
			} else {				
				alert('กรุณาเลือกไฟล์ภาพก่อนค่ะ');
			}
		});
	});
</script>
<script>
	$('.select2-templating').select2();
</script>

<script>
	var oTableSize;
	$(function() {
		oTableSize = $('#data-table-size').DataTable({
			"sDom": "<'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>",
			processing: true,
			serverSide: true,
			scroller: true,
			scrollCollapse: true,
			scrollX: true,
			ordering: false,

			iDisplayLength: 25,
			ajax: {
				url: '{{ route('backend.product.product.datatablesize') }}',
				data: function ( d ) {
					d.Where={};
					$('.myWhere').each(function() {
						if( $.trim($(this).val()) && $.trim($(this).val()) != '0' ){
							d.Where[$(this).attr('name')] = $.trim($(this).val());
						}
					});
					d.Like={};
					$('.myLike').each(function() {
						if( $.trim($(this).val()) && $.trim($(this).val()) != '0' ){
							d.Like[$(this).attr('name')] = $.trim($(this).val());
						}
					});
					d.Custom={};
					$('.myCustom').each(function() {
						if( $.trim($(this).val()) && $.trim($(this).val()) != '0' ){
							d.Custom[$(this).attr('name')] = $.trim($(this).val());
						}
					});
					d.ProductId='{!! isset($sRow)?$sRow->id:'' !!}';
					oData = d;
				},
				method: 'POST'
			},
			columns: [
            {data: 'type', title :'Type', className: 'text-center w50'},    
            {data: 'serial', title :'<center>Serial</center>', className: 'text-left'},
            {data: 'isActive', title :'<center>Active</center>', className: 'text-center w50'},
            {data: 'updated_at', title :'Updated At', className: 'text-center w130'},
            {data: 'id', title :'Action', className: 'text-center w80'},
			],
			rowCallback: function(nRow, aData, dataIndex){
				$('td:last-child', nRow).html(''
				+ '<a href="{{ route('backend.product.product.index') }}/'+aData['id']+'/edit" class="btn btn-sm btn-primary"><i class="bx bx-edit font-size-16 align-middle"></i></a> '
				+ '<a href="javascript: void(0);" data-url="{{ route('backend.product.product.index') }}/'+aData['id']+'" class="btn btn-sm btn-danger cDelete"><i class="bx bx-trash font-size-16 align-middle"></i></a>'
				).addClass('input');
			}
		});
		$('.myWhere,.myLike,.myCustom,#onlyTrashed').on('change', function(e){
			oTableSize.draw();
		});
	});
</script>
@endsection
