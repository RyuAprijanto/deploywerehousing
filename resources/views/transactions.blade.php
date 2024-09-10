@extends('layouts.master')

@section('content')
<div class="container flex flex-col justify-center py-8 px-3 ">
    <h1 class="text-2xl font-semibold mb-6">Rincian Transaksi</h1>

    <div class="mb-6">
        <h2 class="text-lg font-medium">Nilai Total Transaksi Bulan Ini:</h2>
        <p class="text-xl font-semibold {{ $totalValue >= 0 ? 'text-green-600' : 'text-red-600' }}">
            Rp. {{ number_format($totalValue, 2) }}
        </p>
    </div>

    <div class="flex mb-4">
        <a href="{{ route('addTransaction') }}" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md">
            Tambahkan Transaksi
        </a>
    </div>

    <h2 class="text-xl font-medium mb-4">Transaksi Bulanan</h2>
    <table class="min-w-full bg-white border mb-6">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Year</th>
                <th class="py-2 px-4 border-b">Month</th>
                <th class="py-2 px-4 border-b">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($monthlyTransactions as $monthly)
            <tr>
                <td class="py-2 px-4 border-b">{{ $monthly->year }}</td>
                <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::createFromDate($monthly->year, $monthly->month, 1)->format('F') }}</td>
                <td class="py-2 px-4 border-b {{ $monthly->total >= 0 ? 'text-green-600' : 'text-red-600' }}">
                    Rp.{{ number_format($monthly->total, 2) }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2 class="text-xl font-medium mb-4">Riwayat Transaksi</h2>
    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Date</th>
                <th class="py-2 px-4 border-b">Type</th>
                <th class="py-2 px-4 border-b">Price</th>
                <th class="py-2 px-4 border-b">Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
            <tr>
                <td class="py-2 px-4 border-b">{{ $transaction->date }}</td>
                <td class="py-2 px-4 border-b">{{ $transaction->transactionType->name }}</td>
                <td class="py-2 px-4 border-b">Rp.{{ number_format($transaction->price, 2) }}</td>
                <td class="py-2 px-4 border-b">{{ $transaction->description }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
