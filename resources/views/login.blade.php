<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="/css/app.css"> 
  <link rel="stylesheet" href="/css/login.css"> 
  <title>Авторизация</title>
</head>

<body>
  <div class="form">

      @if(session('info'))
        <div class="alert alert-info fade in" role="alert">
            {{ session('info') }}
            <button class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
      @endif
      
      <ul class="tab-group">
        <li class="tab active"><a href="#signup">Регистрация</a></li>
        <li class="tab"><a href="#login">Войти</a></li>
      </ul>
      
      <div class="tab-content">
        <div id="signup">   
          
          <form action="/signup" method="post">
            {{ csrf_field() }}

          <div class="top-row">

            <div class="field-wrap">
              <label>
                Имя пользователя<span class="req">*</span>
              </label>
              <input type="text" name="username" required autocomplete="off" />
              @if($errors->has('username'))
                <span class="help-block">{{ $errors->first('username') }}</span>
              @endif
            </div>
        
            <div class="field-wrap">
              <label>
                Email адрес<span class="req">*</span>
              </label>
              <input type="email" name="email" required autocomplete="off"/>
              @if($errors->has('email'))
                <span class="help-block">{{ $errors->first('email') }}</span>
              @endif
            </div>
          </div>

          <div class="field-wrap">
            <label>
              Пароль<span class="req">*</span>
            </label>
            <input type="password" name="password" required autocomplete="off"/>
            @if($errors->has('password'))
                <span class="help-block">{{ $errors->first('password') }}</span>
              @endif
          </div>
          
          <button type="submit" class="button button-block"/>Зарегистрироваться</button>
          
          </form>

        </div>

        <div id="login">   
          
          <form action="/signin" method="post">
            {{ csrf_field() }}
          
            <div class="field-wrap">
            <label>
              Email адрес<span class="req">*</span>
            </label>
            <input type="email" name="email" required autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Пароль<span class="req">*</span>
            </label>
            <input type="password" name="password" required autocomplete="off"/>
          </div>
          
          <button class="button button-block"/>Войти</button>
          
          </form>

        </div>
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->

    <script  src="/js/app.js"></script>
    <script  src="/js/index.js"></script>

</body>
</html>
