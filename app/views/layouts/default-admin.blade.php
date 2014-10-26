<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Ragnarok Admin</title>
    {{ HTML::style('css/application.css') }}
    {{ HTML::style('css/connect_pages.css') }}
    {{ HTML::style('css/admin.css') }}
    {{ HTML::style('css/users.css') }}
    {{ HTML::script('js/jquery-1.11.1.min.js') }}
  </head>
  <body>
    <div id="body-wrapper">

      <header class="header-admin">
        <div id="logo-wrapper-admin" class="block">
          {{ HTML::image('images/logo.png', 'Connect Logo', array('class' => 'centered')) }}
        </div>
      </header>

      <div id="content" class="block">
        @yield('content-admin')
      </div>

      <footer class="block footer-admin">
        <span class="centered">&copy; 2014 Connect. All Rights Reserved.</span>
      </footer>

    </div>
  </body>
</html>