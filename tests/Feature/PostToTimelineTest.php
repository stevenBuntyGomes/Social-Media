<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PostToTimelineTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
    }

    /** @test */

    public function a_user_can_post_a_test_post()
    {

        // $this->withoutExceptionHandling();

        $this->actingAs($user = factory(User::class)->create(), 'api');
        $response = $this->post('/api/posts', [
            'body' => 'testing body',
        ]);

        $post = Post::first();

        $this->assertCount(1, Post::all());
        $this->assertEquals($user->id, $post->user_id);
        $this->assertEquals('testing body', $post->body);

        $response->assertStatus(201)->assertJson([
            'data' => [
                'type' => 'post',
                'post_id' => [
                    'data' => [
                        'attributes' => [
                            'name' => $user->name,
                        ]
                    ]
                ],
                'attributes' => [
                    'posted_by' => $user->name,
                    'body' => 'testing body'
                ],
            ],
            'links' => [
                'self' => url('/post' . '/' . $post->id)
            ]
        ]);
    }


    /** @test */
    public function a_user_can_post_a_test_post_with_an_image()
    {

        $this->withoutExceptionHandling();


        $this->actingAs($user = factory(User::class)->create(), 'api');


        $file = UploadedFile::fake()->image('user-post.jpg');

        $response = $this->post('/api/posts', [
            'body' => 'testing body',
            'image' => $file,
            'width' => 300,
            'height' => 250,
        ]);

        Storage::disk('public')->assertExists('post-images/' . $file->hashName());

        $response->assertStatus(201)->assertJson([
            'data' => [
                'attributes' => [
                    'body' => 'testing body',
                    'image' => url('post-images/' . $file->hashName()),
                ],
            ],
        ]);
    }
}
