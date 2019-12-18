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
    function guestsUsersCanNotCreateStatuses()
    {

        $response = $this->post(route('statuses.store'),['body'=>'mi primer status']);

        $response->assertRedirect('login');
    }
    /**@test*/
    public function anAuthenticatedUserCanCreateStatuses()
    {
        $this->withExceptionHandling();
        //1. given => teniendo un usuario autenticado
        $user = factory(User::class)->create();
        $this->actingAs($user);

        //2. when => cuando hace a un post request a status
        $response = $this->postJson(route('statuses.store'),['body'=>'mi primer status']);
        $response->assertJson([
            'body'=>'mi primer status'
        ]);

        //3. then => entonces veo un nuevo estado en la base de datos
        $this->assertDatabaseHas('statuses',[
            'user_id' => $user->id,
            'body' => 'mi primer status'
        ]);

    }
    /**@test*/
    function StatusRequireABody(){

        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->postJson(route('statuses.store'),['body'=>'']);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message', 'errors' => ['body']
        ]);
    }
    /**@test*/
    function StatusBodyRequiresRequiresAMinimumLength(){

        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->postJson(route('statuses.store'),['body'=>'ffee']);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message', 'errors' => ['body']
        ]);
    }


}
