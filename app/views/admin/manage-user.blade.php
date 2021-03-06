@extends('layouts.default-admin')

@section('content-admin')
    <div id="subheader-wrapper">
        <span class="subtitle admin">MANAGE USER</span>
    </div>

    <hr id="admin-horizontal-line"/>

    <div id="subcontent-wrapper">
        <div id="subbuttons-wrapper">
            <a href="#manage-customer"><button id="admin-manage-user-customer-button" class="button lightblue dashboard">Customer</button></a>
            <a href="#manage-merchant"><button id="admin-manage-user-merchant-button" class="button lightblue dashboard">Merchant</button></a>
        </div>

        <div id="admin-manage-user-customer-wrapper" class="all-table admin" style="display: none">
            @if (count($users) == 0)
            <div>
                You do not have any customers records yet.
            </div>
            @elseif (count($users) > 0)
            <table id="admin-manage-user-customer-table" align="center">
                <thead>
                    <tr>
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
                @foreach ($users as $user)
                    <tr>
                        <td>
                            {{{$user->username}}}
                        </td>
                        <td>
                            {{{$user->email}}}
                        </td>
                        <td>
                            Rp {{{number_format($user->balance,2,',','.')}}}
                        </td>
                        <td>
                            Rp {{{number_format($user->limitBalance,2,',','.')}}}
                        </td>
                        <td>
                            @if ($profiles[$user->username] AND $profiles[$user->username]->status == 'accepted')
                                <a href="#manage-customer#profile"><button class="profile-button button-table darkblue dashboard" value="{{{$user->username}}}">Profile</button></a>                            
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
            @endif
        </div>

        <div id="admin-manage-user-merchant-wrapper" class="all-table admin" style="display: none">
            @if (count($merchants) == 0)
            <div>
                You do not have any merchants records yet.
            </div>
            @elseif (count($merchants) > 0)
            <table id="admin-manage-user-merchant-table" align="center">
                <thead>
                    <tr>
                        <th>
                            Merchant Username
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
                @foreach ($merchants as $merchant)
                    <tr>
                        <td>
                            {{{$merchant->username}}}
                        </td>
                        <td>
                            {{{$merchant->email}}}
                        </td>
                        <td>
                            Rp {{{number_format($merchant->balance,2,',','.')}}}
                        </td>
                        <td>
                            <a href="#manage-merchant#delete"><button class="delete-id-button button-table darkblue dashboard" value="{{{$merchant->username}}}">Delete ID</button></a>
                        </td>
                        <td>
                            <a href="#manage-merchant#add-product"><button id="add-product" class="add-product-button button-table darkblue dashboard" value={{{$merchant->username}}}>Add Product</button></a>
                        </td>
                    </tr>
                @endforeach
            </table>
            @endif
        </div>

        <div id="profile-box" class="centered admin-side-box" style="display: none">
            <a href="#manage-customer" id="close-profile" class="button-close admin" style="text-decoration: none">&#10006;</a>
            <h2>Customer Details</h2>
            <br/>
            <h1 id="profile_box_username"></h1>
            <br/>
            <table id="admin-side-table" style="font-size: 18px">
                <tr>
                    <td>
                        ID Type
                    </td>
                    <td id="profile_box_id_type">
                        <!-- Generated by jquery -->
                    </td>
                </tr>
                <tr>
                    <td>
                        ID Number
                    </td>
                    <td id="profile_box_id_number">
                        <!-- Generated by jquery -->
                    </td>
                </tr>
                <tr>
                    <td>
                        Full Name
                    </td>
                    <td id="profile_box_full_name">
                        <!-- Generated by jquery -->
                    </td>
                </tr>
                <tr>
                    <td>
                        Address
                    </td>
                    <td id="profile_box_address">
                        <!-- Generated by jquery -->
                    </td>
                </tr>
                <tr>
                    <td>
                        Place, Date of Birth
                    </td>
                    <td>
                        <span id="profile_box_birth_place"></span>, <span id="profile_box_birth_date"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        Gender
                    </td>
                    <td id="profile_box_sex">
                        <!-- Generated by jquery -->
                    </td>
                </tr>
            </table>
        </div>
        <div id="add-product-box" class="centered admin-side-box" style="display: none">
            <a href="#manage-merchant" id="close-add-product" class="button-close admin" style="text-decoration:none">&#10006;</a>
            <h1>Add Product</h1>
            {{ Form::open(array('route' => 'add-product', 'method' => 'post', 'id' => 'add-product-form')) }}
                {{ Form::label('product_name', 'Product Name') }}
                {{ Form::text('product_name', '', array('id' => 'product-name', 'required' => true, 'class' => 'form-control admin')) }}
                {{ $errors->first('product_name', '<span>:message</span>') }}<br/>

                {{ Form::label('price', 'Price') }}
                {{ Form::text('price', '', array('id' => 'price', 'required' => true, 'class' => 'form-control admin')) }}
                {{ $errors->first('price', '<span>:message</span>') }}<br/>

                {{ Form::label('description', 'Description') }}
                {{ Form::textarea('description', '', array('id' => 'description', 'required' => true, 'class' => 'form-control admin text-area')) }}
                {{ $errors->first('description', '<span>:message</span>') }}<br/>

                {{ Form::hidden('merchant_name', '', array('id'=>'merchant-name')) }}

                <div id="validation-errors" style="display: none"></div>

                {{ Form::submit('ADD', array('class' => 'button darkblue admin-notification')) }}
            {{ Form::close() }}
        </div>
        <div id="create-merchant-box" class="centered admin-side-box" style="display: none">
            <a href="#manage-merchant" id="close-create-merchant" class="button-close admin" style="text-decoration: none">&#10006;</a>
            <h1>Create Merchant</h1>
            {{ Form::open(array('url' =>'/admin/create_merchant ')) }}
            
                {{ Form::label('merchant', 'Merchant Name') }}

                {{ Form::text('merchant_name', '', array('maxlength' => 20, 'class' => 'form-control admin')) }}
                @if ($errors->has('merchant_name')) <p class="error-message">{{ $errors->first('merchant_name') }}</p> @endif

                {{ Form::label('merchant_email', 'Merchant Email') }}
                {{ Form::text('merchant_email', '', array('class' => 'form-control admin')) }}
                @if ($errors->has('merchant_email')) <p class="error-message">{{ $errors->first('merchant_email') }}</p> @endif

                {{ Form::submit('ADD', array('class' => 'button darkblue admin-notification')) }}
            {{ Form::close() }}
        </div>
        <a href="#manage-merchant#create-merchant"><button id="create-merchant-button" class="button darkblue dashboard" style="display: none; float: right; margin-right: 5%; margin-top: 1%">Create Merchant</button></a>
        <div id="pop-up-delete-id" class="admin pop-up" style="display: none">
            <h1>DELETE ID</h1>
            <h2>Are you sure want to delete merchant's account?</h2>
            <button id="yes-delete-id" class="button darkblue admin-notification">YES</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="#manage-merchant"><button id="no-delete-id" class="button cyan admin-notification">NO</button></a>
        </div>
        <div id="pop-up-add-product" class="admin pop-up" style="display: none">
            <h1>PRODUCT ADDED</h1>
            <h2>The product has been added!</h2>
            <a href="#manage-merchant"><button id="ok-add-product" class="button darkblue admin-notification">OK</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>
    </div>

    <script type="text/javascript">


        $(function(){

            //For getting the merchant intended to delete
            var deleted_merchant = "";

            var profile_box_username = [];
            var profile_box_id_type = [];
            var profile_box_id_number = [];
            var profile_box_full_name = [];
            var profile_box_address = [];
            var profile_box_birth_place = [];
            var profile_box_birth_date = [];
            var profile_box_sex = [];

            function postDeleteMerchant(){
                method = "post"; // Set method to post by default if not specified.

                // The rest of this code assumes you are not using a library.
                // It can be made less wordy if you use one.
                var form = document.createElement("form");
                form.setAttribute("method", method);
                form.setAttribute("action", '/admin/delete_merchant');

                var hiddenField = document.createElement("input");
                
                hiddenField.setAttribute("type", "hidden");
                hiddenField.setAttribute("name", "merchant_id");
                hiddenField.setAttribute("value", deleted_merchant);

                form.appendChild(hiddenField);

                hiddenField = document.createElement("input");
                
                hiddenField.setAttribute("type", "hidden");
                hiddenField.setAttribute("name", "_token");
                hiddenField.setAttribute("value", "{{{csrf_token()}}}");

                form.appendChild(hiddenField);

                document.body.appendChild(form);
                form.submit();
            }

            @foreach($profiles as $profile)
                @if (isset($profile->username_customer))
                    profile_box_username['{{{$profile->username_customer}}}'] = '{{{$profile->username_customer}}}';
                    profile_box_id_type['{{{$profile->username_customer}}}'] = '{{{$profile->id_type}}}';
                    profile_box_id_number['{{{$profile->username_customer}}}'] = '{{{$profile->id_number}}}';
                    profile_box_full_name['{{{$profile->username_customer}}}'] = '{{{$profile->full_name}}}';
                    profile_box_address['{{{$profile->username_customer}}}'] = '{{{$profile->current_address}}}';
                    profile_box_birth_place['{{{$profile->username_customer}}}'] = '{{{$profile->birth_place}}}';
                    profile_box_birth_date['{{{$profile->username_customer}}}'] = '{{{$profile->birth_date}}}';
                    profile_box_sex['{{{$profile->username_customer}}}'] = '{{{$profile->gender}}}';
                @endif
            @endforeach

            $("#admin-manage-user-customer-button").click(function() {
              $("#admin-manage-user-merchant-wrapper").hide();
              $("#admin-manage-user-customer-wrapper").fadeIn("fast");
              $("#admin-manage-user-merchant-button").removeClass('cyan');
              $("#admin-manage-user-customer-table").css("width","90%");
              $("#admin-manage-user-merchant-table").css("width","90%");
              $("#admin-manage-user-customer-table th:nth-child(5)").animate({'width':'15%'});
              $("#admin-manage-user-customer-table td:nth-child(5)").animate({'width':'15%'});
              $("#admin-manage-user-merchant-table th:nth-child(5)").animate({'width':'15%'});
              $("#admin-manage-user-merchant-table td:nth-child(5)").animate({'width':'15%'});
              $("#profile-box").hide();
              $("#add-product-box").hide();
              $("#create-merchant-box").hide();
              $("#create-merchant-button").hide();
              $("#pop-up-delete-id").hide();
              $(this).addClass('cyan');
            });

            $( "#admin-manage-user-merchant-button" ).click(function() {
              $("#admin-manage-user-customer-wrapper").hide();
              $("#admin-manage-user-merchant-wrapper").fadeIn("fast");
              $("#admin-manage-user-customer-button").removeClass('cyan');
              $("#admin-manage-user-merchant-table").css("width","90%");
              $("#admin-manage-user-customer-table").css("width","90%");
              $("#admin-manage-user-customer-table th:nth-child(5)").animate({'width':'15%'});
              $("#admin-manage-user-customer-table td:nth-child(5)").animate({'width':'15%'});
              $("#admin-manage-user-merchant-table th:nth-child(5)").animate({'width':'15%'});
              $("#admin-manage-user-merchant-table td:nth-child(5)").animate({'width':'15%'});
              $("#profile-box").hide();
              $("#add-product-box").hide();
              $("#create-merchant-box").hide();
              $("#create-merchant-button").show();
              $("#pop-up-delete-id").hide();
              $(this).addClass('cyan');
            });

            $( ".profile-button" ).click(function() {
                $("#profile_box_username").html(profile_box_username[$(this).val()]);
                $("#profile_box_id_type").html(profile_box_id_type[$(this).val()]);
                $("#profile_box_id_number").html(profile_box_id_number[$(this).val()]);
                $("#profile_box_full_name").html(profile_box_full_name[$(this).val()]);
                $("#profile_box_address").html(profile_box_address[$(this).val()]);
                $("#profile_box_birth_place").html(profile_box_birth_place[$(this).val()]);
                $("#profile_box_birth_date").html(profile_box_birth_date[$(this).val()]);
                $("#profile_box_sex").html(profile_box_sex[$(this).val()]);
                $("#profile-box").delay(300).fadeIn("fast");
                $("#admin-manage-user-customer-table").animate({width:'60%'});

            });

            $( "#close-profile" ).click(function() {
                $("#profile-box").fadeOut("fast");
                $("#admin-manage-user-customer-table").delay(300).animate({width:'90%'});
            });

            $( ".add-product-button" ).click(function() {
                $("#add-product-box").delay(300).fadeIn("fast");
                $("#admin-manage-user-merchant-table").animate({width:'60%'});
                $("#create-merchant-button").hide();
                $("#create-merchant-box").hide();
                $("#pop-up-delete-id").hide();
                $("#merchant-name").val($(this).val());
            });

            $( "#close-add-product" ).click(function() {
                $("#add-product-box").fadeOut("fast");
                $("#admin-manage-user-merchant-table").delay(300).animate({width:'90%'});
                $("#create-merchant-button").delay(700).show(10);
                $("#pop-up-delete-id").hide();
            });

            $( ".delete-id-button" ).click(function() {
                deleted_merchant = $(this).val();
                $("#pop-up-delete-id").fadeIn("fast");
            });

            $("#yes-delete-id").click(function(){
                postDeleteMerchant();
            });


            $( "#no-delete-id" ).click(function() {
                $("#pop-up-delete-id").fadeOut("fast");
            });

            $("#create-merchant-button").click(function() {
                $("#create-merchant-box").delay(300).fadeIn("fast");
                $("#admin-manage-user-merchant-table").animate({width:'60%'});
                $("#create-merchant-button").hide();
                $("#add-product-box").hide();
                $("#pop-up-delete-id").hide();
            });

            $( "#close-create-merchant" ).click(function() {
                $("#create-merchant-box").fadeOut("fast");
                $("#admin-manage-user-merchant-table").delay(300).animate({width:'90%'});
                $("#create-merchant-button").delay(700).show(10);
                $("#pop-up-delete-id").hide();
            });

            $( "#ok-add-product" ).click(function(){
                $("#pop-up-add-product").hide();
                $("#close-add-product").trigger("click");
            });

            $( 'form#add-product-form' ).submit(function(event) {
            
                $.ajax({
                    type: 'POST',
                    cache: false,
                    dataType: 'json',
                    url: 'add-product',
                    data: $('form#add-product-form').serialize(),
                    beforeSend: function() { 
                        $("#validation-errors").hide().empty(); 
                    },
                    success: function(data){
                        if(data.success == false)
                        {
                            $("#add-product-box").fadeIn();
                            var arr = data.errors;
                            $.each(arr, function(index, value)
                            {
                                if (value.length != 0)
                                {
                                    $("#validation-errors").append('<div class="alert alert-error"><strong>'+ value +'</strong><div>');
                                }
                            });
                            $("#validation-errors").show();
                        } else if (data.success == true) {
                             $("#pop-up-add-product").fadeIn();
                        }
                    },
                    error: function(xhr, textStatus, thrownError){
                        alert('Error');
                    }
                });
                event.preventDefault();
            });

        });

        $(document).ready(function(){
            var manage_customer_merchant_path = location.href.split("#")[1];
            var create_add_merchant_path = location.href.split("#")[2];
            if(manage_customer_merchant_path == "manage-merchant") {
                $( "#admin-manage-user-merchant-button" ).trigger("click");
                if(create_add_merchant_path == "create-merchant") {
                    setTimeout(function () {
                       jQuery('#create-merchant-button').trigger('click');
                    }, 150);
                }
                else if(create_add_merchant_path == "add-product") {
                    setTimeout(function () {
                       jQuery('.add-product-button').trigger('click');
                    }, 150); 
                }
            }
            else if (manage_customer_merchant_path == "manage-customer"){
                $( "#admin-manage-user-customer-button" ).trigger("click");
            }
        });

    </script>

@stop
