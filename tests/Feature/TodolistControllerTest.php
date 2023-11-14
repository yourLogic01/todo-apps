<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testTodoList()
    {
        $this->withSession([
            "user" => "maulana",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "Belajar Laravel"
                ],
                [
                    "id" => "2",
                    "todo" => "Belajar Laravel 2"
                ]
            ]
        ])->get("/todolist")->assertSeeText("1")
        ->assertSeeText("Belajar Laravel")
        ->assertSeeText("2")
        ->assertSeeText("Belajar Laravel 2");
    }
}
