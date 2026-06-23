<?php

use App\Models\Slide;
use App\Models\User;

it('deletes a slide from the database', function () {
    $user = User::factory()->create();

    $slide = Slide::create([
        'title' => 'Delete me',
        'image' => 'slides/delete-me.jpg',
    ]);

    $response = $this
        ->actingAs($user)
        ->delete('/slides/' . $slide->id);

    $response->assertRedirect(route('slides.index'));
    $this->assertDatabaseMissing('slides', [
        'id' => $slide->id,
    ]);
});
