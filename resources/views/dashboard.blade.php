<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
           <!-- Widget Total Saldo -->
            <div class="p-6 overflow-hidden bg-white border-l-4 border-indigo-500 shadow-sm sm:rounded-lg">
                <div class="text-sm font-medium tracking-wider text-gray-500 uppercase">Total Balance (All Wallets)</div>
                <div class="mt-1 text-3xl font-bold text-gray-900">
                    Rp {{ number_format($totalBalance, 0, ',', '.') }}
                </div>
            </div>

            <!-- Widget Transaksi Terakhir -->
                <div class="p-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <h3 class="mb-4 text-lg font-bold text-gray-900">Recent Transactions</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($recentTransactions as $trx)
                                <tr>
                                    <td class="py-4 text-sm text-gray-500">{{ $trx->transaction_date }}</td>
                                    <td class="py-4 text-sm font-medium text-gray-900">{{ $trx->wallet->name }}</td>
                                    <td class="py-4 text-sm italic text-gray-600">"{{ $trx->description }}"</td>
                                    <td class="py-4 text-sm font-bold text-right {{ $trx->type == 'income' ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $trx->type == 'income' ? '+' : '-' }} Rp {{ number_format($trx->amount, 0, ',', '.') }}
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
                    
                    <div class="mt-4 text-right">
                        <a href="{{ route('transactions.index') }}" class="text-sm font-bold text-indigo-600 underline hover:text-indigo-900">View All Transactions →</a>
                    </div>
                </div>
        </div>
    </div>
</x-app-layout>
