@extends('layouts.default')

@section('content')
	<div id="subheader-wrapper">
    	<span class="subtitle customer">PURCHASE PRODUCTS</span>
    	<div class="balance">
    	  Balance<br/>
            <span class="currency">
                Rp {{{ number_format($data['balance'], 2, ',', '.') }}}
            </span><br/>
            from the limit of
            Rp {{{ number_format($data['limitBalance'], 2, ',', '.') }}}
    	</div>
	</div>

	<hr id="customer-horizontal-line"/>

	<div id="subcontent-wrapper">
		<div id="subbuttons-wrapper" style="overflow:visible">
			<div class="table">
				<div class="column">
					<span style="font-size:18px; float:left; padding: 0 10px">Select Merchant</span>
					<div id="dd" class="wrapper-dropdown" style="float:left">
						<span>{{{ Input::get('merchant') != '' ? Input::get('merchant') : 'Select Merchant'}}}</span>
						<ul class="dropdown">
                            @foreach ($merchants as $merchant)
							<li id="el-1" name="el-1" value={{{$merchant->username}}}>{{ link_to ("/customers/purchase?merchant=".$merchant->username, $merchant->username) }}</li>
						    @endforeach
                        </ul>
					</div>
				</div>
				<div class="column">
					<button id="shopping-cart-button" class="button darkbrown profile" style="margin-right:-50px">SHOPPING CART</button>
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
                @foreach ($products as $product)
                    <tr>
                        <td >
                            {{{ $product->product_name }}}
                        </td>
                        <td>
                            {{{ $product->description }}}
                        </td>
                        <td>
                            Rp {{{ number_format($product->price, 2, ',', '.') }}}
                        </td>
                        <td>
                            <button class="buy-product-button button-table darkbrown " value="{{{$product->id}}}">buy product</button>   
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
	</div>

    <div id="pop-up-buy-product" class="pop-up customer" style="display: none">
        <span id="close-buy-product" class="button-close customer">&#10006;</span>
        <h1>BUY PRODUCT</h1>
        <br/>
        <h3>Product Name</h3>
        <h2 id="buy_product_product_name"><!-- Generated by jquery --></h2>
        <br/>
        <h3>Price</h3>
        <h2 id="buy_product_product_price"><!-- Generated by jquery --></h2>
        <br/>
        <div class="table">
            <div class="column">
                <h3>Quantity</h3>
                <select id="buy-item-quantity"></select>
            </div>
            <div class="column">
                <button id="buy-button" class="button darkbrown admin-notification" style="float:right">BUY</button>
            </div>
        </div>
    </div>

    <div id="pop-up-shopping-cart" class="pop-up customer" style="display: none">
        <span id="close-shopping-cart" class="button-close customer">&#10006;</span>
        <h1>SHOPPING CART</h1>
        <table>
            <thead>
                <th> Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </thead>
        </table>

        <div class="table-box-content">
            <table id="shopping-cart-items">
                <tr>
                    <td><!-- Generated by jquery --></td>
                    <td><!-- Generated by jquery --></td>
                    <td><!-- Generated by jquery --></td>
                    <td><!-- Generated by jquery --></td>
                </tr>
            </table>
        </div>
        <br/>
        <button class="button darkbrown profile" id='button-purchase'>PURCHASE</button>       
    </div>

    <div id="pop-up-buy-success" class="pop-up customer" style="display: none">
        <h1>ADDED TO CART</h1>
        <br/>
        <h3>This product has been added to your shopping cart!</h3>
        <br/>
        <button id="ok-buy-success" class="button darkbrown profile">OK</button>
    </div>

<script type="text/javascript">
			
    var purchasing = false;

    //Variable for selecting intended to buy product
    var selected_product;
    var merchant_username = '{{{Input::get('merchant')}}}';

    //For buy product
    var product_name = [];
    var product_price = [];
    var product_id = [];

    //For shopping cart
    var shopping_cart = [];

    //Class product
    var Product = function(id,quantity){
        this.id = id;
        this.quantity = quantity;
    }

    @foreach ($products as $product)
        product_name[{{{$product->id}}}] = '{{{$product->product_name}}}';
        product_price[{{{$product->id}}}] = {{{$product->price}}};
    @endforeach

	function DropDown(el) {
	    this.dd = el;
	    this.placeholder = this.dd.children('span');
	    this.opts = this.dd.find('ul.dropdown > li');
	    this.val = '';
	    this.index = -1;
	    this.initEvents();
	}

    function shoppingCartToJSON(){
        var json = {"shoppingCart": shopping_cart,"merchant_username": merchant_username};
        return json;
    }

    function addProductToShoppingCart(product){
        for(i = 0;i<shopping_cart.length;i++){
            if(shopping_cart[i].id == product.id){
                shopping_cart[i].quantity = product.quantity;
                return;
            }
        }

        shopping_cart[shopping_cart.length] = product;
        return;
    }

    function postPurchaseProduct(){
        $.ajax({
            url:"/customers/purchase_products",
            type:"POST",
            contentType: 'application/json; charset=UTF-8',
            dataType : 'json',
            data: JSON.stringify(shoppingCartToJSON())
        })
        .fail(function(){
            alert('Sorry, there are some errors with the system');
        })
        .done(function(msg){
            if(msg['status'] == 'success'){
                document.write(msg['message']);
            }else{
                alert(msg['message']);
            }
        })
        .always(function(){
            $("#button-purchase").removeAttr('disabled');
            purchasing = false;
        });
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
			$('.wrapper-dropdown').removeClass('active');
		});

        $(".buy-product-button").click(function(){
            $("#buy-item-quantity").val('')

            //Change selected product for shopping cart
            selected_product = $(this).val();

            //Change buy box text
            $("#buy_product_product_name").html(product_name[$(this).val()]);
            $("#buy_product_product_price").html('Rp '+new Intl.NumberFormat(['ban', 'id']).format(product_price[$(this).val()])+',00');

            $("#pop-up-buy-product").fadeIn();
            $("#pop-up-shopping-cart").fadeOut("fast");
        });

        $("#buy-button").click(function(){
            var quantity = parseInt($("#buy-item-quantity").val());
            if(!isNaN(quantity)){
                addProductToShoppingCart(new Product(selected_product,quantity));
                $("#pop-up-buy-product").fadeOut();
                $("#pop-up-buy-success").fadeIn("fast");
                $('#buy-item-quantity').css('background-color','white');
            }else{
                $('#buy-item-quantity').css('background-color','red');
            }
        });

        $("#shopping-cart-button").click(function(){

            //Refreshing shopping cart items
            $("#shopping-cart-items").html("");

            //Adding shopping cart items
            shopping_cart.forEach(
                function(val){
                    //For adding product to shopping cart display
                    var productElement = "";
                    
                    productElement+='<tr>';
                    productElement+='<td>'+ product_name[val.id] +'</td>';
                    productElement+='<td>Rp '+ new Intl.NumberFormat(['ban', 'id']).format(product_price[val.id]) + ',00' +'</td>';
                    productElement+='<td>'+ val.quantity +'</td>';
                    productElement+='<td> Rp '+ new Intl.NumberFormat(['ban', 'id']).format(val.quantity * product_price[val.id]) + ',00' + '</td>';
                    productElement+='</tr>';
                    $("#shopping-cart-items").append(productElement);
                }
            );

            $("#pop-up-shopping-cart").fadeIn();
            $("#pop-up-buy-product").fadeOut();
        });

        $( "#close-buy-product" ).click(function() {
            $("#pop-up-buy-product").fadeOut("fast");
        });

        $( "#close-shopping-cart" ).click(function() {
            $("#pop-up-shopping-cart").fadeOut("fast");
        });

        $( "#ok-buy-success" ).click(function() {
            $("#pop-up-buy-success").fadeOut("fast"); 
        });

        $('#button-purchase').click(function(){
            if(!purchasing){
                $(this).attr('disabled','disabled');
                purchasing == true;
                postPurchaseProduct();
            }
        });
        
        var $select = $("#buy-item-quantity");
        for (i=1;i<=5;i++){
            $select.append($('<option></option>').val(i).html(i))
        }

	});

</script>

@stop