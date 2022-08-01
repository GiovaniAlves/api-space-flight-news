<?php

namespace Tests\Unit;

use App\Models\Article;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    /**
     * Testing the Welcome Route
     *
     * @return void
     */
    public function test_welcome_route()
    {
        $response = $this->get('/api/');

        $response->assertStatus(200);
    }

    /**
     * Testing the article listing route
     *
     * @return void
     */
    public function test_get_all_articles()
    {
        Article::factory(10)->create();

        $response = $this->getJson('/api/articles');

        $response->assertStatus(200)
                ->assertJsonCount(10, 'data');
    }

    /**
     * Testing the route that gets information from an article
     *
     * @return void
     */
    public function test_get_article()
    {
        $article = Article::factory()->create();

        $response = $this->get("/api/articles/{$article->id}");

        $response->assertStatus(200);
    }

    /**
     * Testing the route that gets information from an article
     *
     * @return void
     */
    public function test_error_get_article()
    {
        $article = 'fake_id';

        $response = $this->get("/api/articles/{$article}");

        $response->assertStatus(404);
    }

    /**
     * Testing the Article Creation Route
     *
     * @return void
     */
    public function test_post_article()
    {
        $payload = [
            "title" => "Teste",
            "url" => "https=>//www.nasaspjaceflight.com",
            "imageUrl" => "https=>//www.nasaspaceflight.com/NG.jpg",
            "publishedAt" => "2018-09-20 18:00:30",
            "updatedAt" => "2021-05-18 13:43:19",
            "launches" => [],
            "events" => []
        ];

        $response = $this->postJson("/api/articles", $payload);

        $response->assertStatus(201);
    }

    /**
     * Testing the Article Updating Route
     *
     * @return void
     */
    public function test_update_article()
    {
        $article = Article::factory()->create();

        $payload = [
            "title" => "Teste",
            "url" => "https=>//www.nasaspjaceflight.com",
            "imageUrl" => "https=>//www.nasaspaceflight.com/NG.jpg",
            "publishedAt" => "2018-09-20 18:00:30",
            "updatedAt" => "2021-05-18 13:43:19",
            "launches" => [],
            "events" => []
        ];

        $response = $this->putJson("/api/articles/{$article->id}", $payload);

        $response->assertStatus(200)
                ->assertJson([
                    'title' => $payload['title'],
                    'url' => $payload['url']
                ]);
    }

    /**
     * Testing the Article deletion Route
     *
     * @return void
     */
    public function test_deletion_article()
    {
        $article = Article::factory()->create();

        $response = $this->deleteJson("/api/articles/{$article->id}");

        $response->assertStatus(204);
    }
}
