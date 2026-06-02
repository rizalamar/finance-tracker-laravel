<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard Summary') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            
            <!-- Grid for Summary Widgets -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <!-- Widget Total Saldo -->
                <div class="p-6 overflow-hidden bg-white border-l-4 border-indigo-500 shadow-sm sm:rounded-lg">
                    <div class="text-sm font-medium tracking-wider text-gray-500 uppercase">Total Balance</div>
                    <div class="mt-1 text-3xl font-bold text-gray-900">
                        Rp {{ number_format($totalBalance, 0, ',', '.') }}
                    </div>
                </div>

                <!-- Widget Total Expense -->
                <div class="p-6 overflow-hidden bg-white border-l-4 border-red-500 shadow-sm sm:rounded-lg">
                    <div class="text-sm font-medium tracking-wider text-gray-500 uppercase">Total Expenses</div>
                    <div class="mt-1 text-3xl font-bold text-red-600">
                        Rp {{ $totalExpense > 0 ? number_format($totalExpense, 0, ',', '.') : '0' }}
                    </div>
                </div>
            </div>

            <!-- Widget Transaksi Terakhir (Compact) -->
            <div class="max-w-4xl p-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <h3 class="pb-2 mb-4 text-lg font-bold text-gray-900 border-b">Recent Transactions</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($recentTransactions as $trx)
                            <tr>
                                <td class="py-3 text-sm text-gray-500 whitespace-nowrap">{{ \Carbon\Carbon::parse($trx->transaction_date)->format('d M') }}</td>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $trx->wallet->name }}</td>
                                <td class="max-w-xs py-3 text-sm italic text-gray-600 truncate">"{{ $trx->description }}"</td>
                                <td class="py-3 text-sm font-bold text-right whitespace-nowrap {{ $trx->type == 'income' ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $trx->type == 'income' ? '+' : '-' }} {{ number_format($trx->amount, 0, ',', '.') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-4 italic text-center text-gray-500">No transactions yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="pt-2 mt-4 text-right border-t">
                    <a href="{{ route('transactions.index') }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-900">View All →</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>