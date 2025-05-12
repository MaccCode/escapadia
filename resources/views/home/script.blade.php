<script>
        // Elements
const loginBtn = document.getElementById('login-btn');
const loginModal = document.getElementById('login-modal');
const registerModal = document.getElementById('register-modal');
const openRegister = document.getElementById('open-register');
const openLogin = document.getElementById('open-login');
const closeModals = document.querySelectorAll('.close-modal');

        
        // Date Picker
        const datePickers = document.querySelectorAll('.date-picker');
        const dateModal = document.getElementById('date-modal');
        const closeDateModal = document.getElementById('close-date-modal');
        const saveDatesBtn = document.getElementById('save-dates');
        const clearDatesBtn = document.getElementById('clear-dates');
        const startDateDisplay = document.getElementById('start-date');
        const endDateDisplay = document.getElementById('end-date');
        
        let currentPicker = null;
        let startDate = null;
        let endDate = null;
        
        datePickers.forEach(picker => {
    // Prevent guest select from opening date modal
    if (!picker.closest('.guest-select')) {
        picker.addEventListener('click', (e) => {
            currentPicker = e.currentTarget;
            dateModal.classList.remove('hidden');
        });
    }
});
        
        closeDateModal.addEventListener('click', () => {
            dateModal.classList.add('hidden');
        });
        
        saveDatesBtn.addEventListener('click', () => {
            if (startDate && endDate) {
                startDateDisplay.textContent = formatDate(startDate);
                endDateDisplay.textContent = formatDate(endDate);
                dateModal.classList.add('hidden');
            }
        });
        
        clearDatesBtn.addEventListener('click', () => {
            startDate = null;
            endDate = null;
            startDateDisplay.textContent = 'Add dates';
            endDateDisplay.textContent = 'Add dates';
            dateModal.classList.add('hidden');
        });
        
        // Simulate date selection (in a real app, you'd implement proper date selection)
        function formatDate(date) {
            const options = { month: 'short', day: 'numeric' };
            return date.toLocaleDateString('en-US', options);
        }
        
        // Set sample dates
        startDate = new Date(2023, 9, 15); // October 15, 2023
        endDate = new Date(2023, 9, 18);   // October 18, 2023
        function confirmBooking() {
    // You can send a request here or show a success message
    alert("Your booking has been confirmed!");
    // Optionally close the modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('bookingModal'));
    modal.hide();
}
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const nightlyPrice = parseFloat(document.getElementById('nightly_price').value);
    const startInput = document.getElementById('start_date');
    const endInput = document.getElementById('end_date');
    const priceInput = document.getElementById('total_price_input');
    const commissionInput = document.getElementById('commission_input');
    const payableInput = document.getElementById('payable_input');
    const display = document.getElementById('total_price_display');

    function updatePrice() {
        const startDate = new Date(startInput.value);
        const endDate = new Date(endInput.value);

        if (!isNaN(startDate.getTime()) && !isNaN(endDate.getTime()) && endDate >= startDate) {
            let nights = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24));
            if (nights === 0) nights = 1; // Minimum 1 night

            const total = nightlyPrice * nights;
            const commission = total * 0.12;
            const payable = total - commission;

            priceInput.value = total.toFixed(2);
            commissionInput.value = commission.toFixed(2);
            payableInput.value = payable.toFixed(2);

            display.textContent = "₱" + total.toLocaleString('en-PH', { minimumFractionDigits: 2 });
        } else {
            priceInput.value = "0";
            commissionInput.value = "0";
            payableInput.value = "0";
            display.textContent = "₱0.00";
        }
    }

    startInput.addEventListener('change', updatePrice);
    endInput.addEventListener('change', updatePrice);
});
</script>
@if (session('error'))
  <script>
    Swal.fire({
      icon: 'error',
      title: 'Booking Conflict',
      html: `
        Your selected dates <strong>{{ session('start_date') }}</strong> to <strong>{{ session('end_date') }}</strong> are already booked.<br><br>
        <strong>Suggested next available start date:</strong> {{ session('suggested_start') }}
      `,
      confirmButtonColor: '#3085d6'
    });
  </script>
@endif
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>



