<?php

use App\Models\User;

test('profile information can be updated', function () {
    $this->actingAs($user = User::factory()->create());

    $response = $this->put('/user/profile-information', [
        'first_name' => 'Test',
        'last_name' => 'Person',
        'email' => 'test@example.com',
    ]);

    expect($user->fresh())
        ->first_name->toEqual('Test')
        ->last_name->toEqual('Person')
        ->email->toEqual('test@example.com');
});
