<!doctype html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Receipt</title>
    <style>
        body {
            font-weight: bold;
            direction: rtl;
            margin: 0; /* Remove default margin */
            padding: 0; /* Remove default padding */
        }

        .header-image {
            margin: 10px 20px 30px 18px;
            background-size: cover;
            background-repeat: no-repeat;
        }

        footer {
            margin: auto;
            position: fixed;
            left: 0;
            right: 0;
            bottom: 20px;
        }

        .table {
            text-align: center;
        }

        .table .custom-table {
            border-spacing: 0 20px;
            margin: auto 50px;
        }

        h1 {
            color: #64327e;
            font-size: 16px;
        }

        h2 {
            font-size: 15px;
            color: black;
        }

        .table-details {
            margin: auto 50px;
        }

        .table-title h2 {
            color: white;
            padding-right: 20px;
            background-color: #64327e;
        }

        .table-item {
            width: 100%;
            border: 0;
            border-collapse: separate;
            border-spacing: 0 5px;
        }

        .table-details .table-item th,
        .table-details .table-item td {
            text-align: right;
        }

        .table-details .table-item th {
            color: #64327e;
            font-size: 20px;
            font-weight: bold;
            border-bottom: 1px solid #64327e;
            padding: 5px 0;
        }

        .table-details .table-item td {
            color: black;
            font-size: 15px;
            font-weight: bold;
            border-bottom: 1px solid #64327e;
            padding: 5px 0;
        }
    </style>
</head>
<body>
<br/>

<div class="header-image">
    <img src="{{ public_path('admin-assets/media/pdf/header.svg') }}" width="100%">
</div>

<div class="table">
    <table class="custom-table">
        <tr>
            <td style="width: 22%; text-align: right;">
                <h1>رقـــم الفاتورة</h1>
                <h1>Invoice No</h1>
            </td>
            <td style="width: 33%; text-align: right;">
                <h2>{{ $data->id }}</h2>
            </td>
            <td style="width: 28%; text-align: left;"> <!-- Adjusted to left alignment -->
                <h1>التاريـخ</h1>
                <h1>Date</h1>
            </td>
            <td style="width: 17%; text-align: left;"> <!-- Adjusted to left alignment -->
                <h2>{{$data->date_human}}</h2>
            </td>
        </tr>

        <tr>
            <td style="width: 25%; text-align: right;">
                <h1>اسم المستأجر</h1>
                <h1>Tenant Name</h1>
            </td>
            <td style="width: 35%; text-align: right;">
                <h2>{{ $data->Contract->User->name }}</h2>
            </td>
            <td style="width: 25%; text-align: left;"> <!-- Adjusted to left alignment -->
                <h1>حالة الدفع</h1>
                <h1>Paid Status</h1>
            </td>
            <td style="width: 15%; text-align: left;"> <!-- Adjusted to left alignment -->
                <h2>{{ $data->paid_string}}</h2>
            </td>
        </tr>

        <tr>
            <td style="width: 25%; text-align: right;">
                <h1>ﻃﺮﻳﻘﺔ اﻟﺪﻓﻊ</h1>
                <h1>Payment Method</h1>
            </td>
            <td style="width: 30%; text-align: right;">
                <h2>{{ $data->receipts->first()->payment_method ?? '' }}</h2>
            </td>
            <td style="width: 25%; text-align: left;"> <!-- Adjusted to left alignment -->
                <h1>ﺷﻴﻚ رﻗـــﻢ</h1>
                <h1>.Cheque No</h1>
            </td>
            <td style="width: 20%; text-align: left;"> <!-- Adjusted to left alignment -->
                <h2>{{ $data->receipts->first()->cheque_number ?? '' }}</h2>
            </td>
        </tr>

        <tr>
            <td style="width: 25%; text-align: right;">
                <h1>اﺳﻢ اﻟﺒﻨﻚ</h1>
                <h1>Bank Name</h1>
            </td>
            <td colspan="3" style="text-align: right;">
                <h2>{{ $data->receipts->first()->bank_name ?? '' }}</h2>
            </td>
        </tr>

    </table>
</div>

<div class="table-details">
    <div class="table-title">
        <h2>تفاصيل القبض</h2>
    </div>

    <table class="table-item">
        <thead>
        <tr>
            <th style="width: 25%; text-align: right;">الرقـــم<br>Number</th>
            <th style="width: 45%; text-align: right;">الــبــيــان<br>Description</th>
            <th style="width: 30%; text-align: right;">المبلغ<br>Amount</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>01</td>
            <td>{{$data->type_string}}</td>
            <td>{{$data->amount_human}}</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: right; padding: 10px;">
                <ul style="list-style-type: none; padding: 0; text-align: right;">
                    <li>وذلك عن عقد رقم {{$data->Contract->id}} المكون من :</li>
                    @foreach($data->Contract->contractApartments as $apartment)
                        <li>{{$apartment->apartment->name ?? ''}}</li>
                    @endforeach
                </ul>
            </td>
        </tr>
        </tbody>
    </table>

</div>

<div class="table" style="margin-top: 30px;">
    <table class="custom-table" style="width: 100%; border-collapse: collapse; text-align: right;">
        <tr>
            <td style="width: 25%; vertical-align: top;">
                <h1 style="color: #64327e; font-size: 16px;">المبلغ بالحروف<br>Amount in Words</h1>
            </td>
            <td style="width: 25%; vertical-align: top;">
                <h2 style="font-size: 16px;">{{ \Alkoumi\LaravelArabicNumbers\Numbers::TafqeetMoney($data->amount_human, 'BHD') }}</h2>
            </td>
            <td style="width: 25%; vertical-align: top;">
                <h1 style="color: #64327e; font-size: 16px;">إجمالي المبلغ<br>Total Amount</h1>
            </td>
            <td style="width: 15%; vertical-align: top;">
                <h2 style="font-size: 16px;">{{$data->amount_human}}</h2>
            </td>
            <td style="width: 10%; vertical-align: top;">
                <h2 style="font-size: 16px;"> BHD</h2>
            </td>
        </tr>
    </table>
</div>

<footer>
    <div class="table">
        <table class="custom-table">
            <tr>
                <td style="text-align: right;"></td>
                <td style="width: 50%; text-align: right;">
                    <h1>اسم المستلم</h1>
                    <h1>Received By</h1>
                </td>
                <td style="width: 50%; text-align: right;">
                    <h2>{{auth()->user()->name}}</h2>
                    <p>{{ now() }}</p>
                </td>
            </tr>
        </table>
    </div>
    <img style="margin: auto 50px;" src="{{ public_path('admin-assets/media/pdf/footer.svg') }}" width="100%">
</footer>

</body>
</html>
