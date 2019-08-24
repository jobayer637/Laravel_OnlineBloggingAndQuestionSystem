<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars mr-4"></a>
            <a class="btn btn-danger mr-4 pr-4" href="index.html">{{Auth::user()->role_id==1?'ADMIN DASHBOARD':'AUTHOR DASHBOARD'}}</a><strong></strong>
            <a class="btn btn-warning" href="{{route('home')}}">Home page</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <!-- Call Search -->
                <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                <!-- #END# Call Search -->
            </ul>
        </div>
    </div>
</nav>
