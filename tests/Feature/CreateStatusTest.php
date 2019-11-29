<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateStatusTest extends TestCase
{
    use RefreshDatabase;
    /**@test  */
    function test_guestsUsersCanNotCreateStatuses()
    {

        $response = $this->post(route('statuses.store'),['body'=>'mi primer status']);

        $response->assertRedirect('login');
    }
    /**@test*/
    public function test_anAuthenticatedUserCanCreateStatuses()
    {
        $this->withExceptionHandling();
        //1. given => teniendo un usuario autenticado
        $user = factory(User::class)->create();
        $this->actingAs($user);

        //2. when => cuando hace a un post request a status
        $response = $this->post(route('statuses.store'),['body'=>'mi primer status']);
        $response->assertJson([
            'body'=>'mi primer status'
        ]);

        //3. then => entonces veo un nuevo estado en la base de datos
        $this->assertDatabaseHas('statuses',[
            'user_id' => $user->id,
            'body' => 'mi primer status'
        ]);

    }

     function test_aStatusRequireABody(){

         $user = factory(User::class)->create();
         $this->actingAs($user);

         $response = $this->postJson(route('statuses.store'),['body'=>'']);

         dd($response->getContent());

         $response->assertSessionHasErrorsIn('body');
     }

}
