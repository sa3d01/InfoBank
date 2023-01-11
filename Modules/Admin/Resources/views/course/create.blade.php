@extends('admin::layouts.master')
@section('title') إضافة دورة @endsection
@section('css')
    <link href="{{URL::asset('libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" />
    <link href="{{asset('libs/dropify/dist/css/dropify.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
 @component('admin::common-components.breadcrumb')
         @slot('title') الدورات  @endslot
         @slot('li_1') إضافة دورة  @endslot
 @endcomponent
 @if($errors->any())
     <div class="alert alert-danger" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
         @foreach ($errors->all() as $error)
             <li>{{ $error }}</li>
         @endforeach
     </div>
 @endif
 <form method="POST" action="{{route('admin.course.store')}}" enctype="multipart/form-data"  data-parsley-validate novalidate>
     @csrf
     @method('POST')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="control-label">الفئة</label>
                            <select name="for" class="form-control select2">
                                <option  value="managers">المدراء</option>
                                <option  value="employees">الموظفين</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label">نوع الدورة</label>
                            <select name="type" id="course_type" class="form-control select2">
                                <option value="online">دورة اونلاين</option>
                                <option value="offline">دورة حضورية</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label">العنوان</label>
                            <input required type="text" class="form-control"  name="title" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">الوصف</label>
                            <textarea required name="description" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label">مميزات الدورة</label>
                            <textarea required name="features" class="form-control"></textarea>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="cover">صورة تعبيرية عن الدورة</label>
                                    <div class="card-box">
                                        <input name="cover" id="input-file-now-custom-11 cover" type="file" accept="image/*" class="dropify" />
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label">اسم الشركة المقدمة</label>
                            <input required type="text" class="form-control"  name="company_name" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">وصف الشركة المقدمة</label>
                            <textarea required name="company_desc" class="form-control"></textarea>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="company_logo">لوجو الشركة المقدمة</label>
                                    <div class="card-box">
                                        <input name="company_logo" id="input-file-now-custom-10 company_logo" type="file" accept="image/*" class="dropify" />
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div id="offline" hidden  class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label class="control-label">الموقع</label>
                                <div class="form-group">
                                    <label class="control-label">مسمي توضيحي لموقع الدورة</label>
                                    <input type="text" class="form-control" maxlength="50" name="location_title" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label">نوع الموقع</label>
                                    <select name="location_type" class="form-control select2">
                                        <option  value="location_online">اونلاين لينك</option>
                                        <option  value="location_map">موقع جغرافي</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                <label class="control-label">اللينك او احداثيات الموقع</label>
                                <input value="24.798506,47.125380" type="text" class="form-control" name="location" />
                            </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">تاريخ البداية والنهاية</label>
                                <div class="form-group">
                                    <label class="control-label">تاريخ البداية</label>
                                    <input type="date" id="example-date-input" class="form-control" name="start_date">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">تاريخ النهاية</label>
                                    <input type="date" id="example-date-input" class="form-control" name="end_date">
                                </div>
                            </div>
                        </div>
                    </div>


            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="image">الملفات التدعيمية - صورة</label>
                            <div class="card-box">
                                <label for="image_title">عنوان الملف</label>
                                <input type="text" class="form-control"  name="image_title" />
                            </div>
                            <div class="card-box">
                                <input name="image" id="input-file-now-custom-1 image" type="file" accept="image/*" class="dropify" />
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="pdf">الملفات التدعيمية - pdf</label>
                            <div class="card-box">
                                <label for="pdf_title">عنوان الملف</label>
                                <input type="text" class="form-control"  name="pdf_title" />
                            </div>
                            <div class="card-box">
                                <input name="pdf" id="input-file-now-custom-2 pdf" type="file"  accept="application/pdf" class="dropify" />
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="excel">الملفات التدعيمية - excel</label>
                            <div class="card-box">
                                <label for="excel_title">عنوان الملف</label>
                                <input type="text" class="form-control"  name="excel_title" />
                            </div>
                            <div class="card-box">
                                <input name="excel" id="input-file-now-custom-3 excel" type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" class="dropify" />
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="word">الملفات التدعيمية - word</label>
                            <div class="card-box">
                                <label for="word_title">عنوان الملف</label>
                                <input type="text" class="form-control"  name="word_title" />
                            </div>
                            <div class="card-box">
                                <input name="word" id="input-file-now-custom-4 word" type="file"  accept="application/msword,
text/plain" class="dropify" />
                            </div>
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
    <script src="{{URL::asset('/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
{{--    <script src="{{URL::asset('/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js')}}"></script>--}}
    <script src="{{URL::asset('/libs/bootstrap-touchspin/bootstrap-touchspin.min.js')}}"></script>
    <script src="{{URL::asset('/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>

<script src="{{URL::asset('/js/pages/form-advanced.init.js')}}"></script>

<script src="{{asset('/libs/dropify/dist/js/dropify.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/js/bootstrap-material-datetimepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/js/bootstrap-material-datetimepicker.min.js"></script>
<script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();
        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove: 'Supprimer',
                error: 'Désolé, le fichier trop volumineux'
            }
        });
        // Used events
        var drEvent = $('#input-file-events').dropify();
        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });
        drEvent.on('dropify.afterClear', function(event, element) {
            alert('File deleted');
        });
        drEvent.on('dropify.errors', function(event, element) {
            console.log('Has Errors');
        });
        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });
</script>
    <script>
        $('#course_type').change(function () {
            if ($("#course_type").val()=='offline'){
                $('#offline').removeAttr('hidden');
            }else {
                $('#offline').attr('hidden', 'hidden');
            }
        });
    </script>

@endsection
