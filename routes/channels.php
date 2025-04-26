<?php

use Illuminate\Support\Facades\Broadcast;

// Authorize private chat channels
Broadcast::channel('chat.{user1}.{user2}', function ($user, $user1, $user2) {
    // Ensure the authenticated user is one of the participants
    return (int) $user->id === (int) $user1 || (int) $user->id === (int) $user2;
});
