@extends('layouts.default')

@section('content')
    <div id="subheader-wrapper">
        <span class="subtitle">DASHBOARD</span>
        <div class="balance">
        	Balance<br/>
        	<span class="currency">
        		Rp 3.000.000,00
        	</span><br/>
            from the limit of
        	@if(true)
          		Rp 5.000.000,00
        	@else
            	Rp 1.000.000,00
        	@endif
        </div>
    </div>
    <hr id="horizontal-line-dashboard" noshade size=1 width=95% />

    <div id="subcontent-wrapper">
        <div id="subbuttons-wrapper">
            <button id="topup-transaction-button" class="button orange dashboard">Top-Up Transaction</button>
            <button id="transfer-transaction-button" class="button lightbrown dashboard">Transfer Transaction</button>
            <button id="purchase-transaction-button" class="button lightbrown dashboard">Purchase Transaction</button>
        </div>

        <div id="topup-transaction-table" class="dashboard-table">
            <table align="center">
                <tr>
                    <td>
                        Top Up ID
                    </td>
                    <td>
                        Date & Time
                    </td>
                    <td>
                        Amount
                    </td>
                    <td>
                        Status
                    </td>
                </tr>
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
                <tr>
                    <td>
                        
                    </td>
                    <td>
                        
                    </td>
                    <td>
                        
                    </td>
                    <td>
                        
                    </td>
                </tr>
                <tr>
                    <td>
                        
                    </td>
                    <td>
                        
                    </td>
                    <td>
                        
                    </td>
                    <td>
                        
                    </td>
                </tr>
            </table>
        </div>

        <div id="transfer-transaction-table" class="dashboard-table" style="display:none">
            <table align="center">
                <tr>
                    <td>
                        Transfer ID
                    </td>
                    <td >
                        Date & Time
                    </td>
                    <td>
                        Amount
                    </td>
                    <td>
                        Destination Account
                    </td>
                </tr>
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
                    <td >
                        Row 2
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
                <tr>
                    <td >
                       
                    </td>
                    <td>
                       
                    </td>
                    <td>
                        
                    </td>
                    <td>
                        
                    </td>
                </tr>
                <tr>
                    <td >
                        
                    </td>
                    <td>
                        
                    </td>
                    <td>
                        
                    </td>
                    <td>
                        
                    </td>
                </tr>
            </table>
        </div>

        <div id="purchase-transaction-table" class="dashboard-table" style="display:none">
            <table align="center">
                <tr>
                    <td>
                        Purchase ID
                    </td>
                    <td >
                        Date & Time
                    </td>
                    <td>
                        Gross Amount
                    </td>
                    <td>
                        Merchant Name
                    </td>
                </tr>
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
                <tr>
                    <td>
                      
                    </td>
                    <td>
                       
                    </td>
                    <td>
                      
                    </td>
                    <td>
                       
                    </td>
                </tr>
                <tr>
                    <td>
                     
                    </td>
                    <td>
                     
                    </td>
                    <td>
                     
                    </td>
                    <td>
                    
                    </td>
                </tr>
            </table>
        </div>

    </div>


    <script type="text/javascript">

        $( "#topup-transaction-button" ).click(function() {
          $( "#topup-transaction-table" ).fadeIn();
          $( "#transfer-transaction-table" ).hide();
          $( "#purchase-transaction-table" ).hide();
        });

        $( "#transfer-transaction-button" ).click(function() {
          $( "#topup-transaction-table" ).hide();
          $( "#transfer-transaction-table" ).fadeIn();
          $( "#purchase-transaction-table" ).hide();
        });

        $( "#purchase-transaction-button" ).click(function() {
          $( "#topup-transaction-table" ).hide();
          $( "#transfer-transaction-table" ).hide();
          $( "#purchase-transaction-table" ).fadeIn();
        });


    </script>
@stop