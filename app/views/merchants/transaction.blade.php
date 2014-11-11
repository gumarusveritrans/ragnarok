@extends('layouts.default-merchant')

@section('content-merchant')
    <div id="subheader-wrapper">
        <span class="subtitle merchant">TRANSACTION</span>
    </div>

    <hr id="merchant-horizontal-line"/>

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
                @foreach ($purchases as $purchase)
                    <tr>
                        <td >
                            TID{{{$purchase->id}}}
                        </td>
                        <td>
                            {{{$purchase->date_transaction}}}
                        </td>
                        <td>
                            {{{$purchase->username_customer}}}
                        </td>
                        <td>
                            {{{$total}}}
                        </td>
                        <td>
                            {{{$purchase->status}}}
                        </td>
                        <td>
                            <a href="#accept-transaction"><button id="{{{$purchase->id}}}" class="accept-button button-table darkred merchant">Accept</button></a>
                        </td>
                        <td>
                            <a href="#reject-transaction"><button id="{{{$purchase->id}}}" class="reject-button button-table lightred merchant">Reject</button></a>
                        </td>
                    </tr>
                @endforeach
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
            $("#pop-up-reject-transaction").fadeOut("fast");
        });

        $( "#reject-button" ).click(function() {
            $("#pop-up-reject-transaction").fadeIn("fast");
        });

        $( "#no-reject-transaction" ).click(function() {
            $("#pop-up-accept-transaction").fadeOut("fast");
            $("#pop-up-reject-transaction").fadeOut("fast");
        });

    </script>

@stop