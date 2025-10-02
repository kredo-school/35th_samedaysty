<x-app-layout>
    <x-title>
        Chat
    </x-title>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Chat Header -->
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Messages</h3>
                        <button id="new-chat-btn"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                            <i class="fas fa-plus mr-2"></i>New Chat
                        </button>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                        <!-- Conversations List -->
                        <div class="lg:col-span-1">
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                <h4 class="font-medium text-gray-900 dark:text-white mb-4">Recent Conversations</h4>

                                <div id="conversations-list" class="space-y-2">
                                    @forelse($conversations as $conversation)
                                    @php
                                    $otherUser = $conversation->getOtherUser(auth()->id());
                                    @endphp
                                    <a href="{{ route('chat.conversation', $conversation->id) }}"
                                        class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                                        <div class="w-10 h-10 rounded-full overflow-hidden flex-shrink-0">
                                            @if($otherUser->avatar)
                                            <img src="{{ asset('storage/' . $otherUser->avatar) }}"
                                                alt="{{ $otherUser->name }}" class="w-full h-full object-cover">
                                            @else
                                            <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                                                <span class="text-gray-600 font-medium">{{ substr($otherUser->name, 0,
                                                    1) }}</span>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                                {{ $otherUser->name }}
                                            </p>
                                            @if ($conversation->last_message)
                                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
                                                {{ Str::limit($conversation->last_message, 30) }}
                                            </p>
                                            @endif
                                        </div>
                                        @if ($conversation->last_message_at)
                                        <span class="text-xs text-gray-400">
                                            {{ $conversation->last_message_at->diffForHumans() }}
                                        </span>
                                        @endif
                                    </a>
                                    @empty
                                    <p class="text-gray-500 dark:text-gray-400 text-sm text-center py-4">
                                        No conversations yet
                                    </p>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        <!-- Users List -->
                        <div class="lg:col-span-2">
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                <h4 class="font-medium text-gray-900 dark:text-white mb-4">Start a New Conversation</h4>

                                <div class="space-y-2">
                                    @forelse($users as $user)
                                    <div
                                        class="flex items-center justify-between p-3 bg-white dark:bg-gray-600 rounded-lg">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 rounded-full overflow-hidden flex-shrink-0">
                                                @if($user->avatar)
                                                <img src="{{ asset('storage/' . $user->avatar) }}"
                                                    alt="{{ $user->name }}" class="w-full h-full object-cover">
                                                @else
                                                <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                                                    <span class="text-gray-600 font-medium">{{ substr($user->name, 0, 1)
                                                        }}</span>
                                                </div>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-900 dark:text-white">
                                                    {{ $user->name }}</p>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $user->email }}</p>
                                            </div>
                                        </div>
                                        <button onclick="startConversation('{{ $user->id }}')"
                                            class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm transition-colors">
                                            Chat
                                        </button>
                                    </div>
                                    @empty
                                    <p class="text-gray-500 dark:text-gray-400 text-sm text-center py-4">
                                        No users available
                                    </p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- New Chat Modal -->
    <div id="new-chat-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white dark:bg-gray-800 rounded-lg max-w-md w-full p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">New Chat</h3>
                    <button onclick="closeNewChatModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Select User
                        </label>
                        <select id="new-chat-user"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Choose a user...</option>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex space-x-3">
                        <button onclick="startConversationFromModal()"
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md transition-colors">
                            Start Chat
                        </button>
                        <button onclick="closeNewChatModal()"
                            class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-700 py-2 px-4 rounded-md transition-colors">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Show new chat modal
        document.getElementById('new-chat-btn').addEventListener('click', function () {
            document.getElementById('new-chat-modal').classList.remove('hidden');
        });

        // Close new chat modal
        function closeNewChatModal() {
            document.getElementById('new-chat-modal').classList.add('hidden');
        }

        // Start conversation from user list
        function startConversation(userId) {
            fetch('/chat/start-conversation', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    user_id: userId
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.redirect_url) {
                        window.location.href = data.redirect_url;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to start conversation');
                });
        }

        // Start conversation from modal
        function startConversationFromModal() {
            const userId = document.getElementById('new-chat-user').value;
            if (!userId) {
                alert('Please select a user');
                return;
            }

            startConversation(userId);
        }

        // Close modal when clicking outside
        document.getElementById('new-chat-modal').addEventListener('click', function (e) {
            if (e.target === this) {
                closeNewChatModal();
            }
        });
    </script>
</x-app-layout>