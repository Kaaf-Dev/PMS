<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>invoice</title>
    <style>
        body {
            direction: rtl;
            padding: 0;
            margin: 0;
            font-family: Arial, serif;
            background-image: url({{public_path('/admin-assets/media/pdf/invoice_img.jpg')}});
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;

        }
    </style>
</head>
<body>
<h1 style="margin-right: 160px;padding-top: 310px;float: right">{{$data->no}}</h1>
<h1 style="margin-right: 1000px;padding-top: -80px;">{{$data->due_human}}</h1>
<h1 style="margin-right: 250px;padding-top: 50px;">{{$data->Contract->User->name ?? ''}}</h1>
<h1 style="margin-right: 160px;padding-top: 50px;">{{$data->amount_human}}</h1>
<h1 style="margin-right: 800px;padding-top: -70px;">{{\Alkoumi\LaravelArabicNumbers\Numbers::TafqeetMoney($data->amount_human,'BHD')}}</h1>
<h1 style="margin-right: 270px;padding-top:60px;">{{$data->receipts->first()->payment_method ?? ''}}</h1>
<h1 style="margin-right: 700px;padding-top: -60px;">{{$data->receipts->first()->cheque_number ?? ''}}</h1>
<h1 style="margin-right: 1200px;padding-top: -60px;">{{$data->receipts->first()->bank_name ?? ''}}</h1>
<h1 style="margin-right: 200px;padding-top: 125px;">{{$data->TypeString}}</h1>

</body>
</html>
