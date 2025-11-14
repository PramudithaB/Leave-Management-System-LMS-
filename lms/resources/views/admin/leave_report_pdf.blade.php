<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; }
        th { background: #f0f0f0; }
        h2 { text-align: center; }
    </style>
</head>
<body>

<h2>Company Leave Report</h2>

<table>
    <thead>
        <tr>
            <th>User</th>
            <th>Leave Type</th>
            <th>From</th>
            <th>To</th>
            <th>Reason</th>
            <th>Status</th>
            <th>Remarks</th>
        </tr>
    </thead>

    <tbody>
        @foreach($leaves as $leave)
        <tr>
<td>{{ $leave->user->name ?? 'Unknown User' }}</td>
            <td>{{ ucfirst($leave->leave_type) }}</td>
            <td>{{ $leave->from_date }}</td>
            <td>{{ $leave->to_date }}</td>
            <td>{{ $leave->reason }}</td>
            <td>{{ ucfirst($leave->status) }}</td>
            <td>{{ $leave->remarks }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
