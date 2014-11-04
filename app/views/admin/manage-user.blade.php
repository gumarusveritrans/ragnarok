@extends('layouts.default-admin')

@section('content-admin')
    <div id="subheader-wrapper">
        <span class="subtitle admin">MANAGE USER</span>
    </div>

    <hr id="horizontal-line-dashboard" noshade size=1 width=95% color="blue" style="margin-top: -10px;">

    <div id="subcontent-wrapper">
        <div id="subbuttons-wrapper">
            <a href="#manage-customer"><button id="admin-manage-user-customer-button" class="button lightblue dashboard">Customer</button></a>
            <a href="#manage-merchant"><button id="admin-manage-user-merchant-button" class="button lightblue dashboard">Merchant</button></a>
        </div>

        <div class="all-table admin">
            <table id="admin-manage-user-customer-table" align="center" style="display: none">
                <thead>
                    <tr>
                        <th>
                            Customer ID
                        </th>
                        <th>
                            Customer Name
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            Balance
                        </th>
                        <th>
                            Limit Amount
                        </th>
                        <th>
                            
                        </th>
                    </tr>
                </thead>
                <tr>
                    <td >
                        CID999999990000000000000
                    </td>
                    <td>
                        gumarus.dharmawan.william
                    </td>
                    <td>
                        gumarus.dharmawan.william@gmail.com
                    </td>
                    <td>
                        Rp 5.000.000,00
                    </td>
                    <td>
                        Rp 5.000.000,00
                    </td>
                    <td>
                        <a href="#profile"><button id="profile-button" class="button-table darkblue dashboard">Profile</button></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        Row 2
                    </td>
                    <td>
                        Row 2
                    </td>
                    <td>
                        Row 2
                    </td>
                    <td>
                        Row 2
                    </td>
                    <td>
                        Row 2
                    </td>
                    <td>
                        
                    </td>
                </tr>
                <tr>
                    <td >
                        Row 3
                    </td>
                    <td>
                        Row 3
                    </td>
                    <td>
                        Row 3
                    </td>
                    <td>
                        Row 3
                    </td>
                    <td>
                        Row 3
                    </td>
                    <td>
                        
                    </td>
                </tr>
            </table>

            <table id="admin-manage-user-merchant-table" align="center" style="display: none">
                <thead>
                    <tr>
                        <th>
                            Merchant ID
                        </th>
                        <th>
                            Merchant Name
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            Balance
                        </th>
                        <th>
                            
                        </th>
                        <th>
                            
                        </th>
                    </tr>
                </thead>
                <tr>
                    <td >
                        MID99999999
                    </td>
                    <td>
                        Garuda Indonesia
                    </td>
                    <td>
                        gumarus.dharmawan.william@gmail.com
                    </td>
                    <td>
                        Rp 5.000.000,00
                    </td>
                    <td>
                        <a href="#delete"><button id="delete-id-button" class="button-table darkblue dashboard">Delete ID</button></a>
                    </td>
                    <td>
                        <a href="#add-product"><button id="add-product-button" class="button-table darkblue dashboard">Add Product</button></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        Row 2
                    </td>
                    <td>
                        Row 2
                    </td>
                    <td>
                        Row 2
                    </td>
                    <td>
                        Row 2
                    </td>
                    <td>
                        
                    </td>
                    <td>
                        
                    </td>
                </tr>
                <tr>
                    <td >
                        Row 3
                    </td>
                    <td>
                        Row 3
                    </td>
                    <td>
                        Row 3
                    </td>
                    <td>
                        Row 3
                    </td>
                    <td>
                        
                    </td>
                    <td>
                        
                    </td>
                </tr>
            </table>
        </div>
        <div id="profile-box" class="centered admin-side-box" style="display: none">
            <span id="close-profile" class="button-close admin">&#10006;</span>
            <h2>Customer Details</h2>
            <br/>
            <h1>daniel.aja</h1>
            <br/>
            <table id="admin-side-table">
                <tr>
                    <td>
                        ID Type
                    </td>
                    <td>
                        Identity Card
                    </td>
                </tr>
                <tr>
                    <td>
                        ID Number
                    </td>
                    <td>
                        2328937862783
                    </td>
                </tr>
                <tr>
                    <td>
                        Full Name
                    </td>
                    <td>
                        Daniel Aja
                    </td>
                </tr>
                <tr>
                    <td>
                        Address
                    </td>
                    <td>
                        Jalan Cisitu lalala lilili lelele lololo
                    </td>
                </tr>
                <tr>
                    <td>
                        Place, Date of Birth
                    </td>
                    <td>
                        Jakarta, 28 Februari 2012
                    </td>
                </tr>
                <tr>
                    <td>
                        Sex
                    </td>
                    <td>
                        Male
                    </td>
                </tr>
            </table>
        </div>
        <div id="add-product-box" class="centered admin-side-box" style="display: none">
            <span id="close-add-product" class="button-close admin">&#10006;</span>
            <h1>Add Product</h1>
            {{ Form::open() }}
                {{ Form::label('product_name', 'Product Name') }}
                {{ Form::text('product_name', '', array('class' => 'form-control')) }}

                {{ Form::label('price', 'Price') }}
                {{ Form::text('price', '', array('class' => 'form-control')) }}

                {{ Form::label('description', 'Description') }}
                {{ Form::textarea('description', '', array('class' => 'form-control text-area')) }}

                {{ Form::submit('ADD', array('class' => 'button darkblue admin-notification')) }}
            {{ Form::close() }}
        </div>
        <div id="create-merchant-box" class="centered admin-side-box" style="display: none">
            <span id="close-create-merchant" class="button-close admin">&#10006;</span>
            <h1>Create Merchant</h1>
            {{ Form::open() }}
                {{ Form::label('merchant', 'Merchant Name') }}
                {{ Form::text('merchant_name', '', array('class' => 'form-control')) }}

                {{ Form::label('merchant_email', 'Merchant Email') }}
                {{ Form::text('merchant_email', '', array('class' => 'form-control')) }}

                {{ Form::submit('ADD', array('class' => 'button darkblue admin-notification')) }}
            {{ Form::close() }}
        </div>
        <a href="#create-merchant"><button id="create-merchant-button" class="button darkblue dashboard" style="display: none; float: right; margin-right: 80px; margin-top: 10px">Create Merchant</button></a>
        <div id="pop-up-delete-id" class="admin pop-up" style="display: none">
            <h1>DELETE ID</h1>
            <h2>Are you sure want to delete merchant's account?</h2>
            <a href=""><button id="yes-add-product" class="button darkblue admin-notification">YES</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button id="no-delete-id" class="button cyan admin-notification">NO</button>
        </div>
    </div>

    <script type="text/javascript">

        $("#admin-manage-user-customer-button").click(function() {
          $("#admin-manage-user-merchant-table").hide();
          $("#admin-manage-user-customer-table").fadeIn("fast");
          $("#admin-manage-user-merchant-button").removeClass('cyan');
          $("#admin-manage-user-customer-table").css("width","1230px");
          $("#admin-manage-user-merchant-table").css("width","1230px");
          $("#admin-manage-user-customer-table th:nth-child(3)").animate({'width':'30%'});
          $("#admin-manage-user-customer-table td:nth-child(3)").animate({'width':'30%'});
          $("#admin-manage-user-merchant-table th:nth-child(3)").animate({'width':'30%'});
          $("#admin-manage-user-merchant-table td:nth-child(3)").animate({'width':'30%'});
          $("#profile-box").hide();
          $("#add-product-box").hide();
          $("#create-merchant-box").hide();
          $("#create-merchant-button").hide();
          $("#pop-up-delete-id").hide();
          $(this).addClass('cyan');
        });

        $( "#admin-manage-user-merchant-button" ).click(function() {
          $("#admin-manage-user-customer-table").hide();
          $("#admin-manage-user-merchant-table").fadeIn("fast");
          $("#admin-manage-user-customer-button").removeClass('cyan');
          $("#admin-manage-user-merchant-table").css("width","1230px");
          $("#admin-manage-user-customer-table").css("width","1230px");
          $("#admin-manage-user-customer-table th:nth-child(3)").animate({'width':'30%'});
          $("#admin-manage-user-customer-table td:nth-child(3)").animate({'width':'30%'});
          $("#admin-manage-user-merchant-table th:nth-child(3)").animate({'width':'30%'});
          $("#admin-manage-user-merchant-table td:nth-child(3)").animate({'width':'30%'});
          $("#profile-box").hide();
          $("#add-product-box").hide();
          $("#create-merchant-box").hide();
          $("#create-merchant-button").show();
          $("#pop-up-delete-id").hide();
          $(this).addClass('cyan');
        });

        $( "#profile-button" ).click(function() {
            $("#profile-box").delay(300).fadeIn("fast");
            $("#admin-manage-user-customer-table").animate({width:'820px'});
            $("#admin-manage-user-customer-table th:nth-child(3)").animate({'width':'0%'});
            $("#admin-manage-user-customer-table td:nth-child(3)").animate({'width':'0%'});
            $("#admin-manage-user-customer-table td:nth-child(3)").css("padding","0px");
            $("#admin-manage-user-customer-table th:nth-child(3)").css("padding","0px");
        });

        $( "#close-profile" ).click(function() {
            $("#profile-box").fadeOut("fast");
            $("#admin-manage-user-customer-table").delay(300).animate({width:'1230px'});
            $("#admin-manage-user-customer-table th:nth-child(3)").delay(300).animate({'width':'30%'});
            $("#admin-manage-user-customer-table td:nth-child(3)").delay(300).animate({'width':'30%'});
        });

        $( "#add-product-button" ).click(function() {
            $("#add-product-box").delay(300).fadeIn("fast");
            $("#admin-manage-user-merchant-table").animate({width:'820px'});
            $("#admin-manage-user-merchant-table th:nth-child(3)").animate({'width':'0%'});
            $("#admin-manage-user-merchant-table td:nth-child(3)").animate({'width':'0%'});
            $("#admin-manage-user-merchant-table td:nth-child(3)").css("padding","0px");
            $("#admin-manage-user-merchant-table th:nth-child(3)").css("padding","0px");
            $("#create-merchant-button").hide();
            $("#create-merchant-box").hide();
            $("#pop-up-delete-id").hide();
        });

        $( "#close-add-product" ).click(function() {
            $("#add-product-box").fadeOut("fast");
            $("#admin-manage-user-merchant-table").delay(300).animate({width:'1230px'});
            $("#admin-manage-user-merchant-table th:nth-child(3)").delay(300).animate({'width':'30%'});
            $("#admin-manage-user-merchant-table td:nth-child(3)").delay(300).animate({'width':'30%'});
            $("#create-merchant-button").delay(700).show(10);
            $("#pop-up-delete-id").hide();
        });

        $( "#delete-id-button" ).click(function() {
            $("#pop-up-delete-id").fadeIn("fast");
        });

        $( "#no-delete-id" ).click(function() {
            $("#pop-up-delete-id").fadeOut("fast");
        });

        $("#create-merchant-button").click(function() {
            $("#create-merchant-box").delay(300).fadeIn("fast");
            $("#admin-manage-user-merchant-table").animate({width:'820px'});
            $("#admin-manage-user-merchant-table th:nth-child(3)").animate({'width':'0%'});
            $("#admin-manage-user-merchant-table td:nth-child(3)").animate({'width':'0%'});
            $("#admin-manage-user-merchant-table td:nth-child(3)").css("padding","0px");
            $("#admin-manage-user-merchant-table th:nth-child(3)").css("padding","0px");
            $("#create-merchant-button").hide();
            $("#add-product-box").hide();
            $("#pop-up-delete-id").hide();
        });

        $( "#close-create-merchant" ).click(function() {
            $("#create-merchant-box").fadeOut("fast");
            $("#admin-manage-user-merchant-table").delay(300).animate({width:'1230px'});
            $("#admin-manage-user-merchant-table th:nth-child(3)").delay(300).animate({'width':'30%'});
            $("#admin-manage-user-merchant-table td:nth-child(3)").delay(300).animate({'width':'30%'});
            $("#create-merchant-button").delay(700).show(10);
            $("#pop-up-delete-id").hide();
        });

    </script>

@stop