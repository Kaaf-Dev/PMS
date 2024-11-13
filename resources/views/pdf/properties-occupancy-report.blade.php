<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تقرير إشغال العقارات</title>
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

        .group-border {
            border: 2px solid #333; /* Border for each group */
            background-color: #eaeaea; /* Light background for group headers */
        }

        .group-border td {
            border: none; /* Remove internal borders */
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
        <div class="kaaflogo" style="width: 50%; text-align: left;">
            <img src="{{ public_path('admin-assets/media/logos/kaaf-logo.png') }}" alt="Kaaf Logo" width="80">
        </div>
        <div class="eslahlogo" style="width: 50%;">
            <img src="{{ public_path('admin-assets/media/logos/logo.png') }}" alt="Eslah Logo" width="190">
        </div>
    </div>

    <h1>تقرير إشغال العقارات</h1>
    <h4 style="text-align: right">استعلام التقرير:
        @if($data['selected_category'] == 1)
            كاف
        @elseif($data['selected_category'] == 2)
            جمعية الإصلاح
        @else
            الكل
        @endif

    </h4>

    <table>
        <thead>
        <tr>
            <th colspan="3" class="group-border">الوحدات</th>
            <th colspan="3" class="group-border">الوحدات المؤجرة</th>
            <th colspan="4" class="group-border">الوحدات غير المؤجرة</th>
        </tr>
        <tr>
            <th style="border-right: 2px solid #333;">#</th>
            <th>العقار</th> <!-- group 1 -->
            <th style="border-left: 2px solid #333;">مجموع الوحدات</th> <!-- group 1 -->
            <th>عدد الوحدات المؤجرة</th> <!-- group 2 -->
            <th>مبلغ الوحدات المؤجرة</th> <!-- group 2 -->
            <th style="border-left: 2px solid #333;">نسبة الوحدات المؤجرة</th> <!-- group 2 -->
            <th>عدد الوحدات غير المؤجرة</th> <!-- group 3 -->
            <th>مبلغ الوحدات غير المؤجرة</th> <!-- group 3 -->
            <th style="border-left: 2px solid #333;">نسبة الوحدات غير المؤجرة</th> <!-- group 3 -->
        </tr>
        </thead>
        <tbody>
        @forelse($data['data'] as $key => $property)
            <tr>
                <td style="border-right: 2px solid #333;">{{$loop->iteration}}</td>
                <td>{{$property['property']}}</td>
                <td style="border-left: 2px solid #333;">{{$property['total']}}</td>
                <td>{{$property['rented_count']}}</td>
                <td>{{number_format($property['rented_cost'])?? 0, 2}}</td>
                <td style="border-left: 2px solid #333;">{{ number_format($property['rented_percent'], 2) . '%' }}</td>
                <td>{{$property['available_count']}}</td>
                <td>{{number_format($property['available_cost'])?? 0, 2}}</td>
                <td style="border-left: 2px solid #333;">{{ number_format($property['available_percent'], 2) . '%' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="11" style="text-align: center;">لا توجد بيانات</td>
            </tr>
        @endforelse
        </tbody>
        <tfoot style="border: 2px solid #333">
        <tr style="background-color: #e1e1e1; border: 2px solid #333">
            <td colspan="2" style="text-align: center; font-weight: bold; border: 2px solid #333">المجموع:</td>
            <td style="font-weight: bold; border: 2px solid #333">
                {{ number_format($data['data']->sum('total'))?? 0, 2}}
            </td>
            <td style="font-weight: bold; border: 2px solid #333">
                {{ number_format($data['data']->sum('rented_count'))?? 0, 2 }}
            </td>
            <td style="font-weight: bold; border: 2px solid #333">
                {{ number_format($data['data']->sum('rented_cost'))?? 0, 2 }}
            </td>
            <td>-</td>
            <td style="font-weight: bold; border: 2px solid #333">
                {{ $data['data']->sum('available_count') }}
            </td>
            <td style="font-weight: bold; border: 2px solid #333">
                {{ number_format($data['data']->sum('available_cost'))?? 0, 2 }}
            </td>
            <td style="border: 2px solid #333">-</td>
        </tr>
        </tfoot>
    </table>


    <div class="date">
        {{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}
    </div>
</div>
</body>
</html>
