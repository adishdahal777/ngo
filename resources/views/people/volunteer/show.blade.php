@extends('layouts.app')

@section('content')

{{-- Toast Container for Success and Failure Messages --}}
<div id="toast-container" class="fixed top-5 right-5 space-y-2 z-50"></div>

{{-- Added hero section and improved overall layout --}}
<div class="min-h-screen bg-background">
  {{-- Hero Section --}}
  <div class="bg-gradient-to-br from-primary/10 via-background to-accent/5 py-16 px-4">
    <div class="max-w-7xl mx-auto text-center">
      <h1 class="text-4xl md:text-5xl font-bold text-foreground mb-4 text-balance">
        Make a Difference in Your Community
      </h1>
      <p class="text-xl text-muted-foreground max-w-2xl mx-auto text-pretty">
        Join our volunteer programs and help create positive change. Choose from various events and start making an impact today.
      </p>
    </div>
  </div>

  {{-- Events Grid Section --}}
  <div class="max-w-7xl mx-auto px-4 py-12">
    {{-- Improved grid layout with better responsive design --}}
    <div class="grid grid-cols-1 md:grid-cols-2  gap-8">
      @foreach ($events as $event)
        {{-- Enhanced event card design with better shadows and hover effects --}}
        <div class="group bg-card rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-border/50 hover:border-primary/20">
          {{-- Event Image with overlay effect --}}
          <div class="relative overflow-hidden">
            <img 
              class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-300" 
              src="{{ asset($event->cover_image_path_name) }}" 
              alt="{{ $event->title }}"
            >
            {{-- Subtle gradient overlay --}}
            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          </div>

          <div class="p-6">
            {{-- Improved typography and spacing --}}
            <!-- Event Title -->
            <h2 class="text-2xl font-bold text-card-foreground mb-3 text-balance group-hover:text-primary transition-colors duration-200">
              {{ $event->title }}
            </h2>
            
            <!-- Event Date and Location -->
            <div class="flex items-center text-muted-foreground text-sm mb-4 gap-2">
              {{-- Updated icon and improved styling --}}
              <div class="flex items-center gap-1">
                <svg class="w-4 h-4 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span class="font-medium">{{ $event->start_date }}</span>
              </div>
              <span class="text-border">•</span>
              <div class="flex items-center gap-1">
                <svg class="w-4 h-4 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span class="font-medium">{{ $event->location }}</span>
              </div>
            </div>

            <!-- Description -->
            {{-- Improved description styling with better line height --}}
            <p class="text-muted-foreground mb-6 leading-relaxed text-pretty">
              {{ $event->description }}
            </p>

            <!-- Apply as Volunteer Button -->
            {{-- Enhanced button design with better hover states and preserved data attribute --}}
            <div class="text-center">
              <button 
                type="button" 
                class="w-full bg-accent hover:bg-accent/90 text-accent-foreground font-semibold px-6 py-3 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 disabled:bg-muted disabled:text-muted-foreground disabled:cursor-not-allowed disabled:shadow-none transform hover:-translate-y-0.5 active:translate-y-0 focus:outline-none focus:ring-2 focus:ring-accent/50 focus:ring-offset-2 focus:ring-offset-background" 
                data="{{ $event->id }}"
              > 
                <span class="flex items-center justify-center gap-2">
                  Apply as Volunteer
                </span>
              </button>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    {{-- Added empty state for when no events are available --}}
    @if($events->isEmpty())
      <div class="text-center py-16">
        <div class="max-w-md mx-auto">
          <svg class="w-16 h-16 text-muted-foreground mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
          </svg>
          <h3 class="text-xl font-semibold text-foreground mb-2">No Events Available</h3>
          <p class="text-muted-foreground">Check back soon for new volunteer opportunities!</p>
        </div>
      </div>
    @endif
  </div>
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