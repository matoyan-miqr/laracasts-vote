<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Idea;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowIdeasTest extends TestCase
{
  use RefreshDatabase;

  public function list_of_ideas_shows_on_main_page()
  {
    $ideaOne = Idea::factoryd()->create([
      'title' => 'My First Title',
      'description' => 'Description of my first Title'
    ]);
    $ideaTwo = Idea::factoryd()->create([
      'title' => 'My Second Title',
      'description' => 'Description of my Second Title'
    ]);

    $response = $this->get(route('idea.index'));


    $response->assertSuccessful();

    $response->assertSee($ideaOne->title);
    $response->assertSee($ideaOne->description);
    $response->assertSee($ideaTwo->title);
    $response->assertSee($ideaTwo->description);
  }
  public function single_idea_shows_correctly_on_the_show_page()
  {
    $idea = Idea::factoryd()->create([
      'title' => 'My First Title',
      'description' => 'Description of my first Title'
    ]);

    $response = $this->get(route('idea.show', $idea));


    $response->assertSuccessful();

    $response->assertSee($idea->title);
    $response->assertSee($idea->description);
  }
}
