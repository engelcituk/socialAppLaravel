<?php

namespace Tests\Unit\Http\Resources;

use App\Models\Status;
use App\Http\Resources\StatusResource;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatusResourceTest extends TestCase
{
    use RefreshDatabase;
    /** @test **/
    public function a_status_must_have_the_necessary_fields()
    {
        $status = factory(Status::class)->create();

        $statusResource = StatusResource::make($status)->resolve();

        $this->assertEquals(
            $status->body,
            $statusResource['body']
        );
        $this->assertEquals(
            $status->user->name,
            $statusResource['user_name']
        );
        $this->assertEquals(
            'https://aprendible.com/images/default-avatar.jpg',
            $statusResource['user_avatar']
        );
        $this->assertEquals(
            $status->created_at->diffForHumans(),
            $statusResource['ago']
        );


        // $this->assertArrayHasKey('body', $statusResource);
        //$this->assertArrayHasKey('user_name', $statusResource);
        //$this->assertArrayHasKey('user_avatar', $statusResource);
        //$this->assertArrayHasKey('ago', $statusResource);

    }
}
