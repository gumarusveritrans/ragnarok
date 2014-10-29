@extends('layouts.default-admin')

@section('content-admin')
    <div id="subheader-wrapper">
        <span class="subtitle admin">NOTIFICATION</span>
    </div>

    <hr id="horizontal-line-dashboard" noshade size=1 width=95% color="blue"/>

    <div id="subcontent-wrapper">
        <div id="subbuttons-wrapper">
            <a href="#close-account"><button id="admin-close-account-button" class="button lightblue dashboard">Close Account</button></a>
            <a href="#increase-limit"><button id="admin-increase-limit-button" class="button lightblue dashboard">Increase Limit</button></a>
        </div>

        <div class="all-table admin">
            <table id="admin-close-account-table" align="center" style="display: none">
                <thead>
                    <tr>
                        <th>
                            Transaction Type
                        </th>
                        <th>
                            Date & Time
                        </th>
                        <th>
                            Bank
                        </th>
                        <th>
                            Amount
                        </th>
                        <th>
                            Description
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

            <table id="admin-increase-limit-table" align="center" style="display: none">
                <thead>
                    <tr>
                        <th>
                            Request ID
                        </th>
                        <th>
                            Date & Time
                        </th>
                        <th>
                            Customer Name
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
                </tr>
            </table>
        </div>

    </div>

    <script type="text/javascript">

        $( "#admin-close-account-button" ).click(function() {
          $( "#admin-increase-limit-table" ).hide();
          $( "#admin-close-account-table" ).fadeIn("fast");
          $('.cyan').removeClass('cyan');
          $(this).addClass('cyan');
        });

        $( "#admin-increase-limit-button" ).click(function() {
          $( "#admin-close-account-table" ).hide();
          $( "#admin-increase-limit-table" ).fadeIn("fast");
          $('.cyan').removeClass('cyan');
          $(this).addClass('cyan');
        });

    </script>
@stop

