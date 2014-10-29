@extends('layouts.default-admin')

@section('content-admin')
    <div id="subheader-wrapper">
        <span class="subtitle admin">MANAGE USER</span>
    </div>

    <hr id="horizontal-line-dashboard" noshade size=1 width=95% color="blue"/>

    <div id="subcontent-wrapper">
        <div id="subbuttons-wrapper">
            <a href="#manage-customer"><button id="admin-manage-user-customer-button" class="button lightblue dashboard">Customer</button></a>
            <a href="#manage-merchant"><button id="admin-manage-user-merchant-button" class="button lightblue dashboard">Merchant</button></a>
        </div>

        <div class="all-table admin">
            <table id="admin-manage-user-customer-table" align="center" style="display: none">
                <thead>
                    <tr>
                        <th>
                            Customer ID
                        </th>
                        <th>
                            Customer Name
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            Balance
                        </th>
                        <th>
                            Limit Amount
                        </th>
                        <th>
                            
                        </th>
                    </tr>
                </thead>
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
                    <td>
                        Row 1
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
                        Row 1
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
                        Row 1
                    </td>
                </tr>
            </table>

            <table id="admin-manage-user-merchant-table" align="center" style="display: none">
                <thead>
                    <tr>
                        <th>
                            Merchant ID
                        </th>
                        <th>
                            Merchant Name
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            Balance
                        </th>
                        <th>
                            
                        </th>
                        <th>
                            
                        </th>
                    </tr>
                </thead>
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
                    <td>
                        Row 1
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
                        Row 1
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
                        Row 1
                    </td>
                </tr>
            </table>

        </div>

    </div>

    <script type="text/javascript">

        $( "#admin-manage-user-customer-button" ).click(function() {
          $( "#admin-manage-user-merchant-table" ).hide();
          $( "#admin-manage-user-customer-table" ).fadeIn("fast");
          $('.cyan').removeClass('cyan');
          $(this).addClass('cyan');
        });

        $( "#admin-manage-user-merchant-button" ).click(function() {
          $( "#admin-manage-user-customer-table" ).hide();
          $( "#admin-manage-user-merchant-table" ).fadeIn("fast");
          $('.cyan').removeClass('cyan');
          $(this).addClass('cyan');
        });

    </script>

@stop