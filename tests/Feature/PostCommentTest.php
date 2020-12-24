<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Post;
use App\User;
use App\Comment;

class PostCommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_comment_on_a_post()
    {


        $this->withoutExceptionHandling();

        $this->actingAs($user = factory(User::class)->create(), 'api');
        $post = factory(Post::class)->create(['id' => 123]);

        $response = $this->post('/api/posts/' . $post->id . '/comment', [
            'body' => 'A great Comment here'
        ])
            ->assertStatus(200);


            $comment = Comment::first();
            $this->assertCount(1, Comment::all());
            $this->assertEquals($user->id, $comment->user_id);
            $this->assertEquals($post->id, $comment->post_id);
            $this->assertEquals('A great Comment here', $comment->body);
            $response->assertJson([
                'data' => [
                    [
                        'data' => [
                            'type' => 'comments',
                            'comment_id' => 1,
                            'attributes' => [
                                'commented_by' => [
                                    'data' => [
                                        'user_id' => $user->id,
                                        'attributes' => [
                                            'name' => $user->name,
                                        ]
                                    ]
                                ],
                                'body' => 'A great Comment here',
                                'commented_at' => $comment->created_at->diffForHumans(),
                            ],
                        ],
                        'links' => [
                            'self' => url('/posts/123'),
                        ]
                    ]
                ],
                'links' => [
                    'self' => url('/posts'),
                ]
            ]);
    }

    /** @test */
    public function a_body_is_required_to_leave_a_commment_on_a_post()
    {
        // $this->withoutExceptionHandling();

        $this->actingAs($user = factory(User::class)->create(), 'api');
        $post = factory(Post::class)->create(['id' => 123]);

        $response = $this->post('/api/posts/' . $post->id . '/comment', [
            'body' => '',
        ])->assertStatus(422);

        $responseString = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('body', $responseString['errors']['meta']);
    }


    /** @test */
    public function posts_are_returned_with_comments()
    {
        $this->actingAs($user = factory(User::class)->create(), 'api');
        $post = factory(Post::class)->create(['id' => 123, 'user_id' => $user->id]);

        $this->post('/api/posts/' . $post->id . '/comment', [
            'body' => 'A great Comment here'
        ]);


        $response = $this->get('/api/get_posts');

        $comment = Comment::first();

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'data' => [
                            'type' => 'posts',
                            'attributes' => [
                                'comments' => [
                                    'data' => [
                                        [
                                            'data' => [
                                                'type' => 'comments',
                                                'comment_id' => 1,
                                                'attributes' => [
                                                    'commented_by' => [
                                                        'data' => [
                                                            'user_id' => $user->id,
                                                            'attributes' => [
                                                                'name' => $user->name,
                                                            ]
                                                        ]
                                                    ],
                                                    'body' => 'A great Comment here',
                                                    'commented_at' => $comment->created_at->diffForHumans(),
                                                ],
                                            ],
                                            'links' => [
                                                'self' => url('/posts/123'),
                                            ]
                                        ]
                                    ],
                                    'comment_count' => 1,
                                ]


                            ]
                        ]
                    ]
                ]
            ]);
    }

}
