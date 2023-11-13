<?php

namespace Tests\Feature;

use App\Services\TodolistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class TodolistServiceTest extends TestCase
{
    private TodolistService $todolistService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->todolistService = $this->app->make(TodolistService::class);
    }

    public function testTodolistNotNull()
    {
        self::assertNotNull($this->todolistService);
    }
    public function testSaveTodolist()
    {
        $this->todolistService->saveTodo(
            "1",
            "Belajar Laravel"
        );
        $todolist = Session::get("todolist");
        foreach($todolist as $value)
        {
            self::assertEquals("1", $value["id"]);
            self::assertEquals("Belajar Laravel", $value["todo"]);
        }

    }
    public function testGetTodolistEmpty()
    {
        self::assertEquals([], $this->todolistService->getTodolist());
    }

    public function testGetTodolistNotEmpty()
    {
        $expected = [
            [
                "id" => "1",
                "todo" => "Belajar Laravel"
            ],
            [
                "id" => "2",
                "todo" => "Maulana"
            ]
        ];

        $this->todolistService->saveTodo("1", "Belajar Laravel");
        $this->todolistService->saveTodo("2", "Maulana");

        self::assertEquals($expected, $this->todolistService->getTodolist());
    }

    public function testRemoveTodo()
    {
        $this->todolistService->saveTodo("1", "Belajar Laravel");
        $this->todolistService->saveTodo("2", "Maulana");

        self::assertEquals(2, sizeof($this->todolistService->getTodolist()));

        $this->todolistService->removeTodo("3");

        self::assertEquals(2, sizeof($this->todolistService->getTodolist()));

        $this->todolistService->removeTodo("1");

        self::assertEquals(1, sizeof($this->todolistService->getTodolist()));

        $this->todolistService->removeTodo("2");

        self::assertEquals(0, sizeof($this->todolistService->getTodolist()));
    }
}
