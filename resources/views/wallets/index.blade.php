<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{__('My Wallets')}}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="p-6 bg-white shadow-sm sm:rounded-lg">

      <h3 class="mb-4 text-lg font-medium text-gray-900">Add New Wallet</h3>

        <!-- Form -->
         <form action="{{ route('wallets.store') }}" method="POST" class="pb-10 mb-10 space-y-4 border-b border-gray-500">
          @csrf
          <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
              <div>
                  <label class="block text-sm font-medium text-gray-700">Wallet Name</label>
                  <input type="text" name="name" placeholder="e.g. Bank Mandiri, Cash"
                      class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
              </div>
              <div>
                  <label class="block text-sm font-medium text-gray-700">Initial Balance</label>
                  <input type="number" name="balance" placeholder="0" 
                      class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
              </div>
          </div>
          <div class="flex justify-end">
              <button type="submit" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                  Create Wallet
              </button>
          </div>
         </form>

      <!-- List Wallet -->
      <h3 class="mb-4 text-lg font-medium text-gray-900">Your Wallets</h3>
      <div class="relative overflow-y-auto border rounded-lg max-h-96">
            <table class="min-w-full border divide-y divide-gray-200">
                <thead class="sticky top-0 z-10 shadow-sm bg-gray-50">
                    <tr>
                    <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">No</th>
                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Wallet Name</th>
                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Balance</th>
                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @forelse($wallets as $index => $wallet)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">{{ $wallet->name }}</td>
                    <td class="px-6 py-4 text-sm font-bold text-green-600 whitespace-nowrap">Rp {{ number_format($wallet->balance, 0, ',', '.') }}</td>
                    <td class="flex justify-end px-6 py-4 space-x-2 text-sm font-medium text-right">
                        <form action="{{ route('wallets.destroy', $wallet) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                        </form>
                    </td>
                </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-gray-500">No wallets found. Create one above!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
          </div>
      </div>
    </div>
  </div>

</x-app-layout>