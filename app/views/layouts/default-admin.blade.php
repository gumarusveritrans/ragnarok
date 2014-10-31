<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Ragnarok Admin</title>
    {{ HTML::style('css/application.css') }}
    {{ HTML::style('css/connect_pages.css') }}
    {{ HTML::style('css/users.css') }}
    {{ HTML::script('js/jquery-1.11.1.min.js') }}
    {{ HTML::script('js/jquery-ui.min.js') }}
  </head>
  <body>
    <div id="body-wrapper">

      <header class="header-admin">
        @if (false)
          <div id="logo-admin-home" class="block">
            {{ HTML::image('images/logo_admin.png', 'Connect Logo', array('class' => 'centered')) }}
          </div>
        @else
          <div id="logo-wrapper" class="block">
            {{ HTML::image('images/logo_admin.png', 'Connect Logo', array('class' => 'centered')) }}
          </div>
          <div id="admin" class="block menu-wrapper">
            <ul class="centered-header">
              <li>{{ link_to ("/admin/dashboard", 'DASHBOARD') }}</li>
              <li>{{ link_to ("/admin/notification", 'NOTIFICATION') }}</li>
              <li>{{ link_to ("/admin/manage-user", 'MANAGE USER') }}</li>
              <li>{{ link_to ("/admin/destroy", 'LOG OUT') }}</li>
            </ul>
          </div>
          <div id="welcome-wrapper" class="admin block">
            <font color="#BDCAD2">Welcome,</font> Admin123
          </div>
        @endif
      </header>

      <div id="content" class="block">
        @yield('content-admin')
      </div>

      <footer class="footer-admin block">
        <span class="centered">&copy; 2014 Connect. All Rights Reserved.</span>
      </footer>

    </div>
  </body>
</html>

<script type="text/javascript">

  $(document).ready(function(){
      var full_path = location.href.split("#")[0];
      $(".centered-header a").each(function(){
          var $this = $(this);
          if($this.prop("href").split("#")[0] == full_path) {
              $this.addClass("active");
          }
      });
  });

</script>