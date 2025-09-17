@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto bg-white border border-gray-200 rounded-lg p-8 mb-6">
        <h2 class="text-xl font-medium mb-8 text-center text-gray-900">Make a Donation</h2>
        <form action="{{ route('people.donations.showPaymentForm') }}" method="POST" class="space-y-6">
            @csrf
            <!-- NGO Selection -->
            <div>
                <label for="ngo_id" class="block text-sm font-medium text-gray-700 mb-2">Select NGO</label>
                <select name="ngo_id" id="ngo_id"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400">
                    @foreach ($ngos as $ngo)
                        <option value="{{ $ngo->id }}">{{ $ngo->name }}</option>
                    @endforeach
                </select>
                @error('ngo_id')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Donation Amount -->
            <div>
                <label for="donation_amount" class="block text-sm font-medium text-gray-700 mb-2">Donation Amount
                    (NPR)</label>
                <input type="number" name="donation_amount" id="donation_amount" min="10" step="10"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400"
                    required>
                @error('donation_amount')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Payment Method -->
            <div>
                <span class="block text-sm font-medium text-gray-700 mb-3">Payment Method</span>
                <div class="grid grid-cols-2 gap-3">
                    <label
                        class="has-checked:bg-indigo-50 has-checked:text-indigo-900 has-checked:ring-indigo-200 flex items-center space-x-3 border border-gray-200 p-3 rounded-md cursor-pointer hover:border-gray-300 transition-colors">
                        <input type="radio" name="payment_method" value="esewa" class="checked:border-indigo-500">
                        <img src="https://cdn.esewa.com.np/ui/images/logos/esewa-icon-large.png" alt="eSewa"
                            class="h-5 w-5">
                        <span class="text-sm text-gray-700">eSewa</span>
                    </label>
                    <label
                        class="has-checked:bg-indigo-50 has-checked:text-indigo-900 has-checked:ring-indigo-200 flex items-center space-x-3 border border-gray-200 p-3 rounded-md cursor-pointer hover:border-gray-300 transition-colors">
                        <input type="radio" name="payment_method" value="cash" class="checked:border-indigo-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v2m14 0h.01M17 9v10a2 2 0 01-2 2H5a2 2 0 01-2-2V9h14zM9 14h.01M15 14h.01" />
                        </svg>
                        <span class="text-sm text-gray-700">Cash</span>
                    </label>
                    <label
                        class="has-checked:bg-indigo-50 has-checked:text-indigo-900 has-checked:ring-indigo-200 flex items-center space-x-3 border border-gray-200 p-3 rounded-md cursor-pointer hover:border-gray-300 transition-colors">
                        <input type="radio" name="payment_method" value="cheque" class="checked:border-indigo-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V6a2 2 0 012-2h5l5 5v11a2 2 0 01-2 2z" />
                        </svg>
                        <span class="text-sm text-gray-700">Cheque</span>
                    </label>
                </div>
                @error('payment_method')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button type="submit"
                    class="w-full bg-gray-900 hover:bg-gray-800 text-white py-2.5 px-4 rounded-md text-sm font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                    <i class="fas fa-donate mr-2"></i> Donate
                </button>
            </div>
        </form>
    </div>

    @if ($donations->isEmpty())
        <div class="text-center py-12">
            <i class="fas fa-donate text-6xl text-gray-300 mx-auto block mb-4"></i>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No Donations</h3>
            <p class="text-gray-600">You have not made any donations yet.</p>
        </div>
    @else
        <div class="space-y-4">
            @foreach ($donations as $donation)
                <div class="p-4 bg-white rounded-lg shadow hover:bg-gray-50 flex items-start space-x-3">
                    <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center">
                        <i class="fas fa-donate text-gray-500"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-500">
                            Donated NPR {{ $donation->donation_amount }} to {{ $donation->ngo->name }}
                            <span
                                class="text-{{ $donation->status === 'completed' ? 'green' : ($donation->status === 'pending' ? 'yellow' : 'red') }}-600 text-sm">({{ ucfirst($donation->status) }})</span>
                        </p>
                        @if ($donation->payments->isNotEmpty())
                            <p class="text-sm text-gray-500">Payment Method:
                                {{ ucfirst($donation->payments->first()->payment_method) }}</p>
                            <p class="text-sm text-gray-500">Payment Status:
                                {{ ucfirst($donation->payments->first()->status) }}</p>
                        @endif
                        <p class="text-xs text-gray-400 mt-1">{{ $donation->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $donations->links() }}
    @endif

@endsection
