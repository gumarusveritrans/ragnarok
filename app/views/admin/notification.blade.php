@extends('layouts.default-admin')

@section('content-admin')
    <div id="subheader-wrapper">
        <span class="subtitle admin">NOTIFICATION</span>
    </div>

    <hr id="admin-horizontal-line"/>

    <div id="subcontent-wrapper">
        <div id="subbuttons-wrapper">
            <a href="#close-account"><button id="admin-close-account-button" class="button lightblue dashboard">Close Account</button></a>
            <a href="#increase-limit"><button id="admin-increase-limit-button" class="button lightblue dashboard">Increase Limit</button></a>
        </div>

        <div id="admin-close-account-wrapper" class="all-table admin" style="display: none">
            @if ($redeems->count() == 0)
            <div>
                You do not have any redeems records yet.
            </div>
            @elseif ($redeems->count() > 0)
            <table id="admin-close-account-table" align="center">
                <thead>
                    <tr>
                        <th>
                            Request ID
                        </th>
                        <th>
                            Date & Time
                        </th>
                        <th>
                            Customer Name
                        </th>
                        <th>
                            
                        </th>
                    </tr>
                </thead>
                @foreach ($redeems as $redeem)
                    <tr>
                        <td>
                            RCA{{{$redeem->id}}}
                        </td>
                        <td>
                            {{{$redeem->date_redeem}}}
                        </td>
                        <td>
                            {{{$redeem->username_customer}}}
                        </td>
                        <td>
                            <a href="#customer-detail"><button id="{{{$redeem->id}}}" class="button-table darkblue dashboard customer-detail-button">Customer Details</button></a>
                        </td>
                    </tr>
                @endforeach
            </table>
            @endif
        </div>

        <div id="admin-increase-limit-wrapper" class="all-table admin" style="display: none">
            @if ($increase_limits->count() == 0)
            <div>
                You do not have any increase limits records yet.
            </div>
            @elseif ($increase_limits->count() > 0)
            <table id="admin-increase-limit-table" align="center">
                <thead>
                    <tr>
                        <th>
                            Request ID
                        </th>
                        <th>
                            Date & Time
                        </th>
                        <th>
                            Customer Name
                        </th>
                        <th>
                            
                        </th>
                    </tr>
                </thead>
                @foreach ($increase_limits as $increase_limit)
                    <tr>
                        <td>
                            RIL{{{$increase_limit->id}}}
                        </td>
                        <td>
                            {{{$increase_limit->date_increase_limit}}}
                        </td>
                        <td>
                            {{{$increase_limit->username_customer}}}
                        </td>
                        <td>
                            <a href="#increase-limit#confirm-request"><button id="{{{$increase_limit->id}}}" class="button-table darkblue dashboard confirm-request-button">Confirm Request</button></a>
                        </td>
                    </tr>
                @endforeach
            </table>
            @endif
        </div>

        <div id="customer-detail-box" class="admin-side-box" style="display: none">
            <span id="close-customer-detail" class="button-close admin">&#10006;</span>
            <h2>Customer Details</h2>
            <br/>
            <h1 id="close-account-name"></h1>
            <br/>
            <table id="admin-side-table">
                <tr>
                    <td>
                        Redeem Amount
                    </td>
                    <td id="close-account-amount">
                        <!-- Generated by jquery -->
                    </td>
                </tr>
                <tr>
                    <td>
                        Account Number
                    </td>
                    <td id="close-account-account-number">
                    </td>
                </tr>
                <tr>
                    <td>
                        Account Bank
                    </td>
                    <td id="close-account-bank-name">
                        <!-- Generated by jquery -->
                    </td>
                </tr>
                <tr>
                    <td>
                        Account Name
                    </td>
                    <td id="close-account-account-name">
                        <!-- Generated by jquery -->
                    </td>
                </tr>
            </table>
            <br/>
            <button id="close-account-button" class="button darkblue dashboard">Close Account</button>
        </div>

        <div id="confirm-request-box" class="centered admin-side-box" style="display: none">
            <a href="#increase-limit" id="close-confirm-request" class="button-close admin" style="text-decoration:none">&#10006;</a>
            <h2>Customer Details</h2>
            <br/>
            <h1 id="increase-limit-name"></h1>
            <br/>
            <img id="increase-limit-image" src="" width="100%" height="40%"></img>
            <table id="admin-side-table">
                <tr>
                    <td>
                        ID Type
                    </td>
                    <td id="increase-limit-id-type">
                    </td>
                </tr>
                <tr>
                    <td>
                        ID Number
                    </td>
                    <td id="increase-limit-id-number">
                        <!-- Generated by jquery -->
                    </td>
                </tr>
                <tr>
                    <td>
                        Full Name
                    </td>
                    <td id="increase-limit-full-name">
                        <!-- Generated by jquery -->
                    </td>
                </tr>
                <tr>
                    <td>
                        Address
                    </td>
                    <td id="increase-limit-address">
                        <!-- Generated by jquery -->
                    </td>
                </tr>
                <tr>
                    <td>
                        Current Address
                    </td>
                    <td id="increase-limit-current-address">
                        <!-- Generated by jquery -->
                    </td>
                </tr>
                <tr>
                    <td>
                        Place, Date of Birth
                    </td>
                    <td>
                        <!-- Generated by jquery -->
                        <span id="increase-limit-place-birth"></span><span id="increase-limit-date-birth"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        Gender
                    </td>
                    <td id="increase-limit-gender">
                        <!-- Generated by jquery -->
                    </td>
                </tr>
            </table>
            <br/>
            <button id="accept-increase-limit-button" class="button darkblue admin-notification">ACCEPT</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="#increase-limit#confirm-request#deny"><button id="denial-button" class="button cyan admin-notification">DENY</button></a>
            <br/><br/>
            <div id="denial-messages-box" style="display: none">
                {{ Form::open((array('url' => 'admin/reject_increase_limit', 'method' => 'post'))) }}
                    {{ Form::label('denial_messages', 'Denial Messages') }}
                    {{ Form::textarea('denial_messages', '', array('class' => 'form-control admin text-area')) }}
                    {{ Form::hidden('increase_limit_id','',array('id'=>'increase_limit_id')) }}
                    {{ Form::hidden('increase_limit_username','',array('id'=>'increase_limit_username')) }}
                    @if ($errors->has('denial_messages')) <p class="error-message">{{ $errors->first('denial_messages') }}</p> @endif
                    {{ Form::submit('SEND', array('class' => 'button darkblue admin-notification')) }}
                {{ Form::close() }}
            </div>
        </div>
        <div id="pop-up-close-account" class="admin pop-up" style="display: none">
            <h1>CLOSE ACCOUNT</h1>
            <h2>Are you sure want to close user's account?</h2>
            <button id="yes-close-account" class="button darkblue admin-notification">YES</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button id="no-close-account" class="button cyan admin-notification">NO</button>
        </div>
        <div id="pop-up-close-account-confirmed" class="admin pop-up" style="display: none">
            <h1>CLOSE ACCOUNT</h1>
            <h2>User Account has been closed successfully!</h2>
            <button id="ok-close-account" class="button darkblue admin-notification">OK</button>
        </div>
        <div id="pop-up-confirm-request" class="admin pop-up" style="display: none">
            <h1>CONFIRMED</h1>
            <h2>User Account's Limit has been increased successfully!</h2>
            <button id="ok-confirm-request" class="button darkblue admin-notification">OK</button>
        </div>
    </div>

    <script type="text/javascript">

        var request_closed_account_id;
        var request_increase_limit_id;
        var customer_name;

        var close_account_name = [];
        var close_account_amount = [];
        var close_account_bank = [];
        var close_account_account_name = [];
        var close_account_number = [];
        @foreach ($redeems as $redeem)
            close_account_name[{{{$redeem->id}}}] = '{{{$redeem->username_customer}}}';
            close_account_amount[{{{$redeem->id}}}] = '{{{$redeem->amount}}}';
            close_account_bank[{{{$redeem->id}}}] = '{{{$redeem->bank_name}}}';
            close_account_account_name[{{{$redeem->id}}}] = '{{{$redeem->bank_account_name_receiver}}}';
            close_account_number[{{{$redeem->id}}}] = '{{{$redeem->bank_account_number_receiver}}}';
        @endforeach

        var increase_limit_name = [];
        var increase_limit_id_type = [];
        var increase_limit_id_number = [];
        var increase_limit_full_name = [];
        var increase_limit_address = [];
        var increase_limit_current_address = [];
        var increase_limit_place_birth = [];
        var increase_limit_date_birth = [];
        var increase_limit_gender = [];
        var increase_limit_image_url = [];
        @foreach ($increase_limits as $increase_limit)
            increase_limit_name[{{{$increase_limit->id}}}] = '{{{$increase_limit->username_customer}}}';
            increase_limit_id_type[{{{$increase_limit->id}}}] = '{{{$increase_limit->id_type}}}';
            increase_limit_id_number[{{{$increase_limit->id}}}] = '{{{$increase_limit->id_number}}}';
            increase_limit_full_name[{{{$increase_limit->id}}}] = '{{{$increase_limit->full_name}}}';
            increase_limit_address[{{{$increase_limit->id}}}] = '{{{$increase_limit->id_address}}}';
            increase_limit_current_address[{{{$increase_limit->id}}}] = '{{{$increase_limit->current_address}}}';
            increase_limit_place_birth[{{{$increase_limit->id}}}] = '{{{$increase_limit->birth_place}}}';
            increase_limit_date_birth[{{{$increase_limit->id}}}] = '{{{$increase_limit->birth_date}}}';
            increase_limit_gender[{{{$increase_limit->id}}}] = '{{{$increase_limit->gender}}}';
            increase_limit_image_url[{{{$increase_limit->id}}}] = '{{{(string) Image::make("app/storage/uploads/".$increase_limit->username_customer.".jpg")->encode("data-url")}}}';
        @endforeach

        function postRedeemed(){
            method = "post"; // Set method to post by default if not specified.

            // The rest of this code assumes you are not using a library.
            // It can be made less wordy if you use one.
            var form = document.createElement("form");
            form.setAttribute("method", method);
            form.setAttribute("action", '/admin/redeem_user');

            var hiddenField = document.createElement("input");
            
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", "_token");
            hiddenField.setAttribute("value", "{{{csrf_token()}}}");

            form.appendChild(hiddenField);

            hiddenField = document.createElement("input");

            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", "redeem_id");
            hiddenField.setAttribute("value", request_closed_account_id);

            form.appendChild(hiddenField);

            hiddenField = document.createElement("input");
            
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", "redeem_username");
            hiddenField.setAttribute("value", customer_name);

            form.appendChild(hiddenField);

            document.body.appendChild(form);
            form.submit();
        }

        function postAccepted(){
            method = "post"; // Set method to post by default if not specified.

            // The rest of this code assumes you are not using a library.
            // It can be made less wordy if you use one.
            var form = document.createElement("form");
            form.setAttribute("method", method);
            form.setAttribute("action", '/admin/accept_increase_limit');

            var hiddenField = document.createElement("input");
            
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", "_token");
            hiddenField.setAttribute("value", "{{{csrf_token()}}}");

            form.appendChild(hiddenField);

            hiddenField = document.createElement("input");
            
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", "increase_limit_id");
            hiddenField.setAttribute("value", request_increase_limit_id);

            form.appendChild(hiddenField);

            hiddenField = document.createElement("input");
            
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", "increase_limit_username");
            hiddenField.setAttribute("value", customer_name);

            form.appendChild(hiddenField);

            document.body.appendChild(form);
            form.submit();
        }

        $( "#admin-close-account-button" ).click(function() {
          $( "#admin-increase-limit-wrapper" ).hide();
          $( "#admin-close-account-wrapper" ).fadeIn("fast");
          $("#admin-increase-limit-button").removeClass('cyan');
          $("#admin-close-account-table").css("width","90%");
          $("#admin-increase-limit-table").css("width","90%");
          $("#customer-detail-box").hide();
          $("#confirm-request-box").hide();
          $("#pop-up-close-account").hide();
          $(this).addClass('cyan');
        });

        $( "#admin-increase-limit-button" ).click(function() {
          $( "#admin-close-account-wrapper" ).hide();
          $( "#admin-increase-limit-wrapper" ).fadeIn("fast");
          $("#admin-close-account-button").removeClass('cyan');
          $("#admin-close-account-table").css("width","90%");
          $("#admin-increase-limit-table").css("width","90%");
          $("#customer-detail-box").hide();
          $("#confirm-request-box").hide();
          $("#pop-up-close-account").hide();
          $(this).addClass('cyan');
        });

        $( ".customer-detail-button" ).click(function() {
            // Get wanted closed id
            request_closed_account_id = $(this).attr('id');
            customer_name = close_account_name[$(this).attr('id')];

            $("#close-account-name").html(close_account_name[$(this).attr('id')]);
            $("#close-account-amount").html('Rp '+new Intl.NumberFormat(['ban', 'id']).format(close_account_amount[$(this).attr('id')])+',00');
            $("#close-account-bank-name").html(close_account_bank[$(this).attr('id')]);
            $("#close-account-account-name").html(close_account_account_name[$(this).attr('id')]);
            $("#close-account-account-number").html(close_account_number[$(this).attr('id')]);

            $("#customer-detail-box").delay(300).fadeIn("fast");
            $("#admin-close-account-table").animate({width:'60%'});
            $("#pop-up-close-account").hide();
        });

        $( ".confirm-request-button" ).click(function() {
            request_increase_limit_id = $(this).attr('id');
            customer_name = increase_limit_name[$(this).attr('id')];

            $("#increase_limit_id").val(request_increase_limit_id);
            $("#increase_limit_username").val(customer_name);

            $("#increase-limit-name").html(increase_limit_name[$(this).attr('id')]);
            $("#increase-limit-id-type").html(increase_limit_id_type[$(this).attr('id')]);
            $("#increase-limit-id-number").html(increase_limit_id_number[$(this).attr('id')]);
            $("#increase-limit-full-name").html(increase_limit_full_name[$(this).attr('id')]);
            $("#increase-limit-address").html(increase_limit_address[$(this).attr('id')]);
            $("#increase-limit-current-address").html(increase_limit_current_address[$(this).attr('id')]);
            $("#increase-limit-place-birth").html(increase_limit_place_birth[$(this).attr('id')]+', ');
            $("#increase-limit-date-birth").html(increase_limit_date_birth[$(this).attr('id')]);
            $("#increase-limit-gender").html(increase_limit_gender[$(this).attr('id')]);
            $("#increase-limit-image").attr('src',increase_limit_image_url[$(this).attr('id')]);

            $("#confirm-request-box").delay(300).fadeIn("fast");
            $("#admin-increase-limit-table").animate({width:'60%'});
        });

        $( "#denial-button" ).click(function() {
            $( "#denial-messages-box" ).fadeIn("fast");
        });

        $( "#close-customer-detail" ).click(function() {
            $("#customer-detail-box").fadeOut("fast");
            $("#admin-close-account-table").delay(300).animate({width:'90%'});
            $("#pop-up-close-account").hide();
        });

        $( "#close-confirm-request" ).click(function() {
            $("#confirm-request-box").fadeOut("fast");
            $("#admin-increase-limit-table").delay(300).animate({width:'90%'});
        });

        $( "#close-account-button" ).click(function() {
            $("#pop-up-close-account").fadeIn("fast");
        });

        $( "#no-close-account" ).click(function() {
            $("#pop-up-close-account").fadeOut("fast");
        });

        $( "#yes-close-account" ).click(function() {
            $("#pop-up-close-account").fadeOut("fast");
            postRedeemed();
        });

        $( "#ok-close-account" ).click(function() {
            $("#pop-up-close-account-confirmed").fadeOut("fast");
        });

        $( "#accept-increase-limit-button" ).click(function() {
            //$("#pop-up-confirm-request").fadeIn("fast");
            postAccepted();
        });

        $( "#ok-confirm-request" ).click(function() {
            $("#pop-up-confirm-request").fadeOut("fast");
        });

        $(document).ready(function(){
            var close_account_increase_limit_path = location.href.split("#")[1];
            var confirm_request_path = location.href.split("#")[2];
            var deny_path = location.href.split("#")[3];
            if(close_account_increase_limit_path == "close-account") {
                $( "#admin-close-account-button" ).trigger("click");
            }
            else if (close_account_increase_limit_path == "increase-limit") {
                $( "#admin-increase-limit-button" ).trigger("click");
                if(confirm_request_path == "confirm-request") {
                    setTimeout(function () {
                       jQuery('.confirm-request-button').trigger('click');
                    }, 150);
                    if(deny_path == "deny") {
                        $( "#denial-button" ).trigger("click");
                    }
                }
            }
        });
    </script>
@stop