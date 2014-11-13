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
                    </tr>
                </thead>
                @foreach ($purchases as $purchase)
                    <tr>
                        <td >
                            TID{{{$purchase->id}}}
                        </td>
                        <td>
                            {{{$purchase->date_purchase}}}
                        </td>
                        <td>
                            {{{$purchase->username_customer}}}
                        </td>
                        <td>
                           Rp {{{number_format($purchase->total(), 2, ',', '.')}}}
                        </td>
                        <td>
                            {{{$purchase->status}}}
                        </td>
                        <td>
                            @if($purchase->status == "success")
                                <a href="#reject-transaction"><button id="{{{$purchase->id}}}" class="reject-button button-table darkred merchant">Reject</button></a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        
        <span class="link-download-merchant" class="link-download">{{ link_to ("/merchants/download-csv", 'Download as CSV') }}</span>
        <div id="pop-up-reject-transaction" class="merchant pop-up" style="display: none">
            <h1>REJECT TRANSACTION</h1>
            <h2>Are you sure want to reject this transaction?</h2>
            <button id="yes-reject-transaction" class="button darkred merchant">YES</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button id="no-reject-transaction" class="button lightred merchant">NO</button>
        </div>
    </div>

    <script type="text/javascript">

        $( ".reject-button" ).click(function() {
            $("#pop-up-reject-transaction").fadeIn("fast");
        });

        $( "#no-reject-transaction" ).click(function() {
            $("#pop-up-reject-transaction").fadeOut("fast");
        });

    </script>

@stop