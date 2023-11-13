<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\UserService;

use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userService = $this->app->make(UserService::class);

    }
    public function testSample()
    {
        self::assertTrue(true);
    }

    public function testLoginSuccess()
    {
        assertTrue($this->userService->login("maulana", "secret"));
    }

    public function testLoginUserNotFound()
    {
        assertFalse($this->userService->login("asyifa", "secret"));
    }
    public function testLoginWrongPassword()
    {
        assertFalse($this->userService->login("maulana", "rahasia"));
    }
}
