@extends('admin::layouts.master')
@section('title') Edit Brand @endsection
@section('css')
<link href="{{URL::asset('libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" />
<link href="{{asset('libs/dropify/dist/css/dropify.min.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
 @component('admin::common-components.breadcrumb')
     @slot('title') Brands  @endslot
     @slot('li_1') Edit Brand  @endslot
 @endcomponent
 @if($errors->any())
     <div class="alert alert-danger" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
         @foreach ($errors->all() as $error)
             <li>{{ $error }}</li>
         @endforeach
     </div>
 @endif
 <form method="POST" action="{{route('admin.brand.update',$row->id)}}" enctype="multipart/form-data" data-parsley-validate novalidate>
     @csrf
     @method('PUT')
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="control-label">Name of brand ar</label>
                            <input value="{{$row->title_ar}}" required type="text" class="form-control"  name="title_ar" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Description of brand ar</label>
                            <textarea required name="description_ar" class="form-control">{!! $row->description_ar !!}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Commercial name</label>
                            <input value="{{$row->commercial_name}}" required type="text" class="form-control" name="commercial_name"  />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Start contract</label>
                            <input value="{{$row->start_contract}}" type="date" id="example-date-input" class="form-control" name="start_contract">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Mobile</label>
                            <input value="{{$row->mobile}}" required type="text" class="form-control" name="mobile"   />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Website</label>
                            <input value="{{$row->website}}" type="url" class="form-control" name="website"   />
                        </div>
                        <div class="form-group">
                            <label class="control-label">instagram</label>
                            <input value="{{$row->insta}}" type="url" class="form-control" name="insta"   />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Twitter</label>
                            <input value="{{$row->twitter}}" type="url" class="form-control" name="twitter"   />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="control-label">Name of brand en</label>
                            <input value="{{$row->title_en}}" required type="text" class="form-control"  name="title_en" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Description of brand en</label>
                            <textarea required name="description_en" class="form-control">{!! $row->description_en !!}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Commercial number</label>
                            <input value="{{$row->commercial_num}}" required type="text" class="form-control" name="commercial_num"  />
                        </div>
                        <div class="form-group">
                            <label class="control-label">End contract</label>
                            <input value="{{$row->end_contract}}" type="date" id="example-date-input" class="form-control" name="end_contract">
                        </div>
                        <div class="form-group">
                            <label class="control-label">phone</label>
                            <input value="{{$row->phone}}" required type="text" class="form-control" name="phone"   />
                        </div>

                        <div class="form-group">
                            <label class="control-label">Owner</label>
                            <select name="brand_owner_id" class="form-control select2">
                                <option selected value="{{$row->brand_owner_id}}">{{$row->owner->name}}</option>
                                @foreach($owners as $owner)
                                    <option value="{{$owner->id}}">{{$owner->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Location</label>
                            <select name="location_id" class="form-control select2">
                                <option selected value="{{$row->location_id}}">{{$row->location->title_ar}}</option>
                                @foreach($locations as $location)
                                    <option value="{{$location->id}}">{{$location->title_ar}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Snapchat</label>
                            <input value="{{$row->snap}}" type="url" class="form-control" name="snap"   />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="image">image</label>
                            <div class="card-box">
                                <input name="image" id="input-file-now-custom-1 image" type="file" class="dropify" data-default-file="value="{{$row->image}}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <button class="btn btn-primary waves-effect waves-light mr-12" type="submit">
                    Update
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
<script src="{{URL::asset('/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{URL::asset('/libs/bootstrap-touchspin/bootstrap-touchspin.min.js')}}"></script>
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
