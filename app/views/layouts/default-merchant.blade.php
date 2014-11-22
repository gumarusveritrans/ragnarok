<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Connect -- Merchant</title>
    <link rel="shortcut icon" href="{{ asset('images/favicon_merchant.ico') }}">
    {{ HTML::style('css/default.css') }}
    {{ HTML::style('css/forms.css') }}
    {{ HTML::style('css/tables.css') }}
    {{ HTML::style('css/buttons.css') }}
    {{ HTML::script('js/jquery-1.11.1.min.js') }}
    {{ HTML::script('js/jquery-ui.min.js') }}
  </head>
  <body>
    <div id="body-wrapper">

      <header class="header-merchant">
        @if (!Session::get('cyclos_session_token'))
          <div id="logo-admin-merchant-home" class="block">
            {{ HTML::image('images/logo_merchant_home.png', 'Connect Logo', array('class' => 'centered')) }}
          </div>
        @else
          <div id="logo-wrapper" class="block">
            {{ HTML::image('images/logo_merchant.png', 'Connect Logo', array('class' => 'centered')) }}
          </div>
          <div id="merchant" class="block menu-wrapper">
            <ul class="centered-header">
              <li>{{ link_to ("/merchants/transaction", 'TRANSACTION') }}</li>
              <li>{{ link_to ("/merchants/list-products", 'LIST PRODUCTS') }}</li>
              <li>{{ link_to ("/merchants/logout", 'LOG OUT', array('data-method' => 'post')) }}</li>
            </ul>
          </div>
          <div id="welcome-wrapper" class="merchant block">
            <font color="#FFFFFF">Welcome,</font> {{Session::get('cyclos_username')}}
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

  $(function(){
    $('[data-method]').append(function(){
        return "\n"+
        "<form action='"+$(this).attr('href')+"' method='POST' style='display:none'>\n"+
        "   <input type='hidden' name='_method' value='"+$(this).attr('data-method')+"'>\n"+
        "</form>\n"
    })
    .removeAttr('href')
    .attr('style','cursor:pointer;')
    .attr('onclick','$(this).find("form").submit();');
  });

</script>