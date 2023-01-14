@extends('admin::layouts.master')
@section('title') إضافة محاضرة @endsection
@section('css')
    <link href="{{URL::asset('libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{URL::asset('libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet"> --}}
    {{-- <link href="{{URL::asset('libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css')}}" rel="stylesheet"> --}}
    <link href="{{URL::asset('libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" />
    {{-- <link href="{{asset('libs/dropify/dist/css/dropify.min.css')}}" rel="stylesheet" type="text/css" /> --}}
@endsection
@section('content')
 @component('admin::common-components.breadcrumb')
         @slot('title') المحاضرات  @endslot
         @slot('li_1') إضافة محاضرة  @endslot
 @endcomponent
 @if($errors->any())
     <div class="alert alert-danger" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
         @foreach ($errors->all() as $error)
             <li>{{ $error }}</li>
         @endforeach
     </div>
 @endif
 <form method="POST" action="{{route('admin.session.store')}}" enctype="multipart/form-data"  data-parsley-validate novalidate>
     @csrf
     @method('POST')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="control-label">عنوان المحاضرة</label>
                            <input required type="text" class="form-control"  name="title" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">الباب</label>
                            <select name="chapter_id" class="form-control select2">
                                @foreach ($chapters as $chapter)
                                    <option  value="{{$chapter->id}}">{{$chapter->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">الوصف</label>
                            <textarea required name="description" class="form-control"></textarea>
                        </div>
                        @if($course->type=='online')
                            <div class="form-group">
                                <label class="control-label">الرابط</label>
                                <input type="url" class="form-control" name="media_link"   />
                            </div>
                        @endif
                        <div class="form-group">
                            <label class="control-label">المدة الزمنية</label>
                            <input type="number" class="form-control" name="duration"   />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <button class="btn btn-primary waves-effect waves-light mr-12" type="submit">
                    إضافة
                </button>
            </div>
        </div>
    </form>
<!-- end row -->


<!-- end row -->
@endsection

@section('script')

    <script src="{{URL::asset('/libs/select2/select2.min.js')}}"></script>
    {{-- <script src="{{URL::asset('/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script> --}}
{{--    <script src="{{URL::asset('/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js')}}"></script>--}}
    <script src="{{URL::asset('/libs/bootstrap-touchspin/bootstrap-touchspin.min.js')}}"></script>
    <script src="{{URL::asset('/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>

<script src="{{URL::asset('/js/pages/form-advanced.init.js')}}"></script>

{{-- <script src="{{asset('/libs/dropify/dist/js/dropify.min.js')}}"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/js/bootstrap-material-datetimepicker.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/js/bootstrap-material-datetimepicker.min.js"></script> --}}

