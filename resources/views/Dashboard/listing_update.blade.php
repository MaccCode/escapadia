<!DOCTYPE html>
<html>
<head> 
    <base href="{{ asset('/public') }}">
    @include('Dashboard.head')
</head>
<body>
@include('Dashboard.header')
<div class="d-flex align-items-stretch">
    @include('Dashboard.sidebar')
    <div class="page-content">

    <!-- Page Header -->
    <div class="page-header no-margin-bottom">
      <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Update Property: {{ $listing->title }}</h2>
      </div>
    </div>

    <!-- Breadcrumb -->
    <div class="container-fluid">
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('view_listing') }}" style="color: #1E90FF;">Properties</a></li>
        <li class="breadcrumb-item active">Update Information</li>
      </ul>
    </div>

    <section class="no-padding-top">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="block">
            <div class="title"><strong style="color: #1E90FF;">Edit All Informations</strong></div>
            <div class="block-body">

              <form class="form-horizontal" action="{{ url('listing_update_confirm', $listing->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Business Name / Property Name -->
                <div class="form-group row">
                  <label class="col-sm-6 form-control-label" style="color: #1E90FF;"><strong>Business Name / Property Name</strong></label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="title" value="{{ old('title', $listing->title) }}" required>
                  </div>
                </div>

                <div class="line"></div>

                <!-- Property Type -->
               <div class="form-group row">
              <label class="col-sm-6 form-control-label" style="color: #1E90FF;"><strong>Property Type</strong></label>
              <div class="col-sm-12">
                <select name="property_type" class="form-control" id="property_type" required onchange="toggleOtherInput()">
                  <option value="" disabled>Select Property Type</option>
                  @php
                    $types = ['Beach Resorts', 'Private Villas', 'Nature Retreats', 'Lakeside', 'Camping', 'Pool Villas'];
                  @endphp
                  @foreach($types as $type)
                    <option value="{{ $type }}" {{ ($listing->property_type == $type) ? 'selected' : '' }}>{{ $type }}</option>
                  @endforeach
                  <option value="Other" {{ (!in_array($listing->property_type, $types)) ? 'selected' : '' }}>Other</option>
                </select>

                <input 
                  type="text" 
                  id="other_property_type" 
                  name="other_property_type" 
                  class="form-control mt-2" 
                  placeholder="Please specify..." 
                  value="{{ (!in_array($listing->property_type, $types)) ? $listing->property_type : '' }}" 
                  style="display: none;"
                >
              </div>
            </div>

            <script>
            function toggleOtherInput() {
              var selectedType = document.getElementById('property_type').value;
              var otherInput = document.getElementById('other_property_type');

              if (selectedType === 'Other') {
                otherInput.style.display = 'block';
                otherInput.required = true;
              } else {
                otherInput.style.display = 'none';
                otherInput.required = false;
                otherInput.value = '';
              }
            }

            // Auto-show the Other input when page loads (editing case)
            document.addEventListener('DOMContentLoaded', function() {
              var selectedType = document.getElementById('property_type').value;
              var otherInput = document.getElementById('other_property_type');

              if (selectedType === 'Other') {
                otherInput.style.display = 'block';
                otherInput.required = true;
              }
            });
            </script>

                <div class="line"></div>

                <!-- Address -->
                <div class="form-group row">
                  <label class="col-sm-6 form-control-label" style="color: #1E90FF;"><strong>Address</strong></label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="address" value="{{ old('address', $listing->address) }}" required>
                  </div>
                </div>

                <div class="line"></div>

                <!-- Guest Max -->
                <div class="form-group row">
                  <label class="col-sm-6 form-control-label" style="color: #1E90FF;"><strong>Maximum Guest Count</strong></label>
                  <div class="col-sm-12">
                    <input type="number" class="form-control" name="guest_max" value="{{ old('guest_max', $listing->guest_max) }}" required>
                  </div>
                </div>

                <div class="line"></div>
                <div class="form-group">
                <label class="form-control-label" style="color: #1E90FF;"><strong>Room Types</strong></label>

                <div class="row g-2 align-items-center mb-2">
                  <div class="col-md-3">
                    <label for="room_type" class="form-label mb-1">Room Type</label>
                    <select class="form-control" id="room_type">
                      <option value="" disabled selected>Select Room Type</option>
                      <option value="Single Bedroom">Single Bedroom</option>
                      <option value="Double Bedroom">Double Bedroom</option>
                      <option value="Multiple Bedroom">Multiple Bedroom</option>
                    </select>
                  </div>

                  <div class="col-md-2">
                    <label for="room_quantity" class="form-label mb-1">Quantity</label>
                    <input type="number" class="form-control" id="room_quantity" placeholder="Enter quantity">
                  </div>

                  <div class="col-md-2">
                    <label for="room_price" class="form-label mb-1">Price per Room</label>
                    <input type="number" class="form-control" id="room_price" placeholder="Enter price (₱)">
                  </div>

                  <div class="col-md-3">
                    <label for="room_image" class="form-label mb-1">Photo</label>
                    <input type="file"  id="room_image" accept="image/*">
                  </div>

                  <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-info w-100" onclick="addRoomType()">Add</button>
                  </div>
                </div>

                <div id="room_list" class="mt-3"></div>
                <div id="room_inputs"></div>

                <!-- Room Types (Existing) -->
                <div class="form-group">
                <label class="form-control-label" style="color: #1E90FF;"><strong>Existing Room Types</strong></label>               
                @php $rooms = json_decode($listing->rooms, true); @endphp
                @if (!empty($rooms))
                  @foreach ($rooms as $index => $room)
                    <div class="border p-2 rounded mb-2" id="room_existing_{{ $index }}">
                      <div class="d-flex justify-content-between align-items-center">
                        
                        <!-- LEFT SIDE: Room info -->
                        <div>
                          <strong>{{ $room['type'] ?? 'Unknown Room' }}</strong><br>
                          {{ $room['quantity'] ?? 0 }} room(s) @ ₱{{ number_format($room['price'] ?? 0, 2) }}
                          @if (!empty($room['image']))
                            <br><img src="{{ asset('listing/' . $room['image']) }}" style="height: 60px; margin-top:5px;">
                          @endif
                        </div>

                        <!-- RIGHT SIDE: Remove button -->
                        <div class="text-end">
                          <button type="button" class="btn btn-danger btn-sm" onclick="removeExistingRoom({{ $index }})">Remove</button>
                        </div>

                      </div>

                      <!-- Hidden input for backend -->
                      <input type="hidden" name="existing_rooms[{{ $index }}]" value="{{ base64_encode(json_encode($room)) }}">
                    </div>
                  @endforeach
                @else
                  <p>No rooms added yet.</p>
                @endif
              </div>

              <div class="mt-4">
             <!-- Room Totals Display -->
            <div class="d-flex justify-content-between mt-3">
              <div>Existing Total: ₱<span id="existing_room_total">0</span></div>
              <div>New Total: ₱<span id="new_room_total">0</span></div>
              <div><strong>Final Total: ₱<span id="final_room_total">0</span></strong></div>
            </div>

            <!-- Hidden Input to submit to backend -->
            <input type="hidden" name="room_total_price" id="room_total_input" value="0">
            </div>

          <div id="room_inputs"></div>

          <script>
          let roomCount = 1000; // Start high to avoid conflict
          let existingRoomCost = 0; // Sum of rooms from database
          let newRoomCost = 0;      // Sum of newly added rooms

          // When page loads
          window.onload = function() {
            calculateExistingRooms();
            updateFinalTotal();
          };

          // Calculate total of existing rooms
          function calculateExistingRooms() {
            const existingRooms = document.querySelectorAll('[id^="room_existing_"]');
            existingRooms.forEach(room => {
              const hiddenInput = room.querySelector('input[type="hidden"]');
              if (hiddenInput) {
                const decoded = JSON.parse(atob(hiddenInput.value)); // Decode base64 JSON
                if (decoded.price && decoded.quantity) {
                  existingRoomCost += decoded.price * decoded.quantity;
                }
              }
            });
            updateFinalTotal();
          }

          // Remove existing room
          function removeExistingRoom(index) {
            if (confirm('Are you sure you want to remove this existing room?')) {
              const roomDiv = document.getElementById(`room_existing_${index}`);
              if (roomDiv) {
                const hiddenInput = roomDiv.querySelector('input[type="hidden"]');
                if (hiddenInput) {
                  const decoded = JSON.parse(atob(hiddenInput.value));
                  if (decoded.price && decoded.quantity) {
                    existingRoomCost -= decoded.price * decoded.quantity;
                  }
                }
                roomDiv.remove();
                updateFinalTotal();
              }
            }
          }

          // Add a new room
          function addRoomType() {
            const type = document.getElementById('room_type').value;
            const quantity = parseInt(document.getElementById('room_quantity').value);
            const price = parseFloat(document.getElementById('room_price').value);
            const imageInput = document.getElementById('room_image');
            const imageFile = imageInput.files[0];

            if (!type || !quantity || !price || !imageFile || quantity <= 0 || price <= 0) {
              alert("Please complete all fields and upload a photo.");
              return;
            }

            const total = quantity * price;
            newRoomCost += total;
            updateFinalTotal();

            roomCount++;

            const reader = new FileReader();
            reader.onload = function (e) {
              const list = document.getElementById('room_list');
              const newDiv = document.createElement('div');
              newDiv.className = "border p-2 rounded mb-2";
              newDiv.id = `room_new_${roomCount}`;

              newDiv.innerHTML = `
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <strong>Added ${type}</strong><br>
                    ${quantity} room(s) @ ₱${price.toFixed(2)} each<br>
                    <strong>Total: ₱${total.toFixed(2)}</strong><br>
                    <img src="${e.target.result}" style="height: 60px; width: auto; margin-top:5px;">
                  </div>
                  <div class="text-end">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeNewRoom(${roomCount}, ${total})">Remove</button>
                  </div>
                </div>
              `;
              list.appendChild(newDiv);
            };
            reader.readAsDataURL(imageFile);

            // Create hidden inputs for backend
            const inputs = document.getElementById('room_inputs');
            const inputSet = document.createElement('div');
            inputSet.id = `room_inputs_${roomCount}`;
            inputSet.innerHTML = `
              <input type="hidden" name="rooms[${roomCount}][type]" value="${type}">
              <input type="hidden" name="rooms[${roomCount}][quantity]" value="${quantity}">
              <input type="hidden" name="rooms[${roomCount}][price]" value="${price}">
            `;

            if (imageFile) {
              const clonedFile = imageInput.cloneNode();
              clonedFile.name = `rooms[${roomCount}][image]`;
              clonedFile.style.display = 'none';
              const dt = new DataTransfer();
              dt.items.add(imageFile);
              clonedFile.files = dt.files;
              inputSet.appendChild(clonedFile);
            }

            inputs.appendChild(inputSet);

            // Reset form fields
            document.getElementById('room_type').value = "";
            document.getElementById('room_quantity').value = "";
            document.getElementById('room_price').value = "";
            document.getElementById('room_image').value = "";
          }

          // Remove newly added room
          function removeNewRoom(id, amount) {
            if (confirm('Are you sure you want to remove this room?')) {
              newRoomCost -= amount;
              updateFinalTotal();

              const roomDiv = document.getElementById(`room_new_${id}`);
              const inputDiv = document.getElementById(`room_inputs_${id}`);
              if (roomDiv) roomDiv.remove();
              if (inputDiv) inputDiv.remove();
            }
          }

          // Update Final Calculation
          function updateFinalTotal() {
          const finalTotal = existingRoomCost + newRoomCost;

          // Update breakdown card
          document.getElementById('room_total_amount').textContent = finalTotal.toFixed(2);
          
          // Update hidden input for final room total
          document.getElementById('room_total_input').value = finalTotal.toFixed(2);

          const commissionRate = 0.12; // 12%
          const commission = finalTotal * commissionRate;
          const payable = finalTotal - commission;

          document.getElementById('commission_amount').textContent = commission.toFixed(2);
          document.getElementById('payable_amount').textContent = payable.toFixed(2);

          // ✅ NEW: Update hidden inputs for commission and payable
          document.getElementById('commission_input').value = commission.toFixed(2);
          document.getElementById('payable_input').value = payable.toFixed(2);
        }
          </script>

              <div class="line"></div>
              <div class="form-group row">
                  <label class="col-sm-6 form-control-label" style="color: #1E90FF;"><strong>Bathroom Quantity</strong></label>
                  <div class="col-sm-12">
                    <input type="number" class="form-control" name="bathroom_count" value="{{ old('bathroom_count', $listing->bathroom_count) }}" required>
                  </div>
                </div>

              <div class="line"></div>

              <!-- Add New Additional -->
              <div class="form-group">
                <label class="form-control-label" style="color: #1E90FF;"><strong>Additionals</strong></label>

                <div class="row g-2 align-items-center mb-2">
                  <div class="col-md-3">
                    <label class="form-label mb-1">Type</label>
                    <select class="form-control" id="additional_type" onchange="togglePriceInput()">
                      <option value="" disabled selected>Select Type</option>
                      <option value="Amenity">Amenity</option>
                      <option value="Service">Service</option>
                    </select>
                  </div>

                  <div class="col-md-3">
                    <label class="form-label mb-1">Item Name</label>
                    <input type="text" class="form-control" id="additional_item" placeholder="Enter item name">
                  </div>

                  <div class="col-md-2">
                    <label class="form-label mb-1">Price (₱)</label>
                    <input type="number" class="form-control" id="additional_price" placeholder="Enter price" disabled>
                  </div>

                  <div class="col-md-3">
                    <label class="form-label mb-1">Photo</label>
                    <input type="file" id="additional_image" accept="image/*">
                  </div>

                  <div class="col-md-1 d-flex align-items-end">
                    <button type="button" class="btn btn-info w-100" onclick="addAdditional()">Add</button>
                  </div>
                </div>
              </div>
            <!-- Hidden Inputs for New Additionals -->
            <div id="additionals_inputs"></div>

            <!-- List of Additionals (Existing and New) -->
            <div class="form-group">
            <label class="form-control-label" style="color: #1E90FF;"><strong>Existing Additionals</strong></label>
            <div class="row">
              <!-- Amenity Column -->
              <div class="col-md-6">
              <h5 class="text-info">Amenities</h5>
              <div id="amenity_list" style="min-height: 150px;">
                @php $additionals = json_decode($listing->additionals, true); @endphp
                @if (!empty($additionals))
                  @foreach ($additionals as $index => $additional)
                    @if (($additional['type'] ?? '') == 'Amenity')
                      <div class="border p-2 rounded mb-2" id="additional_existing_{{ $index }}">
                        <div class="d-flex justify-content-between align-items-center">
                          <div>
                            <strong>{{ $additional['type'] }}</strong>: {{ $additional['item'] }}<br>
                            Included
                            @if (!empty($additional['image']))
                              <br><img src="{{ asset('listing/' . $additional['image']) }}" style="height: 60px; margin-top:5px;">
                            @endif
                          </div>
                          <div class="text-end">
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeExistingAdditional({{ $index }})">Remove</button>
                          </div>
                        </div>
                        <input type="hidden" name="existing_additionals[{{ $index }}]" value="{{ base64_encode(json_encode($additional)) }}">
                      </div>
                    @endif
                  @endforeach
                @endif
              </div>
            </div>
              <!-- Service Column -->
              <div class="col-md-6">
                <h5 class="text-info">Services</h5>
                <div id="service_list" style="min-height: 150px;">
                  @if (!empty($additionals))
                    @foreach ($additionals as $index => $additional)
                      @if (($additional['type'] ?? '') == 'Service')
                        <div class="border p-2 rounded mb-2" id="additional_existing_{{ $index }}">
                          <div class="d-flex justify-content-between align-items-center">
                            <div>
                              <strong>{{ $additional['type'] }}</strong>: {{ $additional['item'] }} @ ₱{{ number_format($additional['price'], 2) }}
                              @if (!empty($additional['image']))
                                <br><img src="{{ asset('listing/' . $additional['image']) }}" style="height: 60px; margin-top:5px;">
                              @endif
                            </div>
                            <div class="text-end">
                              <button type="button" class="btn btn-danger btn-sm" onclick="removeExistingAdditional({{ $index }})">Remove</button>
                            </div>
                          </div>
                          <input type="hidden" name="existing_additionals[{{ $index }}]" value="{{ base64_encode(json_encode($additional)) }}">
                        </div>
                      @endif
                    @endforeach
                  @endif
                </div>
              </div>
            </div>

          <script>
          let additionalCount = 1000; // Start high to avoid conflict

          function togglePriceInput() {
            const type = document.getElementById('additional_type').value;
            const priceInput = document.getElementById('additional_price');
            if (type === 'Amenity') {
              priceInput.value = '';
              priceInput.disabled = true;
            } else if (type === 'Service') {
              priceInput.disabled = false;
            }
          }

          function addAdditional() {
            const type = document.getElementById('additional_type').value;
            const item = document.getElementById('additional_item').value.trim();
            const price = parseFloat(document.getElementById('additional_price').value);
            const imageInput = document.getElementById('additional_image');
            const imageFile = imageInput.files[0];

            if (!type || !item) {
              alert('Please fill out all fields.');
              return;
            }

            if (type === 'Service' && (isNaN(price) || price <= 0)) {
              alert('Service must have a valid price.');
              return;
            }

            const displayPrice = (type === 'Service') ? `₱${price.toFixed(2)}` : 'Included';
            const listId = (type === 'Amenity') ? 'amenity_list' : 'service_list';
            const list = document.getElementById(listId);

            const newDiv = document.createElement('div');
            newDiv.className = "border p-2 rounded mb-2";
            newDiv.id = `additional_new_${additionalCount}`;

            if (imageFile) {
              const reader = new FileReader();
              reader.onload = function (e) {
                newDiv.innerHTML = `
                  <strong>${type}</strong>: ${item}<br>
                  ${displayPrice}<br>
                  <img src="${e.target.result}" style="height: 60px; margin-top:5px;"><br>
                  <button type="button" class="btn btn-danger btn-sm mt-2" onclick="removeNewAdditional(${additionalCount})">Remove</button>
                `;
                list.appendChild(newDiv);
              };
              reader.readAsDataURL(imageFile);
            } else {
             newDiv.innerHTML = `
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <strong>Added ${type}</strong>: ${item}<br>
                  ${displayPrice}
                </div>
                <div class="text-end">
                  <button type="button" class="btn btn-danger btn-sm mt-2" onclick="removeNewAdditional(${additionalCount})">Remove</button>
                </div>
              </div>
            `;
            list.appendChild(newDiv);
            }

            // Hidden Inputs for Form
            const inputs = document.getElementById('additionals_inputs');
            const inputSet = document.createElement('div');
            inputSet.id = `additional_inputs_${additionalCount}`;
            inputSet.innerHTML = `
              <input type="hidden" name="additionals[${additionalCount}][type]" value="${type}">
              <input type="hidden" name="additionals[${additionalCount}][item]" value="${item}">
              <input type="hidden" name="additionals[${additionalCount}][price]" value="${(type === 'Service') ? price : 0}">
            `;

            if (imageFile) {
              const clonedFile = imageInput.cloneNode();
              clonedFile.name = `additionals[${additionalCount}][image]`;
              clonedFile.style.display = 'none';
              const dt = new DataTransfer();
              dt.items.add(imageFile);
              clonedFile.files = dt.files;
              inputSet.appendChild(clonedFile);
            }

            inputs.appendChild(inputSet);

            // Reset fields
            document.getElementById('additional_type').value = "";
            document.getElementById('additional_item').value = "";
            document.getElementById('additional_price').value = "";
            document.getElementById('additional_price').disabled = true;
            document.getElementById('additional_image').value = "";

            additionalCount++;
          }

          function removeExistingAdditional(index) {
            const div = document.getElementById('additional_existing_' + index);
            if (div) div.remove();
          }

          function removeNewAdditional(index) {
            const div = document.getElementById('additional_new_' + index);
            const hidden = document.getElementById('additional_inputs_' + index);
            if (div) div.remove();
            if (hidden) hidden.remove();
          }
          </script>

                <div class="line"></div>

                <!-- Description -->
                <div class="form-group row">
                  <label class="col-sm-6 form-control-label" style="color: #1E90FF;"><strong>Description</strong></label>
                  <div class="col-sm-12">
                    <textarea class="form-control" name="description" required>{{ old('description', $listing->description) }}</textarea>
                  </div>
                </div>

                <div class="line"></div>

                <!-- Map Link -->
                <div class="form-group row">
                  <label class="col-sm-6 form-control-label" style="color: #1E90FF;"><strong>Google Map Link</strong></label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="map_link" value="{{ old('map_link', $listing->map_link) }}">
                  </div>
                </div>

                <div class="line"></div>

                <!-- Current Image -->
                <div class="form-group row">
                  <label class="col-sm-6 form-control-label" style="color: #1E90FF;"><strong>Current Property Image</strong></label>
                  <div class="col-sm-12">
                    <img src="{{ asset('listing/' . $listing->image) }}" style="height: 150px; width: auto;">
                  </div>
                </div>

                <div class="line"></div>

                <!-- Upload New Image -->
                <div class="form-group row">
                  <label class="col-sm-6 form-control-label" style="color: #1E90FF;"><strong>Upload New Image (Optional)</strong></label>
                  <div class="col-sm-12">
                    <input type="file" name="image" class="form-control" accept="image/*">
                  </div>
                </div>

                                        <!-- Tax Agreement Checkbox -->
                        <div class="form-group row mt-3">
                          <div class="col-sm-12">
                            <div style="display: flex; align-items: center;">
                              <input type="checkbox" id="tax_agreement" name="tax_agreement" style="width: 20px; height: 20px; margin-right: 10px;" required>
                              <label for="tax_agreement" style="margin: 0; font-weight: 500; color: #ffffff;">
                                I agree to the platform tax, fees, and commission terms.
                              </label>
                            </div>
                          </div>
                        </div>
                       <!-- Corrected Table -->
                        <div class="card bg-dark text-light mt-4" style="padding: 20px; border-radius: 10px;">
                          <h5 class="mb-3"><i class="fas fa-file-invoice-dollar"></i> Calculation Breakdown</h5>
                          <table style="width: 100%;">
                            <thead>
                              <tr style="border-bottom: 1px solid #555;">
                                <th style="text-align: left; padding-bottom: 10px;">Item</th>
                                <th style="text-align: right; padding-bottom: 10px;">Amount</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td style="padding: 8px 0;">Total Room Amount</td>
                                <td style="text-align: right;">₱<span id="room_total_amount">0.00</span></td> <!-- ✅ fix ID -->
                              </tr>
                              <tr>
                                <td style="padding: 8px 0;">Platform Commission (12%)</td>
                                <td style="text-align: right;">₱<span id="commission_amount">0.00</span></td>
                              </tr>
                              <tr style="border-top: 1px solid #555;">
                                <td style="padding: 8px 0;"><strong>Amount Payable to Owner</strong></td>
                                <td style="text-align: right;"><strong>₱<span id="payable_amount">0.00</span></strong></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                <input type="hidden" id="commission_input" name="commission_input" value="0">
                <input type="hidden" id="payable_input" name="payable_input" value="0">

                <div class="line"></div>

                <!-- Submit Button -->
                <div class="form-group row">
                  <div class="col-sm-12">
                    <a href="{{ url('view_listing') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                  </div>
                </div>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
    </section>

    </div>
</div>

@include('Dashboard.footer')
</body>
</html>
