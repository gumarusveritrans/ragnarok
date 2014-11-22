@extends('layouts.default-merchant')

@section('content-merchant')
    <div id="subheader-wrapper">
        <span class="subtitle merchant">LIST PRODUCTS</span>
        <div class="balance">
          Balance Amount<br/>
            <span class="currency">
                Rp {{{ number_format($data['balance'], 2, ',', '.') }}}
            </span>
        </div>
    </div>

    <hr id="merchant-horizontal-line"/>

    <div id="subcontent-wrapper">

        <div class="all-table merchant">
            @if ($products->count() == 0)
            <div>
                You do not have any product yet.
            </div>
            @elseif ($products->count() > 0)
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
            @endif
        </div>
    </div>

@stop