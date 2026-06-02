<x-app-layout>
  <x-slot name="header">
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
          {{ __('Transactions') }}
      </h2>
  </x-slot>
  
  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="p-8 overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <h3 class="mb-4 text-lg font-medium text-gray-900">Record New Transaction</h3>

        <form action="{{ route('transactions.store') }}" method="POST" class="pb-10 mb-10 space-y-4 border-b border-gray-200">
          @csrf
          <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            <div>
              <label class="block text-sm font-medium text-gray-700">Wallet</label>
              <select name="wallet_id" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500" required>
                @foreach($wallets as $wallet)
                  <option value="{{ $wallet->id }}">{{ $wallet->name }} (Rp {{number_format($wallet->balance, 0) }})</option>
                @endforeach
              </select>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Type</label>
              <select name="type" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500" required>
                <option value="income">Income (+)</option>
                <option value="expense">Expense (-)</option>
              </select>
            </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Amount</label>
                <input type="number" name="amount" step="0.01" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500" required>
              </div>
              <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <input type="text" name="description" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500">
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Date</label>
                <input type="date" name="transaction_date" value="{{ date('Y-m-d')}}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500" required>
              </div>
          </div>
          
          <div class="flex justify-end">
            <button type="submit" class="px-6 py-2 text-xs font-bold tracking-widest text-white uppercase bg-green-600 rounded-md hover:bg-green-700">
                Record Transaction
            </button>
          </div>
        </form>

        <h3 class="mb-4 text-lg font-medium text-gray-900">History</h3>
        <table class="min-w-full border divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Date</th>
              <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Wallet</th>
              <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Description</th>
              <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Amount</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @foreach($transactions as $trx)
            <tr>
              <td class="px-6 py-4 text-sm">{{\Carbon\Carbon::parse($trx->transaction_date)->format('d M Y') }}</td>
              <td class="px-6 py-4 text-sm text-gray-600">{{ $trx->wallet->name}}</td>
              <td class="px-6 py-4 text-sm">{{ $trx->description ?? '-' }}</td>
              <td class="px-6 py-4 text-sm font-bold {{ $trx->type == 'income' ? 'text-green-600' : 'text-red-600' }}">
                {{ $trx->type == 'income' ? '+' : '-' }} Rp {{number_format($trx->amount, 0, ',', '.') }}
              </td>
            </tr>
              @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</x-app-layout>