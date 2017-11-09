<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ route('home') }}">Simple</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      @if (Auth::check())
      <div class="col-sm-6">
        <form class="navbar-form" action="{{ route('search.results') }}">
          <div class="input-group">
            <input type="text" name="query" autocomplete="off" class="form-control">
            <div class="input-group-btn">
              <button type="submit" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-search"></i></button>
            </div>
          </div>
        </form>
        </div>
      @endif
      <ul class="nav navbar-nav navbar-right">
        @if (Auth::check())
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->getFirstNameOrUserName() }} <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="{{ route('profile.edit') }}">Изменить профиль</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="{{ route('auth.signout') }}">Выйти</a></li>
            </ul>
          </li>
        @endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>