<?php
namespace App\Tests\Entity;

use App\Entity\Tasks;
use PHPUnit\Framework\TestCase;

class TasksTest extends TestCase
{
    public function testSetTitre()
    {
        $task = new Tasks();
        $task->setTitre('Test Task');

        $this->assertSame('Test Task', $task->getTitre());
    }

    public function testSetJourDate()
    {
        $task = new Tasks();
        $task->setJourDate('2024-05-27');

        $this->assertSame('2024-05-27', $task->getJourDate());
    }
}
