<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-static-top">
  <div class="container">
    <!-- Branding Image -->
    <a class="navbar-brand " href="{{ url('/') }}">
      LaraBBS
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Left Side Of Navbar -->
      <ul class="navbar-nav mr-auto">
          <li class="nav-item {{active_class(if_route('topic.index'))}}"> <a href="{{route('topics.index')}}" class='nav-link' >话题</a> </li>
          <li class="nav-item {{nav_active(1)}}"> <a href="{{route('categories.show',1)}}" class='nav-link' >分享</a> </li>
          <li class="nav-item {{nav_active(2)}}"> <a href="{{route('categories.show',2)}}" class='nav-link' >教程</a> </li>
          <li class="nav-item {{nav_active(3)}}"> <a href="{{route('categories.show',3)}}" class='nav-link' >问答</a> </li>
          <li class="nav-item {{nav_active(4)}}"> <a href="{{route('categories.show',4)}}" class='nav-link' >公告</a> </li>
      </ul>

      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav navbar-right">
        <!-- Authentication Links -->
        @guest
          <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">登录</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">注册</a></li>
        @else
          <li class="nav-item">
            <a href="{{route('topics.create')}}" class='nav-link mt-1 mr-3 font-weight-blod'>
            <i class="fa fa-plus"></i>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="{{Auth::user()->avator}}" class="img-responsive img-circle" width="30px" height="30px">
              {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{route('users.show',Auth::id())}}"> <i class='fa fa-user mr-2'></i> 个人中心</a>
              <div class='dropdown-divider'></div>
              <a class="dropdown-item" href="{{route('users.edit',Auth::id())}}"> <i class='fa fa-edit mr-2'></i> 编辑资料</a>
              <div class="dropdown-divider"></div>

              <a class="dropdown-item" id="logout" href="#">
                <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('确定退出？')">
                  {{ csrf_field() }}
                  <button class="btn btn-block btn-danger" type="submit" name="button">退出</button>
                </form>
              </a>
            </div>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>