@extends('layouts.app')
@section('content')

    @if ($donations->isEmpty())
        <div class="text-center py-12">
            <i class="fas fa-donate text-6xl text-gray-300 mx-auto block mb-4"></i>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No Donations</h3>
            <p class="text-gray-600">No donations have been received yet.</p>
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
                            {{ $donation->user->name }} donated NPR {{ $donation->donation_amount }}
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
                        @if ($donation->status === 'pending' && in_array($donation->payments->first()->payment_method, ['cash', 'cheque']))
                            <form action="{{ route('ngo.donations.verify', $donation->id) }}" method="POST" class="mt-2">
                                @csrf
                                @method('POST')
                                <button type="submit"
                                    class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 text-sm">
                                    <i class="fas fa-check mr-2"></i> Verify Donation
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        {{ $donations->links() }}
    @endif

@endsection
