@extends('layouts.backend.app')

@section('title', 'Tags')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{asset('assests/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
@endpush

@section('content')

    <div class="container-fluid">
        <div class="block-header">
            <h2>
               <a class="btn btn-primary" href="{{route('admin.question.create')}}">ADD NEW QUESTION</a>
            </h2>
        </div>

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            SHOW ALL QUESTIONS
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">

                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>S/L</th>
                                    <th>Question</th>
                                    <th>Created at</th>
                                    <th>Update at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>S/L</th>
                                    <th>Question</th>
                                    <th>Created at</th>
                                    <th>Update at</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($question as $i=>$value)
                                    <tr id="delete_{{$value->id}}">
                                        <td>{{$i+1}}</td>
                                        <td>{{$value->title}}</td>
                                        <td>{{$value->created_at}}</td>
                                        <td>{{$value->updated_at}}</td>
                                        <td>
                                            <a data-route="{{route('admin.question.destroy',$value->id)}}" class="deleteQuesClass btn btn-sm btn-outline-info" ><i class="fa fa-trash-o"></i></a>
                                                @csrf
                                                @method('DELETE')
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>

@endsection

@push('js')
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{asset('assests/backend/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assests/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('assests/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assests/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
    <script src="{{asset('assests/backend/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
    <script src="{{asset('assests/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
    <script src="{{asset('assests/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
    <script src="{{asset('assests/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assests/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>

    <script src="{{asset('assests/backend/js/pages/tables/jquery-datatable.js')}}"></script>

{{--    start delete question section--}}
    <script>
        $(".deleteQuesClass").on('click', function () {
            if(!confirm('Are you sure?')) return false;
            var route = $(this).data('route');
            var token = $('input[name=_token]').val();
            $.ajax({
                type:'DELETE',
                url:route,
                data:{
                    _token:token,
                },
                success:function (data) {
                    $("#delete_"+data).remove();
                }
            });
        });
    </script>
    {{--    end delete question section--}}
@endpush
