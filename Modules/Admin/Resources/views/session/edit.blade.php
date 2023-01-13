@extends('admin::layouts.master')
@section('title') تعديل حصة @endsection
@section('css')
<link href="{{URL::asset('libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
{{--<link href="{{URL::asset('libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">--}}
{{-- <link href="{{URL::asset('libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css')}}" rel="stylesheet"> --}}
<link href="{{URL::asset('libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" />
{{--<link href="{{asset('libs/dropify/dist/css/dropify.min.css')}}" rel="stylesheet" type="text/css" />--}}
@endsection
@section('content')
 @component('admin::common-components.breadcrumb')
     @slot('title') الحصص  @endslot
     @slot('li_1') تعديل حصة  @endslot
 @endcomponent
 @if($errors->any())
     <div class="alert alert-danger" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
         @foreach ($errors->all() as $error)
             <li>{{ $error }}</li>
         @endforeach
     </div>
 @endif
 <form method="POST" action="{{route('admin.session.update',$row->id)}}" enctype="multipart/form-data" data-parsley-validate novalidate>
     @csrf
     @method('PUT')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="control-label">العنوان</label>
                            <input value="{{$row->title}}" required type="text" class="form-control"  name="title" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">الباب</label>
                            <select name="chapter_id" class="form-control select2">
                                @foreach ($chapters as $chapter)
                                    <option @if($row->chapter_id==$chapter->id) selected @endif  value="{{$chapter->id}}">{{$chapter->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">الوصف</label>
                            <textarea required name="description" class="form-control">{{$row->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label">الرابط</label>
                            <input value="{{$row->media_link}}" type="url" class="form-control" name="media_link"   />
                        </div>
                        <div class="form-group">
                            <label class="control-label">المدة الزمنية</label>
                            <input value="{{$row->duration}}" type="number" class="form-control" name="duration"   />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <button class="btn btn-primary waves-effect waves-light mr-12" type="submit">
                    تعديل
                </button>
            </div>
        </div>
    </form>
<!-- end row -->


<!-- end row -->
@endsection

@section('script')

<script src="{{URL::asset('/libs/select2/select2.min.js')}}"></script>
{{--<script src="{{URL::asset('/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>--}}
{{-- <script src="{{URL::asset('/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js')}}"></script> --}}
<script src="{{URL::asset('/libs/bootstrap-touchspin/bootstrap-touchspin.min.js')}}"></script>
<script src="{{URL::asset('/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>

<!-- form advanced init -->
<script src="{{URL::asset('/js/pages/form-advanced.init.js')}}"></script>

{{--<script src="{{asset('/libs/dropify/dist/js/dropify.min.js')}}"></script>--}}
{{--<script>--}}
{{--    $(document).ready(function() {--}}
{{--        // Basic--}}
{{--        $('.dropify').dropify();--}}
{{--        // Translated--}}
{{--        $('.dropify-fr').dropify({--}}
{{--            messages: {--}}
{{--                default: 'Glissez-déposez un fichier ici ou cliquez',--}}
{{--                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',--}}
{{--                remove: 'Supprimer',--}}
{{--                error: 'Désolé, le fichier trop volumineux'--}}
{{--            }--}}
{{--        });--}}
{{--        // Used events--}}
{{--        var drEvent = $('#input-file-events').dropify();--}}
{{--        drEvent.on('dropify.beforeClear', function(event, element) {--}}
{{--            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");--}}
{{--        });--}}
{{--        drEvent.on('dropify.afterClear', function(event, element) {--}}
{{--            alert('File deleted');--}}
{{--        });--}}
{{--        drEvent.on('dropify.errors', function(event, element) {--}}
{{--            console.log('Has Errors');--}}
{{--        });--}}
{{--        var drDestroy = $('#input-file-to-destroy').dropify();--}}
{{--        drDestroy = drDestroy.data('dropify')--}}
{{--        $('#toggleDropify').on('click', function(e) {--}}
{{--            e.preventDefault();--}}
{{--            if (drDestroy.isDropified()) {--}}
{{--                drDestroy.destroy();--}}
{{--            } else {--}}
{{--                drDestroy.init();--}}
{{--            }--}}
{{--        })--}}
{{--    });--}}
{{--</script>--}}
@endsection
