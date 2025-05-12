<!DOCTYPE html>
<html>
  <head> 
    @include('Dashboard.head')
  </head>
  <body>
    @include('Dashboard.header')
    <div class="d-flex align-items-stretch">
        @include('Dashboard.sidebar')
        <div class="page-content">
        <!-- Page Header-->
        <div class="page-header no-margin-bottom">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">List Property</h2>
          </div>
        </div>
        <!-- Breadcrumb-->
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="" style="color: #1E90FF;">Property</a></li>
            <li class="breadcrumb-item active">Informations</li>
          </ul>
        </div>
        <section class="no-padding-top">
          <div class="container-fluid">
            <div class="row">
              <!-- Form Elements -->
              <div class="col-lg-12">
                <div class="block">
                  <div class="title"><strong style="color: #1E90FF;">All Informations</strong></div>
                  <div class="block-body">
                    <form class="form-horizontal" action="{{ url('add_listing') }}" method="POST" enctype="multipart/form-data">
                      @csrf    
                      <div class="form-group row">
                        <label class="col-sm-6 form-control-label" style="color: #1E90FF;"><strong>Business Name/Property Name</strong></label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" name="title" placeholder="Enter name/title" required>
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-sm-6 form-control-label" style="color: #1E90FF;"><strong>Select Property Type</strong></label>
                        <div class="col-sm-12">
                        <select name="property_type" class="form-control" id="property_type" required>
                            <option value="" disabled selected>Select Property Type</option>
                            <option value="Beach Resorts">Beach Resorts</option>
                            <option value="Private Villas">Private Villas</option>
                            <option value="Nature Retreats">Nature Retreats</option>
                            <option value="Lakeside">Lakeside</option>
                            <option value="Camping">Camping</option>
                            <option value="Pool Villas">Pool Villas</option>
                            <option value="Other">Other</option> <!-- ✅ Corrected: added value="Other" -->
                        </select>
                        <input type="text" id="other_property_type" name="other_property_type" class="form-control mt-2" placeholder="Please specify..." style="display: none;" />

                      <script>
                        document.getElementById('property_type').addEventListener('change', function () {
                          var otherInput = document.getElementById('other_property_type');
                          if (this.value === 'Other') {
                            otherInput.style.display = 'block';
                            otherInput.required = true;
                          } else {
                            otherInput.style.display = 'none';
                            otherInput.required = false;
                            otherInput.value = '';
                          }
                        });
                      </script>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-6 form-control-label" style="color: #1E90FF;"><strong>Address</strong></label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" name ="address" placeholder="Enter address/location" required>
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-sm-6 form-control-label" style="color: #1E90FF;"><strong>Maximum Guest Count</strong></label>
                        <div class="col-sm-12">
                          <input type="number" class="form-control" name="guest_max" placeholder="Enter guest maximum amount" required>
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

                        <div class="mt-2 text-end">
                          <strong>Total: ₱<span name="room_total_price" id="room_total_price">0</span></strong>
                        </div>
                      </div>

                      <!-- Hidden form fields for Laravel -->
                      <div id="room_inputs"></div>

                      <!-- Hidden inputs inside your <form> -->
                      <input type="hidden" id="room_total_input" name="room_total_input" value="0">
                      <input type="hidden" id="commission_input" name="commission_input" value="0">
                      <input type="hidden" id="payable_input" name="payable_input" value="0">

                      <script>
                      let roomCount = 0;
                      let totalRoomCost = 0;

                      function addRoomType() {
                          const type = document.getElementById('room_type').value;
                          const quantity = parseInt(document.getElementById('room_quantity').value);
                          const price = parseFloat(document.getElementById('room_price').value);
                          const imageInput = document.getElementById('room_image');
                          const imageFile = imageInput.files[0];

                          if (!type || !quantity || !price || !imageFile || quantity <= 0 || price <= 0) {
                              alert("Please fill out all fields and upload a photo.");
                              return;
                          }

                          const total = quantity * price;
                          totalRoomCost += total;
                          document.getElementById('room_total_price').textContent = totalRoomCost.toFixed(2);
                          calculateBreakdown();

                          roomCount++;

                          const reader = new FileReader();
                          reader.onload = function (e) {
                              const list = document.getElementById('room_list');
                              const entryDiv = document.createElement('div');
                              entryDiv.className = "d-flex justify-content-between align-items-center border p-2 rounded mb-2";
                              entryDiv.id = `room_entry_${roomCount}`;
                              entryDiv.innerHTML = `
                                  <div>
                                      <strong>${type}</strong><br>
                                      ${quantity} room(s) @ ₱${price.toFixed(2)} each<br>
                                      <strong>Total: ₱${total.toFixed(2)}</strong><br>
                                      <img src="${e.target.result}" style="height: 60px; width: auto; margin-top: 5px;">
                                  </div>
                                  <button class="btn btn-danger btn-sm" onclick="removeRoomType(${roomCount}, ${total})">Remove</button>
                              `;
                              list.appendChild(entryDiv);
                          };
                          reader.readAsDataURL(imageFile);

                          // Hidden inputs for backend
                          const inputs = document.getElementById('room_inputs');
                          const inputSet = document.createElement('div');
                          inputSet.id = `room_inputs_${roomCount}`;
                          inputSet.innerHTML = `
                              <input type="hidden" name="rooms[${roomCount}][type]" value="${type}">
                              <input type="hidden" name="rooms[${roomCount}][quantity]" value="${quantity}">
                              <input type="hidden" name="rooms[${roomCount}][price]" value="${price}">
                          `;

                          const clonedFile = imageInput.cloneNode();
                          clonedFile.name = `rooms[${roomCount}][image]`;
                          clonedFile.style.display = 'none';
                          const dt = new DataTransfer();
                          dt.items.add(imageFile);
                          clonedFile.files = dt.files;
                          inputSet.appendChild(clonedFile);
                          inputs.appendChild(inputSet);

                          // Reset fields
                          document.getElementById('room_type').value = "";
                          document.getElementById('room_quantity').value = "";
                          document.getElementById('room_price').value = "";
                          document.getElementById('room_image').value = "";
                      }

                      function removeRoomType(id, amount) {
                          totalRoomCost -= amount;
                          document.getElementById('room_total_price').textContent = totalRoomCost.toFixed(2);
                          calculateBreakdown();
                          document.getElementById(`room_entry_${id}`).remove();
                          document.getElementById(`room_inputs_${id}`).remove();
                      }

                      // Calculates the totals + updates hidden inputs for backend
                      function calculateBreakdown() {
                          const roomTotal = parseFloat(document.getElementById('room_total_price')?.textContent || 0);
                          const commissionRate = 0.12; // 12%
                          const commission = roomTotal * commissionRate;
                          const payable = roomTotal - commission;

                          document.getElementById('room_total_amount').textContent = roomTotal.toFixed(2);
                          document.getElementById('commission_amount').textContent = commission.toFixed(2);
                          document.getElementById('payable_amount').textContent = payable.toFixed(2);

                          // Update the hidden inputs
                         document.getElementById('room_total_input').value = roomTotal.toFixed(2);
                        document.getElementById('commission_input').value = commission.toFixed(2);
                        document.getElementById('payable_input').value = payable.toFixed(2);
                      }

                      // Recalculate on page load (example if editing a listing later)
                      window.onload = function() {
                          calculateBreakdown();
                      };
                      </script>


                    <div class="line"></div>
                  <div class="form-group row">
                      <label class="col-sm-6 form-control-label" style="color: #1E90FF;"><strong>Bathroom Quantity</strong></label>
                      <div class="col-sm-12">
                        <input type="number" class="form-control" name="bathroom_count" required>
                      </div>
                    </div>

                   <div class="line"></div>
                    <div class="form-group">
                      <label class="form-control-label" style="color: #1E90FF;"><strong>Additionals</strong></label>

                      <div class="row g-2 align-items-center mb-2">
                        <div class="col-md-3">
                          <label for="additional_type" class="form-label mb-1">Type</label>
                          <select class="form-control" id="additional_type" onchange="togglePriceInput()">
                            <option value="" disabled selected>Select Type</option>
                            <option value="Amenity">Amenity</option>
                            <option value="Service">Service</option>
                          </select>
                        </div>

                        <div class="col-md-3">
                          <label for="additional_item" class="form-label mb-1">Item Name</label>
                          <input type="text" class="form-control" id="additional_item" placeholder="Enter item name">
                        </div>

                        <div class="col-md-2">
                          <label for="additional_price" class="form-label mb-1">Price (₱)</label>
                          <input type="number" class="form-control" id="additional_price" placeholder="Enter price" disabled>
                        </div>

                        <div class="col-md-3">
                          <label for="additional_image" class="form-label mb-1">Photo</label>
                          <input type="file" id="additional_image" accept="image/*">
                        </div>

                        <div class="col-md-1 d-flex align-items-end">
                          <button type="button" class="btn btn-info w-100" onclick="addAdditional()">Add</button>
                        </div>
                      </div>

                      <div id="additionals_list" class="mt-2"></div>
                    </div>

                    <!-- Hidden form fields for backend -->
                    <div id="additionals_inputs"></div>

                  <script>
                  let additionalCount = 0;
                  let totalAdditionalPrice = 0;

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
                    const priceInput = document.getElementById('additional_price');
                    const price = parseFloat(priceInput.value);
                    const imageInput = document.getElementById('additional_image');
                    const imageFile = imageInput.files[0];

                    if (!type || !item) {
                      alert('Please complete all required fields.');
                      return;
                    }

                    // For Service, price and image are required
                    if (type === 'Service') {
                      if (isNaN(price) || price <= 0 || !imageFile) {
                        alert('For services, you must enter a valid price and upload a photo.');
                        return;
                      }
                    }

                    // For Amenity, no price needed, and image is optional
                    let subtotal = (type === 'Service') ? price : 0;
                    let displayPrice = (type === 'Service') ? `₱${price}` : 'Included';
                    totalAdditionalPrice += subtotal;

                    additionalCount++;

                    const reader = new FileReader();
                    reader.onload = function (e) {
                      const list = document.getElementById('additionals_list');
                      const entry = document.createElement('div');
                      entry.className = "d-flex justify-content-between align-items-center border p-2 rounded mb-2";
                      entry.id = `additional_entry_${additionalCount}`;
                      entry.innerHTML = `
                        <div>
                          <strong>${type}</strong>: ${item}<br>
                          ${displayPrice}<br>
                          ${imageFile ? `<img src="${e.target.result}" style="height: 60px; margin-top: 5px;">` : ''}
                        </div>
                        <button type="button" class="btn btn-danger btn-sm" onclick="removeAdditional(${additionalCount}, ${subtotal})">Remove</button>
                      `;
                      list.appendChild(entry);
                    };

                    if (imageFile) {
                      reader.readAsDataURL(imageFile);
                    } else {
                      // If no image, still create an empty preview
                      const list = document.getElementById('additionals_list');
                      const entry = document.createElement('div');
                      entry.className = "d-flex justify-content-between align-items-center border p-2 rounded mb-2";
                      entry.id = `additional_entry_${additionalCount}`;
                      entry.innerHTML = `
                        <div>
                          <strong>${type}</strong>: ${item}<br>
                          ${displayPrice}<br>
                        </div>
                        <button type="button" class="btn btn-danger btn-sm" onclick="removeAdditional(${additionalCount}, ${subtotal})">Remove</button>
                      `;
                      list.appendChild(entry);
                    }

                    // Create hidden inputs
                    const hiddenInputs = document.createElement('div');
                    hiddenInputs.id = `additional_inputs_${additionalCount}`;
                    hiddenInputs.innerHTML = `
                      <input type="hidden" name="additionals[${additionalCount}][type]" value="${type}">
                      <input type="hidden" name="additionals[${additionalCount}][item]" value="${item}">
                      <input type="hidden" name="additionals[${additionalCount}][price]" value="${subtotal}">
                    `;

                    if (imageFile) {
                      const clonedFile = imageInput.cloneNode();
                      clonedFile.name = `additionals[${additionalCount}][image]`;
                      clonedFile.style.display = 'none';

                      const dt = new DataTransfer();
                      dt.items.add(imageFile);
                      clonedFile.files = dt.files;

                      hiddenInputs.appendChild(clonedFile);
                    }

                    document.getElementById('additionals_inputs').appendChild(hiddenInputs);

                    // Reset fields
                    document.getElementById('additional_type').value = "";
                    document.getElementById('additional_item').value = '';
                    priceInput.value = '';
                    priceInput.disabled = true;
                    document.getElementById('additional_image').value = '';
                  }

                  function removeAdditional(id, price) {
                    totalAdditionalPrice -= price;

                    const entry = document.getElementById(`additional_entry_${id}`);
                    const hidden = document.getElementById(`additional_inputs_${id}`);

                    if (entry) entry.remove();
                    if (hidden) hidden.remove();
                  }
                  </script>

                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-sm-6 form-control-label" style="color: #1E90FF;"><strong>Description</strong></label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" name="description" placeholder="Enter description" required>
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-sm-6 form-control-label" style="color: #1E90FF;"><strong>Map Link</strong></label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" name="map_link" placeholder="Enter Google map link if available/Embedded Format">
                        </div>
                      </div>
                      <div class="line"></div>
                      <div class="form-group row">
                        <label class="col-sm-6 form-control-label" style="color: #1E90FF;"><strong>Upload Image</strong></label>
                        <div class="col-sm-12">
                          <input type="file"  name="image" placeholder="Enter image file" accept="image/*" required>
                        </div>
                      </div>
                      <div class="line"></div>
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
                      <div class="form-group row">
                        <div class="col-sm-12 ml-auto">
                          <a href="dashboard" class="btn btn-secondary">Cancel</a>
                          <button type="submit" class="btn btn-success">Confirm</button>
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
      <!-- Success Modal -->
      <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title" id="successModalLabel">Success</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            {{ session('message') }}
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" data-bs-dismiss="modal">OK</button>
          </div>
        </div>
      </div>
      </div>
    @include ('Dashboard.footer')
  </body>
</html>