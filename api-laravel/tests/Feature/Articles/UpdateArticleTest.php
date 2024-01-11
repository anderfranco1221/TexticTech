<?php

namespace Tests\Feature\Articles;

use Tests\TestCase;
use App\Models\Article;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateArticleTest extends TestCase
{
    use RefreshDatabase;

     /** @test */
    public function can_update_articles()
    {
        $article = Article::factory()->create();

        $response = $this->patchJson(route('api.v1.articles.update', $article), [
            'title' => 'Update articulo',
            'slug' => $article->slug,
            'content' => 'Actualizar contenido del articulo'
        ])->assertOk();
        
        $article = Article::first();

        $response->assertHeader(
            'Location',
            route('api.v1.articles.show', $article)
        );
        

        $response->assertExactJson([
            'data' =>[
                'type' => 'articles',
                'id' => (string) $article->getRouteKey(),
                'attributes' => [
                    'title' => 'Update articulo',
                    'slug' => $article->slug,
                    'content' => 'Actualizar contenido del articulo'
                ],
                'links' => [
                    'self' => route('api.v1.articles.show', $article)
                ]
            ]
        ]);
        
    }

    /** @test */
    public function title_is_required()
    {
        //$this->withoutExceptionHandling();
        $article = Article::factory()->create();

        $response = $this->patchJson(route('api.v1.articles.update', $article), [
                    'slug' => 'update-articulo',
                    'content' => 'Actualizar Contenido del articulo'
        ]);

        $response->assertJsonApiValidationErrors('title');
        
    }

    /** @test */
    public function slug_is_required()
    {
        //$this->withoutExceptionHandling();
        $article = Article::factory()->create();

        $response = $this->patchJson(route('api.v1.articles.update', $article), [
                    'title' => 'Update articulo',
                    'content' => 'Actualizar Contenido del articulo'
        ]);

        $response->assertJsonApiValidationErrors('slug');
        
    }

    /** @test */
    public function slug_must_be_unique()
    {
        $article1 = Article::factory()->create();
        $article2 = Article::factory()->create();

        $response = $this->patchJson(route('api.v1.articles.update', $article1), [
                    'title' => 'Nuevo articulo',
                    'slug' => $article2->slug,
                    'content' => 'Contenido del articulo'
        ]);

        $response->assertJsonApiValidationErrors('slug');
        
    }

    /** @test */
    public function content_is_required()
    {
        //$this->withoutExceptionHandling();
        $article = Article::factory()->create();

        $response = $this->patchJson(route('api.v1.articles.update', $article), [
            'data' => [
                'type' => 'articles',
                'attributes' => [
                    'title' => 'Update articulo',
                    'slug' => 'update-articulo',
                ]
            ]
        ]);

        $response->assertJsonApiValidationErrors('content');
        
    }
}
