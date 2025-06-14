<?php

use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('chat.user.{id}', function ($user, $id) {
    return $user instanceof User && (int) $user->id === (int) $id;
});

Broadcast::channel('chat.admin.{id}', function ($admin, $id) {
    return $admin instanceof Admin && (int) $admin->id === (int) $id;
});

Broadcast::channel('konsultasi.{id}', function ($userOrAdmin, $id) {
    return $userOrAdmin instanceof User || $userOrAdmin instanceof Admin;
});
