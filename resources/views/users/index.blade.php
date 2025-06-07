<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>User Management</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <style>
    /* Dark theme styles */
    body {
      background-color: #0f172a;
      color: #e2e8f0;
    }
    
    /* Action buttons styling for mobile */
    @media (max-width: 640px) {
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
    }

    /* Desktop styles */
    @media (min-width: 641px) {
      .action-btn {
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
      }
      .action-text {
        display: inline;
        margin-left: 0.25rem;
      }
    }

    /* Floating button styles */
    .floating-btn {
      transition: all 0.3s ease;
      box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.3);
    }
    .floating-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.4);
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
    
    /* Card hover effect */
    .card-hover-effect:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
    }
  </style>
</head>
<body class="min-h-screen">

  <!-- Blob background elements -->
  <div class="blob blob-1"></div>
  <div class="blob blob-2"></div>

  <!-- Header -->
  <header class="bg-dark-800 shadow-sm relative z-10">
    <div class="max-w-7xl mx-auto px-4 py-3 sm:py-4 sm:px-6 lg:px-8 flex justify-between items-center">
      <div class="flex items-center space-x-3 sm:space-x-4">
        <a href="{{ url('/') }}" class="text-gray-400 hover:text-gray-200 transition-colors">
          <i class="ph ph-arrow-left text-xl"></i>
        </a>
        <h1 class="text-lg sm:text-xl font-bold text-gray-200">User Management</h1>
      </div>
      <div class="flex items-center space-x-2">
        <button class="w-8 h-8 rounded-full bg-dark-700 flex items-center justify-center text-gray-400 hover:bg-dark-600 transition-colors">
          <i class="ph ph-bell text-sm"></i>
        </button>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main class="max-w-3xl mx-auto p-4 sm:p-6 relative z-10">
    <!-- Search Bar -->
    <div class="mb-4 sm:mb-6">
      <form method="GET" action="{{ route('users.index') }}" class="w-full">
        <div class="relative">
          <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search users..."
            class="w-full pl-10 pr-4 py-2 text-sm sm:text-base rounded-lg bg-dark-700 border border-dark-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent text-gray-200 placeholder-gray-500"
          />
          <div class="absolute left-3 top-2.5 text-gray-500">
            <i class="ph ph-magnifying-glass text-lg"></i>
          </div>
        </div>
      </form>
    </div>

    <!-- User List -->
    <div class="bg-dark-800 rounded-lg shadow-card overflow-hidden card-hover-effect transition-all duration-200">
      <!-- Table Header -->
      <div class="grid grid-cols-12 bg-dark-700 px-4 py-3 border-b border-dark-600 text-gray-400 font-medium text-xs sm:text-sm uppercase tracking-wider">
        <div class="col-span-1">No</div>
        <div class="col-span-7 sm:col-span-8">Name</div>
        <div class="col-span-4 sm:col-span-3 text-right">Actions</div>
      </div>
      
      <!-- User Rows -->
      @forelse ($users as $user)
        <div class="grid grid-cols-12 px-4 py-3 border-b border-dark-700 hover:bg-dark-750 items-center transition-colors">
          <div class="col-span-1 text-gray-400 text-sm sm:text-base">
            {{ $loop->iteration}}
          </div>
          <div class="col-span-7 sm:col-span-8 font-medium text-gray-200 flex items-center text-sm sm:text-base">
            <span class="truncate">{{ $user->name }}</span>
          </div>
          <div class="col-span-4 sm:col-span-3 flex justify-end">
            <div class="action-buttons">
              <a href="{{ route('users.edit', $user->id) }}" 
                 class="action-btn bg-dark-700 text-primary-400 hover:bg-dark-600 transition-colors"
                 title="Edit">
                <i class="ph ph-pencil-simple-line text-sm"></i>
                <span class="action-text text-sm">Edit</span>
              </a>
              <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline ml-2">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="action-btn bg-dark-700 text-red-400 hover:bg-dark-600 transition-colors"
                        title="Delete" 
                        onclick="return confirm('Are you sure you want to delete this user?')">
                  <i class="ph ph-trash text-sm"></i>
                  <span class="action-text text-sm">Delete</span>
                </button>
              </form>
            </div>
          </div>
        </div>
      @empty
        <div class="px-4 py-6 text-center text-gray-500">
          <i class="ph ph-users text-3xl mb-2 text-gray-600"></i>
          <p class="text-sm sm:text-base">No users found</p>
        </div>
      @endforelse
    </div>
  </main>

  <!-- Floating Add Button -->
  <a href="{{ route('users.create') }}" 
     class="floating-btn fixed bottom-5 right-5 bg-primary-600 text-white rounded-full p-4 hover:bg-primary-700 transition duration-200 flex items-center justify-center"
     title="Add User">
    <i class="ph ph-plus text-xl"></i>
    <span class="sr-only">Add User</span>
  </a>
</body>
</html>