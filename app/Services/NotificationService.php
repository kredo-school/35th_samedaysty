<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;
use App\Models\Reaction;
use App\Models\Comment;
use App\Models\ParticipantChat;
use Illuminate\Support\Facades\Auth;

class NotificationService
{
    /**
     * 通知を作成して保存
     */
    private static function createNotification(User $recipient, string $type, string $title, string $message, array $data = []): Notification
    {
        return Notification::create([
            'user_id' => $recipient->id,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'data' => $data,
        ]);
    }

    /**
     * フォローリクエスト通知
     */
    public static function sendFollowRequestNotification(User $follower, User $following): Notification
    {
        $title = "New Follow Request";
        $message = "{$follower->name} wants to follow you.";
        $data = [
            'follower_id' => $follower->id,
            'follower_name' => $follower->name,
            'following_id' => $following->id,
            'type' => 'follow_request',
        ];

        return self::createNotification($following, 'follow_request', $title, $message, $data);
    }

    /**
     * フォロー承認通知
     */
    public static function sendFollowAcceptedNotification(User $follower, User $following): Notification
    {
        $title = "Follow Request Accepted";
        $message = "{$following->name} accepted your follow request.";
        $data = [
            'follower_id' => $follower->id,
            'following_id' => $following->id,
            'following_name' => $following->name,
            'type' => 'follow_accepted',
        ];

        return self::createNotification($follower, 'follow_accepted', $title, $message, $data);
    }

    /**
     * Send notification when a plan is liked
     */
    public static function sendPlanLikedNotification(Reaction $reaction): ?Notification
    {
        $plan = $reaction->plan;
        $liker = $reaction->user;
        $owner = $plan->user;

        if ($owner->id === $liker->id) {
            return null; // Don't notify when user likes their own plan
        }

        $title = "Your plan was liked!";
        $message = "{$liker->name} liked your plan: \"{$plan->title}\".";
        $data = [
            'plan_id' => $plan->id,
            'plan_title' => $plan->title,
            'liker_id' => $liker->id,
            'liker_name' => $liker->name,
            'type' => 'plan_liked',
        ];

        return self::createNotification($owner, 'plan_liked', $title, $message, $data);
    }

    /**
     * Send notification when a plan is marked as interested
     */
    public static function sendPlanInterestedNotification(Reaction $reaction): ?Notification
    {
        $plan = $reaction->plan;
        $interestedUser = $reaction->user;
        $owner = $plan->user;

        if ($owner->id === $interestedUser->id) {
            return null; // Don't notify when user is interested in their own plan
        }

        $title = "Someone is interested in your plan!";
        $message = "{$interestedUser->name} is interested in your plan: \"{$plan->title}\".";
        $data = [
            'plan_id' => $plan->id,
            'plan_title' => $plan->title,
            'interested_user_id' => $interestedUser->id,
            'interested_user_name' => $interestedUser->name,
            'type' => 'plan_interested',
        ];

        return self::createNotification($owner, 'plan_interested', $title, $message, $data);
    }

    /**
     * Send notification when a join request is made for a plan
     */
    public static function sendJoinRequestNotification(Reaction $reaction): ?Notification
    {
        $plan = $reaction->plan;
        $requester = $reaction->user;
        $owner = $plan->user;

        if ($owner->id === $requester->id) {
            return null; // Don't notify when user requests to join their own plan
        }

        $title = "New Join Request";
        $message = "{$requester->name} wants to join your plan: \"{$plan->title}\".";
        $data = [
            'plan_id' => $plan->id,
            'plan_title' => $plan->title,
            'requester_id' => $requester->id,
            'requester_name' => $requester->name,
            'type' => 'join_request',
        ];

        return self::createNotification($owner, 'join_request', $title, $message, $data);
    }

    /**
     * Send notification when a join request is accepted
     */
    public static function sendJoinRequestAcceptedNotification(User $requester, $plan): Notification
    {
        $title = "Join Request Accepted";
        $message = "Your request to join \"{$plan->title}\" has been accepted!";
        $data = [
            'plan_id' => $plan->id,
            'plan_title' => $plan->title,
            'type' => 'join_accepted',
        ];

        return self::createNotification($requester, 'join_accepted', $title, $message, $data);
    }

    /**
     * Send notification when a join request is rejected
     */
    public static function sendJoinRequestRejectedNotification(User $requester, $plan): Notification
    {
        $title = "Join Request Rejected";
        $message = "Your request to join \"{$plan->title}\" has been rejected.";
        $data = [
            'plan_id' => $plan->id,
            'plan_title' => $plan->title,
            'type' => 'join_rejected',
        ];

        return self::createNotification($requester, 'join_rejected', $title, $message, $data);
    }

    /**
     * チャットメッセージ通知
     */
    public static function sendChatMessageNotification(User $recipient, User $sender, $conversation): Notification
    {
        $title = "New Chat Message";
        $message = "{$sender->name} sent you a message.";
        $data = [
            'conversation_id' => $conversation->id,
            'sender_id' => $sender->id,
            'sender_name' => $sender->name,
            'type' => 'chat_message',
        ];

        return self::createNotification($recipient, 'chat_message', $title, $message, $data);
    }

    /**
     * Send notification when a comment is added to a plan
     */
    public static function sendPlanCommentNotification(Comment $comment): ?Notification
    {
        $plan = $comment->plan;
        $commenter = $comment->user;
        $owner = $plan->user;

        if ($owner->id === $commenter->id) {
            return null; // Don't notify when user comments on their own plan
        }

        $title = "New comment on your plan!";
        $message = "{$commenter->name} commented on your plan: \"{$plan->title}\". Comment: \"{$comment->body}\"";
        $data = [
            'plan_id' => $plan->id,
            'plan_title' => $plan->title,
            'comment_id' => $comment->id,
            'commenter_id' => $commenter->id,
            'commenter_name' => $commenter->name,
            'type' => 'plan_comment',
        ];

        return self::createNotification($owner, 'plan_comment', $title, $message, $data);
    }

    /**
     * Send notification when a comment is added to a plan's group chat
     */
    public static function sendGroupCommentNotification(ParticipantChat $chatMessage): ?Notification
    {
        $plan = $chatMessage->plan;
        $sender = $chatMessage->user;
        $owner = $plan->user;

        $notifications = [];

        // Notify plan owner (if comment is not from themselves)
        if ($owner->id !== $sender->id) {
            $title = "New group message in your plan!";
            $message = "{$sender->name} posted in your plan's group chat for \"{$plan->title}\". Message: \"{$chatMessage->body}\"";
            $data = [
                'plan_id' => $plan->id,
                'plan_title' => $plan->title,
                'chat_message_id' => $chatMessage->id,
                'sender_id' => $sender->id,
                'sender_name' => $sender->name,
                'type' => 'group_chat_owner',
            ];
            $notifications[] = self::createNotification($owner, 'group_chat_owner', $title, $message, $data);
        }

        // Notify plan participants (if comment is not from themselves and not from owner)
        foreach ($plan->participants as $participant) {
            if ($participant->id !== $sender->id && $participant->id !== $owner->id) {
                $title = "New group message in a plan you joined!";
                $message = "{$sender->name} posted in the group chat for \"{$plan->title}\". Message: \"{$chatMessage->body}\"";
                $data = [
                    'plan_id' => $plan->id,
                    'plan_title' => $plan->title,
                    'chat_message_id' => $chatMessage->id,
                    'sender_id' => $sender->id,
                    'sender_name' => $sender->name,
                    'type' => 'group_chat_participant',
                ];
                $notifications[] = self::createNotification($participant, 'group_chat_participant', $title, $message, $data);
            }
        }

        return count($notifications) > 0 ? $notifications[0] : null; // 最初の通知を返すか、null
    }

    /**
     * 未読通知数を取得
     */
    public static function getUnreadCount(User $user): int
    {
        return $user->unreadNotifications()->count();
    }
}
