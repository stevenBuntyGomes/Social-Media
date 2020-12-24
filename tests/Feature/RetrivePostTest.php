<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Friend;

class RetrivePostTest extends TestCase
{
    use RefreshDatabase;
    /** @test */

    public function a_user_can_retrive_post()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($user = factory(\App\User::class)->create(), 'api');
        $anotherUser = factory(\App\User::class)->create();
        $posts = factory(\App\Post::class, 2)->create(['user_id' => $anotherUser->id]);
        Friend::create([
            'user_id' => $user->id,
            'friend_id' => $anotherUser->id,
            'confirmed_at' => now(),
            'status' => 1,
        ]);

        $response = $this->get('/api/posts');

        $response->assertStatus(200)->assertJson([
            'data' => [
                'data' => [
                    'type' => 'post',
                    'post_id' => $posts->last()->id,
                    'attributes' => [
                        'body' => $posts->last()->body,
                        'image' => url($posts->last()->image),
                        'posted_at' => $posts->last()->created_at->diffForHumans(),
                    ]
                ],

                'data' => [
                    'type' => 'post',
                    'post_id' => $posts->first()->id,
                    'attributes' => [
                        'body' => $posts->first()->body,
                        'image' => url($posts->first()->image),
                        'posted_at' => $posts->first()->created_at->diffForHumans(),
                    ]
                ],
            ],
            'links' => [
                'self' => url('/posts')
            ]

        ]);
    }


    /** @test */
    public function a_user_can_only_retrive_their_post(){
        $this->actingAs($user = factory(\App\User::class)->create(), 'api');
        $posts = factory(\App\Post::class, 2)->create();

        $response = $this->get('/api/posts');

        $response->assertStatus(200)->assertExactJson([
            'data' => [],
            'links' => [
                'self' => url('/posts'),
            ]
        ]);
    }
}
