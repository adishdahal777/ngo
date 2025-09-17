@extends('layouts.app')

@section('content')

{{-- Toast Container for Success and Failure Messages --}}
<div id="toast-container" class="fixed top-5 right-5 space-y-2 z-50"></div>

  <div class="grid sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4 justify-start">
  @foreach ($events as $event)
    
      
  <div class="w-full mx-auto mt-6">
    <div class="bg-white w-full rounded-2xl shadow-lg overflow-hidden">
      {{-- <a href={{ route('event.show', $event->id) }}> --}}
      <!-- Event Image -->
      <img class="w-full h-48 object-cover" src={{ asset($event->cover_image_path_name) }} alt="Event Image">

      <div class="p-6">
        <!-- Event Title -->
        <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $event->title}}</h2>
        
        <!-- Event Date and Location -->
        <div class="flex items-center text-gray-600 text-sm mb-4">
          <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10m-14 6h14m-6 4h6m-14 0h6m6-16h2a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h2"></path>
          </svg>
          <span>{{ $event->start_date }} · {{ $event->location }}</span>
        </div>

        <!-- Description -->
        <p class="text-gray-700 mb-6">
          {{ $event->description }}
        </p>

      {{-- </a> --}}
        <!-- Apply as Volunteer-->
        <div class="text-center">
          <button type="button" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-xl shadow transition duration-200 disabled:bg-gray-400 disabled:cursor-not-allowed" 
          data="{{ $event->id }}"
          > 
          Apply as Volunteer
          </button>
        </div>

      </div>
    </div>
  </div>

  @endforeach
  </div>
@endsection

@push('scripts')
<script>
  const csrfToken = "{{ csrf_token() }}";

  // Event Listeners to the buttons for fetch
  document.addEventListener('DOMContentLoaded', () => {
    const allButtons = document.querySelectorAll('button[data]');

    allButtons.forEach(button => {
      button.addEventListener('click', async () => {
        const eventId = button.getAttribute('data');
        try {
          const response = await fetch("{{ route('people.volunteer.apply') }}", {
            method: 'POST',
            headers:{
              'Content-Type': 'application/json',
              'X-CSRF-Token': csrfToken
            },
            body: JSON.stringify({event_id: eventId})
          })

          const data = await response.json();

          if(response.ok){
            showToast(data.message);
            button.disabled = true;
            button.innerText = "Applied Successfully";
          }
          else {
            console.log(data);
            showToast(data.message || "Something went Wrong.", 'failure');
          }
          
        } catch (error) {
          console.error(error);
          showToast('An unexpected error occured.', 'failure')
        }
      })
    });
  })

  // function to show the small toast on top right
  const showToast = (message, type='success') => {
    const container = document.getElementById('toast-container');

    const toast = document.createElement('div');
    // Css 
    toast.className = `max-w-xs w-full px-4 py-2 rounded shadow text-white ${
        type === 'success' ? 'bg-green-500' : 'bg-red-500'
    } transform transition-transform duration-300 ease-in-out`;

    toast.textContent = message;

    container.appendChild(toast);

    // Slide in for toast
    requestAnimationFrame(() => {
        toast.classList.add('translate-x-0');
    });

    // Remove after 3 seconds
    setTimeout(() => {
        toast.classList.add('opacity-0');
        setTimeout(() => {
            toast.remove();
        }, 300);
    }, 3000);
  }
    
</script>
@endpush