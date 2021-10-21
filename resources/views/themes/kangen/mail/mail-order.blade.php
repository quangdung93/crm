<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="{{asset('')}}">
    <style>
        body {
            background: #f4f4f4;
            font-family: Arial, Helvetica, sans-serif;
            font-size:13px;
        }

        .body-mail {
            background: #f4f4f4;
        }

        .content-mail {
            padding: 20px;
            background: #fff;
            width: 650px;
            margin: 0 auto;
        }

        .tit-mail {
            background: #ebebeb;
            border-radius: 5px;padding: 10px;
            text-align:center;
        }

        .tit-mail i {
            display: block;
            margin: 0 auto;
        }

        .message-mail h3 {
            margin-top: 20px;
            margin-bottom: 15px;
            color: #063fb0;
        }

        .tk-mail {
            margin:0;
            padding: 20px 10px;
            border-bottom: 1px solid #cacaca;
        }

        .mail-info{
            margin-top:10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e0e0e0;
        }

        .mail-info h4{
            color: #063fb0;
            margin:10px 0;
        }

        .mail-info ul{
            padding: 0 0 0 10px;
            margin: 0;
        }

        .mail-info ul li{
            display: block;
            padding:5px 0;
        }

        .pttt {
            margin-top: 30px;
        }

        .table tr th {
            color: #fff;
            padding: 10px;
            font-size: 13px;
            font-weight: 400;
        }

        .table tr td {
            padding: 10px;
            font-size: 13px;
        }

        .center {
            text-align: center;
        }

        .strong{
            font-weight: 600;
        }

        tbody tr td:not(:first-child) {
            text-align: center;
        }

        p.bank ul{
            padding: 0 0 0 10px;
            margin: 0;
        }

        p.bank ul li{
            display: block;
            padding:5px 0;
        }

        tbody tr:nth-child(even) {
            background: #f4f4f4;
        }
        .logo{
            width: 80px;
        }
        .total-cart{
            text-align:right;
            color:#333; 
            padding:10px; 
            background: #eeeeee
        }
        .total-cart span{
            color:red;
        }
        @media (min-width: 767px) {
            .limit-name{
                width:20%;
                word-break: break-word;
            }
            .limit-code{
                width:20%;
                word-break: break-all;
            }
        }
        @media (max-width: 479px) {
            .content-mail{
                width: 95%;
                padding: 10px;
            }

            .table-wrap{
                overflow: auto;
            }

            .table-wrap table{
                zoom: 0.8;
            }
        }
    </style>
    <meta charset="utf-8">
</head>

<body>
    <div class="body-mail">
        <div class="content-mail">
            {{-- <div class="tit-mail">
                <img width="200" src="{{ asset(theme('logo.image')) }}" alt="Logo">
            </div> --}}
            <div class="message-mail">
                <h2 class="tk-mail">Kangen nhận được đơn hàng mới!</h2>
                <h3>THÔNG TIN ĐƠN HÀNG - #{{$order->id}} - Ngày đặt: {{date('d/m/Y',strtotime($order->created_at))}} lúc {{date('H:i',strtotime($order->created_at))}}</h3>
                <div class="mail-info">
                    <h4><b>Thông tin khách hàng:</b></h4>
                    <ul>
                        <li><span class="strong">{{$order->customer_gender == 1 ? 'Anh' : 'Chị'}}</span> {{$order->customer_name}}</li>
                        <li><span class="strong">Phone:</span> {{$order->customer_phone}}</li>
                        <li><span class="strong">Email:</span> {{$order->customer_email}}</li>
                    </ul>
                </div>
                <div class="mail-info">
                    <h4><b>Thông tin giao hàng:</b></h4>
                    <ul>
                        <li><span class="strong">Địa chỉ:</span> {{$order->customer_address}}</li>
                        <li><span class="strong">Tỉnh/thành phố:</span> {{ optional($order->province)->name }}</li>
                        <li><span class="strong">Quận/huyện:</span> {{ optional($order->district)->name }}</li>
                        <li><span class="strong">Phường/xã:</span> {{ optional($order->ward)->name }}</li>
                    </ul>
                </div>
                @if($order->note)
                    <div class="mail-info">
                        <h4><b>Ghi chú:</b></h4>
                        <p>{{$order->note}}</p>
                    </div>
                @endif
                <div style="clear:both;"></div>
                <h3>CHI TIẾT ĐƠN HÀNG</h3>
                <table style="width: 100%;border-spacing: 1px;" class="table">
                    <thead>
                        <tr style="background-color:#063fb0;">
                            <th>STT</th>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá gốc</th>
                            <th>Giá bán</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $stt = 0;
                            $sumNewPrice = 0;
                        @endphp
                        @foreach($order->detail as $row)
                        @php 
                            $stt++;
                        @endphp
                        <tr>
                            <td class="center">{{$stt}}</td>
                            <td class="limit-name">
                                {{$row->name}}
                            </td>
                            <td class="center">{{$row->pivot->qty}}</td>
                            <td class="center">{{number_format($row->pivot->price_old)}}</td>
                            <td class="center">{{number_format($row->pivot->price)}}</td>
                            <td class="center">{{number_format($row->pivot->subtotal)}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <h4 class="total-cart">
                    <p class="strong">Tổng cộng: <span>{{number_format($order->total)}} đ</span></p>
                </h4>
                <p style="text-align:center">{{ url('/') }}</p>
            </div>
        </div>
    </div>
</body>
</html>