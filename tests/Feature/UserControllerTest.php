<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testLoginPage()
    {
        $this->get('/login')
            ->assertStatus(200)
            ->assertSee('Login');
    }

    public function testLoginSuccess()
    {
        $this->post('/login', [
            'user' => 'maulana',
            'password' => 'secret',
        ])->assertRedirect('/')
        ->assertSessionHas('user', 'maulana');
    }
    public function testLoginValidationError()
    {
        $this->post('/login', [])
        ->assertSeeText("User or password is required");
    }
    public function testLoginFailed()
    {
        $this->post('/login', [
            'user' => 'maulana',
            'password' => 'rahasia',
        ])->assertSeeText("User or password is wrong");
    }
}
