<!DOCTYPE html>
<html lang="en">
<head>
    @include ('home.head')
</head>
<body class="bg-gray-50">
    @include ('home.navbar')
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
<section id="display">
@include ('home.property-listing') 
</section>
<section id="about" class="bg-gray py-20">
  <div class="max-w-7xl mx-auto px-4 text-center">
    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">Get to Know Escapadia</h2>
    <p class="text-lg text-gray-600 mb-12 max-w-2xl mx-auto">
      Behind every stay is a story. Here's who we are and what we stand for.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- About Us -->
      <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition duration-300">
        <div class="relative h-56">
          <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e" alt="About" class="w-full h-full object-cover">
          <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent p-4 flex items-end">
            <div>
              <h3 class="text-white text-xl font-bold">About Us</h3>
              <p class="text-white text-sm">A locally focused platform that makes exploring Zambales easier and more authentic.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Mission -->
      <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition duration-300">
        <div class="relative h-56">
          <img src="https://images.unsplash.com/photo-1506748686214-e9df14d4d9d0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1050&q=80" 
               alt="Mission" class="w-full h-full object-cover">
          <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent p-4 flex items-end">
            <div>
              <h3 class="text-white text-xl font-bold">Our Mission</h3>
              <p class="text-white text-sm">To help travelers discover unforgettable stays while empowering local hosts in Zambales.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Vision -->
      <div class="rounded-xl overflow-hidden shadow-md hover:shadow-xl transition duration-300">
        <div class="relative h-56">
          <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?ixlib=rb-4.0.3&auto=format&fit=crop&w=1050&q=80" 
               alt="Vision" class="w-full h-full object-cover">
          <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent p-4 flex items-end">
            <div>
              <h3 class="text-white text-xl font-bold">Our Vision</h3>
              <p class="text-white text-sm">
                To become the go-to platform for regional travel starting with the hidden gems of Zambales.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@include ('home.footer')
@include ('home.script')
</body>
</html>