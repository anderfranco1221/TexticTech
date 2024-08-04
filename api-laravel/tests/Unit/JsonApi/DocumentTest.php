<?php

namespace Tests\Unit\JsonApi;

use App\JsonApi\Document;
use Mockery;
use PHPUnit\Framework\TestCase;

class DocumentTest extends TestCase
{

    /** @test */
    public function can_create_json_api_documents()
    {
        $category = Mockery::mock('Category', function($mock){
            $mock->shouldReceive('getResourceType')->andReturn('categories');
            $mock->shouldReceive('getRouteKey')->andReturn('category-id');
        });


        $document = Document::type('articles')
                    ->id('articles-id')
                    ->attributes([
                        'title' => 'article title'
                    ])->relationshipsData([
                        'category' => $category
                    ])->toArray();

        $expected = [
            'data' => [
                'type' => 'articles',
                'id' => 'articles-id',
                'attributes' =>[
                    'title' => 'article title'
                ],
                'relationships' => [
                    'category' => [
                        'data' => [
                            'type' =>'categories',
                            'id' => 'category-id'
                        ]
                    ]
                ]
            ]
        ];

        $this->assertEquals($expected, $document);
    }
}

