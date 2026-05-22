<h1>Employee List</h1>
<table>
    <thead>
        <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Status</th>
            <th>Hire Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($employees as $employee)
            <tr>
                <td>{{ $employee->employee_code }}</td>
                <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                <td>{{ $employee->status }}</td>
                <td>{{ $employee->hire_date }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
