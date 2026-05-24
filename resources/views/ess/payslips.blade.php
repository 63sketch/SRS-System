<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Payslips') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th>Period</th>
                            <th>Gross</th>
                            <th>Net</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payslips as $payslip)
                            <tr>
                                <td>{{ $payslip->period_month->format('F Y') }}</td>
                                <td>{{ number_format($payslip->gross_salary, 2) }}</td>
                                <td>{{ number_format($payslip->net_salary, 2) }}</td>
                                <td><a href="#" class="text-blue-600">Download PDF</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
