@extends('backend.layouts.master')

@section('title') E-Mail Template @endsection

@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">E-Mail Template</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Backend</a></li>
                    <li class="breadcrumb-item active">E-Mail Template</li>
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
                <form action="{{ route('backend.email-template.store') }}" method="POST" autocomplete="off">
                @else
                <form action="{{ route('backend.email-template.update', $sRow->id ) }}" method="POST" autocomplete="off">
                <input name="_method" type="hidden" value="PUT">
                @endif
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-9">
                        <div class="form-group">
                            <label class="control-label">Subject :</label>
                            <input type="text" class="form-control" name="subject" value="{{ isset($sRow)?$sRow->subject:'' }}" required/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Full Description : </label>
                            <textarea class="form-control" name="fulltext">{{ $sRow->fulltext }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Mail To : <sub>เมื่อเป็นเมล์ที่ส่งให้แอนมินให้ระบุ</sub></label>
                            <input type="text" class="form-control" name="to" value="{{ isset($sRow)?$sRow->to:'' }}"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Mail CC : <sub>เมื่อต้องการส่งให้แอนมินด้วยให้ระบุ</sub></label>
                            <input type="text" class="form-control" name="cc" value="{{ isset($sRow)?$sRow->cc:'' }}"/>
                        </div>


                        <div class="form-group mb-0 row">
                            <div class="col-md-6">
                                <a class="btn btn-secondary waves-effect" href="{{ route('backend.email-template.index') }}">
                                  <i class="bx bx-arrow-back font-size-16 align-middle mr-1"></i> ย้อนกลับ
                                </a>
                            </div>
                            <div class="col-md-6 text-right">
                                <button type="submit" class="btn btn-primary waves-effect">
                                  <i class="bx bx-save font-size-16 align-middle mr-1"></i> บันทึกข้อมูล
                                </button>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-3">

                      <div class="form-group m-l-10">
                        <label>เมล์สำหรับทดสอบรับ :</label>
                        <input type="email" class="form-control" name="receiver" value="{{ $sRow->receiver }}">
                      </div>

                      <div class="form-group m-l-10">
                        <label>ตัวแปลที่สามารถใช้ได้ :</label>
                        <br/>
                        @if (strpos($sRow->scopes, 'customer') !== false)
                        <b>ข้อมูลสมาชิก</b>
                        <table class="codeinput">
                          <tr>
                            <td><input value="@{{$username}}" type="text" class="form-control w100" readonly> </td>
                            <td><input value="username" type="text" class="form-control" readonly> </td>
                          </tr>
                          <tr>
                            <td><input value="@{{$fullname}}" type="text" class="form-control w100" readonly> </td>
                            <td><input value="fullname" type="text" class="form-control" readonly> </td>
                          </tr>
                          <tr>
                            <td><input value="@{{$fullname}}" type="text" class="form-control w100" readonly> </td>
                            <td><input value="fullname" type="text" class="form-control" readonly> </td>
                          </tr>
                          <tr>
                            <td><input value="@{{$subscribe}}" type="text" class="form-control w100" readonly> </td>
                            <td><input value="url unsubscribe " type="text" class="form-control" readonly> </td>
                          </tr>
                        </table>
                        @endif

                        @if (strpos($sRow->scopes, 'order') !== false)
                        <b>ข้อมูลออเดอร์</b>
                        <table class="codeinput">
                          <tr>
                            <td class="w175"><input value="@{{$orderNo}}" type="text" class="form-control" readonly> </td>
                            <td><input value="เลขออเดอร์" type="text" class="form-control" readonly> </td>
                          </tr>
                          <tr>
                            <td><input value="@{{$orderDate}}" type="text" class="form-control" readonly> </td>
                            <td><input value="วันที่สั่งซื้อ" type="text" class="form-control" readonly> </td>
                          </tr>
                          <tr>
                            <td><input value="@{{$orderShippingName}}" type="text" class="form-control" readonly> </td>
                            <td><input value="ชื่อ" type="text" class="form-control" readonly> </td>
                          </tr>
                          <tr>
                            <td><input value="@{{$orderShippingAddress}}" type="text" class="form-control" readonly> </td>
                            <td><input value="ที่อยู่" type="text" class="form-control" readonly> </td>
                          </tr>
                          <tr>
                            <td><input value="@{{$orderShippingTel}}" type="text" class="form-control" readonly> </td>
                            <td><input value="เบอร์ติดต่อ" type="text" class="form-control" readonly> </td>
                          </tr>
                          <tr>
                            <td><input value="@{{$orderShippingEmail}}" type="text" class="form-control" readonly> </td>
                            <td><input value="อีเมล์" type="text" class="form-control" readonly> </td>
                          </tr>
                          <tr>
                            <td><input value="@{{$orderShippingMethod}}" type="text" class="form-control" readonly> </td>
                            <td><input value="การจัดส่ง" type="text" class="form-control" readonly> </td>
                          </tr>
                          <tr>
                            <td><input value="@{{$orderCoupon}}" type="text" class="form-control" readonly> </td>
                            <td><input value="Coupon" type="text" class="form-control" readonly> </td>
                          </tr>
                          <tr>
                            <td><input value="@{{$orderSubTotal}}" type="text" class="form-control" readonly> </td>
                            <td><input value="SubTotal" type="text" class="form-control" readonly> </td>
                          </tr>
                          <tr>
                            <td><input value="@{{$orderDiscount}}" type="text" class="form-control" readonly> </td>
                            <td><input value="Discount" type="text" class="form-control" readonly> </td>
                          </tr>
                          <tr>
                            <td><input value="@{{$orderShipping}}" type="text" class="form-control" readonly> </td>
                            <td><input value="Shipping" type="text" class="form-control" readonly> </td>
                          </tr>
                          <tr>
                            <td><input value="@{{$orderTotal}}" type="text" class="form-control" readonly> </td>
                            <td><input value="Total" type="text" class="form-control" readonly> </td>
                          </tr>
                          <tr>
                            <td><input value="@{{$orderTracking}}" type="text" class="form-control" readonly> </td>
                            <td><input value="Tracking" type="text" class="form-control" readonly> </td>
                          </tr>
                          <tr>
                            <td><input value="@{{$orderTrackingUrl}}" type="text" class="form-control" readonly> </td>
                            <td><input value="Tracking kerry url" type="text" class="form-control" readonly> </td>
                          </tr>
                        </table>
                        @endif

                      </div>

                      <div class="form-group m-l-10  m-b-10" style="font-size: 12px;color: red;">
                        ต้องบันทึกข้อมูลก่อนการทดสอบ<br/>หากทดสอบแล้ว error กรุณาตรวจสอบตัวแปล
                      </div>
                        <div class="form-group mb-0 row">
                            <div class="col-md-6">
                                <a class="btn btn-primary waves-effect" href="{{ route('backend.email-template.show',$sRow->id) }}">
                                  ตัวอย่างก่อนส่ง
                                </a>
                            </div>
                            <div class="col-md-6 text-right">
                                <button type="button" class="btn btn-warning cAjax" data-url="{{ route('backend.email-template.test',$sRow->id) }}">
                                  ทดสอบส่งเมล์
                                </button>
                            </div>
                        </div>

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
<style>
.codeinput input{
  padding:3px 0px;height:auto;background-color:transparent !important;border:transparent;
}
</style>
@endsection

@section('script')
<script>
$(function() {
  CKEDITOR.replace( 'fulltext', {allowedContent: true,height:1000} );
});
</script>
@endsection
