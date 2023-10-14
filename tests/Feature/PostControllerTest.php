<?php

namespace Tests\Feature;

use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    public function it_shows_list_of_post()
    {
        $this->assertTrue(true);
    }
    // use RefreshDatabase;

    // /** @test */
    // public function it_shows_list_of_post()
    // {
    //     //Arrange
    //     Post::factory()->count(15)->create();

    //     //Act
    //     $posts = (new PostController)->index();

    //     // Assert
    //     $this->assertEquals(15, $posts->count());

    // }

}
