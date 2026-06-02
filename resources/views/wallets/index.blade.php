<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{__('My Wallets')}}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="p-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <!-- Form -->
         <form action="{{ route('wallets.store') }}" method="POST" class="mb-6">
          @csrf
          <div class="flex gap-4">
            <input type="text" name="name" placeholder="Wallet Name (e.g Cash)" class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500" required >
            <input type="number" name="balance" placeholder="Initial Balance" class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500" required >
            <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">Add Wallet</button>
          </div>
         </form>

         <!-- List -->
          <table class="min-w-full divide-y divide-gray-200">
            <thead>
              <tr>
                <th class="px-6 py-3 text-sm font-medium text-left text-gray-500 uppercase">Name</th>
                <th class="px-6 py-3 text-sm font-medium text-left text-gray-500 uppercase">Balance</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach($wallets as $wallet)
              <tr>
                <td class="px-6 py-3">{{$wallet->name}}</td>
                <td class="px-6 py-3">{{number_format($wallet->balance, 2)}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
      </div>
    </div>
  </div>

</x-app-layout>