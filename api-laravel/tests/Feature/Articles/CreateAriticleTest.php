<?php

namespace Tests\Feature\Articles;

use Tests\TestCase;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateAriticleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_create_articles()
    {
        //$this->withoutExceptionHandling();
        $category = Category::factory()->create();

        $response = $this->postJson(route('api.v1.articles.store'), [
            'title' => 'Nuevo articulo',
            'slug' => 'nuevo-articulo',
            'content' => 'Contenido del articulo',
            '_relationships' => [
                'category' => $category
            ]
        ])->assertCreated();

        $article = Article::first();

        $response->assertHeader(
            'Location',
            route('api.v1.articles.show', $article)
        );


        $response->assertJsonApiResource($article, [
            'title' => 'Nuevo articulo',
            'slug' => 'nuevo-articulo',
            'content' => 'Contenido del articulo'
        ]);

    }

    /** @test */
    public function title_is_required()
    {
        //$this->withoutExceptionHandling();

        $response = $this->postJson(route('api.v1.articles.store'), [
                    'slug' => 'nuevo-articulo',
                    'content' => 'Contenido del articulo'
        ]);

        $response->assertJsonApiValidationErrors('title');

    }

    /** @test */
    public function slug_is_required()
    {
        //$this->withoutExceptionHandling();

        $response = $this->postJson(route('api.v1.articles.store'), [
                    'title' => 'Nuevo articulo',
                    'content' => 'Contenido del articulo'
        ]);

        $response->assertJsonApiValidationErrors('slug');

    }

    /** @test */
    public function slug_must_be_unique()
    {
        $article = Article::factory()->create();

        $response = $this->postJson(route('api.v1.articles.store'), [
                    'title' => 'Nuevo articulo',
                    'slug' => $article->slug,
                    'content' => 'Contenido del articulo'
        ]);

        $response->assertJsonApiValidationErrors('slug');

    }

    /** @test */
    public function slug_must_only_contain_letters_numbers_and_dashes()
    {
        $response = $this->postJson(route('api.v1.articles.store'), [
                    'title' => 'Nuevo articulo',
                    'slug' => '$#$$?)(&%$%#""',
                    'content' => 'Contenido del articulo'
        ]);

        $response->assertJsonApiValidationErrors('slug');

    }

     /** @test */
    public function slug_must_not_contain_underscores()
    {
        $response = $this->postJson(route('api.v1.articles.store'), [
                    'title' => 'Nuevo articulo',
                    'slug' => 'holla_as',
                    'content' => 'Contenido del articulo'
        ])->assertSee(trans('validation.no_underscores', ['attribute' => 'data.attributes.slug']));

        $response->assertJsonApiValidationErrors('slug');

    }

     /** @test */
    public function slug_must_not_start_with_dashes()
    {
        $response = $this->postJson(route('api.v1.articles.store'), [
                    'title' => 'Nuevo articulo',
                    'slug' => '-starts-with-dashe',
                    'content' => 'Contenido del articulo'
        ])->assertSee(trans('validation.no_starting_dashes', ['attribute' => 'data.attributes.slug']));

        $response->assertJsonApiValidationErrors('slug');

    }

     /** @test */
    public function slug_must_not_finish_with_dashes()
    {
        $response = $this->postJson(route('api.v1.articles.store'), [
                    'title' => 'Nuevo articulo',
                    'slug' => 'finish-with-dashe-',
                    'content' => 'Contenido del articulo'
        ])->assertSee(trans('validation.no_ending_dashes', ['attribute' => 'data.attributes.slug']));

        $response->assertJsonApiValidationErrors('slug');

    }

    /** @test */
    public function content_is_required()
    {
        //$this->withoutExceptionHandling();

        $response = $this->postJson(route('api.v1.articles.store'), [
            'data' => [
                'type' => 'articles',
                'attributes' => [
                    'title' => 'Nuevo articulo',
                    'slug' => 'nuevo-articulo',
                ]
            ]
        ]);

        $response->assertJsonApiValidationErrors('content');

    }
}
