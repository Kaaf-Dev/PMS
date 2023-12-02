<!DOCTYPE html>
<html>
<head>
    <title> New Maintenance Request - {{$ticket->no}}</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even){background-color: #f2f2f2}

        th {
            background-color: #321c69;
            color: white;
        }
    </style>
</head>
<body>
<center>
    <h2 style="padding: 23px;background: #321c69;border-bottom: 6px #ad9616 solid;">New Maintenance Request
        - {{$ticket->no}}</h2>
</center>
<p>Dear Esteemed {{$selected_company->name}},</p>
<p>
    Kindly be informed that you have received a new maintenance request as below
</p>
<table>
    <tr>
        <th>Ticket Number</th>
        <th>Tenant Name</th>
        <th>Unit Number</th>
        <th>Building Name</th>
        <th>Details</th>
    </tr>
    <tr>
        <td>{{$ticket->no}}</td>
        <td>{{$ticket->contract->User->name ?? ''}}</td>
        <td>{{$ticket->property->ky_no ?? ''}}</td>
        <td>{{$ticket->apartment->name ?? ''}}</td>
        <td>{{$ticket->description ?? ''}}</td>
    </tr>

</table>
<p>
    You can login the PMS system by <a href="{{route('user.auth.login')}}" style="color: #0a58ca;"><u>click here</u></a>
</p>
<strong>Thanks for continues efforts and support :)</strong></body>
</html>
