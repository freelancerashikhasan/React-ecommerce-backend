

<div class="invoice_view p-4">
    <div class="row" id="printableArea">
        {{-- header view part --}}
        <div class="col-6 col-md-6" style="background: #6C757D; padding: 30px; vertically-align: middle;">
            <div class="left-side">

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="40px" height="40px" style="fill: white; margin-top: 40px;"><path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>
                <h3 style="font-size: 24px; margin-top: 10px; color: #fff; font-weight: bold;">{{ 'Invoice' }}</h3>
            </div>
        </div>
        <div class="col-6 col-md-6" style="background: #6C757D; padding: 30px; " >
            <div class="right-side" style="text-align: right; font-weight: bold; color: #ffffff;">
                <h2 style="font-weight: bold; color: #ffffff;">{{ companyInfo()->company_name }}</h2>
                <p style="margin: 5px 0; color: #ffffff;">Company Address</p>
            </div>
        </div>
        {{-- body view part  --}}
        <div class="col-6 col-md-6 my-5">
            <div class="billing_left">
                <p style="margin: 5px 0 5px 12px;"><strong>Bill To :</strong> </p>
                <p style="margin: 5px 0 5px 12px;"><strong>Company Name :  {{ $order->name }}</strong> </p>
                <p style="margin: 5px 0 5px 12px;"><strong>Address : {{ $order->address }}</strong> </p>
            </div>
        </div>
        <div class="col-6 col-md-6 my-5">
            <div class="billing_right text-right">
                <p style="margin: 5px 12px 5px 0;"><strong>Invoice No. </strong> </p>
                <p style="margin: 5px 12px 5px 0;">#{{ zero($order->id) }}</p>
                <p style="margin: 5px 12px 5px 0;"><strong>Invoice Date</strong></p>
                <p style="margin: 5px 12px 5px 0;">{{ dateFormat($order->date) }}</p>
            </div>
        </div>
        <div class="col-md-12">

            <table class="table table-borderd table-hover">
                <hr style="border: 1px solid #d3d4d5; width: 98%; margin: 0 auto 20px;">
                <thead>
                    <tr>
                    <th style="text-align: left;" scope="col">No</th>
                    <th scope="col">Product Details</th>
                    <th class="text-center" scope="col">Qty</th>
                    {{-- <th class="text-center" scope="col">Point</th> --}}
                    <th style="text-align: right;" scope="col">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalQtys = 0;
                    @endphp

                    @foreach ($items as $key => $item)
                        <tr>
                            <td style="text-align: right;" scope="row">{{ $key+1 }}</td>
                            <td>
                                <div class="details">
                                    <div class="d-flex">
                                        <div class="product-img" style="margin-right: 1rem;">
                                            <a href="">
                                                <img class="rounded border" src="{{ asset('uploads/product/' . $item->product->thumbnail) }}" width="80px" alt="Product Image">
                                            </a>
                                        </div>
                                        <div class="product-details">
                                            <a href="">
                                                <h4 class="product-title m-0 pt-0" style="font-size: 16px; color: initial;">{{ $item->product->title }}</h4>
                                            </a>
                                            <p class="product-subtitle m-0 text-muted" style="font-size: 14px;">{{ $item->product->sub_title }}</p>
                                            <p class="product-category m-0" style="font-size: 14px;">{{ ($item->product->category) ?$item->product->category->category_name : 'N/A'  }}</p>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            @php
                                $totalQtys += $item->qty;
                            @endphp
                            {{-- offer_price --}}

                            <td class="text-center">{{ $item->qty }}</td>
                            {{-- <td class="text-center">{{ number_format(($item->point * $item->qty), 2) }}</td> --}}
                            <td style="text-align: right;">
                                @auth
                                    {{ currency()['symble'] }}
                                @endauth

                                @if ($item->offer_price == null)
                                    {{ number_format(($item->price * $item->qty), 2) }}
                                @elseif ($item->offer_price == '0.00')
                                    {{ number_format(($item->price * $item->qty), 2) }}
                                @else
                                    {{ number_format(($item->offer_price * $item->qty), 2) }}
                                @endif

                            </td>
                        </tr>
                    @endforeach

                    <tr>
                        <td class="font-weight-bold" colspan="2" style="text-align: right;" >Total</td>
                        <td class="text-center">{{ $totalQtys }}</td>
                        {{-- <td class="text-center">{{ number_format($order->total_point, 2) }}</td> --}}
                        <td style="text-align: right;"> @auth {{ currency()['symble'] }} @endauth {{ number_format($order->bill_amount, 2) }}</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
