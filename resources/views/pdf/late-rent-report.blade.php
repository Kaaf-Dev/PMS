<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تقرير متأخرات الإيجار</title>
    <style>
        body {
            font-family: "Madani Arabic Medium", serif;
            margin: 0;
            padding: 20px;
            direction: rtl; /* Set text direction for Arabic */
            background-color: #FFFFFF;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white; /* White background for the container */
            padding: 20px;
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }

        .header {
            overflow: hidden; /* Clear floats */
        }

        .kaaflogo {
            float: left; /* Position kaaf logo to the left */
        }

        .eslahlogo {
            float: right; /* Position eslah logo to the right */
            margin-left: 20px; /* Optional margin for spacing */
        }

        h1 {
            text-align: center;
            font-size: 24px;
            color: #333; /* Darker text for better readability */
        }

        table {
            width: 100%;
            border-collapse: collapse; /* Remove double borders */
            margin-top: 20px; /* Space between title and table */
        }

        th, td {
            padding: 12px;
            text-align: center; /* Align text to the center for better readability */
            border: 1px solid #ccc; /* Add border to table cells */
            font-size: 14px; /* Slightly larger font size */
        }

        th {
            background-color: #f4f4f4; /* Light background for header */
            font-weight: bold; /* Bold header text */
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9; /* Zebra striping for better readability */
        }

        tbody tr:hover {
            background-color: #eaeaea; /* Highlight row on hover */
        }

        .date {
            text-align: left; /* Align date to the left */
            margin-top: 20px; /* Space above the date */
            font-size: 12px; /* Smaller font size for date */
            color: #777; /* Light color for date */
        }

        tfoot {
            background-color: #e1e1e1; /* Footer background color */
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <div class="kaaflogo" style="width: 50%;text-align: left">
            <img src="{{ public_path('admin-assets/media/logos/kaaf-logo.png') }}" alt="Kaaf Logo" width="80">
        </div>
        <div class="eslahlogo" style="width: 50%; ">
            <img src="{{ public_path('admin-assets/media/logos/logo.png') }}" alt="Eslah Logo" width="190">
        </div>
    </div>

    <h1>تقرير متأخرات الإيجار</h1>
    <h4 style="text-align: right">
        الفئة:
        @if($data['selected_category'] == 1)
            كاف
        @elseif($data['selected_category'] == 2)
            جمعية الإصلاح
        @else
            الكل
        @endif
    </h4>

    <h4 style="text-align: right">
        الحالة:
        @if($data['lawyer_cases'] == 1)
            غير محول إلى المحامي
        @elseif($data['lawyer_cases'] == 2)
            محول إلى المحامي
        @else
            الكل
        @endif
    </h4>


    <h4 style="text-align: right">عدد أشهر المتأخرات: {{ $data['month_count'] ?? 'غير محدد' }}</h4>


    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>اسم المستأجر</th>
            <th>رقم الهاتف</th>
            <th>رقم العقار</th>
            <th>اسم العقار</th>
            <th>قيمة الإيجار</th>
            <th>عدد الأشهر</th>
            <th>مجموع المتأخرات</th>
        </tr>
        </thead>
        <tbody>
        @forelse($data['data'] as $key => $property)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$property['user_name']}}</td>
                <td>{{$property['user_phone']}}</td>
                <td>{{$property['property_no']}}</td>
                <td>{{$property['property_name']}}</td>
                <td>{{$property['apartment_cost']}}</td>
                <td>{{$property['unpaid_invoices']}}</td>
                <td>{{$property['unpaid_invoices_sum']}}</td>
            </tr>
        @empty
            <tr>
                <td colspan="8" style="text-align: center;">لا توجد بيانات</td>
            </tr>
        @endforelse
        </tbody>

        <tfoot style="border: 2px solid #333">
        <tr style="background-color: #e1e1e1; border: 2px solid #333">
            <td colspan="5" style="text-align: center; font-weight: bold; border: 2px solid #333">المجموع:</td>
            <td style="font-weight: bold; border: 2px solid #333">
                {{ number_format(array_sum(array_column($data['data'], 'apartment_cost')), 2) }}
            </td>
            <td style="font-weight: bold; border: 2px solid #333">
                {{ array_sum(array_column($data['data'], 'unpaid_invoices')) }}
            </td>
            <td style="font-weight: bold; border: 2px solid #333">
                {{ number_format(array_sum(array_column($data['data'], 'unpaid_invoices_sum')), 2) }}
            </td>
        </tr>
        </tfoot>
    </table>
    <div class="date">
        {{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}
    </div>
</div>
</body>
</html>
