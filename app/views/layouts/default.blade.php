<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Connect</title>
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
    <?= stylesheet_link_tag() ?>
    <?= javascript_include_tag() ?>
  </head>
  <body>
    <div id="body-wrapper">
      <header class="header-customer">
        <div id="logo-wrapper" class="block">
          {{ HTML::image('images/logo.png', 'Connect Logo', array('class' => 'centered')) }}
        </div>
        @if (Session::get('cyclos_session_token'))
            <div id="customer" class="block menu-wrapper" >
              <ul class="centered-header">
                <li>{{ link_to ("/customers/dashboard", 'DASHBOARD') }}</li>
                <li>
                  <a href="#">TRANSACTION</a>
                  <ul>
                    <li>{{ link_to ("/customers/topup", 'TOP-UP') }}</li>
                    <li>{{ link_to ("/customers/transfer", 'TRANSFER') }}</li>
                    <li>{{ link_to ("/customers/purchase", 'PURCHASE') }}</li>
                  </ul>
                </li>
                <li>{{ link_to ("/customers/profile", 'MY PROFILE') }}</li>
                <li>{{ link_to ("/customers/logout", 'LOG OUT', array('data-method' => 'post')) }}</li>
              </ul>
            </div>
            <div id="welcome-wrapper" class="customer block">
              <font color="#C2B59B">Welcome,</font> {{Session::get('cyclos_username')}}
            </div>
        @else
            <div id="home" class="block menu-wrapper">
              <ul class="centered-header">
                <li>{{ link_to ("/", 'HOME') }}</li>
                <li>{{ link_to ("/about", 'ABOUT') }}</li>
                <li>{{ link_to ("/pricing", 'PRICING') }}</li>
                <li>{{ link_to ("/product", 'PRODUCT') }}</li>
                <li>{{ link_to ("/contact", 'CONTACT') }}</li>
              </ul>
            </div>
            <div id="login-register-wrapper" class="block">
              <a href="{{ url('/login') }}"><button class="button orange centered">LOGIN</button></a>
              <a href="{{ url('/register') }}"><button class="button darkbrown centered">REGISTER</button></a>
            </div>
        @endif
      </header>

      <div id="content" class="block">
        @yield('content')
      </div>

      <footer class="footer-customer block">
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
          if($this.prop("href") == full_path){
              $this.addClass("active");
              $this.parent().parent().siblings().addClass("active");
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