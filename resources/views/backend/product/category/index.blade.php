@extends('backend.layouts.master')

@section('title') Category List @endsection

@section('css')
@endsection

@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Category List</h4>

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
                <div class="row">
					<div class="col-8">
						<input type="text" class="form-control float-left text-center w200 myLike" placeholder="Name Local" name="name">
					</div>
					<div class="col-4 text-right">
						<a class="btn btn-info btn-sm mt-1" href="{{ route('backend.product.category.create') }}">
							<i class="bx bx-plus font-size-16 align-middle mr-1"></i>Add Data
						</a>
					</div>
				</div>

                <table id="data-table" class="table table-bordered dt-responsive" style="width: 100%;"></table>

			</div>
		</div>
	</div> <!-- end col -->
</div> <!-- end row -->

@endsection

@section('script')

<script>
	var oTable;
	$(function() {
		oTable = $('#data-table').DataTable({
			"sDom": "<'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>",
			processing: true,
			serverSide: true,
			scroller: true,
			scrollCollapse: true,
			scrollX: true,
			ordering: false,

			iDisplayLength: 25,
			ajax: {
				url: '{{ route('backend.product.category.datatable') }}',
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
					oData = d;
				},
				method: 'POST'
			},
			columns: [
            //{data: 'id', title :'Code', className: 'text-center w50'},
            {data: 'type', title :'Type', className: 'text-center w50'},
            {data: 'global.name', title :'<center>Name English</center>', className: 'text-left'},
            {data: 'name', title :'<center>Name Local</center>', className: 'text-left'},
            {data: 'isShow', title :'<center>Show</center>', className: 'text-center w50'},
            {data: 'isActive', title :'<center>Active</center>', className: 'text-center w50'},
            {data: 'updated_at', title :'Updated At', className: 'text-center w130'},
            {data: 'id', title :'Action', className: 'text-center w100'},
			],
			rowCallback: function(nRow, aData, dataIndex){
				let name1='<br/>';
				let name2='<br/>';
if(aData.node){
	$.each(aData.node, function(key, row) {
		name1 = name1+'- '+row.name+' <a href="{{ route('backend.product.category.create') }}?category_id='+row.id+'"><i class="bx bxs-add-to-queue font-size-5  text-success"></i></a> ';
		name1 = name1+'<a href="{{ route('backend.product.category.index') }}/'+row.id+'/edit?category_id='+aData['id']+'"><i class="bx bx-edit font-size-5"></i></a> ';
		name1 = name1+'<a href="javascript: void(0);" data-url="{{ route('backend.product.category.index') }}/'+row.id+'" class="cDelete"><i class="bx bx-trash font-size-5 text-danger"></i></a><br/>';


		if(row.node){
			$.each(row.node, function(key, row1) {
				name1 = name1+'- - '+row1.name+' <a href="{{ route('backend.product.category.index') }}/'+row1.id+'/edit?category_id='+aData['id']+'"><i class="bx bx-edit font-size-5"></i></a> ';
				name1 = name1+'<a href="javascript: void(0);" data-url="{{ route('backend.product.category.index') }}/'+row1.id+'" class="cDelete"><i class="bx bx-trash font-size-5 text-danger"></i></a><br/>';
			});
		}
	});
}

				//$('td:eq(1)', nRow).html(aData.name+name1);
				$('td:eq(2)', nRow).html(aData.name+name1);

				$('td:last-child', nRow).html(''
				+ '<a href="{{ route('backend.product.category.create') }}?category_id='+aData['id']+'" class="btn btn-sm btn-success"><i class="bx bxs-add-to-queue font-size-16 align-middle"></i></a> '
				+ '<a href="{{ route('backend.product.category.index') }}/'+aData['id']+'/edit" class="btn btn-sm btn-primary"><i class="bx bx-edit font-size-16 align-middle"></i></a> '
				+ '<a href="javascript: void(0);" data-url="{{ route('backend.product.category.index') }}/'+aData['id']+'" class="btn btn-sm btn-danger cDelete"><i class="bx bx-trash font-size-16 align-middle"></i></a>'
				).addClass('input');
			}
		});
		$('.myWhere,.myLike,.myCustom,#onlyTrashed').on('change', function(e){
			oTable.draw();
		});
	});
</script>
@endsection
