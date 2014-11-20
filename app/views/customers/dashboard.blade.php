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
            @if ($topups->count() == 0)
            <div>
                You do not have any top-up transaction records yet.
            </div>
            @elseif ($topups->count() > 0)
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
            @endif
        </div>


        <div id="transfer-dashboard-table" class="all-table customer" style="display:none">
            @if ($transfers->count() == 0)
            <div>
                You do not have any transfer transaction records yet.
            </div>
            @elseif ($transfers->count() > 0)
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
                            Sender Account
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
                        Rp {{{ number_format($transfer->amount, 2, ',', '.') }}}
                    </td>
                    <td>
                        {{{ $transfer->from_username }}}
                    </td>
                    <td>
                        {{{ $transfer->to_username }}}
                    </td>
                </tr>
                @endforeach
            </table>
            <span class="link-download-customer">{{ link_to ("/customers/download-csv?transaction_type=transfer", 'Download as CSV') }}</span>
            </div>
            @endif
        </div>

        <div id="purchase-dashboard-table" class="all-table customer" style="display:none">
            @if ($purchases->count() == 0)
            <div>
                You do not have any purchase transaction records yet.
            </div>
            @elseif ($purchases->count() > 0)
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
                        <th>
                            Status
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
                    <td>
                        {{{ $purchase->status }}}
                    </td>
                </tr>
                @endforeach
            </table>
            <span class="link-download-customer">{{ link_to ("/customers/download-csv?transaction_type=purchase", 'Download as CSV') }}</span>
            </div>
            @endif
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

        $(document).ready(function(){
            var purchase_transfer_topup_path = location.href.split("#")[1];
            if(purchase_transfer_topup_path == "purchase") {
                $( "#purchase-dashboard-button" ).trigger("click");
            }
            else if(purchase_transfer_topup_path == "transfer") {
                $( "#topup-dashboard-button" ).trigger("click");
            }
            else if(purchase_transfer_topup_path == "top-up") {
                $( "#transfer-dashboard-button" ).trigger("click");
            }
        });

    </script>
@stop