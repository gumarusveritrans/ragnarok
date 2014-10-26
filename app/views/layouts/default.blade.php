<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Ragnarok</title>
    {{ HTML::style('css/application.css') }}
    {{ HTML::style('css/connect_pages.css') }}
    {{ HTML::style('css/customers.css') }}
    {{ HTML::style('css/users.css') }}
    {{ HTML::script('js/jquery-1.11.1.min.js') }}
  </head>
  <body>
    <div id="body-wrapper">

      <header>
        <div id="logo-wrapper" class="block">
          {{ HTML::image('images/logo.png', 'Connect Logo', array('class' => 'centered')) }}
        </div>
        @if (true)
            <div id="customer" class="block menu-wrapper" >
              <ul class="centered">
                <li>{{ link_to ("/customers/dashboard", 'DASHBOARD') }}</li>
                <li>
                  <a href="">TRANSACTION</a>
                  <ul>
                    <li>{{ link_to ("/customers/topup", 'TOP-UP') }}</li>
                    <li>{{ link_to ("/customers/transfer", 'TRANSFER') }}</li>
                    <li>{{ link_to ("/customers/purchase", 'PURCHASE') }}</li>
                  </ul>
                </li>
                <li>{{ link_to ("/customers/show", 'MY PROFILE') }}</li>
                <li>{{ link_to ("/customers/destroy", 'LOG OUT') }}</li>
              </ul>
            </div>
              <div id="welcome-customer" class="block">
                <font color="#C2B59B">Welcome, </font>
              </div>
        @else
            <div id="home" class="block menu-wrapper">
              <ul class="centered">
                <li>{{ link_to ("/", 'HOME') }}</li>
                <li>{{ link_to ("/about", 'ABOUT') }}</li>
                <li>{{ link_to ("/pricing", 'PRICING') }}</li>
                <li>{{ link_to ("/product", 'PRODUCT') }}</li>
                <li>{{ link_to ("/contact", 'CONTACT') }}</li>
              </ul>
            </div>
            <div id="login-register-wrapper" class="block">
              <button href="" class="button orange centered">LOGIN</button>
              <button href="" class="button darkbrown centered">REGISTER</button>
            </div>
        @endif
      </header>

      <div id="content" class="block">
        @yield('content')
      </div>

      <footer class="block">
        <span class="centered">&copy; 2014 Connect. All Rights Reserved.</span>
      </footer>

    </div>
  </body>
</html>