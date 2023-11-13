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
    public function testLoginPageForMember()
    {
        $this->withSession(['user' => 'maulana'])
            ->get('/login')
            ->assertRedirect('/');
    }

    public function testLoginSuccess()
    {
        $this->post('/login', [
            'user' => 'maulana',
            'password' => 'secret',
        ])->assertRedirect('/')
        ->assertSessionHas('user', 'maulana');
    }
    public function testLoginForUserAlreadyLogin()
    {
        $this->withSession(['user' => 'maulana'])->post('/login', [
            'user' => 'maulana',
            'password' => 'secret',
        ])->assertRedirect('/');
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
    public function testLogout()
    {
        $this->withSession(['user' => 'maulana'])
        ->post('/logout')
        ->assertRedirect('/')
        ->assertSessionMissing('user');
    }
    public function testLogoutGuest()
    {
        $this->post('/logout')
        ->assertRedirect('/');
    }
}
