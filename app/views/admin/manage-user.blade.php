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
                            @if ($profiles[$user->username])
                                <a href="#profile"><button class="profile-button button-table darkblue dashboard" value="{{{$user->username}}}">Profile</button></a>                            
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>

            <table id="admin-manage-user-merchant-table" align="center" style="display: none">
                <thead>
                    <tr>
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
                            <a href="#delete"><button  class="delete-id-button button-table darkblue dashboard" value="{{{$merchant->username}}}">Delete ID</button></a>
                        </td>
                        <td>
                            <a href="#add-product"><button class="add-product-button button-table darkblue dashboard" value={{{$merchant->username}}}>Add Product</button></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div id="profile-box" class="centered admin-side-box" style="display: none">
            <span id="close-profile" class="button-close admin">&#10006;</span>
            <h2>Customer Details</h2>
            <br/>
            <h1 id="profile_box_username">Gumarus.d</h1>
            <br/>
            <table id="admin-side-table">
                <tr>
                    <td>
                        ID Type
                    </td>
                    <td id="profile_box_id_type">
                        Identity Card
                    </td>
                </tr>
                <tr>
                    <td>
                        ID Number
                    </td>
                    <td id="profile_box_id_number">
                        2328937862783
                    </td>
                </tr>
                <tr>
                    <td>
                        Full Name
                    </td>
                    <td id="profile_box_full_name">
                        Gumarus Darmawan
                    </td>
                </tr>
                <tr>
                    <td>
                        Address
                    </td>
                    <td id="profile_box_address">
                        Jalan Cisitu lalala lilili lelele lololo
                    </td>
                </tr>
                <tr>
                    <td>
                        Place, Date of Birth
                    </td>
                    <td>
                        <span id="profile_box_birth_place">Jakarta</span>, <span id="profile_box_birth_date">28 Februari 2012</span>
                    </td>
                </tr>
                <tr>
                    <td id="profile_box_sex">
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
            {{ Form::open(array('url' => '/admin/add-product', 'method' => 'post')) }}
                {{ Form::label('product_name', 'Product Name') }}
                {{ Form::text('product_name', '', array('class' => 'form-control')) }}

                {{ Form::label('price', 'Price') }}
                {{ Form::text('price', '', array('class' => 'form-control')) }}

                {{ Form::label('description', 'Description') }}
                {{ Form::textarea('description', '', array('class' => 'form-control text-area')) }}

                {{ Form::hidden('merchant_name', '', array('id'=>'merchant-name-input')) }}

                {{ Form::submit('ADD', array('class' => 'button darkblue admin-notification')) }}
            {{ Form::close() }}
        </div>
        <div id="create-merchant-box" class="centered admin-side-box" style="display: none">
            <span id="close-create-merchant" class="button-close admin">&#10006;</span>
            <h1>Create Merchant</h1>
            {{ Form::open(array('url' =>'/admin/create_merchant ')) }}
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
            <button id="yes-delete-id" class="button darkblue admin-notification">YES</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button id="no-delete-id" class="button cyan admin-notification">NO</button>
        </div>
    </div>

    <script type="text/javascript">

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
          $("#admin-manage-user-merchant-table").hide();
          $("#admin-manage-user-customer-table").fadeIn("fast");
          $("#admin-manage-user-merchant-button").removeClass('cyan');
          $("#admin-manage-user-customer-table").css("width","1230px");
          $("#admin-manage-user-merchant-table").css("width","1230px");
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
          $("#admin-manage-user-customer-table").hide();
          $("#admin-manage-user-merchant-table").fadeIn("fast");
          $("#admin-manage-user-customer-button").removeClass('cyan');
          $("#admin-manage-user-merchant-table").css("width","1230px");
          $("#admin-manage-user-customer-table").css("width","1230px");
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
            $("#admin-manage-user-customer-table").animate({width:'820px'});
            $("#admin-manage-user-customer-table th:nth-child(5)").animate({'width':'0%'});
            $("#admin-manage-user-customer-table td:nth-child(5)").animate({'width':'0%'});
            $("#admin-manage-user-customer-table td:nth-child(5)").css("padding","0px");
            $("#admin-manage-user-customer-table th:nth-child(5)").css("padding","0px");
        });

        $( "#close-profile" ).click(function() {
            $("#profile-box").fadeOut("fast");
            $("#admin-manage-user-customer-table").delay(300).animate({width:'1230px'});
            $("#admin-manage-user-customer-table th:nth-child(5)").delay(300).animate({'width':'15%'});
            $("#admin-manage-user-customer-table td:nth-child(5)").delay(300).animate({'width':'15%'});
        });

        $( ".add-product-button" ).click(function() {
            $("#add-product-box").delay(300).fadeIn("fast");
            $("#admin-manage-user-merchant-table").animate({width:'820px'});
            $("#admin-manage-user-merchant-table th:nth-child(5)").animate({'width':'0%'});
            $("#admin-manage-user-merchant-table td:nth-child(5)").animate({'width':'0%'});
            $("#admin-manage-user-merchant-table td:nth-child(5)").css("padding","0px");
            $("#admin-manage-user-merchant-table th:nth-child(5)").css("padding","0px");
            $("#create-merchant-button").hide();
            $("#create-merchant-box").hide();
            $("#pop-up-delete-id").hide();
            $("#merchant-name-input").val($("#add-product-button").val());
        });

        $( "#close-add-product" ).click(function() {
            $("#add-product-box").fadeOut("fast");
            $("#admin-manage-user-merchant-table").delay(300).animate({width:'1230px'});
            $("#admin-manage-user-merchant-table th:nth-child(5)").delay(300).animate({'width':'15%'});
            $("#admin-manage-user-merchant-table td:nth-child(5)").delay(300).animate({'width':'15%'});
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
            $("#admin-manage-user-merchant-table").animate({width:'820px'});
            $("#admin-manage-user-merchant-table th:nth-child(5)").animate({'width':'0%'});
            $("#admin-manage-user-merchant-table td:nth-child(5)").animate({'width':'0%'});
            $("#admin-manage-user-merchant-table td:nth-child(5)").css("padding","0px");
            $("#admin-manage-user-merchant-table th:nth-child(5)").css("padding","0px");
            $("#create-merchant-button").hide();
            $("#add-product-box").hide();
            $("#pop-up-delete-id").hide();
        });

        $( "#close-create-merchant" ).click(function() {
            $("#create-merchant-box").fadeOut("fast");
            $("#admin-manage-user-merchant-table").delay(300).animate({width:'1230px'});
            $("#admin-manage-user-merchant-table th:nth-child(5)").delay(300).animate({'width':'15%'});
            $("#admin-manage-user-merchant-table td:nth-child(5)").delay(300).animate({'width':'15%'});
            $("#create-merchant-button").delay(700).show(10);
            $("#pop-up-delete-id").hide();
        });

    </script>

@stop