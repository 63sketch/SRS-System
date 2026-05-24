<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Employee Report</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; color: #333; }
        h1 { text-align: center; color: #1a365d; border-bottom: 3px solid #2d3748; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background-color: #2d3748; color: white; padding: 12px; text-align: left; border: 1px solid #ccc; }
        td { padding: 10px; border: 1px solid #ddd; }
        tr:nth-child(even) { background-color: #f7fafc; }
    </style>
</head>
<body>
    <h1>📊 Employee Report</h1>
    <div class="company-info">
        <p><strong>Company:</strong> Birrama Inc.</p>
        <p><strong>Report Generated:</strong> {{ now()->format('d F Y H:i') }}</p>
        <p><strong>Total Employees:</strong> {{ count($employees) }}</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Department</th>
                <th>Position</th>
                <th>Status</th>
                <th>Join Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
                <tr>
                    <td>{{ $employee->employee_code }}</td>
                    <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                    <td>{{ $employee->department->name ?? 'N/A' }}</td>
                    <td>{{ $employee->position->title ?? 'N/A' }}</td>
                    <td>{{ ucfirst($employee->status) }}</td>
                    <td>{{ $employee->hire_date?->format('d M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
