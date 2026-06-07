<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('PBI 19: user profile status defaults to pending', function () {
    $user = User::factory()->create();
    expect($user->profile_status)->toBe('pending');
});

test('PBI 19: user profile status can be updated', function () {
    $user = User::factory()->create();
    $user->update(['profile_status' => 'verified']);
    expect($user->fresh()->profile_status)->toBe('verified');
});
