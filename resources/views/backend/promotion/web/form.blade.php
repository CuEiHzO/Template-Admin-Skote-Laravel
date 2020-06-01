@extends('backend.layouts.master')

@section('title') ส่วนลดทั้งเว็บไซต์ @endsection

@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">ส่วนลดทั้งเว็บไซต์</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Backend</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Promotion</a></li>
                    <li class="breadcrumb-item active">ส่วนลดทั้งเว็บไซต์</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->



<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                @if( empty($sRow) )
                <form action="{{ route('backend.promotion.web.store') }}" method="POST" autocomplete="off">
                @else
                <form action="{{ route('backend.promotion.web.update', $sRow->id ) }}" method="POST" autocomplete="off">
                <input name="_method" type="hidden" value="PUT">
                @endif
                {{ csrf_field() }}
                    <div class="row">

                        <div class="col-lg-6 row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label">โปรโมชั่น :</label>
                                    <input type="text" class="form-control" name="name" value="{{ isset($sRow)?$sRow->name:'' }}"  />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label">ช่วงวันที่ :</label>
                                    <input type="text" class="form-control datetimes" name="daterange" value="{{ isset($sRow)?$sRow->dateFormat('date_start').' - '.$sRow->dateFormat('date_end'):'' }}"  readonly/>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label">สถานะ :</label>
                                    <select class="form-control" name="isActive">
                                        <option value="Y" {{ (@$sRow->isActive=='Y')?'selected':'' }}>ใช้งาน</option>
                                        <option value="N" {{ (@$sRow->isActive=='N')?'selected':'' }}>ไม่ใช้งาน</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label">ราคาที่ต่อชิ้นขั้นต่ำ เพื่อให้เข้าเงื่อนไข :</label>
                                    <input type="text" class="form-control" name="minimum" value="{{ isset($sRow)?$sRow->minimum:'' }}" placeholder="ราคาที่กำหนดเพื่อให้เข้าเงื่อนไข" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">ประเภทส่วนลด :</label>
                                    <select class="form-control" name="type">
                                        <option value="P" {{ (@$sRow->type=='P')?'selected':'' }}>ส่วนลด %</option>
                                        <option value="B" {{ (@$sRow->type=='B')?'selected':'' }}>ส่วนลด บาท</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">ยอดส่วนลด :</label>
                                    <input type="number" class="form-control" placeholder="ยอดส่วนลด" value="{{ $sRow->discount??'' }}" name="discount"  required="" />
                                </div>
                            </div>
                            <div class="col-lg-6 limit">
                                <div class="form-group">
                                    <label class="control-label">ส่วนลดสูงสุด :</label>
                                    <input type="number" class="form-control" placeholder="ส่วนลดสูงสุด" value="{{ $sRow->limit??'' }}" name="limit" />
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="form-group">
                              <label>รายระเอียด :</label>
                              <textarea class="form-control no-resize" rows="4" placeholder="Please type what you want..." name="note">{{ $sRow->note??'' }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-0 row">
                        <div class="col-md-6">
                            <a class="btn btn-secondary waves-effect" href="{{ route('backend.promotion.web.index') }}">
                              <i class="bx bx-arrow-back font-size-16 align-middle mr-1"></i> ย้อนกลับ
                            </a>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="submit" class="btn btn-primary waves-effect">
                              <i class="bx bx-save font-size-16 align-middle mr-1"></i> บันทึกข้อมูล
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
        <!-- end select2 -->
    </div>

</div>
<!-- end row -->

@endsection




@section('css')
<link rel="stylesheet" type="text/css" href="{!!asset('backend/libs/daterangepicker/daterangepicker.css')!!}" />
@endsection

@section('script')
<script type="text/javascript" src="{!!asset('backend/libs/daterangepicker/moment.min.js')!!}"></script>
<script type="text/javascript" src="{!!asset('backend/libs/daterangepicker/daterangepicker.js')!!}"></script>
<script>
$(function() {
    $(document).ready(function() {
      $('.datetimes').daterangepicker({
        timePicker: true,
        @if(empty($sRow))
        startDate: moment().startOf('hour'),
        endDate: moment().startOf('hour').add(32, 'hour'),
        @endif
        timePicker24Hour:true,
        locale: {
          format: 'DD/MM/YYYY hh:mm:ss'
        }
      });

      $('select[name="type"]').on('change', function(){
          if($(this).val()=='B'){
              $('.limit').css('visibility', 'hidden');
          }else{
              $('.limit').css('visibility', 'visible');
          }
      });

      if($('select[name="type"]').val()=='B'){
        $('.limit').css('visibility', 'hidden');
      }
   });
});


</script>
@endsection
