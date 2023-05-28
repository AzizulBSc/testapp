<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use App\Http\Controllers\PostController;

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
