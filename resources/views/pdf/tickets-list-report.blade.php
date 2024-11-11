<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>قائمة طلبات الصيانة</title>
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

    <h1>قائمة طلبات الصيانة</h1>
    <h4 style="text-align: right">استعلام التقرير:
        @if($data['selected_year'])
            {{ $data['selected_year'] }}
        @else
            الكل
        @endif
    </h4>

    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>المستأجر</th>
            <th>الوحدة</th>
            <th>العقار</th>
            <th>رقم العقار</th>
            <th>الموضوع</th>
            <th>الفئة</th>
            <th>تاريخ استلام الطلب</th>
            <th>تاريخ تحويل الطلب لشركة الصيانة</th>
            <th>مدة التسليم للشركة</th>
            <th>تاريخ الإنجاز</th>
            <th>مبلغ التكلفة</th>
            <th>الحالة</th>
        </tr>
        </thead>
        <tbody>
        @forelse($data['data'] as $key => $property)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $property['user'] }}</td> <!-- Displaying user name -->
                <td>{{ $property['apartment'] }}</td>
                <td>{{ $property['property'] }}</td>
                <td>{{ $property['property_no'] }}</td>
                <td>{{ $property['subject'] }}</td>
                <td>{{ $property['category'] }}</td>
                <td>{{ $property['created_at'] }}</td>
                <td>{{ $property['assigned_at'] }}</td>
                <td>{{ $property['diffDays'] }} يوم</td>
                <td>{{ $property['visited_at'] }}</td>
                <td>{{ $property['cost'] }}</td>
                <td>{{ $property['status'] }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="13" style="text-align: center;">لا توجد بيانات</td>
            </tr>
        @endforelse
        </tbody>
    </table>


    <div class="date">
        {{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}
    </div>
</div>
</body>
