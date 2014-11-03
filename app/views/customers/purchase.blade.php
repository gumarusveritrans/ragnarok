@extends('layouts.default')

@section('content')
	<div id="subheader-wrapper">
    	<span class="subtitle customer">PURCHASE PRODUCTS</span>
    	<div class="balance">
    	  Balance<br/>
    	      <span class="currency">
    	        Rp 1.500.000,00
    	      </span><br/>
    	        from the limit of 
    	      @if(true)
    	          Rp 5.000.000,00
    	      @else
    	          Rp 1.000.000,00
    	      @endif
    	</div>
	</div>

	<hr id="horizontal-line-dashboard" noshade size=1 width=95% />

	<div id="subcontent-wrapper">
		<div id="subbuttons-wrapper" style="overflow:visible">
			<div class="table">
				<div class="column">
					<span style="font-size:18px; float:left; padding: 0 10px">Select Merchant</span>
					<div id="dd" class="wrapper-dropdown" style="float:left">
						<span>Select Merchant</span>
						<ul class="dropdown">
							<li id="el-1" name="el-1" value="lazada"><label for="el-1">Lazada</label></li>
							<li id="el-2" name="el-2" value="zalora"><label for="el-2">Zalora</label></li>
						</ul>
					</div>
				</div>
				<div class="column">
					<button id="shopping-cart-button" class="button darkbrown profile">SHOPPING CART</button>
				</div>
			</div>

		</div>

        <div id="purchase-transaction-table" class="all-table customer">
            <table align="center">
                <thead>
                    <tr>
                        <th>
                            Product Name
                        </th>
                        <th>
                            Description
                        </th>
                        <th>
                            Price
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tr>
                    <td >
                        Product 01
                    </td>
                    <td>
                        Casio Type X
                    </td>
                    <td>
                        Rp 1.000.000,00
                    </td>
                    <td>
                        <button id="buy-product-01" class="button-table darkbrown">buy product</button>   
                    </td>
                </tr>
                <tr>
                    <td>
                        Product 02
                    </td>
                    <td>
                        Rp 20.000,-
                    </td>
                    <td>
                        Casio Type Y
                    </td>
                    <td>
                        <button id="buy-product-02" class="button-table darkbrown">buy product</button> 
                    </td>
                </tr>
            </table>

        </div>

        <div id="subbuttons-wrapper">
        	<div class="table">
        		<div class="column">
					<a href="{{ url('/customers/purchase-success') }}"><button class="button darkbrown profile" style="float:right">PURCHASE</button></a>
        		</div>
        	</div>
        </div>

	</div>

    <div id="pop-up-buy-product" class="pop-up customer" style="display: none">
        <span id="close-buy-product" class="button-close customer">&#10006;</span>
        <h1>BUY PRODUCT</h1>
        <br/>
        <h3>Product Name</h3>
        <h2>Ticket Travel Samarinda-Jakarta</h2>
        <br/>
        <h3>Price</h3>
        <h2>Rp 1.000.000,00</h2>
        <br/>
        <div class="table">
            <div class="column">
                <h3>Quantity</h3>
                <h2>15</h2>
            </div>
            <div class="column">
                <button id="buy-button" class="button darkbrown admin-notification" style="float:right">BUY</button>
            </div>
        </div>
    </div>

    <div id="pop-up-shopping-cart" class="pop-up customer" style="display: none">
        <span id="close-shopping-cart" class="button-close customer">&#10006;</span>
        <h1>SHOPPING CART</h1>
        <br/>
        <table>
            <thead>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </thead>
        </table>

        <div class="table-box-content">
            <table>
                <tr>
                    <td>PID999999</td>
                    <td>Product 01</td>
                    <td>Rp 1.000.000,00</td>
                    <td>1</td>
                    <td>Rp 1.000.000,00</td>
                </tr>
                <tr>
                    <td>PID999999</td>
                    <td>Product 02</td>
                    <td>Rp 20.000,-</td>
                    <td>2</td>
                    <td>Rp 40.000,-</td>
                </tr>
                <tr>
                    <td>PID999999</td>
                    <td>Product 03</td>
                    <td>Rp 20.000,-</td>
                    <td>2</td>
                    <td>Rp 40.000,-</td>
                </tr>
                <tr>
                    <td>PID999999</td>
                    <td>Product 04</td>
                    <td>Rp 20.000,-</td>
                    <td>2</td>
                    <td>Rp 40.000,-</td>
                </tr>
                <tr>
                    <td>PID999999</td>
                    <td>Product 05</td>
                    <td>Rp 20.000,-</td>
                    <td>2</td>
                    <td>Rp 40.000,-</td>
                </tr>
            </table>
        </div>
        <br/>
        <a href="{{ url('/customers/purchase-success') }}"><button class="button darkbrown profile">PURCHASE</button></a>       
    </div>

    <div id="pop-up-buy-success" class="pop-up customer" style="display: none">
        <h1>ADDED TO CART</h1>
        <br/>
        <h2>This product has been added to your shopping cart!</h2>
        <br/>
        <button id="ok-buy-success" class="button darkbrown profile">OK</button>
    </div>

<script type="text/javascript">
			
	function DropDown(el) {
	    this.dd = el;
	    this.placeholder = this.dd.children('span');
	    this.opts = this.dd.find('ul.dropdown > li');
	    this.val = '';
	    this.index = -1;
	    this.initEvents();
	}
	DropDown.prototype = {
		initEvents : function() {
			var obj = this;

			obj.dd.on('click', function(event){
				$(this).toggleClass('active');
				event.stopPropagation();
			});

			obj.opts.on('click',function(){
		            var opt = $(this);
		            obj.val = opt.text();
		            obj.index = opt.index();
		            obj.placeholder.text(obj.val);
		        });
	    },
	    getValue : function() {
	        return this.val;
	    },
	    getIndex : function() {
	        return this.index;
	    }
	}

	$(function() {
		var dd = new DropDown( $('#dd') );
		$(document).click(function() {
			// all dropdowns
			$('.wrapper-dropdown').removeClass('active');
		});

        $("#buy-product-01").click(function(){
            $("#pop-up-buy-product").fadeIn();
        });

        $("#buy-button").click(function(){
            $("#pop-up-buy-product").hide();
        });

        $("#shopping-cart-button").click(function(){
            $("#pop-up-shopping-cart").fadeIn();
        });

        $( "#close-buy-product" ).click(function() {
            $("#pop-up-buy-product").fadeOut("fast");
        });

        $( "#close-shopping-cart" ).click(function() {
            $("#pop-up-shopping-cart").fadeOut("fast");
        });

        $( "#buy-button" ).click(function() {
            $("#pop-up-buy-product").fadeOut("fast");
            $("#pop-up-buy-success").fadeIn("fast"); 
        });

        $( "#ok-buy-success" ).click(function() {
            $("#pop-up-buy-success").fadeOut("fast"); 
        });
	});

</script>

@stop