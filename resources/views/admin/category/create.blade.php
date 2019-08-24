@extends('layouts.backend.app')

@section('title', 'question')

@push('css')

    <link href="{{asset('assests/backend/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
@endpush

@section('content')

   <div class="container-fluid">

        <!-- Vertical Layout | With Floating Label -->
        <div class="row clearfix">
             <form class="was-validated" action="{{route('admin.category.store')}}" method="POST">
            @csrf
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 col-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    CREATE A NEW CATEGORY
                                    <small>Category/create</small>
                                </h2>

                            </div>
                            <div class="body">
                                @if($errors->any())
                                    @foreach($errors->all() as $error)
                                        <div class="alert alert-warning alert-dismissible" role="alert">
                                            <strong>Opps Sorry!</strong> {{$error}}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endforeach
                                @endif

                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="name" id="category" class="form-control" required>
                                            <label class="form-label">Category Name</label>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">SAVE</button>
                                    <a href="{{route('admin.category.index')}}" class="btn btn-warning m-t-15 waves-effect">BACK</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- Vertical Layout | With Floating Label -->

    </div>

@endsection


@push('js')

@endpush
