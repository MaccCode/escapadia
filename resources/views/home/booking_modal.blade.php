<div class="modal fade" id="bookingModal{{ $data->id }}" tabindex="-1" aria-labelledby="bookingModalLabel{{ $data->id }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- Centered + Wider -->
    <div class="modal-content rounded-lg shadow-lg"> <!-- Rounded corners + shadow -->
    
      <div class="modal-header">
        <h5 class="modal-title" id="bookingModalLabel{{ $data->id }}">Book: {{ $data->title }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="bookingForm{{ $data->id }}" method="POST" action="{{ url('add_booking', $data->id) }}">
        @csrf
        <div class="modal-body">
        <div class="mb-3">
                <label for="start_date{{ $data->id }}" class="form-label">Location:</label>
                <input type="text" name="lister_id" id="lister_id" value="{{$data->user_id}}" class="text-muted" hidden>
                <input type="text" name="price" id="price" value="{{$data->user_id}}" class="text-muted" hidden>
                <label for="start_date{{ $data->id }}" class="form-label">Price:</label>
                            <span class="font-bold text-lg text-gray-800">₱{{ number_format($data->room_total_price, 2) }}</span>
                        <span class="text-gray-500">/ Night</span>
            </div>
            <div class="mb-3">
                <label class="form-label">Bedroom: </label>
                @foreach ($rooms as $room)
                <Label class="text-muted">{{ $room['type'] }} • {{ $room['quantity'] }} * ₱{{ number_format($room['price'], 2) }}</Label>
                @endforeach
            </div>
            <label for="start_date{{ $data->id }}" class="form-label">Amenities</label>
            <div class="mb-3">
                @foreach ($additionals as $info)
                @if ($info['type'] == 'Amenity')
                    <Label class="text-muted">
                • {{ $info['item'] }}
                    </Label>
                @endif
                @endforeach
            </div>
            @if (Route::has('login'))
            @Auth
            <div class="mb-3">
                <label for="start_date{{ $data->id }}" class="form-label">Name</label>
                <input type="text" name="name" id="name" value="{{ Auth::user()->name }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="start_date{{ $data->id }}" class="form-label">Email</label>
                <input type="text" name="email" id="email" value="{{ Auth::user()->email }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="start_date{{ $data->id }}" class="form-label">Phone</label>
                <input type="text" name="phone" id="phone" value="{{ Auth::user()->phone }}" class="form-control"required>
            </div>
            @else
            <div class="mb-3">
                <label for="start_date{{ $data->id }}" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="start_date{{ $data->id }}" class="form-label">Email</label>
                <input type="text" name="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="start_date{{ $data->id }}" class="form-label">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control" required>
            </div>
            @endauth
            @endif

            <div class="mb-3">
                <label for="start_date{{ $data->id }}" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date" min="{{ date('Y-m-d') }}" required>
            </div>

            <div class="mb-3">
                <label for="end_date{{ $data->id }}" class="form-label">End Date</label>
                <input class="form-control" type="date" id="end_date" name="end_date" min="{{ date('Y-m-d') }}" required>
            </div>

            <div class="mb-3">
                <label for="guests{{ $data->id }}" class="form-label">Number of guests</label>
                <select name="number_of_guests" id="number_of_guests" class="form-control" required>
                    @for ($i = $data->guest_minimum; $i <= $data->guest_max; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                <small class="text-muted">Maximum guests allowed:  {{ $data->guest_max }} </small>
            </div>
            <div class="mb-3">
                <label for="message{{ $data->id }}" class="form-label">Message</label>
                <textarea name="message" id="message{{ $data->id }}" class="form-control" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="payment_method{{ $data->id }}" class="form-label">Payment Method</label>
                <select name="payment_method" id="payment_method{{ $data->id }}" class="form-control" required>
                    <!-- <option value="credit_card">Credit Card</option>
                    <option value="bank_transfer">Bank Transfer</option> -->
                    <option value="pay_on_arrival">Pay on Arrival</option>
                    <!-- <option value="paypal">PayPal</option> -->
                    <option value="gcash">GCash</option>
                </select>
            </div>
           <!-- Base nightly price -->
            <input type="hidden" id="nightly_price" value="{{ $data->room_total_price }}">

            <!-- Hidden fields for calculated totals -->
            <input type="hidden" id="total_price_input" name="price" value="0">
            <input type="hidden" id="commission_input" name="commission_input" value="0">
            <input type="hidden" id="payable_input" name="payable_input" value="0">
            <!-- Total Price Display -->
            <p>Total Price: ₱<span id="total_price_display">0</span></p>

        </div>      
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success" data-bs-target="#confirmApproveModal{{ $data->id }}">Confirm Booking</button>
        </div>
      </form>
    </div>
  </div>
</div>
