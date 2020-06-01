
<!-- #modal-divModal-->
<div class="modal fade" id="divSize">
  <div class="modal-dialog">
  <form autocomplete="off" id="formSize">
    <div class="modal-content">
      <div class="modal-body form-horizontal">
        <fieldset>
          <div class="col-md-12 mt-2">
            <div class="form-group row">
              <label class="col-md-2 col-form-label text-right">Serial :</label>
              <div class="col-md-10">
                <input type="text" class="form-control" name="serial" required/>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-2 col-form-label text-right">Size :</label>
              <div class="col-md-10">
                <input type="text" class="form-control" name="size" required/>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-2 col-form-label text-right">Unit :</label>
              <div class="col-md-10">
                <input type="text" class="form-control" name="unit" required/>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-2 col-form-label text-right">Price :</label>
              <div class="col-md-10">
                <input type="number" class="form-control" name="price" required/>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-2 col-form-label text-right">Stock :</label>
              <div class="col-md-10">
                <input type="number" class="form-control" name="stock" required/>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-2 col-form-label text-right">Sort :</label>
              <div class="col-md-10">
                <input type="number" class="form-control" name="sort" required/>
                <input type="hidden" name="id"/>
                <input type="hidden" name="product2local_id" value="{{ $sRow->id }}"/>
              </div>
            </div>
            <div class="form-group row mb-0">
              <label class="col-md-2 col-form-label text-right">Active :</label>
              <div class="col-md-10">
                <select class="form-control" name="isActive">
                  <option value="Y">Y</option>
                  <option value="N">N</option>
                </select>
              </div>
            </div>

          </div>
        </fieldset>
      </div>
      <div class="modal-footer">
        <div class="pull-right">
          <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
          <button type="submit" class="btn btn-sm btn-primary Updated">บันทึกข้อมูล</button>
          <button type="submit" class="btn btn-sm btn-primary Created">เพิ่มข้อมูล</button>
        </div>
      </div>
    </div>
  </form>
  </div>
</div>

@section('script-inc-size')
<script>
  var oTableSize;
  $(function() {
    oTableSize = $('#data-table-size').DataTable({
      "sDom": "<'row'<'col-sm-12'tr>>",
      processing: true,
      serverSide: true,
      scroller: true,
      scrollCollapse: true,
      scrollX: true,
      ordering: false,
      iDisplayLength: 25,
      ajax: {
        url: '{{ route('backend.product.product-size.datatable') }}',
        data: function ( d ) {
          d.id = {{ $sRow->id }};
        },
        method: 'POST'
      },
      columns: [
            {data: 'sort', title :'Sort', className: 'text-center w30'},
            {data: 'serial', title :'<center>Serial</center>', className: 'text-left'},
            {data: 'size', title :'Size', className: 'text-center'},
            {data: 'unit', title :'Unit', className: 'text-center'},
            {data: 'price', title :'<center>Price</center>', className: 'text-right w70'},
            {data: 'stock', title :'<center>Stock</center>', className: 'text-right w70'},
            {data: 'sell', title :'<center>Sell</center>', className: 'text-right w70'},
            {data: 'isActive', title :'<center>Active</center>', className: 'text-center w50'},
            {data: 'updated_at', title :'Updated At', className: 'text-center w130'},
            {data: 'id', title :'Action', className: 'text-center w70'},
      ],
      rowCallback: function(nRow, aData, dataIndex){
        $(nRow).data('aData',  aData);
        $('td:last-child', nRow).html(''
        + '<a href="javascript:;" class="btn btn-sm btn-primary cEdit"><i class="bx bx-edit font-size-16 align-middle"></i></a> '
        + '<a href="javascript: void(0);" data-url="{{ route('backend.product.product-size.index') }}/'+aData['id']+'" class="btn btn-sm btn-danger cDelete"><i class="bx bx-trash font-size-16 align-middle"></i></a>'
        ).addClass('input');
      }
    });




    $( 'div' ).on( "click", '#ModalSize', function() {
      $('#divSize .Updated').hide();
      $('#divSize .Created').show();
      document.getElementById("formSize").reset();
    });



    $( '#data-table-size' ).on( "click", '.cEdit', function() {
      $('#divSize').modal('show');
      $('#divSize .Updated').show();
      $('#divSize .Created').hide();
      if( $(this).parent().parent().data('aData') ){
        $('#divSize input[name="sort"]').val($(this).parent().parent().data('aData').sort);
        $('#divSize input[name="serial"]').val($(this).parent().parent().data('aData').serial);
        $('#divSize input[name="size"]').val($(this).parent().parent().data('aData').size);
        $('#divSize input[name="unit"]').val($(this).parent().parent().data('aData').unit);
        $('#divSize input[name="price"]').val($(this).parent().parent().data('aData').price);
        $('#divSize input[name="stock"]').val($(this).parent().parent().data('aData').stock);
        $('#divSize select[name="isActive"]').val($(this).parent().parent().data('aData').isActive);
        $('#divSize input[name="id"]').val($(this).parent().parent().data('aData').id);
      }
    });



  $('#formSize').on('submit', function(e) {
      e.preventDefault();
      $('#divSize').modal('hide');
      $.ajax({
        type: ($('#divSize input[name="id"]').val()?'PUT':'POST'),
        url: ($('#divSize input[name="id"]').val()?'{{ route('backend.product.product-size.update',1)}}':'{{ route('backend.product.product-size.store') }}'),
        dataType: 'JSON',
        data:$("#formSize").serialize(),
        processData: false,
        success: function(result) {
          if( result ){
            oTableSize.draw(false);
          }
        }
      });
      document.getElementById("formSize").reset();
  });





  });

</script>
@endsection
