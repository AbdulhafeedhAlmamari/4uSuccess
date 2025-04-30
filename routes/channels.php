<?php

use Illuminate\Support\Facades\Broadcast;

// Authorize private chat channels
Broadcast::channel('chat.{user1}.{user2}', function ($user, $user1, $user2) {
    // Ensure the authenticated user is one of the participants
    return (int) $user->id === (int) $user1 || (int) $user->id === (int) $user2;
});

Broadcast::channel('private-chat.{id1}.{id2}', function ($user, $id1, $id2) {
    return in_array($user->id, [$id1, $id2]);
});