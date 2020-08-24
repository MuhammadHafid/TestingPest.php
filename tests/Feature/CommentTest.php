<?php

use App\Models\Article;
use App\Models\User;
use App\Models\Comment;
use Faker\Factory;
use function Tests\actingAs;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

it('has comment page', function () {

    $user = factory(User::class)->create();

    $response = $this->actingAs($user)
        ->withSession(['foo' => 'bar'])
        ->get('/api/comments')
        ->assertStatus(200);
});

test('Create_Comment_Test', function () {
    $user = factory(User::class)->create();
    $article = factory(Article::class)->create();

    $comment = new stdClass();
    $comment->content = "Bismillahirrahmanirrahim98";

    $this->actingAs($user, 'api')
        ->post(route('comments.store'), [
            'content' => $comment->content,
            'user_id' => $user->id,
            'article_id' => $article->id,
        ])->assertSuccessful();

    $this->assertDatabaseHas('comments', [
        'content' => $comment->content,
        'user_id' => $user->id,
        'article_id' => $article->id,
    ]);
});


it('Update_Comment_Test', function () {
    $user = factory(User::class)->create();
    $article = factory(Article::class)->create();

    
    $comment = factory(Comment::class)->make();
    $comment->user_id = $user->id;
    $comment->article_id = $article->id;

    
    $user->comment()->save($comment);
    $comment->content = "Bismillahirrahmanirrahim 9899";

    $this->actingAs($user, 'api')
        ->post(route('comments.store'), [
            'content' => $comment->content,
            'user_id' => $user->id,
            'article_id' => $article->id,
        ])->assertSuccessful();

    $this->assertDatabaseHas('comments', [
        'content' => $comment->content,
        'user_id' => $user->id,
        'article_id' => $article->id,
    ]);
});


it('Show_Comment_Test', function () {

    $user = factory(User::class)->create();
    $article = factory(Article::class)->create();

    $this->actingAs($user, 'api');

    $comment = factory(Comment::class)->make();
    $comment->user_id = $user->id;
    $comment->article_id = $article->id;

    $user->comment()->save($comment);

    $this->get(route('comments.show', $comment->id))->assertStatus(200);
});

it('Delete_Comment_Test', function () {

    $user = factory(User::class)->create();
    $article = factory(Article::class)->create();

    $this->actingAs($user, 'api');

    $comment = factory(Comment::class)->make();
    $comment->user_id = $user->id;
    $comment->article_id = $article->id;

    $user->comment()->save($comment);

    $this->delete(route('comments.destroy', $comment->id))->assertStatus(200);
});

it('List_Comment_Test', function () {

    $user = factory(User::class)->create();
    $article = factory(Article::class)->create();

    
    $this->actingAs($user, 'api');

    $comment = factory(Comment::class, 3)->make();

    $user->comment()->saveMany($comment);

    $this->get(route('comments.index', ))->assertStatus(200);
});
