@extends('layouts.default-admin')

@section('content-admin')
    <div id="subheader-wrapper">
        <span class="subtitle admin">DASHBOARD</span>
    </div>

    <hr id="admin-horizontal-line"/>

    <div id="subcontent-wrapper">
        <div id="subbuttons-wrapper">
            <a href="#purchase"><button id="admin-purchase-transaction-button" class="button lightblue dashboard">Purchase Transaction</button></a>
            <a href="#transfer"><button id="admin-transfer-transaction-button" class="button lightblue dashboard">Transfer Transaction</button></a>
            <a href="#top-up"><button id="admin-top-up-transaction-button" class="button lightblue dashboard">Top-Up Transaction</button></a>
        </div>

        <div id="admin-purchase-transaction-table" class="all-table admin" style="display: none">
            @if ($purchases->count() == 0)
            <div>
                You do not have any purchase transaction records yet.
            </div>
            @elseif ($purchases->count() > 0)
            <table align="center">
                <thead>
                    <tr>
                        <th>
                            Purchase ID
                        </th>
                        <th>
                            Date & Time
                        </th>
                        <th>
                            Customer Name
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
                    <td >
                        {{{ "PID".$purchase->id }}}
                    </td>
                    <td>
                        {{{ $purchase->date_purchase }}}
                    </td>
                    <td>
                        {{{ $purchase->username_customer }}}
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
            <span class="link-download-admin">{{ link_to ("/admin/download-csv?transaction_type=purchase", 'Download as CSV') }}</span>
            @endif
        </div>

        <div id="admin-transfer-transaction-table" class="all-table admin" style="display: none">
            @if ($transfers->count() == 0)
            <div>
                You do not have any transfer transaction records yet.
            </div>
            @elseif ($transfers->count() > 0)
            <table align="center">
                <thead>
                    <tr>
                        <th>
                            Transfer ID
                        </th>
                        <th>
                            Date & Time
                        </th>
                        <th>
                            Customer Name (Sender)
                        </th>
                        <th>
                            Amount
                        </th>
                        <th>
                            Customer Name (Receiver)
                        </th>
                    </tr>
                </thead>
                @foreach ($transfers as $transfer)
                <tr>
                    <td >
                        {{{ "TID".$transfer->id }}}
                    </td>
                    <td>
                        {{{ $transfer->date_transfer }}}
                    </td>
                    <td>
                        {{{ $transfer->from_username }}}
                    </td>
                    <td>
                        Rp {{{ number_format($transfer->amount, 2, ',', '.') }}}
                    </td>
                    <td>
                        {{{ $transfer->to_username }}}
                    </td>
                </tr>
                @endforeach
            </table>
            <span class="link-download-admin">{{ link_to ("/admin/download-csv?transaction_type=transfer", 'Download as CSV') }}</span>
            @endif
        </div>

        <div id="admin-top-up-transaction-table" class="all-table admin" style="display: none">
            @if ($topups->count() == 0)
            <div>
                You do not have any top up transaction records yet.
            </div>
            @elseif ($topups->count() > 0)
            <table  align="center">
                <thead>
                    <tr>
                        <th>
                            Top-Up ID
                        </th>
                        <th>
                            Date & Time
                        </th>
                        <th>
                            Customer Name
                        </th>
                        <th>
                            Permata VA Number
                        </th>
                        <th>
                            Amount
                        </th>
                        <th>
                            Status
                        </th>
                    </tr>
                </thead>
                @foreach ($topups as $topup)
                <tr>
                    <td >
                        {{{ "TID".$topup->id }}}
                    </td>
                    <td>
                        {{{ $topup->date_topup }}}
                    </td>
                    <td>
                        {{{ $topup->username_customer }}}
                    </td>
                    <td>
                        {{{ $topup->permata_va_number }}}
                    </td>
                    <td>
                        Rp {{{ number_format($topup->amount, 2, ',', '.') }}}
                    </td>
                    <td>
                        {{{ $topup->status }}}
                    </td>
                </tr>
                @endforeach
            </table>
            <span class="link-download-admin">{{ link_to ("/admin/download-csv?transaction_type=topup", 'Download as CSV') }}</span>
            @endif
        </div>
        
    </div>

    <script type="text/javascript">

        $( "#admin-purchase-transaction-button" ).click(function() {
          $( "#admin-transfer-transaction-table" ).hide();
          $( "#admin-top-up-transaction-table" ).hide();
          $( "#admin-purchase-transaction-table" ).fadeIn("fast");
          $('.cyan').removeClass('cyan');
          $(this).addClass('cyan');
        });

        $( "#admin-transfer-transaction-button" ).click(function() {
          $( "#admin-purchase-transaction-table" ).hide();
          $( "#admin-top-up-transaction-table" ).hide();
          $( "#admin-transfer-transaction-table" ).fadeIn("fast");
          $('.cyan').removeClass('cyan');
          $(this).addClass('cyan');
        });
    
        $( "#admin-top-up-transaction-button" ).click(function() {
          $( "#admin-purchase-transaction-table" ).hide();
          $( "#admin-transfer-transaction-table" ).hide();
          $( "#admin-top-up-transaction-table" ).fadeIn("fast");
          $('.cyan').removeClass('cyan');
          $(this).addClass('cyan');
        });

        $(document).ready(function(){
            var purchase_transfer_topup_path = location.href.split("#")[1];
            if(purchase_transfer_topup_path == "purchase") {
                $( "#admin-purchase-transaction-button" ).trigger("click");
            }
            else if(purchase_transfer_topup_path == "transfer") {
                $( "#admin-transfer-transaction-button" ).trigger("click");
            }
            else if(purchase_transfer_topup_path == "top-up") {
                $( "#admin-top-up-transaction-button" ).trigger("click");
            }
        });

    </script>
@stop