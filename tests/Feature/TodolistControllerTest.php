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

    public function testAddTodoFailed()
    {
        $this->withSession([
            "user" => "maulana",
        ])->post("/todolist", [])
        ->assertSeeText("Todo is required");
    }

    public function testAddTodoSuccess()
    {
        $this->withSession([
            "user" => "maulana",
        ])->post("/todolist", [
            "todo" => "Belajar Laravel"
        ])->assertRedirect("/todolist");
    }

    public function testRemoveTodoSuccess()
    {
        $this->withSession([
            "user" => "maulana",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "Belajar Laravel"
                ]
            ]
        ])->post("/todolist/1/delete")
        ->assertRedirect("/todolist");
    }
}
