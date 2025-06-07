<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <title>Event Management</title>
  <style>
    /* Dark theme styles */
    body {
      background-color: #0f172a;
      color: #e2e8f0;
      font-family: 'Inter', sans-serif;
    }
    
    /* Blob background effects */
    .blob {
      position: absolute;
      width: 300px;
      height: 300px;
      background: linear-gradient(135deg, rgba(14, 165, 233, 0.1) 0%, rgba(124, 58, 237, 0.08) 100%);
      border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
      filter: blur(40px);
      z-index: 0;
      animation: float 12s ease-in-out infinite;
    }
    
    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }
    
    .blob-1 {
      top: -100px;
      left: -100px;
      width: 400px;
      height: 400px;
      animation-delay: 0s;
    }
    
    .blob-2 {
      bottom: -50px;
      right: -100px;
      width: 350px;
      height: 350px;
      animation-delay: 2s;
      animation-direction: reverse;
    }
    
    /* Responsive adjustments */
    @media (max-width: 767px) {
      .mobile-hidden {
        display: none;
      }
      .action-buttons {
        display: flex;
        flex-direction: row;
        gap: 0.5rem;
        justify-content: flex-end;
      }
      .action-btn {
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
      }
      .action-text {
        display: none;
      }
      .event-title {
        font-weight: 600;
        color: #f8fafc;
      }
    }
    
    @media (min-width: 768px) {
      .action-btn {
        padding: 0.4rem 0.75rem;
        border-radius: 0.375rem;
      }
      .action-text {
        display: inline;
        margin-left: 0.375rem;
      }
    }
    
    /* Floating button styling */
    .floating-btn {
      transition: all 0.3s ease;
      box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.3);
      z-index: 10;
    }
    
    .floating-btn:hover {
      transform: translateY(-2px) scale(1.05);
      box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.4);
    }
    
    /* Event card styling */
    .event-card {
      transition: all 0.3s ease;
      background-color: #1e293b;
      border: 1px solid #334155;
    }
    
    .event-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.25);
      border-color: #3b82f6;
    }
    
    /* Empty state styling */
    .empty-state {
      background-color: #1e293b;
      border: 1px dashed #475569;
    }
    
    /* Success message styling */
    .success-message {
      background-color: rgba(16, 185, 129, 0.2);
      border-left: 4px solid #10b981;
    }
    
    /* Custom scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
    }
    
    ::-webkit-scrollbar-track {
      background: #1e293b;
    }
    
    ::-webkit-scrollbar-thumb {
      background: #475569;
      border-radius: 4px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
      background: #64748b;
    }
  </style>
</head>
<body class="min-h-screen relative">

  <!-- Blob background elements -->
  <div class="blob blob-1"></div>
  <div class="blob blob-2"></div>

  <!-- Header -->
  <header class="bg-dark-800 shadow-sm sticky top-0 z-10">
    <div class="max-w-7xl mx-auto px-4 py-3 sm:py-4 sm:px-6 lg:px-8 flex justify-between items-center">
      <div class="flex items-center space-x-3 sm:space-x-4">
        <a href="{{ url('/') }}" class="text-gray-400 hover:text-gray-200 transition-colors">
          <i class="ph ph-arrow-left text-xl"></i>
        </a>
        <h1 class="text-lg sm:text-xl font-bold text-gray-200">Event Management</h1>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main class="max-w-6xl mx-auto p-4 sm:p-6 relative z-10">

    <!-- Search Bar -->
    <div class="mb-4 sm:mb-6">
      <form method="GET" action="{{ route('events.index') }}" class="w-full">
        <div class="relative">
          <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search events..."
            class="w-full pl-10 pr-4 py-2 text-sm sm:text-base rounded-lg bg-dark-700 border border-dark-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent text-gray-200 placeholder-gray-500"
          />
          <div class="absolute left-3 top-2.5 text-gray-500">
            <i class="ph ph-magnifying-glass text-lg"></i>
          </div>
        </div>
      </form>
    </div>

    @if (session('success'))
      <div class="success-message mb-4 p-3 rounded-lg flex items-center">
        <i class="ph ph-check-circle text-green-400 mr-2"></i>
        <span class="text-green-200">{{ session('success') }}</span>
      </div>
    @endif

    <!-- Desktop Table View -->
    <div class="hidden md:block bg-dark-800 rounded-lg shadow overflow-hidden border border-dark-700">
      <div class="grid grid-cols-12 bg-dark-700 px-4 py-3 border-b border-dark-600 text-gray-300 font-medium text-sm uppercase tracking-wider">
        <div class="col-span-1">No</div>
        <div class="col-span-3">Title</div>
        <div class="col-span-4">Description</div>
        <div class="col-span-2">Date</div>
        <div class="col-span-2 text-right">Actions</div>
      </div>

      @forelse ($events as $event)
        <div class="grid grid-cols-12 px-4 py-3 border-b border-dark-700 hover:bg-dark-750 items-center transition-colors">
          <div class="col-span-1 text-gray-400">{{ $loop->iteration }}</div>
          <div class="col-span-3 text-gray-200 font-medium truncate">{{ $event->title }}</div>
          <div class="col-span-4 text-gray-400 truncate">{{ $event->description }}</div>
          <div class="col-span-2 text-sm text-gray-400">
            {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}
          </div>
          <div class="col-span-2 flex justify-end">
            <div class="action-buttons">
              <a href="{{ route('events.edit', $event->id) }}"
                 class="action-btn bg-dark-700 text-primary-400 hover:bg-dark-600 transition-colors"
                 title="Edit">
                <i class="ph ph-pencil-simple"></i>
                <span class="action-text">Edit</span>
              </a>
              <form action="{{ route('events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event?')" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="action-btn bg-dark-700 text-red-400 hover:bg-dark-600 transition-colors"
                        title="Delete">
                  <i class="ph ph-trash"></i>
                  <span class="action-text">Delete</span>
                </button>
              </form>
            </div>
          </div>
        </div>
      @empty
        <div class="empty-state px-4 py-8 text-center rounded-lg">
          <i class="ph ph-calendar-blank text-4xl mb-3 text-gray-600"></i>
          <p class="text-gray-400 font-medium">No events found</p>
          <p class="text-gray-500 text-sm mt-1">Create your first event by clicking the + button</p>
        </div>
      @endforelse
    </div>

    <!-- Mobile Card View -->
    <div class="md:hidden space-y-3">
      @forelse ($events as $event)
        <div class="event-card rounded-lg shadow p-4">
          <div class="flex justify-between items-start">
            <div>
              <h3 class="event-title text-gray-200">{{ $event->title }}</h3>
              <p class="text-gray-500 text-sm mt-1">
                <i class="ph ph-calendar-blank mr-1"></i>
                {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}
              </p>
            </div>
            <div class="action-buttons">
              <a href="{{ route('events.edit', $event->id) }}"
                 class="action-btn bg-dark-700 text-primary-400 hover:bg-dark-600 transition-colors"
                 title="Edit">
                <i class="ph ph-pencil-simple"></i>
              </a>
              <form action="{{ route('events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Delete this event?')" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="action-btn bg-dark-700 text-red-400 hover:bg-dark-600 transition-colors"
                        title="Delete">
                  <i class="ph ph-trash"></i>
                </button>
              </form>
            </div>
          </div>
          @if($event->description)
            <p class="text-gray-400 text-sm mt-2 line-clamp-2">{{ $event->description }}</p>
          @endif
        </div>
      @empty
        <div class="empty-state px-4 py-8 text-center rounded-lg">
          <i class="ph ph-calendar-blank text-3xl mb-3 text-gray-600"></i>
          <p class="text-gray-400 font-medium">No events found</p>
        </div>
      @endforelse
    </div>
  </main>

  <!-- Floating Add Event Button -->
  <a href="{{ route('events.create') }}" 
     class="floating-btn fixed bottom-5 right-5 bg-primary-600 text-white rounded-full p-4 hover:bg-primary-700 transition duration-200 flex items-center justify-center"
     title="Add Event">
    <i class="ph ph-plus text-xl"></i>
    <span class="sr-only">Add Event</span>
  </a>

</body>
</html>