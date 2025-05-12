<!-- Floating Chat Button -->
<button id="chat-toggle" class="fixed bottom-5 right-5 bg-rose-500 text-white p-3 rounded-full shadow-lg hover:bg-rose-600 transition">
  <i class="fas fa-comment-dots text-xl"></i>
</button>

<!-- Chatbot Container -->
<div id="chatbot-wrapper" class="fixed bottom-5 right-5 bg-white shadow-lg rounded-lg overflow-hidden flex flex-col w-[350px] h-[500px] hidden">

  <!-- Header -->
  <div class="bg-rose-500 text-white p-4 flex items-center">
    <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center mr-3">
      <i class="fas fa-robot text-rose-500 text-xl"></i>
    </div>
    <div>
      <h1 class="font-bold text-lg">Escapadia FAQ Assistant</h1>
      <p class="text-xs opacity-80">How can I help you?</p>
    </div>
    <button id="close-chat" class="ml-auto text-white opacity-70 hover:opacity-100">
      <i class="fas fa-times"></i>
    </button>
  </div>

  <!-- FAQ Chat Content -->
  <div class="chat-container overflow-y-auto p-4 flex-1" id="chat-container">
    <!-- Welcome Message -->
    <div class="message-animation mb-4 flex">
      <div class="w-8 h-8 rounded-full bg-rose-100 flex items-center justify-center mr-2 flex-shrink-0">
        <i class="fas fa-robot text-rose-500 text-sm"></i>
      </div>
      <div class="bg-gray-100 rounded-lg p-3 max-w-[80%]">
        <p class="text-gray-800">Hi there! 👋 I can answer your common questions. Please select a topic below:</p>
      </div>
    </div>

    <!-- FAQ Buttons -->
    <div class="message-animation mb-4">
      <div class="flex flex-wrap gap-2 ml-10">
        <button class="quick-question bg-gray-200 hover:bg-gray-300 text-gray-800 text-xs px-3 py-1 rounded-full transition">What's check-in time?</button>
        <button class="quick-question bg-gray-200 hover:bg-gray-300 text-gray-800 text-xs px-3 py-1 rounded-full transition">What's check-out time?</button>
        <button class="quick-question bg-gray-200 hover:bg-gray-300 text-gray-800 text-xs px-3 py-1 rounded-full transition">Nearby restaurants</button>
        <button class="quick-question bg-gray-200 hover:bg-gray-300 text-gray-800 text-xs px-3 py-1 rounded-full transition">Extend my stay</button>
        <button class="quick-question bg-gray-200 hover:bg-gray-300 text-gray-800 text-xs px-3 py-1 rounded-full transition">House rules</button>
        <button class="quick-question bg-gray-200 hover:bg-gray-300 text-gray-800 text-xs px-3 py-1 rounded-full transition">Wifi information</button>
        <button class="quick-question bg-gray-200 hover:bg-gray-300 text-gray-800 text-xs px-3 py-1 rounded-full transition">Pet policy</button>
        <button class="quick-question bg-gray-200 hover:bg-gray-300 text-gray-800 text-xs px-3 py-1 rounded-full transition">Parking information</button>
        <button class="quick-question bg-gray-200 hover:bg-gray-300 text-gray-800 text-xs px-3 py-1 rounded-full transition">Cancellation policy</button>
        <button class="quick-question bg-gray-200 hover:bg-gray-300 text-gray-800 text-xs px-3 py-1 rounded-full transition">How to contact host</button>
      </div>
    </div>
  </div>

</div>

<!-- JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
      const chatWrapper = document.getElementById('chatbot-wrapper');
      const chatToggle = document.getElementById('chat-toggle');
      const closeButton = document.getElementById('close-chat');
      const chatContainer = document.getElementById('chat-container');
      const quickQuestions = document.querySelectorAll('.quick-question');
    
      // Minimize/Expand Logic
      closeButton.addEventListener('click', function() {
        chatWrapper.classList.add('hidden');
        chatToggle.classList.remove('hidden');
      });
    
      chatToggle.addEventListener('click', function() {
        chatWrapper.classList.remove('hidden');
        chatToggle.classList.add('hidden');
      });
    
      // Predefined FAQ Answers
      const sampleResponses = {
        "what's check-in time?": "🕒 Standard check-in time is 2:00 PM or 12:00 noon. Early check-in might be available upon request!",
        "what's check-out time?": "🕚 Standard check-out time is 11:00 AM. Late check-out can sometimes be arranged.",
        "extend my stay": "📅 To extend your stay, please request through your booking page or contact our support.",
        "house rules": "🏠 Common house rules:<br>• No smoking<br>• No parties/events<br>• Quiet hours: 10PM - 8AM",
        "wifi information": "📶 Wifi name and password are available in your booking confirmation or at check-in.",
        "pet policy": "🐾 Pets are generally not allowed unless specifically mentioned in the listing.",
        "parking information": "🚗 Free onsite parking is available. Details are provided before check-in.",
        "cancellation policy": "📝 Free cancellation within 48 hours after booking. Conditions apply after that.",
        "how to contact host": "📩 You can message your host directly through the Escapadia platform anytime!"
      };
    
      // Function to add message
      function addMessage(content, isUser = false) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `message-animation mb-4 flex ${isUser ? 'justify-end' : ''}`;
    
        if (isUser) {
          messageDiv.innerHTML = `
            <div class="bg-rose-500 text-white rounded-lg p-3 max-w-[80%]">
              ${content}
            </div>
            <div class="w-8 h-8 rounded-full bg-rose-100 flex items-center justify-center ml-2 flex-shrink-0">
              <i class="fas fa-user text-rose-500 text-sm"></i>
            </div>
          `;
        } else {
          messageDiv.innerHTML = `
            <div class="w-8 h-8 rounded-full bg-rose-100 flex items-center justify-center mr-2 flex-shrink-0">
              <i class="fas fa-robot text-rose-500 text-sm"></i>
            </div>
            <div class="bg-gray-100 rounded-lg p-3 max-w-[80%]">
              ${content}
            </div>
          `;
        }
    
        chatContainer.appendChild(messageDiv);
        chatContainer.scrollTop = chatContainer.scrollHeight;
      }
    
      // Click FAQ button
      quickQuestions.forEach(button => {
        button.addEventListener('click', function() {
          const questionText = this.textContent.trim();
          const questionKey = questionText.toLowerCase();
          const reply = sampleResponses[questionKey] || "🤖 Sorry, I don't have an answer for that yet.";
    
          // First show user's question
          addMessage(questionText, true);
    
          // Then bot reply after short delay
          setTimeout(() => {
            addMessage(reply, false);
          }, 500);
        });
      });
    
    });
    </script>
