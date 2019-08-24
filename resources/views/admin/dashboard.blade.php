@extends('layouts.backend.app')

@section('title', 'AdminBoard')

@push('css')
@endpush

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <h2>DASHBOARD</h2>
        </div>
    </div>
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
