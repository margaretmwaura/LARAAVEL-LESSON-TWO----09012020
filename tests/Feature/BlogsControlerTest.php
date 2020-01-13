<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Writeup;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlogsControlerTest extends TestCase
{
//    use DatabaseTransactions;
//    use RefreshDatabase;

    public function test_signed_in_user_can_see_create_form()
    {
        $this->actingAs(factory(User::class)->create());
        $this->get('/')->assertSee('Create Blog');
    }

    public function test_adding_a_blog_to_the_database()
    {
         Event::fake();
        $this->withoutExceptionHandling();
        $this->actingAs(factory(User::class)->create());
        $this->post('writeups',[
            'title' => 'This is Maggie',
            'message' => 'Gal is writtng tests' ,
            'date' => \Carbon\Carbon::now()
        ]);
        $this->assertCount(1,Writeup::all());
//        $this->assertDatabaseHas('writeups', array $data);
    }
    public function test_getting_blogs_from_database()
    {
        $user = factory(User::class)->create();
        factory(Writeup::class)->create(['user_id' => $user->id]);
        $response = $this->get('writeups');
         $response->assertStatus(201);
    }

    public function test_deleting_blog_in_the_database()
    {
        $this->delete('writeups/82');
        $this->assertDatabaseMissing('writeups',['id' => 82]);
    }
}
