<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('chat.index') }}"
                    class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                    <i class="fas fa-arrow-left text-xl"></i>
                </a>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('profile.show', $otherUser->id) }}" class="w-10 h-10 rounded-full overflow-hidden flex-shrink-0">
                        @if($otherUser->avatar)
                        <img src="{{ $otherUser->avatar }}"
                            alt="{{ $otherUser->name }}" class="w-full h-full object-cover">
                        @else
                        <div class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                            <span class="text-white text-lg font-bold">{{ strtoupper(substr($otherUser->name, 0, 1)) }}</span>
                        </div>
                        @endif
                    </a>
                    <div>
                        <a href="{{ route('profile.show', $otherUser->id) }}" class="hover:underline">
                            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                                {{ $otherUser->name }}
                            </h2>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-col h-[600px]">

                    <!-- Messages Area -->
                    <div id="messages-container" class="flex-1 overflow-y-auto p-6 space-y-4">
                        @foreach ($messages as $message)
                            <div class="flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}"
                                data-message-id="{{ $message->id }}">
                                <div class="max-w-xs lg:max-w-md">
                                    <div
                                        class="flex items-end space-x-2 {{ $message->sender_id === auth()->id() ? 'flex-row-reverse space-x-reverse' : '' }}">
                                        @if ($message->sender_id !== auth()->id())
                                            <div class="w-8 h-8 rounded-full overflow-hidden flex-shrink-0">
                                                @if($message->sender->avatar)
                                                <img src="{{ $message->sender->avatar }}"
                                                    alt="{{ $message->sender->name }}" class="w-full h-full object-cover">
                                                @else
                                                <div class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                                    <span class="text-white text-sm font-bold">{{ strtoupper(substr($message->sender->name, 0, 1)) }}</span>
                                                </div>
                                                @endif
                                            </div>
                                        @endif

                                        <div
                                            class="bg-{{ $message->sender_id === auth()->id() ? 'blue' : 'gray' }}-100 dark:bg-{{ $message->sender_id === auth()->id() ? 'blue' : 'gray' }}-700 rounded-lg px-4 py-2">
                                            <p class="text-sm text-gray-900 dark:text-gray-100 whitespace-pre-wrap">{!! nl2br(e($message->content)) !!}
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                {{ $message->formatted_time }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Message Input -->
                    <div class="border-t border-gray-200 dark:border-gray-700 p-4">
                        <form id="message-form" class="flex space-x-4 items-end">
                            <input type="hidden" id="conversation-id" value="{{ $conversation->id }}">
                            <div class="flex-1">
                                <textarea id="message-input" placeholder="Type your message... (Shift+Enter for new line)" rows="1"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white resize-none overflow-hidden"
                                    maxlength="1000"></textarea>
                            </div>
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors disabled:opacity-50 disabled:cursor-not-allowed flex-shrink-0">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        const conversationId = {{ $conversation->id }};
        const currentUserId = {{ auth()->id() }};
        const messagesContainer = document.getElementById('messages-container');
        const messageForm = document.getElementById('message-form');
        const messageInput = document.getElementById('message-input');

        // Track the last message ID to avoid duplicates
        let lastMessageId = {{ $messages->count() > 0 ? $messages->last()->id : 0 }};

        // Debug information
        console.log('Chat initialized:', {
            conversationId: conversationId,
            currentUserId: currentUserId,
            lastMessageId: lastMessageId,
            csrfToken: document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
        });

        // Scroll to bottom of messages
        function scrollToBottom() {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        // Scroll to bottom on page load
        scrollToBottom();

        // Prevent double submission
        let isSubmitting = false;

        // Handle message form submission
        messageForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Prevent double submission
            if (isSubmitting) {
                return;
            }

            const content = messageInput.value.trim();
            if (!content) return;

            // Set submitting flag
            isSubmitting = true;

            // Disable form while sending
            const submitBtn = messageForm.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

            // Send message
            fetch('/chat/send-message', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        conversation_id: conversationId,
                        content: content
                    })
                })
                .then(response => {
                    console.log('Response status:', response.status);
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Response data:', data);
                    if (data.message) {
                        // Add message to UI
                        addMessageToUI(data.message, true);
                        messageInput.value = '';
                        
                        // Reset textarea height
                        messageInput.style.height = 'auto';
                        
                        scrollToBottom();

                        // Update last message ID to prevent duplicate in polling
                        lastMessageId = Math.max(lastMessageId, data.message.id);
                    } else {
                        console.error('No message in response:', data);
                        alert('Failed to send message: Invalid response');
                    }
                })
                .catch(error => {
                    console.error('Error sending message:', error);
                    alert('Failed to send message: ' + error.message);
                })
                .finally(() => {
                    // Re-enable form
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i>';
                    isSubmitting = false;
                });
        });

        // Add message to UI
        function addMessageToUI(message, isOwnMessage = false) {
            // Check if message already exists to prevent duplicates
            const existingMessage = document.querySelector(`[data-message-id="${message.id}"]`);
            if (existingMessage) {
                return; // Message already exists, don't add again
            }

            const messageDiv = document.createElement('div');
            messageDiv.className = `flex ${isOwnMessage ? 'justify-end' : 'justify-start'}`;
            messageDiv.setAttribute('data-message-id', message.id);

            const messageContent = `
                <div class="max-w-xs lg:max-w-md">
                    <div class="flex items-end space-x-2 ${isOwnMessage ? 'flex-row-reverse space-x-reverse' : ''}">
                        ${!isOwnMessage ? `
                                                                <div class="w-8 h-8 rounded-full overflow-hidden flex-shrink-0">
                                                                    ${message.sender_avatar ? `
                                                                        <img src="${message.sender_avatar}" alt="${message.sender_name}" class="w-full h-full object-cover">
                                                                    ` : `
                                                                        <div class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                                                            <span class="text-white text-sm font-bold">${message.sender_name ? message.sender_name.charAt(0).toUpperCase() : 'U'}</span>
                                                                        </div>
                                                                    `}
                                                                </div>
                                                            ` : ''}
                        
                        <div class="bg-${isOwnMessage ? 'blue' : 'gray'}-100 dark:bg-${isOwnMessage ? 'blue' : 'gray'}-700 rounded-lg px-4 py-2">
                            <p class="text-sm text-gray-900 dark:text-gray-100 whitespace-pre-wrap">${message.content.replace(/\n/g, '<br>')}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                ${message.formatted_time || new Date().toLocaleTimeString('en-US', {hour: '2-digit', minute: '2-digit'})}
                            </p>
                        </div>
                    </div>
                </div>
            `;

            messageDiv.innerHTML = messageContent;
            messagesContainer.appendChild(messageDiv);
        }

        // Auto-resize textarea
        messageInput.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 120) + 'px';
        });

        // Focus on message input when page loads
        messageInput.focus();

        // Handle Enter and Shift+Enter keys
        messageInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                if (!e.shiftKey) {
                    // Enter without Shift: send message
                    e.preventDefault();
                    if (!isSubmitting) {
                        messageForm.dispatchEvent(new Event('submit'));
                    }
                }
                // Shift+Enter: allow default behavior (new line)
            }
        });



        // Simple polling for messages (fallback to basic functionality)
        setInterval(function() {
            fetch(`/chat/conversations/${conversationId}/messages?after=${lastMessageId}`)
                .then(response => response.json())
                .then(messages => {
                    const newMessages = messages.filter(message => message.id > lastMessageId);
                    if (newMessages.length > 0) {
                        newMessages.forEach(message => {
                            const isOwnMessage = message.sender_id === currentUserId;
                            if (!isOwnMessage) {
                                addMessageToUI(message, false);
                            }
                        });
                        lastMessageId = Math.max(...newMessages.map(m => m.id));
                        scrollToBottom();
                    }
                })
                .catch(error => console.error('Error polling messages:', error));
        }, 5000);
    </script>
</x-app-layout>
