<!DOCTYPE html>
<html>
  <head> 
    @include('Dashboard.head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  </head>
  <body>
    @include('Dashboard.header')
    <div class="d-flex align-items-stretch">
        @include('Dashboard.sidebar')
        <div class="page-content">
        <!-- Page Header-->
        <div class="page-header no-margin-bottom">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">View Listings</h2>
          </div>
        </div>
        <!-- Breadcrumb-->
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Listing</a></li>
            <li class="breadcrumb-item active">Information            </li>
          </ul>
        </div>
        <section class="no-padding-top">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-12">
                <div class="block">
                  <div class="title mb-3"><strong style="color: #1E90FF;">Property</strong></div>

                  <div class="row">
                  @foreach ($data as $listing)
                      @if (Auth::user()->id == $listing->user_id)

                          @php
                              $rooms = json_decode($listing->rooms, true) ?? []; // decode inside foreach
                              $additionals = json_decode($listing->additionals, true) ?? [];
                          @endphp

                         <div class="col-md-4 mb-4">
                        <div style="background-color: #212529; color: #f8f9fa; box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.5); border-radius: 15px; overflow: hidden; transition: 0.3s; transform: scale(1);" 
                            onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 1rem 2rem rgba(0,0,0,0.7)';" 
                            onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 0.5rem 1rem rgba(0,0,0,0.5)';">

                            <!-- Property Image -->
                            <div style="position: relative;">
                                <img src="/listing/{{ $listing->image }}" 
                                    alt="{{ $listing->title }}" 
                                    style="width: 100%; height: 220px; object-fit: cover;">
                                <span style="position: absolute; top: 0; right: 0; margin: 8px; background-color: #0d6efd; color: white; padding: 2px 8px; border-radius: 5px; font-size: 12px;">
                                    ID: {{ $listing->id }}
                                </span>
                            </div>

                            <!-- Card Body -->
                            <div style="padding: 20px; min-height: 300px; display: flex; flex-direction: column; justify-content: space-between;">

                                <!-- Title and Address -->
                                <div>
                                    <h5 style="font-weight: bold; margin-bottom: 8px;">{{ $listing->title }}</h5>
                                    <p style="color: #adb5bd; font-size: 14px; margin-bottom: 16px;">
                                        <i class="fas fa-map-marker-alt" style="margin-right: 6px;"></i>{{ $listing->address }}
                                    </p>

                                    <!-- Room Details -->
                                    @if (!empty($rooms))
                                        @foreach ($rooms as $info)
                                            <p style="color: #ced4da; font-size: 14px; margin-bottom: 4px;">
                                                • {{ $info['type'] ?? 'Unknown' }} - {{ $info['quantity'] ?? 0 }} room(s) @ ₱{{ number_format($info['price'] ?? 0, 2) }}
                                            </p>
                                        @endforeach
                                    @else
                                        <p style="color: #ced4da; font-size: 14px;">No room information.</p>
                                    @endif
                                    @foreach ($additionals as $info)
                                    
                                    @endforeach
                                </div>

                                <!-- Price Section -->
                                <div style="margin-top: 12px;">
                                    <h5 style="font-weight: bold; color: #f8f9fa; margin-bottom: 0;">
                                        ₱{{ number_format($listing->room_total_price ?? 0, 2) }}
                                        <small style="color: #adb5bd;">/ Night</small>
                                    </h5>
                                </div>

                                <!-- Action Buttons -->
                                <div style="margin-top: 20px; display: flex; gap: 10px;">
                                    <a href="{{ url('listing_update', $listing->id) }}" 
                                      style="flex: 1; text-align: center; background-color: transparent; color: #0d6efd; border: 1px solid #0d6efd; padding: 6px 0; border-radius: 5px; text-decoration: none; font-size: 14px;">
                                      <i class="fas fa-edit"></i> Update
                                    </a>

                                    <form action="{{ url('listing_delete', $listing->id) }}" method="Get" 
                                          onsubmit="return confirm('Are you sure you want to delete this listing?');" 
                                          style="flex: 1;">
                                        @csrf
                                        <button type="submit" 
                                                style="width: 100%; background-color: transparent; color: #dc3545; border: 1px solid #dc3545; padding: 6px 0; border-radius: 5px; font-size: 14px;">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>

                      @endif
                  @endforeach
                  </div>

                </div>
              </div>
            </div>
          </div>
        </section>
        </div>
        </div>   
       @include ('Dashboard.footer')
  </body>
</html>