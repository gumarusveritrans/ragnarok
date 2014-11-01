@extends('layouts.default-merchant')

@section('content-merchant')
    <div id="subheader-wrapper">
        <span class="subtitle merchant">LIST PRODUCTS</span>
    </div>

    <hr id="horizontal-line-dashboard" noshade size=1 width=95% color="red" style="margin-top: -10px;">

    <div id="subcontent-wrapper">

        <div class="all-table merchant">
            <table id="merchant-list-products-table" align="center">
                <thead>
                    <tr>
                        <th>
                            Product ID
                        </th>
                        <th>
                            Product Name
                        </th>
                        <th>
                            Price
                        </th>
                        <th>
                            Description
                        </th>
                    </tr>
                </thead>
                <tr>
                    <td >
                        PID99999999
                    </td>
                    <td>
                        Tiket Samarinda-Jakarta PP
                    </td>
                    <td>
                        Rp 1.500.000,00
                    </td>
                    <td>
                        Tiket penerbangan dari Samarinda ke Jakarta pulang-pergi
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

@stop