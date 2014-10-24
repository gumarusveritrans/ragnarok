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
            <button href="" class="button orange dashboard">Top-Up Transaction</button>
            <button href="" class="button lightbrown dashboard">Transfer Transaction</button>
            <button href="" class="button lightbrown dashboard">Purchase Transaction</button>
        </div>

        <div class="dashboard-table">
            <table align="center">
                <tr>
                    <td>
                        Transaction Type
                    </td>
                    <td >
                        Date & Time
                    </td>
                    <td>
                        Bank
                    </td>
                    <td>
                        Amount
                    </td>
                    <td>
                        Description
                    </td>
                </tr>
                <tr>
                    <td >
                        Row 1
                    </td>
                    <td>
                        Row 1
                    </td>
                    <td>
                        Row 1
                    </td>
                    <td>
                        Row 1
                    </td>
                    <td>
                        Row 1
                    </td>
                </tr>
                <tr>
                    <td >
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
                <tr>
                    <td >
                        Row 4
                    </td>
                    <td>
                        Row 4
                    </td>
                    <td>
                        Row 4
                    </td>
                    <td>
                        Row 4
                    </td>
                    <td>
                        Row 4
                    </td>
                </tr>
            </table>

        </div>

    </div>
@stop