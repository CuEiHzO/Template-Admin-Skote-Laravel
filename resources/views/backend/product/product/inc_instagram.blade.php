
<!-- #modal-divModal-->
<div class="modal fade" id="divInstagram">
  <div class="modal-dialog">
  <form autocomplete="off" id="formInstagram">
    <div class="modal-content">
      <div class="modal-body form-horizontal">
        <fieldset>
          <div class="col-md-12 mt-2">
            <div class="form-group row" id="rowInstagram">
              <label class="col-md-4 col-form-label text-right">Instagram (500px) :</label>
              <div class="col-md-8">
                <input type="file" name="filesinstagram" accept="image/*" class="form-control">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-3 col-form-label text-right">Url :</label>
              <div class="col-md-9">
                <input type="text" class="form-control" name="url" required/>
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

@section('script-inc-instagram')
<script>
  var oTableInstagram;
  $(function() {
    oTableInstagram = $('#data-table-instagram').DataTable({
      "sDom": "<'row'<'col-sm-12'tr>>",
      processing: true,
      serverSide: true,
      scroller: true,
      scrollCollapse: true,
      scrollX: true,
      ordering: false,
      iDisplayLength: 25,
      ajax: {
        url: '{{ route('backend.product.product-instagram.datatable') }}',
        data: function ( d ) {
          d.id = {{ $sRow->id }};
        },
        method: 'POST'
      },
      columns: [
            {data: 'sort',  title :'Instagram', className: 'text-center'},
            {data: 'isActive', title :'#', className: 'text-center w30'},
            {data: 'id', title :'', className: 'text-center w30'},
      ],
      rowCallback: function(nRow, aData, dataIndex){
        $(nRow).data('aData',  aData);
        $('td:eq(0)', nRow).html('<img src="{{ asset('asset/images/product-instagram/') }}/'+aData['img']+'_thumb'+aData['ext']+'" width="75" />');
        $('td:last-child', nRow).html(''
        + '<a href="javascript:;" class="btn btn-sm btn-primary cEdit m-b-1" style="margin-bottom:10px;"><i class="bx bx-edit font-size-16 align-middle"></i></a><br>'
        + '<a href="javascript: void(0);" data-url="{{ route('backend.product.product-instagram.index') }}/'+aData['id']+'" class="btn btn-sm btn-danger cDelete"><i class="bx bx-trash font-size-16 align-middle"></i></a>'
        ).addClass('input');
      }
    });




    $( 'div' ).on( "click", '#ModalInstagram', function() {
      $('#rowInstagram').show();
      $('#divInstagram .Updated').hide();
      $('#divInstagram .Created').show();
      $('#divInstagram input[name="id"]').val('');
      document.getElementById("formInstagram").reset();
    });



    $( '#data-table-instagram' ).on( "click", '.cEdit', function() {
      $('#rowInstagram').hide();
      $('#divInstagram').modal('show');
      $('#divInstagram .Updated').show();
      $('#divInstagram .Created').hide();
      if( $(this).parent().parent().data('aData') ){
        $('#divInstagram input[name="sort"]').val($(this).parent().parent().data('aData').sort);
        $('#divInstagram select[name="isActive"]').val($(this).parent().parent().data('aData').isActive);
        $('#divInstagram input[name="id"]').val($(this).parent().parent().data('aData').id);
      }
    });



  $('#formInstagram').on('submit', function(e) {
      e.preventDefault();
      $('#divInstagram').modal('hide');

      formData = new FormData();
      formData.append("product2local_id", {{ $sRow->id }});
      formData.append("id", $('#divInstagram input[name="id"]').val());
      formData.append("sort", $('#divInstagram input[name="sort"]').val());
      formData.append("url", $('#divInstagram input[name="url"]').val());
      formData.append("isActive", $('#divInstagram select[name="isActive"]').val());

      var input  = $('input[name="filesinstagram"]');
      var file = input[0].files[0];

      if(file != undefined) {
        if(!!file.type.match(/image.*/)) {
          formData.append("files", file);
        } else {
          alert('กรุณาเลือกเฉพาะไฟล์ภาพเท่านั้นค่ะ');
        }
        $.ajax({
          type: ($('#divInstagram input[name="id"]').val()?'PUT':'POST'),
          url: ($('#divInstagram input[name="id"]').val()?'{{ route('backend.product.product-instagram.update',1)}}':'{{ route('backend.product.product-instagram.store') }}'),
          dataType: 'JSON',
          data:formData,
          processData: false,
          contentType : false,
          async   : false,
          success: function(result) {
            if( result ){
              oTableInstagram.draw(false);
            }
          }
        });
      }else{
        $.ajax({
          type: ($('#divInstagram input[name="id"]').val()?'PUT':'POST'),
          url: ($('#divInstagram input[name="id"]').val()?'{{ route('backend.product.product-instagram.update',1)}}':'{{ route('backend.product.product-instagram.store') }}'),
          dataType: 'JSON',
          data:$("#formInstagram").serialize(),
          processData: false,
          success: function(result) {
            if( result ){
              oTableInstagram.draw(false);
            }
          }
        });
      }


      document.getElementById("formInstagram").reset();
  });



  });

</script>
@endsection
