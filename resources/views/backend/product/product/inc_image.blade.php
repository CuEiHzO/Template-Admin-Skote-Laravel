
<!-- #modal-divModal-->
<div class="modal fade" id="divImage">
  <div class="modal-dialog">
  <form autocomplete="off" id="formImage">
    <div class="modal-content">
      <div class="modal-body form-horizontal">
        <fieldset>
          <div class="col-md-12 mt-2">
            <div class="form-group row" id="rowImage">
              <label class="col-md-4 col-form-label text-right">Image (500px) :</label>
              <div class="col-md-8">
                <input type="file" name="files" accept="image/*" class="form-control">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-3 col-form-label text-right">Sort :</label>
              <div class="col-md-9">
                <input type="number" class="form-control" name="sort" value="1" required/>
                <input type="hidden" name="id"/>
                <input type="hidden" name="product2local_id" value="{{ $sRow->id }}"/>
              </div>
            </div>
            <div class="form-group row mb-0">
              <label class="col-md-3 col-form-label text-right">Active :</label>
              <div class="col-md-9">
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

@section('script-inc-image')
<script>
  var oTableImage;
  $(function() {
    oTableImage = $('#data-table-image').DataTable({
      "sDom": "<'row'<'col-sm-12'tr>>",
      processing: true,
      serverSide: true,
      scroller: true,
      scrollCollapse: true,
      scrollX: true,
      ordering: false,
      iDisplayLength: 25,
      ajax: {
        url: '{{ route('backend.product.product-image.datatable') }}',
        data: function ( d ) {
          d.id = {{ $sRow->id }};
        },
        method: 'POST'
      },
      columns: [
            {data: 'sort',  title :'Image', className: 'text-center'},
            {data: 'isActive', title :'#', className: 'text-center w30'},
            {data: 'id', title :'', className: 'text-center w30'},
      ],
      rowCallback: function(nRow, aData, dataIndex){
        $(nRow).data('aData',  aData);
        $('td:eq(0)', nRow).html('<img src="{{ asset('asset/images/product/') }}/'+aData['img']+'_thumb'+aData['ext']+'" width="75" />');
        $('td:last-child', nRow).html(''
        + '<a href="javascript:;" class="btn btn-sm btn-primary cEdit m-b-1" style="margin-bottom:10px;"><i class="bx bx-edit font-size-16 align-middle"></i></a><br>'
        + '<a href="javascript: void(0);" data-url="{{ route('backend.product.product-image.index') }}/'+aData['id']+'" class="btn btn-sm btn-danger cDelete"><i class="bx bx-trash font-size-16 align-middle"></i></a>'
        ).addClass('input');
      }
    });




    $( 'div' ).on( "click", '#ModalImage', function() {
      $('#rowImage').show();
      $('#divImage .Updated').hide();
      $('#divImage .Created').show();
      $('#divImage input[name="id"]').val('');
      document.getElementById("formImage").reset();
    });



    $( '#data-table-image' ).on( "click", '.cEdit', function() {
      $('#rowImage').hide();
      $('#divImage').modal('show');
      $('#divImage .Updated').show();
      $('#divImage .Created').hide();
      if( $(this).parent().parent().data('aData') ){
        $('#divImage input[name="sort"]').val($(this).parent().parent().data('aData').sort);
        $('#divImage select[name="isActive"]').val($(this).parent().parent().data('aData').isActive);
        $('#divImage input[name="id"]').val($(this).parent().parent().data('aData').id);
      }
    });



  $('#formImage').on('submit', function(e) {
      e.preventDefault();
      $('#divImage').modal('hide');

      formData = new FormData();
      formData.append("product2local_id", {{ $sRow->id }});
      formData.append("id", $('#divImage input[name="id"]').val());
      formData.append("sort", $('#divImage input[name="sort"]').val());
      formData.append("isActive", $('#divImage select[name="isActive"]').val());

      var input  = $('input[name="files"]');
      var file = input[0].files[0];

      if(file != undefined) {
        if(!!file.type.match(/image.*/)) {
          formData.append("files", file);
        } else {
          alert('กรุณาเลือกเฉพาะไฟล์ภาพเท่านั้นค่ะ');
        }
        $.ajax({
          type: ($('#divImage input[name="id"]').val()?'PUT':'POST'),
          url: ($('#divImage input[name="id"]').val()?'{{ route('backend.product.product-image.update',1)}}':'{{ route('backend.product.product-image.store') }}'),
          dataType: 'JSON',
          data:formData,
          processData: false,
          contentType : false,
          async   : false,
          success: function(result) {
            if( result ){
              oTableImage.draw(false);
            }
          }
        });
      }else{
        $.ajax({
          type: ($('#divImage input[name="id"]').val()?'PUT':'POST'),
          url: ($('#divImage input[name="id"]').val()?'{{ route('backend.product.product-image.update',1)}}':'{{ route('backend.product.product-image.store') }}'),
          dataType: 'JSON',
          data:$("#formImage").serialize(),
          processData: false,
          success: function(result) {
            if( result ){
              oTableImage.draw(false);
            }
          }
        });
      }


      document.getElementById("formImage").reset();
  });



  });

</script>
@endsection
