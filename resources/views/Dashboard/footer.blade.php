       <footer class="footer">
          <div class="footer block block no-margin-bottom">
            <div class="container-fluid text-center">
               <p class="no-margin-bottom">2025 &copy; Escapedia</p>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="js/charts-custom.js"></script>
    <script src="js/front.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteModal = document.getElementById('confirmDeleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const listingId = button.getAttribute('data-id');
        const form = deleteModal.querySelector('#deleteForm');
        form.action = '/listing_delete/' + listingId;
    });
});
</script>
<script>
  $('#confirmApproveModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var bookingID = button.data('id');
    var form = $('#deleteForm');
    form.attr('action', '/booking_approve/' + bookingID);
  });
</script>
<script>
  $('#confirmApproveModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var bookingID = button.data('id');
    var form = $('#deleteForm');
    form.attr('action', '/booking_approve/' + bookingID);
  });
</script>
<script>
    // When delete button is clicked, save scroll position
    document.querySelectorAll(".btn-action").forEach(button => {
        button.addEventListener('click', function () {
            localStorage.setItem('scrollPosition', window.scrollY);
        });
    });

    // When page loads, restore scroll position (if available)
    window.addEventListener('load', function () {
        const scrollPos = localStorage.getItem('scrollPosition');
        if (scrollPos) {
            window.scrollTo(0, parseInt(scrollPos));
            localStorage.removeItem('scrollPosition'); // clear after use
        }
    });
</script>
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

