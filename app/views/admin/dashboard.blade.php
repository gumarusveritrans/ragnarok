@extends('layouts.default-admin')

@section('content-admin')
    <div id="subheader-wrapper">
        <span class="subtitle admin">DASHBOARD</span>
    </div>

    <hr id="horizontal-line-dashboard" noshade size=1 width=95% color="blue" style="margin-top: -10px;">

    <div id="subcontent-wrapper">
        <div id="subbuttons-wrapper">
            <a href="#purchase"><button id="admin-purchase-transaction-button" class="button lightblue dashboard">Purchase Transaction</button></a>
            <a href="#transer"><button id="admin-transfer-transaction-button" class="button lightblue dashboard">Transfer Transaction</button></a>
            <a href="#top-up"><button id="admin-top-up-transaction-button" class="button lightblue dashboard">Top-Up Transaction</button></a>
        </div>

        <div class="all-table admin">
            <table id="admin-purchase-transaction-table" align="center"style="display: none">
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
                </tr>
            </table>

            <table id="admin-transfer-transaction-table" align="center" style="display: none">
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
                <tr>
                    <td >
                        TID99999999
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
                        gumarus.darmawan.william
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
                </tr>
            </table>

            <table id="admin-top-up-transaction-table" align="center" style="display: none">
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
                <tr>
                    <td >
                        TUID99999999
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
                        Inactive
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
                </tr>
            </table>

        </div>
        <span id="download-purchase" class="link-download" style="display: none">{{ link_to ("/", 'Download as Excel or CSV') }}</span>
        <span id="download-transfer" class="link-download" style="display: none">{{ link_to ("/", 'Download as Excel or CSV') }}</span>
        <span id="download-top-up" class="link-download" style="display: none">{{ link_to ("/", 'Download as Excel or CSV') }}</span>
    </div>

    <script type="text/javascript">

        $( "#admin-purchase-transaction-button" ).click(function() {
          $( "#admin-transfer-transaction-table" ).hide();
          $( "#admin-top-up-transaction-table" ).hide();
          $( "#download-transfer" ).hide();
          $( "#download-top-up" ).hide();
          $( "#admin-purchase-transaction-table" ).fadeIn("fast");
          $( "#download-purchase" ).fadeIn("fast");
          $('.cyan').removeClass('cyan');
          $(this).addClass('cyan');
        });

        $( "#admin-transfer-transaction-button" ).click(function() {
          $( "#admin-purchase-transaction-table" ).hide();
          $( "#admin-top-up-transaction-table" ).hide();
          $( "#download-purchase" ).hide();
          $( "#download-top-up" ).hide();
          $( "#admin-transfer-transaction-table" ).fadeIn("fast");
          $( "#download-transfer" ).fadeIn("fast");
          $('.cyan').removeClass('cyan');
          $(this).addClass('cyan');
        });
    
        $( "#admin-top-up-transaction-button" ).click(function() {
          $( "#admin-purchase-transaction-table" ).hide();
          $( "#admin-transfer-transaction-table" ).hide();
          $( "#download-purchase" ).hide();
          $( "#download-transfer" ).hide();
          $( "#admin-top-up-transaction-table" ).fadeIn("fast");
          $( "#download-top-up" ).fadeIn("fast");
          $('.cyan').removeClass('cyan');
          $(this).addClass('cyan');
        });

    </script>
@stop