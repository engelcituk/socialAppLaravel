<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    use  DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @test void
     * @throws \Throwable
     */
    public function registeredUserCanLogin()
    {
        factory(User::class)->create([
            'email'=> 'citukcaamal@gmail.com'
        ]);

        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email','citukcaamal@gmail.com')
                    ->type('password','secret')
                    ->press('#login-btn')
                    ->assertPathIs('/')
                    ->assertAuthenticated()
            ;
        });
    }
}
