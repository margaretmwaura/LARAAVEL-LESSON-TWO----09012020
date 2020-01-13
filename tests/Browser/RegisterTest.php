<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterTest extends DuskTestCase
{

    use DatabaseMigrations;

    protected $user;

    public function setUp(){
        parent::setUp();
        $this->user = factory(User::class)->create();

    }

    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink('The blogs')
                ->assertSee('Welcome to blogging');
        });
    }

    public function testAuthentication()
    {
        $user = $this->user;

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/')
                ->assertSee('Create Blog')
                ->assertAuthenticatedAs($user)
                ->logout()
                ->assertGuest();
        });
    }
}
