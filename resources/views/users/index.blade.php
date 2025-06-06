<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <title>User Management</title>
  <style>
    body {
      font-family: 'Inter', sans-serif;
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
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    .floating-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    
    /* Table row hover effect */
    .user-row:hover {
      background-color: rgba(255, 255, 255, 0.03);
    }
    
    /* Decorative line */
    .decorative-line {
      position: absolute;
      height: 1px;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
    }
  </style>
</head>
<body class="bg-gray-900 min-h-screen text-gray-100">

  <!-- Header -->
  <header class="bg-gray-800 border-b border-gray-700">
    <div class="max-w-7xl mx-auto px-4 py-3 sm:py-4 sm:px-6 lg:px-8 flex justify-between items-center">
      <div class="flex items-center space-x-3 sm:space-x-4">
        <a href="{{ url('/') }}" class="text-gray-400 hover:text-gray-200 transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
          </svg>
        </a>
        <h1 class="text-lg sm:text-xl font-bold text-gray-100">User Management</h1>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main class="max-w-3xl mx-auto p-4 sm:p-6">
    <!-- Search Bar -->
    <div class="mb-4 sm:mb-6 relative">
      <div class="absolute top-0 left-0 w-full h-full overflow-hidden">
        <div class="decorative-line w-full top-1/2"></div>
      </div>
      <form method="GET" action="{{ route('users.index') }}" class="relative z-10 w-full">
        <div class="relative">
          <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search users..."
            class="w-full pl-9 sm:pl-10 pr-3 sm:pr-4 py-2 text-sm sm:text-base rounded-lg bg-gray-700 border border-gray-600 focus:outline-none focus:ring-1 focus:ring-gray-500 focus:border-transparent text-gray-100 placeholder-gray-400"
          />
          <div class="absolute left-2 sm:left-3 top-2 sm:top-2.5 text-gray-400">
            <i class="fas fa-search text-sm sm:text-base"></i>
          </div>
        </div>
      </form>
    </div>

    <!-- User List -->
    <div class="bg-gray-800 rounded-lg border border-gray-700 overflow-hidden">
      <!-- Table Header -->
      <div class="grid grid-cols-12 bg-gray-700 px-3 sm:px-4 py-2 sm:py-3 border-b border-gray-600 text-gray-300 font-medium text-xs sm:text-sm uppercase tracking-wider">
        <div class="col-span-1">No</div>
        <div class="col-span-7 sm:col-span-8">Name</div>
        <div class="col-span-4 sm:col-span-3 text-right">Actions</div>
      </div>
      
      <!-- User Rows -->
      @forelse ($users as $user)
        <div class="user-row grid grid-cols-12 px-3 sm:px-4 py-3 sm:py-3 border-b border-gray-700 items-center transition-colors">
          <div class="col-span-1 text-gray-400 text-sm sm:text-base">
            {{ $loop->iteration}}
          </div>
          <div class="col-span-7 sm:col-span-8 font-medium text-gray-100 flex items-center text-sm sm:text-base">
            <span class="truncate">{{ $user->name }}</span>
          </div>
          <div class="col-span-4 sm:col-span-3 flex justify-end">
            <div class="action-buttons">
              <a href="{{ route('users.edit', $user->id) }}" 
                 class="action-btn bg-gray-700 text-gray-300 hover:bg-gray-600 hover:text-gray-100 transition-colors"
                 title="Edit">
                <i class="fas fa-edit text-sm"></i>
                <span class="action-text text-sm">Edit</span>
              </a>
              <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline ml-2">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="action-btn bg-gray-700 text-red-400 hover:bg-gray-600 hover:text-red-300 transition-colors"
                        title="Delete" 
                        onclick="return confirm('Are you sure you want to delete this user?')">
                  <i class="fas fa-trash-alt text-sm"></i>
                  <span class="action-text text-sm">Delete</span>
                </button>
              </form>
            </div>
          </div>
        </div>
      @empty
        <div class="px-4 py-6 text-center text-gray-400">
          <i class="fas fa-users-slash text-2xl sm:text-3xl mb-2 text-gray-600"></i>
          <p class="text-sm sm:text-base">No users found</p>
        </div>
      @endforelse
    </div>
  </main>

  <!-- Floating Add Button -->
  <a href="{{ route('users.create') }}" 
     class="floating-btn fixed bottom-5 right-5 bg-gray-700 text-gray-100 rounded-full p-4 hover:bg-gray-600 hover:text-white transition duration-200 border border-gray-600"
     title="Add User">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <line x1="12" y1="5" x2="12" y2="19"></line>
      <line x1="5" y1="12" x2="19" y2="12"></line>
    </svg>
    <span class="sr-only">Add User</span>
  </a>

</body>
</html>