@extends('layouts.backend.app')

@section('title', 'AdminBoard')

@push('css')
@endpush

@section('content')
{{--    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">--}}
{{--        <div class="">--}}
{{--            <div class="media">--}}
{{--                <div class="media-left">--}}
{{--                    <a href="javascript:void(0);">--}}
{{--                        <img class="media-object" src="{{Auth::user()->avatar}}" width="64" height="64">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="media-body">--}}
{{--                    <h4 class="media-heading">{{Auth::user()->role->name}}</h4>--}}
{{--                    <h6>{{Auth::user()->name}}</h6>--}}
{{--                    <h6>{{Auth::user()->email}}</h6>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

        <!-- Badges -->
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Online Blogging and question system
                    </h2>
                </div>
                <div class="body">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Total Users</strong> <span class="badge bg-pink">{{$user->count('id')}}</span></li>
                        <li class="list-group-item"><strong>Total Subscribers</strong> <span class="badge bg-pink">{{$subscriber->count('id')}}</span></li>
                        <li class="list-group-item"><strong>Total Blogs</strong> <span class="badge bg-cyan">{{$blog->count('id')}}</span></li>
                        <li class="list-group-item"><strong>Total Questions</strong> <span class="badge bg-teal">{{$question->count('id')}}</span></li>
                        <li class="list-group-item"><strong>Total Comments</strong> <span class="badge bg-orange">{{$comment->count('id')}}</span></li>
                        <li class="list-group-item"><strong>Total Answers</strong> <span class="badge bg-purple">{{$answer->count('id')}}</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #END# Badges -->

@endsection

@push('js')
    <!-- Jquery CountTo Plugin Js -->
    <script src="{{asset('assests/backend/plugins/jquery-countto/jquery.countTo.js')}}"></script>

    <!-- Morris Plugin Js -->
    <script src="{{asset('assests/backend/plugins/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('assests/backend/plugins/morrisjs/morris.js')}}"></script>

    <!-- ChartJs -->
    <script src="{{asset('assests/backend/plugins/chartjs/Chart.bundle.js')}}"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="{{asset('assests/backend/plugins/flot-charts/jquery.flot.js')}}"></script>
    <script src="{{asset('assests/backend/plugins/flot-charts/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('assests/backend/plugins/flot-charts/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('assests/backend/plugins/flot-charts/jquery.flot.categories.js')}}"></script>
    <script src="{{asset('assests/backend/plugins/flot-charts/jquery.flot.time.js')}}"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="{{asset('assests/backend/plugins/jquery-sparkline/jquery.sparkline.js')}}"></script>

    <script src="{{asset('assests/backend/js/pages/index.js')}}"></script>
@endpush
