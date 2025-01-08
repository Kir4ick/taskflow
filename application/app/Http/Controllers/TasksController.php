<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tasks\CreateTaskRequest;
use App\Http\Requests\Tasks\ListTasksRequest;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

final readonly class TasksController
{

    public function __construct(
        private TaskService $taskService,
    )
    {}

    public function index(ListTasksRequest $request): Response
    {
        $taskList = $this->taskService->list($request->get('dashboardId'));

        return Inertia::render('views/TaskList', [
            'taskList' => $taskList,
        ]);
    }

    public function create(CreateTaskRequest $request): JsonResponse
    {
        $createdUser = Auth::user()->getAuthIdentifier();

        $task = $this->taskService->create(
            $request->post('dashboardId'),
            $request->post('title'),
            $request->post('description'),
            $request->post('type'),
            $request->post('priority'),
            $request->post('endDate'),
            $createdUser
        );

        return response()->json($task);
    }

    public function remove(int $taskId): JsonResponse
    {
        $result = $this->taskService->remove($taskId);

        return response()->json(['result' => $result]);
    }
}
