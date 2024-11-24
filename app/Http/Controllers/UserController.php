<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon;
class UserController extends Controller
{
    public function usersNotLoggedIn()
{
    $thirtyDaysAgo = Carbon::now()->subDays(30);

    // Query to fetch users who haven't logged in within the last 30 days
    $inactiveUsers = User::whereDoesntHave('userLogInfos', function ($query) use ($thirtyDaysAgo) {
        $query->where('logged_at', '>=', $thirtyDaysAgo);
    })->get();
    foreach ($inactiveUsers as $user) {
        SendInactiveUserEmail::dispatch($user);
    }

    return response()->json([
        'message' => 'Emails queued for inactive users.'
    ]);

   
}
}
