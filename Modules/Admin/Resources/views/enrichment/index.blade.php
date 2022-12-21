@extends('admin::layouts.master')
@section('title') عرض الكل @endsection
@section('css')
    <link href="{{ URL::asset('/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('admin::common-components.breadcrumb')
        @slot('title') الاثراءات  @endslot
        @slot('li_1') عرض الكل  @endslot
    @endcomponent
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{route('admin.enrichment.create')}}">
                        <button type="button" class="btn btn-block btn-sm btn-success waves-effect waves-light">إضافة </button>
                    </a>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>العنوان</th>
                            <th>الوصف</th>
                            <th>الرابط</th>
                            <th>مفعل</th>
                            <th>تعديل</th>
                            <th>حذف</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($rows as $row)
                            <tr>
                                <td>{{$row->title}}</td>
                                <td>{{$row->description}}</td>
                                <td>
                                    @php(preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user|shorts)\/))([^\?&\"'>]+)/", $row->media_link, $matches))
                                    <iframe src="https://www.youtube.com/embed/{{$matches[1]}}" height="200" width="300" title="{{$row->title}}"></iframe>
                                </td>
                                <td>
                                    <div class="button-list">
                                        @if($row->banned==0)
                                            <button data-id="{{$row->id}}" data-href="{{ route('admin.enrichment.ban',$row->id) }}" class="ban btn btn-danger waves-effect waves-light">
                                                <i class="fa fa-archive mr-1"></i> <span>حظر</span>
                                            </button>
                                        @else
                                            <button data-id="{{$row->id}}" data-href="{{ route('admin.enrichment.activate',$row->id) }}" class="activate btn btn-success waves-effect waves-light">
                                                <i class="fa fa-user-clock mr-1"></i> <span>تفعيل</span>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="button-list">
                                        <a href="{{route('admin.enrichment.edit',$row->id)}}">
                                            <button class="btn btn-warning waves-effect waves-light">
                                                <i class="fa fa-pen mr-1"></i> <span>تعديل</span>
                                            </button>
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="button-list">
                                        <form class="delete" data-id="{{$row->id}}" method="POST" action="{{ route('admin.enrichment.destroy',[$row->id]) }}">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <input type="hidden" value="{{$row->id}}">
                                            <button type="button" class="btn p-0 no-bg">
                                                <i class="fa fa-trash text-danger"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
@endsection
@section('script')
    <!-- Required datatable js -->
    <script src="{{ URL::asset('/libs/datatables/datatables.min.js')}}"></script>
    <script src="{{ URL::asset('/libs/jszip/jszip.min.js')}}"></script>
    <script src="{{ URL::asset('/libs/pdfmake/pdfmake.min.js')}}"></script>
    <!-- Datatable init js -->
    <script src="{{ URL::asset('/js/pages/datatables.init.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        $(document).on('click', '.ban', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: "تأكيد عملية الحظر ؟",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn-danger',
                confirmButtonText: 'نعم !',
                cancelButtonText: 'ﻻ , الغى العملية!',
                closeOnConfirm: false,
                closeOnCancel: false,
                preConfirm: () => {
                    $.ajax({
                        url: $(this).data('href'),
                        type:'GET',
                    })
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then(() => {
                location.reload();
            })
        });
        $(document).on('click', '.activate', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: "تأكيد عملية التفعيل ؟",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn-danger',
                confirmButtonText: 'نعم !',
                cancelButtonText: 'ﻻ , الغى العملية!',
                closeOnConfirm: false,
                closeOnCancel: false,
                preConfirm: () => {
                    $.ajax({
                        url: $(this).data('href'),
                        type:'GET',
                    })
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then(() => {
                location.reload();
            })
        });
    </script>
    <script>
        $(document).on('click', '.delete', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: "هل انت متأكد من الحذف ؟",
                text: "لن تستطيع استعادة هذا العنصر مرة أخرى!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn-danger',
                confirmButtonText: 'نعم , قم بالحذف!',
                cancelButtonText: 'ﻻ , الغى عملية الحذف!',
                closeOnConfirm: false,
                closeOnCancel: false,
                preConfirm: () => {
                    $("form[data-id='" + id + "']").submit();
                },
                allowOutsideClick: () => !Swal.isLoading()
            })
        });
    </script>
@endsection
