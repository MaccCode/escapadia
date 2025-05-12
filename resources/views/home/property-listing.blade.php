<main style="padding: 30px 50px;">
  <div style="max-width: 1400px; margin: 0 auto;">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
      <h2 style="font-size: 26px; font-weight: bold;">Featured Properties in Zambales</h2>
      <a href="display" style="color: #2563eb; font-size: 16px; text-decoration: none;" onmouseover="this.style.textDecoration='underline';" onmouseout="this.style.textDecoration='none';">View all</a>
    </div>

    <!-- Big Property Cards -->
    <div style="display: flex; flex-wrap: wrap; gap: 25px; justify-content: center;">

      @foreach ($data->take(3) as $listing)
      @php
        $rooms = json_decode($listing->rooms, true) ?? [];
      @endphp

      <div style="width: 340px; background-color: #ffffff; box-shadow: 0 6px 15px rgba(0,0,0,0.15); border-radius: 16px; overflow: hidden; transition: all 0.3s ease; display: flex; flex-direction: column;"
           onmouseover="this.style.transform='scale(1.04)';" 
           onmouseout="this.style.transform='scale(1)';">

        <!-- Image -->
        <div style="height: 220px; overflow: hidden; position: relative;">
          <img src="/listing/{{ $listing->image }}" alt="{{ $listing->title }}" style="width: 100%; height: 100%; object-fit: cover;">
          <button style="position: absolute; top: 10px; right: 10px; background: none; border: none; color: red; font-size: 22px;">
            <i class="far fa-heart"></i>
          </button>
        </div>

        <!-- Info -->
        <div style="padding: 20px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">

          <!-- Top Info -->
          <div>
            <h5 style="font-size: 20px; font-weight: bold; margin-bottom: 8px; color: #111;">{{ $listing->title }}</h5>
            <p style="color: #666; font-size: 14px; margin-bottom: 14px;">
              <i class="fas fa-map-marker-alt" style="margin-right: 5px;"></i> {{ $listing->address }}
            </p>

            @if (!empty($rooms))
              @foreach ($rooms as $info)
                <p style="font-size: 14px; color: #444; margin: 3px 0;">
                  • {{ $info['type'] ?? 'Unknown' }} - {{ $info['quantity'] ?? 0 }} room(s) @ ₱{{ number_format($info['price'] ?? 0, 2) }}
                </p>
              @endforeach
            @else
              <p style="font-size: 14px; color: #444;">No rooms listed</p>
            @endif
          </div>

          <!-- Price and Button -->
          <div style="margin-top: 18px;">
            <h5 style="font-weight: bold; color: #111; font-size: 18px;">
              ₱{{ number_format($listing->room_total_price ?? 0, 2) }}<small style="color: #666;"> / Night</small>
            </h5>
            <div style="margin-top: 15px;">
              <a href="{{ url('property_details', $listing->id) }}" 
                 style="display: block; background-color: #2563eb; color: white; padding: 10px 0; border-radius: 8px; text-align: center; font-size: 16px; font-weight: 600; text-decoration: none;"
                 onmouseover="this.style.backgroundColor='#1d4ed8';"
                 onmouseout="this.style.backgroundColor='#2563eb';">
                View
              </a>
            </div>
          </div>

        </div>

      </div>
      @endforeach

    </div>

  </div>
</main>
