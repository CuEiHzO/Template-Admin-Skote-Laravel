@extends('backend.layouts.master')

@section('title') Account (ผู้ดูแลระบบ) @endsection

@section('css')

@endsection

@section('content')

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-18">Account (ผู้ดูแลระบบ)</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Backend</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Permission</a></li>
                                            <li class="breadcrumb-item active">Account (ผู้ดูแลระบบ)</li>
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

                                        <table id="data-table" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        </table>

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
        scrollY: ''+($(window).height()-370)+'px',
        iDisplayLength: 25,
        ajax: {
          url: '{{ action("Backend\Permission\AdminController@Datatable") }}',
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
            {data: 'id', title :'Code', className: 'text-center w50'},
            {data: 'region.rg_comment', title :'Language', className: 'text-center w100'},
            {data: 'subject', title :'<center>Subject</center>', className: 'text-left'},
            {data: 'staff.username', title :'Updated By', className: 'text-center w100'},
            {data: 'updated_at', title :'Updated At', className: 'text-center w130'},
            {data: 'id', title :'Action', className: 'text-center w60'},
        ],
        rowCallback: function(nRow, aData, dataIndex){
          $('td:last-child', nRow).html(''
            + '<a href="{{ action("Backend\Permission\AdminController@index") }}/'+aData['id']+'/edit'+(aData['deleted_at']?'?withTrashed=true':'')+'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> แก้ไข</a> '
          ).addClass('input');
        }
    });
    $('.myWhere,.myLike,.myCustom,#onlyTrashed').on('change', function(e){
      oTable.draw();
    });
});
</script>
@endsection
