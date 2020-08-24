<?php

use App\Models\Article;
use App\Models\Category;
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
    $category = factory(Category::class)->create();

    $article = new stdClass();
    $article->title = "Test Title";
    $article->content = "Bismillahirrahmanirrahim";

    $this->actingAs($user, 'api')
        ->post(route('articles.store'), [
            'title' => $article->title,
            'content' => $article->content,
            'user_id' => $user->id,
            'category_id' => $category->id,
        ])->assertSuccessful();

    $this->assertDatabaseHas('articles', [
        'title' => $article->title,
        'content' => $article->content,
        'user_id' => $user->id,
        'category_id' => $category->id,
    ]);
});

it('Update_Article_Test', function () {

    $user = factory(User::class)->create();
    $category = factory(Category::class)->create();

    $article = factory(Article::class)->make();
    $article->user_id = $user->id;
    $article->category_id = $category->id;

    $user->articles()->save($article);

    $article->title = "Test Title 2";
    $article->content = "Bismillahirrahmanirrahim2";

    $this->actingAs($user, 'api')
        ->put(route('articles.update', $article->id), [
            'title' => $article->title,
            'content' => $article->content,
            'user_id' => $user->id,
            'category_id' => $category->id,
        ])->assertSuccessful();

    $this->assertDatabaseHas('articles', [
        'title' => $article->title,
        'content' => $article->content,
        'user_id' => $user->id,
        'category_id' => $category->id,
    ]);
});

it('Show_Article_Test', function () {

    $user = factory(User::class)->create();
    $category = factory(Category::class)->create();

    $this->actingAs($user, 'api');

    $article = factory(Article::class)->make();
    $article->user_id = $user->id;
    $article->category_id = $category->id;

    $user->articles()->save($article);

    $this->get(route('articles.show', $article->id))->assertStatus(200);
});

it('Delete_Article_Test', function () {

    $user = factory(User::class)->create();
    $category = factory(Category::class)->create();

    $this->actingAs($user, 'api');

    $article = factory(Article::class)->make();
    $article->user_id = $user->id;
    $article->category_id = $category->id;

    $user->articles()->save($article);

    $this->delete(route('articles.destroy', $article->id))->assertStatus(200);
});


it('List_Article_Test', function () {

    $user = factory(User::class)->create();
    $category = factory(Category::class)->create();

    
    $this->actingAs($user, 'api');

    $article = factory(Article::class, 3)->make();

    $user->articles()->saveMany($article);

    $this->get(route('articles.index', ))->assertStatus(200);
});