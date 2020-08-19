<?php

use App\Models\User;
uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

it('has comment page', function () {

    $user = factory(User::class)->create();

    $response = $this->actingAs($user)
        ->withSession(['foo' => 'bar'])
        ->get('/api/comments')
        ->assertStatus(200);

});
