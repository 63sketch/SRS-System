<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Employee Report - Birrama HRMS</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
        }
        
        .container {
            padding: 40px 30px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #1a365d;
            padding-bottom: 20px;
        }
        
        .header h1 {
            color: #1a365d;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .header p {
            color: #666;
            font-size: 12px;
        }
        
        .company-info {
            background-color: #f0f4f8;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 11px;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
        }
        
        .company-info p {
            margin: 5px 0;
        }
        
        .company-info strong {
            color: #1a365d;
        }
        
        .confidential {
            background-color: #fed7d7;
            border-left: 4px solid #c53030;
            padding: 10px;
            margin-bottom: 20px;
            font-size: 11px;
            font-weight: bold;
            color: #742a2a;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        thead {
            background-color: #1a365d;
            color: white;
        }
        
        th {
            padding: 12px 8px;
            text-align: left;
            font-size: 10px;
            font-weight: bold;
            border: 1px solid #2d3748;
        }
        
        td {
            padding: 10px 8px;
            border: 1px solid #e0e0e0;
            font-size: 9px;
        }
        
        tbody tr:nth-child(odd) {
            background-color: #f7fafc;
        }
        
        tbody tr:nth-child(even) {
            background-color: #ffffff;
        }
        
        .status {
            display: inline-block;
            padding: 3px 6px;
            border-radius: 3px;
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .status.active {
            background-color: #c6f6d5;
            color: #22543d;
        }
        
        .status.inactive {
            background-color: #fed7d7;
            color: #742a2a;
        }
        
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #e0e0e0;
            text-align: center;
            font-size: 9px;
            color: #666;
        }
        
        .footer p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        {{-- Header --}}
        <div class="header">
            <h1>EMPLOYEE REPORT</h1>
            <p>Birrama HRMS - Human Resource Management System</p>
        </div>
        
        {{-- Confidential Notice --}}
        <div class="confidential">
            ⚠️ CONFIDENTIAL - For Authorized Personnel Only
        </div>
        
        {{-- Company Info --}}
        <div class="company-info">
            <div>
                <p><strong>Company:</strong></p>
                <p>Birrama Inc.</p>
            </div>
            <div>
                <p><strong>Generated:</strong></p>
                <p>{{ now()->format('d F Y H:i:s') }}</p>
            </div>
            <div>
                <p><strong>Total Employees:</strong></p>
                <p>{{ count($employees) }} employees</p>
            </div>
        </div>
        
        {{-- Employee Table --}}
        <table>
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Position</th>
                    <th>Status</th>
                    <th>Join Date</th>
                    <th>Manager</th>
                </tr>
            </thead>
            <tbody>
                @forelse($employees as $employee)
                    <tr>
                        <td><strong>{{ $employee->employee_id ?? 'N/A' }}</strong></td>
                        <td>{{ $employee->first_name ?? '' }} {{ $employee->last_name ?? '' }}</td>
                        <td>{{ $employee->email ?? 'N/A' }}</td>
                        <td>{{ $employee->department?->name ?? 'N/A' }}</td>
                        <td>{{ $employee->position?->name ?? 'N/A' }}</td>
                        <td>
                            <span class="status {{ strtolower($employee->employment_status ?? 'active') === 'active' ? 'active' : 'inactive' }}">
                                {{ ucfirst($employee->employment_status ?? 'N/A') }}
                            </span>
                        </td>
                        <td>{{ $employee->join_date?->format('d M Y') ?? 'N/A' }}</td>
                        <td>{{ $employee->manager?->first_name ?? '' }} {{ $employee->manager?->last_name ?? '' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align: center; color: #999; padding: 20px;">
                            No employees found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        {{-- Footer --}}
        <div class="footer">
            <p><strong>Generated by Birrama HRMS</strong></p>
            <p>{{ now()->format('d F Y \a\t H:i:s A') }}</p>
            <p style="margin-top: 10px; font-style: italic;">
                This is a confidential document. Unauthorized distribution is prohibited.
            </p>
        </div>
    </div>
</body>
</html>
