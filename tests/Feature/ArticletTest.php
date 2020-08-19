<?php

use App\Models\Article;
use App\Models\User;
use Faker\Factory;
use function Tests\actingAs;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);


it('has article page', function () {

    $user = factory(User::class)->create();

    $response = $this->actingAs($user)
        ->withSession(['foo' => 'bar'])
        ->get('/api/articles')
        ->assertStatus(200);

});

test('Create_Article_Test', function () {
    $user = factory(User::class)->create();
    $article = factory(Article::class)->make();

    $response = actingAs($user)
        ->post(route('articles.store'), [
            'title' => $article->title,
            'content' => $article->content,
            'user_id' => 1,
            'category_id' => 1,
        ]);

    $response->assertSuccessful();

    assertDatabaseHas('articles', [
        'title' => $article->title,
        'content' => $article->content,
        'user_id' => $user->id,
        'category_id' => $user->id,
    ]);
});

it('Update_Article_Test', function () {

    $user = factory(User::class)->create();
    $article = factory(Article::class)->make();

    $this->$user->articles()->save($article);

    $this->actingAs($user, 'api');

    $updatedData = [
        'title' => 'Bismillah2',
        'content' => 'tes tes tes',
        'category_id' => '1',
    ];

    $response = $this->json('PUT', route('articles.update', $article->id), $updatedData)
        ->assertJson(['data' => $updatedData]);
    dump($response->getContent()); // add this temporarily
    dump($response);
    $response->assertStatus(200);
});

it('Show_Article_Test', function () {

    $user = factory(User::class)->create();

    $this->actingAs($user, 'api');

    $article = factory(Article::class)->make();

    $this->$user->articles()->save($article);

    $this->get(route('articles.show', $article->id))->assertStatus(200);
});

it('Delete_Article_Test', function () {

    $user = factory(User::class)->create();

    $this->actingAs($user, 'api');

    $article = factory(Article::class)->make();

   $this->$user->articles()->save($article);

    $this->delete(route('articles.destroy', $article->id))->assertStatus(200);
});
