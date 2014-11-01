<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Ragnarok Merchant</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    {{ HTML::style('css/application.css') }}
    {{ HTML::style('css/connect_pages.css') }}
    {{ HTML::style('css/users.css') }}
    {{ HTML::script('js/jquery-1.11.1.min.js') }}
    {{ HTML::script('js/jquery-ui.min.js') }}
  </head>
  <body>
    <div id="body-wrapper">

      <header class="header-merchant">
        @if (false)
          <div id="logo-admin-merchant-home" class="block">
            {{ HTML::image('images/logo_merchant.png', 'Connect Logo', array('class' => 'centered')) }}
          </div>
        @else
          <div id="logo-wrapper" class="block">
            {{ HTML::image('images/logo_merchant.png', 'Connect Logo', array('class' => 'centered')) }}
          </div>
          <div id="merchant" class="block menu-wrapper">
            <ul class="centered-header">
              <li>{{ link_to ("/merchants/transaction", 'TRANSACTION') }}</li>
              <li>{{ link_to ("/merchants/list-products", 'LIST PRODUCTS') }}</li>
              <li>{{ link_to ("/merchants/destroy", 'LOG OUT') }}</li>
            </ul>
          </div>
          <div id="welcome-wrapper" class="merchant block">
            <font color="#E0A2A8">Welcome,</font> Merchant123
          </div>
        @endif
      </header>

      <div id="content" class="block">
        @yield('content-merchant')
      </div>

      <footer class="footer-merchant block">
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