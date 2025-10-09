<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Get notifications list
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $perPage = $request->get('per_page', 20);

        $notifications = Notification::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        $unreadCount = NotificationService::getUnreadCount($user);

        // Return JSON for API requests
        if ($request->expectsJson()) {
            return response()->json([
                'notifications' => $notifications,
                'unread_count' => $unreadCount,
            ]);
        }

        // Mark all notifications as read when opening the notifications page
        Notification::where('user_id', $user->id)
            ->where('read', false)
            ->update(['read' => true]);

        // Return view for regular requests
        return view('notifications.index', compact('notifications', 'unreadCount'));
    }

    /**
     * Get unread notifications only
     */
    public function unread(Request $request): JsonResponse
    {
        $user = $request->user();
        $notifications = Notification::where('user_id', $user->id)
            ->where('read', false)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['notifications' => $notifications]);
    }

    /**
     * Get unread notification count
     */
    public function unreadCount(Request $request): JsonResponse
    {
        $user = $request->user();
        $count = NotificationService::getUnreadCount($user);
        return response()->json(['unread_count' => $count]);
    }

    /**
     * Mark specific notification as read
     */
    public function markAsRead(Request $request, $id): JsonResponse
    {
        $notification = Notification::findOrFail($id);

        \Log::info('Mark as read request', [
            'notification_id' => $notification->id,
            'user_id' => Auth::id(),
            'notification_user_id' => $notification->user_id,
            'current_read_status' => $notification->read
        ]);

        if ($notification->user_id !== Auth::id()) {
            \Log::warning('Unauthorized mark as read attempt', [
                'notification_id' => $notification->id,
                'user_id' => Auth::id(),
                'notification_user_id' => $notification->user_id
            ]);
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $notification->update(['read' => true]);
        \Log::info('Notification marked as read successfully', [
            'notification_id' => $notification->id,
            'new_read_status' => $notification->fresh()->read
        ]);

        return response()->json(['message' => 'Notification marked as read.']);
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead(Request $request): JsonResponse
    {
        $user = $request->user();
        Notification::where('user_id', $user->id)
            ->where('read', false)
            ->update(['read' => true]);
        return response()->json(['message' => 'All notifications marked as read.']);
    }

    /**
     * Delete notification
     */
    public function destroy($id): JsonResponse
    {
        $notification = Notification::findOrFail($id);

        if ($notification->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $notification->delete();
        return response()->json(['message' => 'Notification deleted.']);
    }
}