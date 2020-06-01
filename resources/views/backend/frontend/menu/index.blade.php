@extends('backend.layouts.master')

@section('title') Menu @endsection

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
                <div class="row">
					<div class="col-8">
						<select id="groupMenu" class="form-control float-left text-center w200 myWhere" name="group">
							<option value="Main">Main Menu</option>
							<option value="First">PAÑPURI FIRST Menu</option>
							<option value="FooterLeft">Footer Left</option>
							<option value="FooterRight">Footer Right</option>
							<option value="Connect">Connect</option>
						</select>
						<input type="text" class="form-control float-left ml-1 text-center w200 myLike" placeholder="Menu Name" name="name_en">
					</div>
					<div class="col-4 text-right">
						<!--
						<a class="btn btn-info btn-sm mt-1" href="{{ route('backend.frontend.menu.create') }}">
							<i class="bx bx-plus font-size-16 align-middle mr-1"></i>Add Data
						</a>
					-->
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
			iDisplayLength: 50,
			ajax: {
				url: '{{ route('backend.frontend.menu.datatable') }}',
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
            {data: 'id', title :'Code', className: 'text-center w40'},
            {data: 'group', title :'Group', className: 'text-center w90'},
            {data: 'name_en', title :'<center>Menu Name</center>', className: 'text-left'},
            {data: 'sort', title :'Sort', className: 'text-center w40'},
            {data: 'isActive', title :'<center>Active</center>', className: 'text-center w50'},
            {data: 'system', title :'<center>Mode</center>', className: 'text-center w50'},
            {data: 'updated_at', title :'Updated At', className: 'text-center w130'},
            {data: 'id', title :'<center>Action</center>', className: 'text-right w100'},
			],
			rowCallback: function(nRow, aData, dataIndex){
        let name='<br/>';
        if(aData.node){
          $.each(aData.node, function(key, row) {
            name = name+'- '+row.name_en+' ';
            name = name+'<a href="{{ route('backend.frontend.menu.index') }}/'+row.id+'/edit?menu_id='+aData['id']+'"><i class="bx bx-edit font-size-5"></i></a> ';
            name = name+'<a href="javascript: void(0);" data-url="{{ route('backend.frontend.menu.index') }}/'+row.id+'" class="cDelete"><i class="bx bx-trash font-size-5 text-danger"></i></a><br/>';
          });
        }


        $('td:eq(2)', nRow).html(aData.name_en+name);
				$('td:last-child', nRow).html(''
        + ((aData.ref=='0' && aData.group=='Main')?'<a href="{{ route('backend.frontend.menu.create') }}/?menu_id='+aData['id']+'" class="btn btn-sm btn-success"><i class="bx bxs-add-to-queue font-size-16 align-middle"></i></a> ':'')
				+ '<a href="{{ route('backend.frontend.menu.index') }}/'+aData['id']+'/edit" class="btn btn-sm btn-primary"><i class="bx bx-edit font-size-16 align-middle"></i></a> '
				+ '<a href="javascript: void(0);" data-url="{{ route('backend.frontend.menu.index') }}/'+aData['id']+'" class="btn btn-sm btn-danger '+((aData.system=="Lock")?"disabled":"cDelete")+'"><i class="bx bx-trash font-size-16 align-middle"></i></a>'
				).addClass('input');
			}
		});
		$('.myWhere,.myLike,.myCustom,#onlyTrashed').on('change', function(e){
			oTable.draw();
		});
	});
</script>
@endsection
