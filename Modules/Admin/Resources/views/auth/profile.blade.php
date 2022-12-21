@extends('admin::layouts.master')
@section('title') تعديل بيانات الحساب @endsection
@section('css')
    <link href="{{asset('libs/dropify/dist/css/dropify.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('admin::common-components.breadcrumb')
        @slot('title') تعديل  @endslot
        @slot('li_1') الحساب الشخصي  @endslot
    @endcomponent
    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif
    <form method="POST" action="{{route('admin.profile.update')}}" enctype="multipart/form-data" data-parsley-validate novalidate>
        @csrf
        @method('PUT')
        <input hidden name="id" value="{{$row->id}}">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">البيانات العامة</h4>
                        <div class="form-group">
                            <label for="image">الصورة الشخصية</label>
                            <div class="card-box">
                                <input name="avatar" id="input-file-now-custom-1 image" type="file" class="dropify" data-default-file="{{$row->avatar}}"  />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Name</label>
                            <input required value="{{$row->name}}" type="text" class="form-control" maxlength="25" name="name" id="alloptions" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Email</label>
                            <input required value="{{$row->email}}" type="email" class="form-control"  name="email" />
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <div>
                                <input name="password" type="password" id="pass2" class="form-control" placeholder="Password" />
                            </div>
                            <div class="mt-2">
                                <input name="password_confirm" type="password" class="form-control" data-parsley-equalto="#pass2" placeholder="Re-Type Password" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <button class="btn btn-primary waves-effect waves-light mr-12" type="submit">
                    تأكيد
                </button>
            </div>
        </div>
    </form>
    <!-- end row -->


    <!-- end row -->
@endsection

@section('script')
    <script src="{{URL::asset('/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
    <!-- form advanced init -->
    <script src="{{URL::asset('/js/pages/form-advanced.init.js')}}"></script>
    <script src="{{asset('/libs/dropify/dist/js/dropify.min.js')}}"></script>
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
@endsection
