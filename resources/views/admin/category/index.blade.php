@extends('layouts.backend.app')

@section('title', 'Tags')

@push('css')
    <!-- JQuery DataTable Css -->
    <link href="{{asset('assests/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
@endpush

@section('content')

    <div class="container-fluid">
        <div class="block-header">
            <h2>
               <a class="btn btn-primary" href="{{route('admin.category.create')}}">CREATE NEW CATEGORY</a>
            </h2>
        </div>

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            SHOW ALL CATEGORIES
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
                                    <th>Category Name</th>
                                    <th>Created at</th>
                                    <th>Update at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>S/L</th>
                                    <th>Category Name</th>
                                    <th>Created at</th>
                                    <th>Update at</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($categories as $i=>$value)
                                    <tr id="row_{{$value->id}}">
                                        <td>{{$i+1}}</td>
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->created_at}}</td>
                                        <td>{{$value->updated_at}}</td>
                                        <td>
                                            {{--  <a href="{{route('admin.category.edit',$value->id)}}" class="btn btn-primary disabled" style="float:left; margin-right: 5px; margin-bottom: 5px;">Edit</a>--}}
                                            <button data-route="{{ route('admin.category.destroy',$value->id) }}" class="deleteCategoryBtn btn btn-sm btn-danger" type="button" name="button"> <i class="material-icons">delete_sweep</i></button>
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

{{--  start  delete category section--}}
    <script>
        $(".deleteCategoryBtn").on('click', function () {
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
                    $("#row_"+data).remove();
                }
            })
        })
    </script>
{{--  end  delete category section--}}
@endpush
