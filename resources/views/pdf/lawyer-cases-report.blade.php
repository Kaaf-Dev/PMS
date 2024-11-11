<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تقرير القضايا</title>
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
            background-color: #e1e1e1; /* Background color for footer */
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

    <h1>تقرير القضايا</h1>
    <h4 style="text-align: right">استعلام التقرير:</h4>
    @if($data['selected_lawyer'])
        {{\App\Models\Lawyer::find($data['selected_lawyer'])->name}}
    @else
        الكل
    @endif
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>رقم الدعوى</th>
            <th>المنفذ ضده</th>
            <th>المنفذ له</th>
            <th>الحالة</th>
            <th>المبلغ المحصل</th>
            <th>المبلغ المحكوم به</th>
        </tr>
        </thead>
        <tbody>
        @forelse($data['data'] as $key => $property)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$property['case_no']}}</td>
                <td>{{$property['second_side']}}</td>
                <td>{{$property['first_side']}}</td>
                <td>{{$property['status']}}</td>
                <td>{{$property['collected_amount']}}</td>
                <td>{{$property['amount']}}</td>
            </tr>
        @empty
            <tr>
                <td colspan="7" style="text-align: center;">لا توجد بيانات</td>
            </tr>
        @endforelse
        </tbody>

        <tfoot>
        <tr style="border: 2px solid #333">
            <td colspan="5" style="text-align: center; font-weight: bold; border: 2px solid #333">المجموع:</td>
            <td style="font-weight: bold; border: 2px solid #333">
                {{ collect($data['data'])->sum('collected_amount') }}
            </td>
            <td style="font-weight: bold; border: 2px solid #333">
                {{ collect($data['data'])->sum('amount') }}
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
