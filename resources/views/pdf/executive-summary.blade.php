<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الملخص التنفيذي</title>
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
            border-collapse: collapse;
            margin-top: 20px; /* Space between title and table */
        }

        th, td {
            padding: 12px;
            text-align: right; /* Align text to the right for Arabic */
            border: 1px solid #ccc;
            font-size: 14px; /* Slightly larger font size */
        }

        th {
            background-color: #f4f4f4;
            font-weight: bold; /* Bold header text */
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

    <h1>الملخص التنفيذي للعقارات</h1>
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
            <th>#</th>
            <th>العقار</th>
            <th>رقم النظام الخيري</th>
            <th>القيمة التسويقية</th>
            <th>البناية</th>
            <th>المجمع</th>
            <th>الطريق</th>
            <th>عدد الشقق السكنية</th>
            <th>عدد المحلات التجارية</th>
            <th>مجموع الوحدات</th>
            <th>إجمالي المبلغ الشهري</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($data['data'] as $key => $property)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $property['property_name'] ?? 'لايوجد' }}</td>
                <td>{{ $property['property_ky_no'] ?? 'لايوجد' }}</td>
                <td>BD {{ number_format($property['market_value'] ?? 0, 2) }}</td>
                <td>
                    @if (isset($property['property_place']) && !empty($property['property_place']))
                        {{ $property['property_place'] }}
                    @else
                        -
                    @endif
                </td>
                <td>
                    @if (isset($property['property_block']) && !empty($property['property_block']))
                        {{ $property['property_block'] }}
                    @else
                        -
                    @endif
                </td>

                <td>
                    @if (isset($property['property_road']) && !empty($property['property_road']))
                        {{ $property['property_road'] }}
                    @else
                        -
                    @endif
                </td>
                <td>{{ $property['apartment_with_type_1_count'] ?? 'لايوجد' }}</td>
                <td>{{ $property['apartment_with_type_2_count'] ?? 'لايوجد' }}</td>
                <td>{{ $property['sum_of_apartments'] ?? 'لايوجد' }}</td>
                <td>BD {{ number_format($property['total_amount_for_active_contract'] ?? 0, 2) }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="11" style="text-align: center;">لا توجد بيانات</td>
            </tr>
        @endforelse
        </tbody>
        <tfoot>
        <tr style="background-color: #dddddd">
            <td colspan="2" style="text-align: center; font-weight: bold;">مجموع:</td>
            <td style="text-align: center; font-weight: bold;">-</td>
            <td style="text-align: center; font-weight: bold;">BD {{ number_format($data['data']->sum('market_value'), 2) }}</td>
            <td style="text-align: center; font-weight: bold;">-</td>
            <td style="text-align: center; font-weight: bold;">-</td>
            <td style="text-align: center; font-weight: bold;">-</td>
            <td style="text-align: center; font-weight: bold;">{{ intval($data['data']->sum('apartment_with_type_1_count')) }}</td>
            <td style="text-align: center; font-weight: bold;">{{ intval($data['data']->sum('apartment_with_type_2_count')) }}</td>
            <td style="text-align: center; font-weight: bold;">{{ intval($data['data']->sum('sum_of_apartments')) }}</td>
            <td style="text-align: center; font-weight: bold;">BD {{ number_format($data['data']->sum('total_amount_for_active_contract'), 2) }}</td>
        </tr>
        </tfoot>
    </table>
    <div class="date">
        {{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}
    </div>
</div>
</body>
</html>
