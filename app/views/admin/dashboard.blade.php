@extends('layouts.default-admin')

@section('content-admin')
    <div id="subheader-wrapper">
        <span class="subtitle admin">DASHBOARD</span>
    </div>

    <hr id="admin-horizontal-line"/>

    <div id="subcontent-wrapper">
        <div id="subbuttons-wrapper">
            <a href="#purchase"><button id="admin-purchase-transaction-button" class="button lightblue dashboard">Purchase Transaction</button></a>
            <a href="#transer"><button id="admin-transfer-transaction-button" class="button lightblue dashboard">Transfer Transaction</button></a>
            <a href="#top-up"><button id="admin-top-up-transaction-button" class="button lightblue dashboard">Top-Up Transaction</button></a>
        </div>

        <div  id="admin-purchase-transaction-table" class="all-table admin" style="display: none">
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
                <tr>
                    <td >
                        PID99999999
                    </td>
                    <td>
                        16/10/2014 18:10:14
                    </td>
                    <td>
                        gumarus.dharmawan.william
                    </td>
                    <td>
                        Rp 5.000.000,00
                    </td>
                    <td>
                        Garuda Indonesia
                    </td>
                </tr>
            </table>
            <span class="link-download-admin">{{ link_to ("/admin/download-csv-purchase", 'Download as CSV') }}</span>
        </div>
        <div id="admin-transfer-transaction-table" class="all-table admin" style="display: none">
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
                        {{{ $transfer->amount }}}
                    </td>
                    <td>
                        {{{ $transfer->to_username }}}
                    </td>
                </tr>
                @endforeach
            </table>
            <span class="link-download-admin">{{ link_to ("/admin/download-csv-transfer", 'Download as CSV') }}</span>
        </div>
        <div id="admin-top-up-transaction-table" class="all-table admin" style="display: none">
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
                        {{{ $topup->amount }}}
                    </td>
                    <td>
                        {{{ $topup->status }}}
                    </td>
                </tr>
                @endforeach
            </table>
            <span class="link-download-admin">{{ link_to ("/admin/download-csv-topup", 'Download as CSV') }}</span>
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

    </script>
@stop