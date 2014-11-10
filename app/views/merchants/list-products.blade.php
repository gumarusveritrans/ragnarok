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
                @foreach ($products as $product)
                <tr>
                    <td >
                        {{{ 'PID'.$product->id }}}
                    </td>
                    <td>
                        {{{ $product->product_name }}}
                    </td>
                    <td>
                        Rp {{{ number_format($product->price, 2, ',', '.') }}}
                    </td>
                    <td>
                        {{{ $product->description }}}
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>

@stop