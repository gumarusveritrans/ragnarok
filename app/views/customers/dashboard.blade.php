@extends('layouts.default')

@section('content')
    <div id="subheader-wrapper">
        <span class="subtitle customer">DASHBOARD</span>
        <div class="balance">
        	Balance<br/>
        	<span class="currency">
        		Rp {{{$data['balance']}}}
        	</span><br/>
            from the limit of
        	Rp {{{$data['limitBalance']}}}
        </div>
    </div>
    <hr id="horizontal-line-dashboard" noshade size=1 width=95% color="#534741" />

    <div id="subcontent-wrapper">
        <div id="subbuttons-wrapper">
            <a href="#top-up"><button id="topup-dashboard-button" class="button lightbrown dashboard">Top-Up Transaction</button></a>
            <a href="#transfer"><button id="transfer-dashboard-button" class="button lightbrown dashboard">Transfer Transaction</button></a>
            <a href="#purchase"><button id="purchase-dashboard-button" class="button lightbrown dashboard">Purchase Transaction</button></a>
        </div>

        <div id="topup-dashboard-table" class="all-table customer" style="display:none">
            <table align="center">
                <thead>
                    <tr>
                        <th>
                            Top Up ID
                        </th>
                        <th>
                            Date & Time
                        </th>
                        <th>
                            Amount
                        </th>
                        <th>
                            Status
                        </th>
                    </tr>
                </thead>
                <tr>
                    <td>
                        TUID001
                    </td>
                    <td>
                        16/10/2014 18:10:14
                    </td>
                    <td>
                        Rp 150.000,00
                    </td>
                    <td>
                        Success
                    </td>
                </tr>
                <tr>
                    <td>
                        TUID001
                    </td>
                    <td>
                        17/10/2014 18:10:14
                    </td>
                    <td>
                        Rp 200.000,00
                    </td>
                    <td>
                        Pending
                    </td>
                </tr>
            </table>
        </div>

        <div id="transfer-dashboard-table" class="all-table customer" style="display:none">
            <table align="center">
                <thead>
                    <tr>
                        <th>
                            Transfer ID
                        </th>
                        <th >
                            Date & Time
                        </th>
                        <th>
                            Amount
                        </th>
                        <th>
                            Destination Account
                        </th>
                    </tr>
                </thead>
                <tr>
                    <td >
                        TID001
                    </td>
                    <td>
                        18/10/2014 18:10:14
                    </td>
                    <td>
                        Rp 10.000,00
                    </td>
                    <td>
                        william.gumarus
                    </td>
                </tr>
                <tr>
                    <td>
                        TID002
                    </td>
                    <td>
                        19/10/2014 18:10:14
                    </td>
                    <td>
                        Rp 50.000,00
                    </td>
                    <td>
                        daniel
                    </td>
                </tr>
            </table>
        </div>

        <div id="purchase-dashboard-table" class="all-table customer" style="display:none">
            <table align="center">
                <thead>
                    <tr>
                        <th>
                            Purchase ID
                        </th>
                        <th >
                            Date & Time
                        </th>
                        <th>
                            Amount
                        </th>
                        <th>
                            Merchant Name
                        </th>
                    </tr>
                </thead>
                <tr>
                    <td>
                        PID001
                    </td>
                    <td>
                        20/10/2014 18:10:14
                    </td>
                    <td>
                        Rp 150.000,00
                    </td>
                    <td>
                        Lazada
                    </td>
                </tr>
                <tr>
                    <td>
                        PID002
                    </td>
                    <td>
                        21/10/2014 18:10:14
                    </td>
                    <td>
                        Rp 100.000,00
                    </td>
                    <td>
                        Zalora
                    </td>
                </tr>
            </table>
        </div>

    </div>


    <script type="text/javascript">

        $("#topup-dashboard-button").click(function() {
          $("#transfer-dashboard-table").hide();
          $("#purchase-dashboard-table").hide();
          $("#topup-dashboard-table").fadeIn();
          $('.lightbrown').removeClass('lightbrown');
          $('.orange').removeClass('orange');
          $("#transfer-dashboard-button").addClass('lightbrown');
          $("#purchase-dashboard-button").addClass('lightbrown');
          $(this).addClass('orange');
        });

        $("#transfer-dashboard-button").click(function() {
          $("#topup-dashboard-table").hide();
          $("#purchase-dashboard-table").hide();
          $("#transfer-dashboard-table").fadeIn();
          $('.lightbrown').removeClass('lightbrown');
          $('.orange').removeClass('orange');
          $("#topup-dashboard-button").addClass('lightbrown');
          $("#purchase-dashboard-button").addClass('lightbrown');
          $(this).addClass('orange');
        });

        $("#purchase-dashboard-button").click(function() {
          $("#topup-dashboard-table").hide();
          $("#transfer-dashboard-table").hide();
          $("#purchase-dashboard-table").fadeIn();
          $('.lightbrown').removeClass('lightbrown');
          $('.orange').removeClass('orange');
          $("#topup-dashboard-button").addClass('lightbrown');
          $("#transfer-dashboard-button").addClass('lightbrown');
          $(this).addClass('orange');
        });


    </script>
@stop