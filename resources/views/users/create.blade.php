<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <title>Create User</title>
  <style>
    /* Dark theme styles */
    body {
      background-color: #0f172a;
      color: #e2e8f0;
    }
    
    /* Input field styling */
    .input-field {
      background-color: #1e293b;
      border: 1px solid #334155;
      color: #e2e8f0;
      transition: all 0.3s ease;
    }
    
    .input-field:focus {
      border-color: #38bdf8;
      box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.3);
    }
    
    /* Select dropdown styling */
    .select-field {
      background-color: #1e293b;
      border: 1px solid #334155;
      color: #e2e8f0;
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%2394a3b8' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
      background-position: right 0.5rem center;
      background-repeat: no-repeat;
      background-size: 1.5em 1.5em;
    }
    
    /* Input icon styling */
    .input-icon {
      color: #64748b;
      transition: color 0.3s ease;
    }
    
    .input-container:focus-within .input-icon {
      color: #38bdf8;
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
    
    /* Card styling */
    .card {
      background-color: #1e293b;
      border: 1px solid #334155;
      box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.3);
      transition: all 0.3s ease;
    }
    
    /* Required field indicator */
    .required:after {
      content: " *";
      color: #f87171;
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
        <a href="{{ route('users.index') }}" class="text-gray-400 hover:text-gray-200 transition-colors">
          <i class="ph ph-arrow-left text-xl"></i>
        </a>
        <h1 class="text-lg sm:text-xl font-bold text-gray-200">User Management</h1>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main class="max-w-7xl mx-auto p-4 sm:p-6 relative z-10">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
      <div>
        <h2 class="text-2xl font-bold text-gray-200">Create New User</h2>
        <p class="text-sm text-gray-400">Add a new user to the system</p>
      </div>
    </div>

    <!-- Create Form Card -->
    <div class="card rounded-lg overflow-hidden">
      <!-- Card Header -->
      <div class="px-6 py-4 border-b bg-gradient-to-r from-primary-600 to-primary-700">
        <h3 class="text-lg font-semibold text-white flex items-center">
          <i class="ph ph-user-circle-plus mr-2"></i> User Information
        </h3>
      </div>

      <!-- Card Body -->
      <div class="p-6">
        <!-- Error Messages -->
        @if ($errors->any())
          <div class="mb-6 p-4 bg-red-900 bg-opacity-20 border-l-4 border-red-500 rounded-lg">
            <div class="flex items-center">
              <div class="flex-shrink-0 text-red-400">
                <i class="ph ph-warning-circle text-xl"></i>
              </div>
              <div class="ml-3">
                <h3 class="text-sm font-medium text-red-200">
                  There were {{ $errors->count() }} errors with your submission
                </h3>
                <div class="mt-2 text-sm text-red-300">
                  <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
        @endif

        <!-- Form -->
        <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
          @csrf

          <!-- Name Field -->
          <div>
            <label for="name" class="block text-sm font-medium text-gray-300 mb-1 required">
              Full Name
            </label>
            <div class="relative rounded-md shadow-sm input-container">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="ph ph-user input-icon"></i>
              </div>
              <input 
                type="text" 
                name="name" 
                id="name" 
                value="{{ old('name') }}"
                class="input-field block w-full pl-10 py-2 rounded-md focus:ring-primary-500 focus:border-primary-500"
                placeholder="Enter full name"
                required
              >
            </div>
          </div>

          <!-- Email Field -->
          <div>
            <label for="email" class="block text-sm font-medium text-gray-300 mb-1 required">
              Email Address
            </label>
            <div class="relative rounded-md shadow-sm input-container">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="ph ph-envelope-simple input-icon"></i>
              </div>
              <input 
                type="email" 
                name="email" 
                id="email" 
                value="{{ old('email') }}"
                class="input-field block w-full pl-10 py-2 rounded-md focus:ring-primary-500 focus:border-primary-500"
                placeholder="example@email.com"
                required
              >
            </div>
          </div>

          <!-- Gender Field -->
          <div>
            <label for="gender" class="block text-sm font-medium text-gray-300 mb-1">
              Gender
            </label>
            <div class="relative rounded-md shadow-sm input-container">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="ph ph-gender-intersex input-icon"></i>
              </div>
              <select 
                name="gender" 
                id="gender"
                class="select-field block w-full pl-10 py-2 rounded-md focus:ring-primary-500 focus:border-primary-500"
              >
                <option value="">-- Select Gender --</option>
                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
              </select>
            </div>
          </div>

          <!-- Form Actions -->
          <div class="flex items-center justify-end pt-6 border-t border-dark-700">
            <a 
              href="{{ route('users.index') }}" 
              class="mr-4 inline-flex items-center px-4 py-2 border border-dark-600 shadow-sm text-sm font-medium rounded-md text-gray-300 bg-dark-700 hover:bg-dark-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500"
            >
              <i class="ph ph-x mr-2"></i> Cancel
            </a>
            <button 
              type="submit"
              class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500"
            >
              <i class="ph ph-user-plus mr-2"></i> Create User
            </button>
          </div>
        </form>
      </div>
    </div>
  </main>
</body>
</html>