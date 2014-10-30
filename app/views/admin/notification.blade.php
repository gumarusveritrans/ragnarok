@extends('layouts.default-admin')

@section('content-admin')
    <div id="subheader-wrapper">
        <span class="subtitle admin">NOTIFICATION</span>
    </div>

    <hr id="horizontal-line-dashboard" noshade size=1 width=95% color="blue"/>

    <div id="subcontent-wrapper">
        <div id="subbuttons-wrapper">
            <a href="#close-account"><button id="admin-close-account-button" class="button lightblue dashboard">Close Account</button></a>
            <a href="#increase-limit"><button id="admin-increase-limit-button" class="button lightblue dashboard">Increase Limit</button></a>
        </div>

        <div class="all-table admin">
            <table id="admin-close-account-table" align="center" style="display: none">
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
                <tr>
                    <td >
                        Row 1
                    </td>
                    <td>
                        Row 1
                    </td>
                    <td>
                        Row 1
                    </td>
                    <td>
                        <a href="#customer-detail"><button id="customer-detail-button" class="button-table darkblue dashboard">Customer Details</button></a>
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
                        
                    </td>
                </tr>
            </table>

            <table id="admin-increase-limit-table" align="center" style="display: none">
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
                <tr>
                    <td>
                        Row 1
                    </td>
                    <td>
                        Row 1
                    </td>
                    <td>
                        Row 1
                    </td>
                    <td>
                        <a href="#confirm-request"><button id="confirm-request-button" class="button-table darkblue dashboard">Confirm Request</button></a>
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
                </tr>
            </table>
        </div>

        <div id="customer-detail-box" class="centered admin-side-box" style="display: none">
            <span id="close-customer-detail" class="button-close">&#10006;</span>
            <h2>Customer Details</h2>
            <br/>
            <h1>daniel.aja</h1>
            <br/>
            <table id="admin-side-table">
                <tr>
                    <td>
                        Redeem Amount
                    </td>
                    <td>
                        Rp 100.000,-
                    </td>
                </tr>
                <tr>
                    <td>
                        Account Number
                    </td>
                    <td>
                        4235325234
                    </td>
                </tr>
                <tr>
                    <td>
                        Account Bank
                    </td>
                    <td>
                        BCA
                    </td>
                </tr>
                <tr>
                    <td>
                        Account Name
                    </td>
                    <td>
                        Daniel Aja
                    </td>
                </tr>
            </table>
            <br/>
            <button id="close-account-button" class="button darkblue dashboard">Close Account</button>
        </div>

        <div id="confirm-request-box" class="centered admin-side-box" style="display: none">
            <span id="close-confirm-request" class="button-close">&#10006;</span>
            <h2>Customer Details</h2>
            <br/>
            <h1>daniel.aja</h1>
            <br/>
            <img src="" width="100%" height="200px"></img>
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
            <br/>
            <a href="#"><button class="button darkblue admin-notification">ACCEPT</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="#deny"><button id="denial-button" class="button cyan admin-notification">DENY</button></a>
            <br/><br/>
            <div id="denial-messages-box" style="display: none">
                {{ Form::open() }}
                    {{ Form::label('denial_messages', 'Denial Messages') }}
                    {{ Form::textarea('denial_messages', '', array('class' => 'form-control text-area')) }}
                    {{ Form::submit('SEND', array('class' => 'button darkblue admin-notification')) }}
                {{ Form::close() }}
            </div>
        </div>
        <div id="pop-up-close-account" class="pop-up" style="display: none">
            <h1>CLOSE ACCOUNT</h1>
            <h2>Are you sure to close user's account?</h2>
            <a href=""><button id="yes-close-account" class="button darkblue admin-notification">YES</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button id="no-close-account" class="button cyan admin-notification">NO</button>
        </div>
    </div>

    <script type="text/javascript">

        $( "#admin-close-account-button" ).click(function() {
          $( "#admin-increase-limit-table" ).hide();
          $( "#admin-close-account-table" ).fadeIn("fast");
          $("#admin-increase-limit-button").removeClass('cyan');
          $("#admin-close-account-table").css("width","90%");
          $("#admin-increase-limit-table").css("width","90%");
          $("#customer-detail-box").hide();
          $("#confirm-request-box").hide();
          $(this).addClass('cyan');
        });

        $( "#admin-increase-limit-button" ).click(function() {
          $( "#admin-close-account-table" ).hide();
          $( "#admin-increase-limit-table" ).fadeIn("fast");
          $("#admin-close-account-button").removeClass('cyan');
          $("#admin-close-account-table").css("width","90%");
          $("#admin-increase-limit-table").css("width","90%");
          $("#customer-detail-box").hide();
          $("#confirm-request-box").hide();
          $(this).addClass('cyan');
        });

        $( "#customer-detail-button" ).click(function() {
            $("#customer-detail-box").delay(300).fadeIn("fast");
            $("#admin-close-account-table").animate({width:'60%'});
        });

        $( "#confirm-request-button" ).click(function() {
            $("#confirm-request-box").delay(300).fadeIn("fast");
            $("#admin-increase-limit-table").animate({width:'60%'});
        });

        $( "#denial-button" ).click(function() {
            $( "#denial-messages-box" ).fadeIn("fast");
        });

        $( "#close-customer-detail" ).click(function() {
            $("#customer-detail-box").fadeOut("fast");
            $("#admin-close-account-table").delay(300).animate({width:'90%'});
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

        //$( "#customer-detail-button" ).click(function() {
        //   $("td:nth-child(2),th:nth-child(2)").hide();
        //});

    </script>
@stop

