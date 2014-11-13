@extends('layouts.default')

@section('content')
    <div id="subheader-wrapper">
        <span class="subtitle customer">DASHBOARD</span>
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
        <div id="subbuttons-wrapper">
            <a href="#top-up"><button id="topup-dashboard-button" class="button lightbrown dashboard">Top-Up Transaction</button></a>
            <a href="#transfer"><button id="transfer-dashboard-button" class="button lightbrown dashboard">Transfer Transaction</button></a>
            <a href="#purchase"><button id="purchase-dashboard-button" class="button lightbrown dashboard">Purchase Transaction</button></a>
        </div>

        <div id="topup-dashboard-table" class="all-table customer" style="display:none">
            <div class="centered">
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
                            Permata VA Number
                        </th>
                        <th>
                            Status
                        </th>
                    </tr>
                </thead>
                @foreach ($topups as $topup) 
                <tr>
                    <td>
                        {{{ "TUID".$topup->id }}}
                    </td>
                    <td>
                        {{{ $topup->date_topup }}}
                    </td>
                    <td>
                        Rp {{{ number_format($topup->amount, 2, ',', '.') }}}
                    </td>
                    <td>
                        {{{ $topup->permata_va_number }}}
                    </td>
                    <td>
                        {{{ $topup->status }}}
                    </td>
                </tr>
                @endforeach
            </table>

            <span class="link-download-customer">{{ link_to ("/customers/download-csv?transaction_type=topup", 'Download as CSV') }}</span>
            </div>
        </div>

        <div id="transfer-dashboard-table" class="all-table customer" style="display:none">
            <div class="centered">
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
                @foreach ($transfers as $transfer) 
                <tr>
                    <td>
                        {{{ "TID".$transfer->id }}}
                    </td>
                    <td>
                        {{{ $transfer->date_transfer }}}
                    </td>
                    <td>
                        {{{ $transfer->amount }}}
                    </td>
                    <td>
                        {{{ $transfer->to_username }}}
                    </td>
                </tr>
                @endforeach
            </table>
            <span class="link-download-customer">{{ link_to ("/customers/download-csv?transaction_type=transfer", 'Download as CSV') }}</span>
            </div>
        </div>

        <div id="purchase-dashboard-table" class="all-table customer" style="display:none">
            <div class="centered">
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
                @foreach ($purchases as $purchase) 
                <tr>
                    <td>
                        {{{ "PID".$purchase->id }}}
                    </td>
                    <td>
                        {{{ $purchase->date_purchase }}}
                    </td>
                    <td>
                       Rp {{{ number_format($purchase->total(),2,',','.') }}}
                    </td>
                    <td>
                        {{{ $purchase->product->first()->merchant_name or 'error' }}}
                    </td>
                </tr>
                @endforeach
            </table>
            <span class="link-download-customer">{{ link_to ("/customers/download-csv?transaction_type=purchase", 'Download as CSV') }}</span>
            </div>
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