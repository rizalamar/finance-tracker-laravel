<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard Summary') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            
            <!-- Summary Widgets -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div class="p-6 overflow-hidden bg-white border-l-4 border-indigo-500 shadow-sm sm:rounded-lg">
                    <div class="text-sm font-medium tracking-wider text-gray-500 uppercase">Total Balance</div>
                    <div class="mt-1 text-3xl font-bold text-gray-900">
                        Rp {{ number_format($totalBalance, 0, ',', '.') }}
                    </div>
                </div>

                <div class="p-6 overflow-hidden bg-white border-l-4 border-red-500 shadow-sm sm:rounded-lg">
                    <div class="text-sm font-medium tracking-wider text-gray-500 uppercase">Total Expenses</div>
                    <div class="mt-1 text-3xl font-bold text-red-600">
                        Rp {{ $totalExpense > 0 ? number_format($totalExpense, 0, ',', '.') : '0' }}
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                
                <!-- Wallet Highlights (2/3) -->
                <div class="p-6 overflow-hidden bg-white shadow-sm lg:col-span-2 sm:rounded-lg">
                    <div class="flex items-center justify-between pb-4 mb-6 border-b">
                        <h3 class="text-lg font-bold tracking-tight text-gray-900 uppercase">Your Wallets</h3>
                        <a href="{{ route('wallets.index') }}" class="text-xs font-bold text-indigo-600 underline uppercase hover:text-indigo-900">Manage Wallets</a>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        @forelse($wallets as $wallet)
                        <div class="p-4 transition border rounded-xl hover:shadow-md bg-gray-50">
                            <div class="text-xs font-bold text-gray-500 uppercase">{{ $wallet->name }}</div>
                            <div class="mt-1 text-xl font-bold text-gray-900">Rp {{ number_format($wallet->balance, 0, ',', '.') }}</div>
                            <div class="mt-2 text-[10px] text-gray-400">Last updated: {{ $wallet->updated_at->diffForHumans() }}</div>
                        </div>
                        @empty
                        <div class="col-span-2 py-8 text-center border-2 border-dashed rounded-xl">
                            <p class="italic text-gray-400">No wallets found. <a href="{{ route('wallets.index') }}" class="font-bold text-indigo-600 underline">Create one</a></p>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Recent Transactions -->
                <div class="p-6 overflow-hidden bg-white shadow-sm lg:col-span-1 sm:rounded-lg">
                    <div class="flex items-center justify-between pb-4 mb-6 border-b">
                        <h3 class="text-lg font-bold tracking-tight text-gray-900 uppercase">Recent</h3>
                        <a href="{{ route('transactions.index') }}" class="text-xs font-bold text-indigo-600 underline uppercase hover:text-indigo-900">View All</a>
                    </div>

                    <div class="space-y-4">
                        @forelse($recentTransactions as $trx)
                        <div class="flex items-center justify-between p-2 transition border-b border-gray-100 rounded-lg hover:bg-gray-50 last:border-0">
                            <div class="flex items-center space-x-3 overflow-hidden">
                                <!-- Small Icon -->
                                <div class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center {{ $trx->type == 'income' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                    @if($trx->type == 'income')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5-5v12" />
                                        </svg>
                                    @endif
                                </div>
                                <div class="truncate">
                                    <div class="text-sm font-bold text-gray-900 truncate">{{ $trx->description ?? 'Transaction' }}</div>
                                    <div class="text-xs text-gray-500">{{ $trx->wallet->name }}</div>
                                </div>
                            </div>
                            <div class="flex-shrink-0 text-right">
                                <div class="text-xs font-bold {{ $trx->type == 'income' ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $trx->type == 'income' ? '+' : '-' }}{{ number_format($trx->amount, 0, ',', '.') }}
                                </div>
                                <div class="text-[9px] text-gray-400">{{ \Carbon\Carbon::parse($trx->transaction_date)->format('d M') }}</div>
                            </div>
                        </div>
                        @empty
                        <div class="py-4 text-xs italic text-center text-gray-400">No records.</div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>