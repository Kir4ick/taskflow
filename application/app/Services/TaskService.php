<?php

namespace App\Services;

use App\Models\Task;
use App\Models\UsersWorked;
use Illuminate\Database\Eloquent\Collection;

class TaskService
{

    public function list(int $dashboardId): Collection
    {
        $list = Task::with([
            'user',
            'usersWorkers',
            'usersWorkers.user',
            'taskFiles',
            'taskComments',
            'taskHistories',
            'taskTimes',
        ])->where('dashboard_id', $dashboardId)->get();

        return $list->map(function (Task $task) {
            return $this->mapTask($task);
        });
    }

    private function mapTask(Task $item): array
    {
        return [
            'id' => $item->id,
            'title' => $item->title,
            'description' => $item->description,
            'endDate' => $item->end_date,
            'type' => $item->type,
            'priority' => $item->priority,
            'user' => [
                'id' => $item->user->id,
                'name' => $item->user->name,
                'email' => $item->user->email,
            ],
            'files' => $item->taskFiles,
            'comments' => $item->taskComments,
            'statusHistory' => $item->taskHistories,
            'times' => $item->taskTimes,
            'userWorkers' => $item->usersWorkers->map(function (UsersWorked $usersWorked) {
                return [
                    'id' => $usersWorked->user->id,
                    'name' => $usersWorked->user->name,
                    'email' => $usersWorked->user->email,
                ];
            }),
        ];
    }

    public function create(
        int $dashboardId,
        string $title,
        string $description,
        int $type,
        int $priority,
        string $endDate,
        int $createdBy
    ): array
    {
        $task = new Task();
        $task->title = $title;
        $task->description = $description;
        $task->type = $type;
        $task->priority = $priority;
        $task->end_date = $endDate;
        $task->created_by = $createdBy;
        $task->dashboard_id = $dashboardId;

        $task->save();

        return $this->mapTask($task);
    }

    public function remove($taskId): bool
    {
        $task = Task::query()->find($taskId);
        if (!$task) {
            return false;
        }

        return (bool)$task->delete();
    }

    public function update(int $taskId, array $data): ?Task
    {
        $task = Task::query()->find($taskId);
        if (!$task) {
            return null;
        }

        $result = $task->update($data);
        if (!$result) {
            return null;
        }

        return $task;
    }

}
