<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>{{ $data->title }} | Escapadia</title> 
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Lightbox2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">

<!-- Lightbox2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>



</head>
<body class="bg-gray-50 text-gray-800">
  <!-- Navbar -->
  <nav class="bg-white/80 backdrop-blur-md shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16">
  
        <!-- Logo -->
        <div class="flex items-center space-x-2">
          <i class="fas fa-umbrella-beach text-blue-600 text-2xl"></i>
          <span class="text-2xl font-bold text-blue-600">Escapadia</span>
        </div>
  
        <!-- Navigation Links -->
        <div class="hidden md:flex space-x-8">
          <a href="{{url('/')}}" class="text-gray-600 hover:text-blue-600 relative group text-base font-medium transition">
            Home
            <span class="absolute bottom-0 left-0 w-0 h-[2px] bg-blue-600 transition-all group-hover:w-full"></span>
          </a>
          <a href="#overview" class="text-gray-600 hover:text-blue-600 relative group text-base font-medium transition">
            Overview
            <span class="absolute bottom-0 left-0 w-0 h-[2px] bg-blue-600 transition-all group-hover:w-full"></span>
          </a>
          <a href="#gallery" class="text-gray-600 hover:text-blue-600 relative group text-base font-medium transition">
            Photo Gallery
            <span class="absolute bottom-0 left-0 w-0 h-[2px] bg-blue-600 transition-all group-hover:w-full"></span>
          </a>
          <a href="#location" class="text-gray-600 hover:text-blue-600 relative group text-base font-medium transition">
            Location
            <span class="absolute bottom-0 left-0 w-0 h-[2px] bg-blue-600 transition-all group-hover:w-full"></span>
          </a>
        </div>
  
      </div>
    </div>
  </nav>
  <!-- Hero Image -->
<main class="max-w-6xl mx-auto px-6 py-12 space-y-12">
  <div class="flex justify-center bg-white-100">
    <div class="max-w-6xl w-full">
      <img src="/listing/{{ $data->image }}" 
           alt="Crystal Beach Resort"
           class="w-full h-[500px] object-cover rounded-xl shadow-sm" />
    </div>
  </div>
</main>
  <!-- Main Content -->
<main class="max-w-6xl mx-auto px-6 py-12 space-y-12">

    <!-- Overview Section -->

  <section id="overview" class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 mb-12">
      <h2 class="text-2xl font-bold text-gray-900 mb-6">Overview</h2>
    
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        
        <div class="bg-blue-50 hover:bg-blue-100 transition rounded-lg p-6 text-center">
          <i class="fas fa-home text-2xl text-blue-500 mb-2"></i>
          <p class="text-sm text-gray-500">Title</p>
          <p class="text-lg font-semibold text-gray-900">{{ $data->title }}</p>
        </div>
    
        <div class="bg-blue-50 hover:bg-blue-100 transition rounded-lg p-6 text-center">
          <i class="fas fa-shower text-2xl text-blue-500 mb-2"></i>
          <p class="text-sm text-gray-500">Bathrooms</p>
          <p class="text-lg font-semibold text-gray-900">{{ $data->bathroom_count }}</p>
        </div>
        <div class="bg-blue-50 hover:bg-blue-100 transition rounded-lg p-6 text-center">
          <i class="fas fa-bed text-2xl text-blue-500 mb-2"></i>
          <p class="text-sm text-gray-500">Bedrooms</p>
          @foreach ($rooms as $room)
          <p class="text-md font-semibold text-gray-900">{{ $room['type'] }} • {{ $room['quantity'] }} * ₱{{ number_format($room['price'], 2) }}</p>
          @endforeach
        </div>
        <div class="bg-blue-50 hover:bg-blue-100 transition rounded-lg p-6 text-center">
          <i class="fas fa-building text-2xl text-blue-500 mb-2"></i>
          <p class="text-sm text-gray-500">Property Type</p>
          <p class="text-lg font-semibold text-gray-900">{{ $data->property_type }}</p>
        </div>
    
        <div class="bg-blue-50 hover:bg-blue-100 transition rounded-lg p-6 text-center">
          <i class="fas fa-tag text-2xl text-blue-500 mb-2"></i>
          <p class="text-sm text-gray-500">Price</p>
          <p class="text-lg font-semibold text-gray-900">
          <span class="font-bold text-lg text-gray-800">₱{{ number_format($data->room_total_price, 2) }}</span>
          <span class="text-gray-500">/ Night</span>
          </p>
        </div>
    
        <div class="bg-blue-50 hover:bg-blue-100 transition rounded-lg p-6 text-center">
          <i class="fas fa-users text-2xl text-blue-500 mb-2"></i>
          <p class="text-sm text-gray-500">Max Guests Allowed</p>
          <p class="text-lg font-semibold text-gray-900">{{ $data->guest_max }}</p>
        </div>
      </div>
      <div>
        <br>
      </div>
     <!-- Property Amenities -->
      @if(collect($additionals)->where('type', 'Amenity')->isNotEmpty())
      <section class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Property Amenities</h2>
        <ul style="list-style: disc; padding-left: 20px;">
          @foreach ($additionals as $info)
            @if ($info['type'] == 'Amenity')
              <li class="text-gray-700 leading-relaxed text-lg mb-1">
                {{ $info['item'] }}
              </li>
            @endif
          @endforeach
        </ul>
      </section>
      @endif

      <!-- Services Offered -->
@if (collect($additionals)->where('type', 'Service')->isNotEmpty())
<section class="mb-12">
    <h2 class="text-3xl font-bold text-gray-900 mb-8">We Offer Services</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        @foreach (collect($additionals)->where('type', 'Service') as $service)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
            
            @if (!empty($service['image']))
                <img 
                    src="{{ asset('listing/' . $service['image']) }}" 
                    alt="{{ $service['item'] }}" 
                    class="w-full h-48 object-cover"
                >
            @else
                <div class="w-full h-48 flex items-center justify-center bg-gray-200 text-gray-500">
                    <i class="fas fa-concierge-bell fa-2x"></i>
                </div>
            @endif

            <div class="p-4 text-center">
                <h3 class="text-lg font-semibold text-gray-800">{{ $service['item'] ?? 'Unknown Service' }}</h3>
                <p class="text-green-600 font-bold mt-2">
                    ₱{{ number_format($service['price'] ?? 0, 2) }}
                </p>
            </div>

        </div>
        @endforeach
    </div>
</section>
@endif
    </section>
    <!-- Description -->
    <section class="mb-12">
      <h2 class="text-2xl font-semibold mb-4 text-gray-900">Description</h2>
      <p class="text-gray-700 leading-relaxed text-lg">
        {{ $data->description }}
      </p>
    </section>


@if (auth()->check())
    <form id="bookingForm{{ $data->id }}" method="POST" action="{{ url('send_message', $data->id) }}">
      @csrf
      <section class="message-section mb-12">
        <div class="message-box">
          <h2 class="text-2xl font-semibold mb-4 text-gray-900">Message Us</h2>
          <label for="message">Message</label>
          <textarea id="message" name="message" placeholder="Type your message here..." required></textarea>
          <button type="submit" class="btn btn-primary">Send</button>
        </div>
      </section>
    </form>
@else
    <h2 class="text-2xl font-semibold mb-4 text-gray-900">Message Us</h2>
    <p>You need to <a href="{{ route('login') }}">log in</a> to send a message.</p>
@endif


<!-- Gallery Title -->
<h3 id="gallery" class="text-3xl font-bold mb-8 text-gray-900 text-center">Room Gallery</h3>

<!-- Lightbox Modal -->
<div id="lightboxModal" style="display:none; position:fixed; inset:0; background: rgba(0,0,0,0.8); justify-content:center; align-items:center; z-index:9999;">
    <img id="lightboxImage" src="" alt="Full View" class="max-h-[90vh] max-w-[90vw] rounded-lg shadow-lg">
    <button onclick="closeLightbox()" style="position: absolute; top: 20px; right: 30px; font-size: 30px; color: white;">&times;</button>
</div>

<!-- Gallery Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
    @foreach ($rooms as $room)
    <div class="flex flex-col items-center text-center">

        <!-- Bed Type -->
        <h4 class="text-xl font-semibold text-gray-700 mb-4">
            {{ $room['type'] }}
        </h4>

        <!-- Room Image -->
        <div 
            onclick="openLightbox('/listing/{{ $room['image'] }}')" 
            class="w-72 h-48 bg-gray-100 rounded-xl overflow-hidden shadow-md hover:shadow-lg transition transform hover:scale-105 cursor-pointer"
        >
            <img 
                src="/listing/{{ $room['image'] }}" 
                alt="{{ $room['type'] }}" 
                class="w-full h-full object-cover"
            >
        </div>

    </div>
    @endforeach
</div>
<h3 id="gallery" class="text-3xl font-bold mb-8 text-gray-900 text-center">Photo Gallery</h3>
<!-- GALLERY SECTION -->
<div class="container py-6">
  <div class="grid" style="display: flex; flex-wrap: wrap; margin-left: -10px; margin-right: -10px; gap: 10px;">

    @foreach ($gallery as $image)
      <div onclick="openLightbox('/Gallery/{{ $image->image }}')" 
           class="grid-item" 
           style="width: 250px; cursor: pointer;">
        <img 
          src="/Gallery/{{ $image->image }}" 
          alt="Gallery Image" 
          style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); transition: transform 0.3s;"
          onmouseover="this.style.transform='scale(1.05)'" 
          onmouseout="this.style.transform='scale(1)'"
        >
      </div>
    @endforeach

  </div>
</div>

<!-- LIGHTBOX MODAL -->
<div id="lightboxModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.8); align-items:center; justify-content:center; z-index:1000;">
  <span onclick="closeLightbox()" 
        style="position:absolute; top:20px; right:30px; font-size:40px; color:white; cursor:pointer;">
    &times;
  </span>
  <img id="lightboxImage" 
       style="max-width:90%; max-height:90%; border-radius:10px; object-fit:contain;">
</div>

<!-- LIGHTBOX SCRIPT -->
<script>
function openLightbox(imageSrc) {
    document.getElementById('lightboxModal').style.display = 'flex';
    document.getElementById('lightboxImage').src = imageSrc;
}

function closeLightbox() {
    document.getElementById('lightboxModal').style.display = 'none';
    document.getElementById('lightboxImage').src = '';
}
</script>

<!-- Lightbox JavaScript -->
<script>
    function openLightbox(imageSrc) {
        document.getElementById('lightboxModal').style.display = 'flex';
        document.getElementById('lightboxImage').src = imageSrc;
    }

    function closeLightbox() {
        document.getElementById('lightboxModal').style.display = 'none';
        document.getElementById('lightboxImage').src = '';
    }
</script>


    <!-- Location Map -->
    <section id="location">
      <h2 class="text-2xl font-semibold mb-4">📍 Location</h2>
      <p class="text-gray-600 mb-4 max-w-2xl">{{ $data->address }}</p>
      <div class="overflow-hidden rounded-xl border shadow-lg">
        <iframe 
          src="{{ $data->map_link }}"
          width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
          class="w-full">
        </iframe>
      </div>
    </section>
    <style>
.message-section {
  display: flex;
  justify-content: center;
}

.message-box {
  width: 100%;
  max-width: 800px; /* adjust for preferred width */
  margin: 20px 0;
  box-sizing: border-box;
  display: flex;
  flex-direction: column;
  gap: 10px;
  padding: 0 20px; /* optional for spacing on smaller screens */
}

.message-box textarea {
  width: 100%;
  height: 100px;
  padding: 10px;
  font-size: 14px;
  resize: none;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.message-box button {
  width: 100px;
  padding: 8px;
  background-color: #1E90FF;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  align-self: flex-end;
}

.message-box button:hover {
  background-color: #187bcd;
}

</style>


    <div class="mt-6 flex justify-center">
      <button class="bg-blue-600 hover:bg-blue-700 text-white text-xl font-semibold px-8 py-4 rounded-full shadow-lg transition duration-300" data-bs-toggle="modal" data-bs-target="#bookingModal{{$data->id}}">
          Book Now
      </button>
  </div>
</main>
  <!-- Footer -->
@include('home.booking_modal')
@include('home.footer')
@include('home.script')
 <script>
  document.addEventListener('DOMContentLoaded', function () {
    const nightlyPrice = parseFloat(document.getElementById('nightly_price').value);
    const startInput = document.getElementById('start_date');
    const endInput = document.getElementById('end_date');
    const priceInput = document.getElementById('total_price_input');
    const display = document.getElementById('total_price_display');

    function updatePrice() {
        const startDate = new Date(startInput.value);
        const endDate = new Date(endInput.value);

        if (!isNaN(startDate) && !isNaN(endDate) && endDate >= startDate) {
            let nights = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24));
            if (nights === 0) nights = 1;

            const total = nightlyPrice * nights;
            priceInput.value = total.toFixed(2);        // ✅ This saves the total price to DB
            display.textContent = total.toFixed(2);
            display.textContent = total.toLocaleString('en-PH', { minimumFractionDigits: 2 });// For user display
        } else {
            priceInput.value = "0";
            display.textContent = "0";
        }
    }
    startInput.addEventListener("change", updatePrice);
    endInput.addEventListener("change", updatePrice);
});
</script>
@if (session('success'))
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session("success") }}',
        confirmButtonColor: '#3085d6'
      });
    });
  </script>
@endif
</body>
</html>
