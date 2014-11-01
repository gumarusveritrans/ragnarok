@extends('layouts.default-merchant')

@section('content-merchant')
    <div id="subheader-wrapper">
        <span class="subtitle merchant">TRANSACTION</span>
    </div>

    <hr id="horizontal-line-dashboard" noshade size=1 width=95% color="red" style="margin-top: -10px;">

    <div id="subcontent-wrapper">

        <div class="all-table merchant">
            <table id="merchant-transaction-table" align="center">
                <thead>
                    <tr>
                        <th>
                            Transaction ID
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
                        <th>
                            
                        </th>
                        <th>
                            
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
                        In Process
                    </td>
                    <td>
                        <a href="#accept-transaction"><button id="accept-button" class="button-table darkred merchant">Accept</button></a>
                    </td>
                    <td>
                        <a href="#reject-transaction"><button id="reject-button" class="button-table lightred merchant">Reject</button></a>
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
                    <td>
                        Row 3
                    </td>
                    <td>
                        Row 3
                    </td>
                </tr>
            </table>
        </div>
        <span id="download-transaction" class="link-download" style="display: none">{{ link_to ("/", 'Download as Excel or CSV') }}</span>
        <div id="pop-up-accept-transaction" class="merchant pop-up" style="display: none">
            <h1>ACCEPT TRANSACTION</h1>
            <h2>Are you sure want to accept this transaction?</h2>
            <button id="yes-accept-transaction" class="button darkred merchant">YES</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button id="no-accept-transaction" class="button lightred merchant">NO</button>
        </div>
        <div id="pop-up-reject-transaction" class="merchant pop-up" style="display: none">
            <h1>REJECT TRANSACTION</h1>
            <h2>Are you sure want to reject this transaction?</h2>
            <button id="yes-reject-transaction" class="button darkred merchant">YES</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button id="no-reject-transaction" class="button lightred merchant">NO</button>
        </div>
    </div>

    <script type="text/javascript">

        $( "#accept-button" ).click(function() {
            $("#pop-up-accept-transaction").fadeIn("fast");
        });

        $( "#no-accept-transaction" ).click(function() {
            $("#pop-up-accept-transaction").fadeOut("fast");
        });

        $( "#reject-button" ).click(function() {
            $("#pop-up-reject-transaction").fadeIn("fast");
        });

        $( "#no-reject-transaction" ).click(function() {
            $("#pop-up-reject-transaction").fadeOut("fast");
        });

    </script>

@stop