<!DOCTYPE html>
<html lang="en">
<head>
    @include('home.head')
</head>
<body>
<!-- Navigation -->
<nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <i class="fas fa-umbrella-beach text-2xl text-blue-600 mr-2"></i>
                        <span class="text-xl font-bold text-blue-600">Escapedia</span>
                    </div>
                </div>
                <div class="hidden md:ml-6 md:flex md:items-center md:space-x-8">
                    <a href="{{ url('/') }}" class="text-gray-500 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 border-transparent hover:border-gray-300 text-sm font-medium">Home</a>
                    <a href="{{ url('display') }}" class="text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 border-blue-500 text-sm font-medium">Explore</a>
                    <a href="{{ url('/') }}" class="text-gray-500 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 border-transparent hover:border-gray-300 text-sm font-medium">About</a>
                </div>
                <div class="hidden md:ml-6 md:flex md:items-center">
                    @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a
                            href="{{ url('dashboard') }}"
                            class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg border border-white hover:bg-blue-700 transition"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg border border-white hover:bg-blue-700 transition duration-300 ease-in-out"
                        >
                            Log in
                        </a>
                        @endauth
                        </nav>
                    @endif
                </div>
                <div class="-mr-2 flex items-center md:hidden">
                    <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                        <span class="sr-only">Open main menu</span>
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>
    <div class="hero-bg h-96 flex items-center justify-center text-white">
        <div class="text-center px-4">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Discover Your Perfect Getaway in Zambales</h1>
            <p class="text-xl mb-8">Beachfront resorts, private villas, and nature retreats for your next escape</p>
        </div>
    </div>
<!-- Property Categories -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-2xl font-bold mb-8">Browse by property type</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">   
            <!-- Beach Resorts -->
            <a href="{{ url('beach') }}" class="block">
                <div class="flex flex-col items-center p-4 rounded-lg hover:bg-gray-100 cursor-pointer">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-2">
                        <i class="fas fa-umbrella-beach text-blue-600 text-xl"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-800">Beach Resorts</span>
                </div>
            </a>

            <!-- Private Villas -->
            <a href="{{ url('private') }}" class="block">
                <div class="flex flex-col items-center p-4 rounded-lg hover:bg-gray-100 cursor-pointer">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-2">
                        <i class="fas fa-home text-blue-600 text-xl"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-800">Private Villas</span>
                </div>
            </a>

            <!-- Nature Retreats -->
            <a href="{{ url('nature') }}" class="block">
                <div class="flex flex-col items-center p-4 rounded-lg hover:bg-gray-100 cursor-pointer">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-2">
                        <i class="fas fa-tree text-blue-600 text-xl"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-800">Nature Retreats</span>
                </div>
            </a>

            <!-- Lakeside -->
            <a href="{{ url('lake') }}" class="block">
                <div class="flex flex-col items-center p-4 rounded-lg hover:bg-gray-100 cursor-pointer">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-2">
                        <i class="fas fa-water text-blue-600 text-xl"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-800">Lakeside</span>
                </div>
            </a>

            <!-- Camping -->
            <a href="{{ url('camp') }}" class="block">
                <div class="flex flex-col items-center p-4 rounded-lg hover:bg-gray-100 cursor-pointer">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-2">
                        <i class="fas fa-campground text-blue-600 text-xl"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-800">Camping</span>
                </div>
            </a>

            <!-- Pool Villas -->
            <a href="{{ url('pool') }}" class="block">
                <div class="flex flex-col items-center p-4 rounded-lg hover:bg-gray-100 cursor-pointer">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-2">
                        <i class="fas fa-swimming-pool text-blue-600 text-xl"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-800">Pool Villas</span>
                </div>
            </a>
        </div>
    </div>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h2 class="text-2xl font-bold mb-8">Browse Camping Property</h2>
    <main class="py-6 text-center">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
    <!-- Property Card -->
        @foreach ($data as $listing)
        @if ($listing->property_type == 'Camping')        
            <div class="property-card bg-white rounded-xl overflow-hidden shadow-md transition duration-300 flex flex-col">
            <div class="relative">
                <img src="/listing/{{ $listing->image }}" alt="{{ $listing->title }}" class="w-full h-64 object-cover">
                <button class="absolute top-3 right-3 text-red-500">
                    <i class="far fa-heart text-2xl"></i>
                </button>
            </div>
            <div class="p-4 flex flex-col justify-between flex-grow text-left">
                <div>
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-bold text-lg">{{ $listing->title }}</h3>
                            <p class="text-gray-600 flex items-center"><i class="fa fa-map-pin mr-2"></i>{{ $listing->address }}</p>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-star text-yellow-400"></i>
                            <span class="ml-1">4.8</span>
                        </div>
                    </div>
                    <div class="mt-2 text-gray-500">
                        {{ $listing->guest_minimum }} - {{ $listing->guest_max }} guest · {{ $listing->bedroom_count }} bedroom · {{ $listing->bathroom_count }} bathroom
                    </div>
                    <div class="mt-2">
                        @if($listing->initial_price > $listing->current_price && $listing->current_price != 0)
                            <span class="text-gray-500 line-through">₱{{ number_format($listing->initial_price, 2) }}</span>
                            <span class="font-bold text-lg ml-2 text-green-600">₱{{ number_format($listing->current_price, 2) }}</span>
                        @else
                            <span class="font-bold text-lg text-gray-800">₱{{ number_format($listing->initial_price, 2) }}</span>
                        @endif
                        <span class="text-gray-500">/ Night</span>
                    </div>
                </div>     
                <div class="mt-4 flex justify-end">
                    <button class="text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded">
                        <a href="{{ url("property_details", $listing->id) }}">View</a>
                    </button>
                </div>
            </div>
         </div>
        @endif
        @endforeach
        </div>
    </div>
</main>
</div>
  @include('home.footer')
  @include('home.script')
</body>
</html>