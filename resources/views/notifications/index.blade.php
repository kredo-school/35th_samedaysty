<x-app-layout>
    <x-title>
        {{ __('Notifications') }}
    </x-title>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                        Your Notifications (Unread: {{ $unreadCount }})
                    </h3>

                    @if($notifications->isEmpty())
                    <p class="text-gray-600 dark:text-gray-400">You have no notifications.</p>
                    @else
                    <div class="mb-4">
                        <button id="mark-all-read-btn"
                            class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                            Mark All As Read
                        </button>
                    </div>

                    <ul class="divide-y divide-gray-200">
                        @foreach($notifications as $notification)
                        <li
                            class="py-4 {{ $notification->read ? 'bg-gray-50' : 'bg-blue-50' }} rounded-lg mb-2 p-3 shadow-sm">
                            <div class="flex items-start space-x-3">
                                <!-- User Avatar -->
                                @php
                                $data = $notification->data ?? [];
                                $actorId = null;
                                $actorAvatar = null;
                                $actorName = null;

                                // Determine actor based on notification type
                                if (isset($data['follower_id'])) {
                                $actorId = $data['follower_id'];
                                } elseif (isset($data['liker_id'])) {
                                $actorId = $data['liker_id'];
                                } elseif (isset($data['interested_user_id'])) {
                                $actorId = $data['interested_user_id'];
                                } elseif (isset($data['requester_id'])) {
                                $actorId = $data['requester_id'];
                                } elseif (isset($data['sender_id'])) {
                                $actorId = $data['sender_id'];
                                } elseif (isset($data['commenter_id'])) {
                                $actorId = $data['commenter_id'];
                                } elseif (in_array($notification->type, ['join_accepted', 'join_rejected'])) {
                                // For join acceptance/rejection, get the plan owner as the actor
                                if (isset($data['plan_id'])) {
                                $plan = \App\Models\TravelPlan::find($data['plan_id']);
                                $actorId = $plan ? $plan->user_id : null;
                                }
                                }

                                // Get actor details
                                if ($actorId) {
                                $actor = \App\Models\User::find($actorId);
                                if ($actor) {
                                $actorAvatar = $actor->avatar;
                                $actorName = $actor->name;
                                }
                                }
                                @endphp

                                <div class="w-10 h-10 rounded-full overflow-hidden flex-shrink-0">
                                    @if($actorAvatar)
                                    <img src="{{ $actorAvatar }}" alt="{{ $actorName ?? 'User' }}"
                                        class="w-full h-full object-cover">
                                    @else
                                    <div
                                        class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                        <i class="fas fa-bell text-white text-lg"></i>
                                    </div>
                                    @endif
                                </div>

                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900">{{ $notification->title }}</p>
                                    <p class="text-sm text-gray-600">{{ $notification->message }}</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ $notification->created_at->diffForHumans()
                                        }}</p>

                                    <!-- Links based on notification type -->
                                    @php
                                    $data = $notification->data ?? [];
                                    $linkUrl = null;
                                    $linkText = null;

                                    switch($notification->type) {
                                    case 'plan_liked':
                                    case 'plan_interested':
                                    case 'plan_comment':
                                    case 'join_request':
                                    case 'join_accepted':
                                    case 'join_rejected':
                                    case 'group_chat_owner':
                                    case 'group_chat_participant':
                                    if (isset($data['plan_id'])) {
                                    $linkUrl = route('plan.show', $data['plan_id']);
                                    $linkText = 'View Plan';
                                    }
                                    break;
                                    case 'chat_message':
                                    if (isset($data['conversation_id'])) {
                                    $linkUrl = route('chat.index') . '?conversation=' . $data['conversation_id'];
                                    $linkText = 'Open Chat';
                                    }
                                    break;
                                    case 'follow_request':
                                    case 'follow_accepted':
                                    if (isset($data['follower_id'])) {
                                    $linkUrl = route('profile.show', $data['follower_id']);
                                    $linkText = 'View Profile';
                                    }
                                    break;
                                    }
                                    @endphp

                                    @if($linkUrl)
                                    <div class="mt-2">
                                        <a href="{{ $linkUrl }}"
                                            class="notification-link inline-flex items-center px-3 py-1 text-xs font-medium text-blue-600 bg-blue-100 rounded-md hover:bg-blue-200 transition-colors"
                                            data-notification-id="{{ $notification->id }}">
                                            <i class="fas fa-external-link-alt mr-1"></i>
                                            {{ $linkText }}
                                        </a>
                                    </div>
                                    @endif

                                    <!-- Action Buttons -->
                                    <div class="flex items-center space-x-2 mt-3">
                                        @unless($notification->read)
                                        <button
                                            class="mark-as-read-btn px-3 py-1 text-xs bg-green-500 text-white rounded-md hover:bg-green-600 transition-colors"
                                            data-id="{{ $notification->id }}">
                                            <i class="fas fa-check mr-1"></i>
                                            Mark as Read
                                        </button>
                                        @endunless
                                        <button
                                            class="delete-notification-btn px-3 py-1 text-xs bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors"
                                            data-id="{{ $notification->id }}">
                                            <i class="fas fa-trash mr-1"></i>
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>

                    <div class="mt-4">
                        {{ $notifications->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Mark as Read button
            document.querySelectorAll('.mark-as-read-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const notificationId = this.dataset.id;
                    const button = this;

                    // Disable button to prevent multiple clicks
                    button.disabled = true;
                    button.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>Processing...';

                    fetch(`/notifications/${notificationId}/read`, {
                        method: 'PATCH',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json',
                        },
                    })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Mark as read response:', data);
                            if (data.message) {
                                // Update UI immediately without reload
                                const notificationItem = button.closest('li');
                                notificationItem.classList.remove('bg-blue-50');
                                notificationItem.classList.add('bg-gray-50');
                                button.remove(); // Remove the button since it's now read

                                // Update unread count on this page
                                const unreadCountElement = document.querySelector('h3');
                                if (unreadCountElement) {
                                    const currentCount = parseInt(unreadCountElement.textContent.match(/\d+/)[0]);
                                    const newCount = Math.max(0, currentCount - 1);
                                    unreadCountElement.innerHTML = unreadCountElement.innerHTML.replace(/\d+/, newCount);
                                }

                                // Update header notification badge
                                if (typeof window.updateNotificationBadge === 'function') {
                                    window.updateNotificationBadge();
                                }
                            }
                        })
                        .catch(error => {
                            console.error('Error marking notification as read:', error);
                            // Re-enable button on error
                            button.disabled = false;
                            button.innerHTML = '<i class="fas fa-check mr-1"></i>Mark as Read';
                            alert('Failed to mark notification as read. Please try again.');
                        });
                });
            });

            // Notification link click - mark as read and navigate
            document.querySelectorAll('.notification-link').forEach(link => {
                link.addEventListener('click', function (e) {
                    const notificationId = this.dataset.notificationId;
                    const href = this.href;

                    // Mark as read in background
                    fetch(`/notifications/${notificationId}/read`, {
                        method: 'PATCH',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json',
                        },
                    })
                        .then(() => {
                            // Update header notification badge before navigation
                            if (typeof window.updateNotificationBadge === 'function') {
                                window.updateNotificationBadge();
                            }
                        })
                        .catch(error => console.error('Error marking notification as read:', error));

                    // Navigate to the link
                    window.location.href = href;
                });
            });

            // Delete button
            document.querySelectorAll('.delete-notification-btn').forEach(button => {
                button.addEventListener('click', function () {
                    if (!confirm('Are you sure you want to delete this notification?')) {
                        return;
                    }
                    const notificationId = this.dataset.id;
                    fetch(`/notifications/${notificationId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json',
                        },
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.message) {
                                location.reload(); // Reload to update list
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            });

            // Mark All As Read button
            document.getElementById('mark-all-read-btn').addEventListener('click', function () {
                fetch('/notifications/mark-all-read', {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.message) {
                            // Update header notification badge
                            if (typeof window.updateNotificationBadge === 'function') {
                                window.updateNotificationBadge();
                            }
                            location.reload(); // Reload to update status
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    </script>
</x-app-layout>