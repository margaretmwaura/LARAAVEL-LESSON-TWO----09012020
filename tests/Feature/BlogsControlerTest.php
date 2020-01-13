<?php

namespace Tests\Feature;

use App\Http\Controllers\BlogsController;
use App\Models\User;
use App\Models\Writeup;
use App\Repository\BlogRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Mockery;
use Tests\TestCase;

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

    public function test_the_delete_function()
    {
        Event::fake();

        $this->withoutExceptionHandling();
        $id = 83;
        $controller =new BlogRepository();
        $controller->deleteRecord($id);
        $this->assertDatabaseMissing('writeups',['id' => 83]);

    }

    public function test_the_store_function_in_repo()
    {
        Event::fake();
        $id = 84;
        $request = Request::create('/store', 'POST',[
            'title'=>'Testing repo',
            'message'=>'It is working',
        ]);
        $controller =new BlogRepository();
        $controller->updateRecord($request,$id);
        $this->assertDatabaseHas('writeups',['title' => 'Testing repo']);
    }

    public function test_the_controller_with_repo()
    {
        $id = 84;
        $mock = Mockery::mock(BlogRepository::class);
        $mock->shouldReceive('deleteRecord')->with($id)->once()->andReturn(true);
        $controller = new BlogsController($mock);
        $this->assertEquals(1,  $controller->destroy($id));
//        $this->assertDatabaseMissing('writeups',['id' => 84]);
        Mockery::close();
    }

    public function test_the_find_function_in_repository()
    {
        $id = 84;
        $controller =new BlogRepository();
        $response=$controller->find($id);
        dd($response);
    }
}
