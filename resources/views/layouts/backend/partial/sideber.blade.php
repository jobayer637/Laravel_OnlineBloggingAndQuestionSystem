<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            @if(Auth::user()->avatar=="profile.jpg")
            <img src="http://localhost:8000/storage/profile/{{Auth::user()->image}}" width="48" height="48" alt="User" />
            @else
            <img src="{{Auth::user()->avatar}}" width="48" height="48" alt="User" />
            @endif
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}</div>
            <div class="email">{{Auth::user()->email}}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                    <li role="separator" class="divider"></li>
                    <li>
                      <a class="dropdown-item" href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                          <i class="material-icons">input</i>
                          {{ __('Logout') }}
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            @if(Request::is('admin*'))
                <li class="{{Request::is('admin/dashboard')?'active':''}}">
                    <a href="{{route('admin.dashboard')}}">
                        <i class="material-icons">video_label</i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="{{Request::is('admin/user*')?'active':''}}">
                    <a href="{{route('admin.user.index')}}">
                        <i class="material-icons">people</i>
                        <span>Users</span>
                    </a>
                </li>

                <li class="{{Request::is('admin/blog*')?'active':''}}">
                    <a href="{{route('admin.blog.index')}}">
                        <i class="material-icons">view_list</i>
                        <span>Blog</span>
                    </a>
                </li>

                <li class="{{Request::is('admin/question*')?'active':''}}">
                    <a href="{{route('admin.question.index')}}">
                        <i class="material-icons">help</i>
                        <span>Question</span>
                    </a>
                </li>



                <li class="{{Request::is('admin/category*')?'active':''}}">
                    <a href="{{route('admin.category.index')}}">
                        <i class="material-icons">flip_to_back</i>
                        <span>Categories</span>
                    </a>
                </li>


                <li class="header">SYSTEM</li>

                </li>
                <li title="{{Auth::user()->name}}">
                    <a  href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">

                        <i class="material-icons">input</i>
                        <span>Logout</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>

            @endif

            @if(Request::is('author*'))

            @endif

        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            {{date("Y")}} &copy; Developed by Jobayer Hossain
        </div>
    </div>
    <!-- #Footer -->
</aside>
