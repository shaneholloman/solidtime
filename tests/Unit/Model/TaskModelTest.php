<?php

declare(strict_types=1);

namespace Tests\Unit\Model;

use App\Models\Member;
use App\Models\Organization;
use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\Task;
use App\Models\TimeEntry;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Task::class)]
class TaskModelTest extends ModelTestAbstract
{
    public function test_it_belongs_to_a_organization(): void
    {
        // Arrange
        $organization = Organization::factory()->create();
        $task = Task::factory()->forOrganization($organization)->create();

        // Act
        $task->refresh();
        $organizationRel = $task->organization;

        // Assert
        $this->assertNotNull($organizationRel);
        $this->assertTrue($organizationRel->is($organization));
    }

    public function test_it_belongs_to_a_project(): void
    {
        // Arrange
        $project = Project::factory()->create();
        $task = Task::factory()->forProject($project)->create();

        // Act
        $task->refresh();
        $projectRel = $task->project;

        // Assert
        $this->assertNotNull($projectRel);
        $this->assertTrue($projectRel->is($project));
    }

    public function test_it_has_many_time_entries(): void
    {
        // Arrange
        $otherTask = Task::factory()->create();
        $task = Task::factory()->create();
        $timeEntries = TimeEntry::factory()->forTask($task)->count(3)->create();
        $otherTimeEntries = TimeEntry::factory()->forTask($otherTask)->count(2)->create();

        // Act
        $task->refresh();
        $timeEntries = $task->timeEntries;

        // Assert
        $this->assertCount(3, $timeEntries);
    }

    public function test_scope_visible_by_user_filters_so_that_only_tasks_of_public_projects_or_projects_where_the_user_is_member_are_shown(): void
    {
        // Arrange
        $member = Member::factory()->create();
        $projectPrivate = Project::factory()->isPrivate()->create();
        $projectPublic = Project::factory()->isPublic()->create();
        $projectPrivateButMember = Project::factory()->isPrivate()->create();
        ProjectMember::factory()->forProject($projectPrivateButMember)->forMember($member)->create();
        $taskPrivate = Task::factory()->forProject($projectPrivate)->create();
        $taskPublic = Task::factory()->forProject($projectPublic)->create();
        $taskPrivateButMember = Task::factory()->forProject($projectPrivateButMember)->create();

        // Act
        $tasksVisible = Task::query()->visibleByEmployee($member->user)->get();
        $allTasks = Task::query()->get();

        // Assert
        $this->assertEqualsIdsOfEloquentCollection([
            $taskPublic->getKey(),
            $taskPrivateButMember->getKey(),
        ], $tasksVisible);
        $this->assertEqualsIdsOfEloquentCollection([
            $taskPrivate->getKey(),
            $taskPublic->getKey(),
            $taskPrivateButMember->getKey(),
        ], $allTasks);
    }

    public function test_accessor_is_done_is_true_if_done_at_is_not_null(): void
    {
        // Arrange
        $task = Task::factory()->isDone()->create();

        // Act
        $task->refresh();

        // Assert
        $this->assertTrue($task->is_done);
    }

    public function test_accessor_is_done_is_false_if_done_at_is_null(): void
    {
        // Arrange
        $task = Task::factory()->create();

        // Act
        $task->refresh();

        // Assert
        $this->assertFalse($task->is_done);
    }

    public function test_task_can_store_big_amounts_of_spent_time(): void
    {
        // Arrange
        $task = Task::factory()->create();
        $spentTime = 100 * 365 * 24 * 60 * 60; // 100 years in seconds

        // Act
        $task->spent_time = $spentTime;
        $task->save();
        $task->refresh();

        // Assert
        $this->assertSame($spentTime, $task->spent_time);
    }
}
