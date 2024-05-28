<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testGetId()
    {
        $user = new User();
        $this->assertNull($user->getId());
    }

    public function testGetSetEmail()
    {
        $user = new User();
        $email = 'test@example.com';
        $user->setEmail($email);
        $this->assertEquals($email, $user->getEmail());
    }

    public function testGetSetRoles()
    {
        $user = new User();
        $roles = ['ROLE_ADMIN'];
        $user->setRoles($roles);
        $this->assertContains('ROLE_ADMIN', $user->getRoles());
        $this->assertContains('ROLE_USER', $user->getRoles()); // ROLE_USER should be added by default
    }

    public function testGetSetPassword()
    {
        $user = new User();
        $password = 'hashedpassword';
        $user->setPassword($password);
        $this->assertEquals($password, $user->getPassword());
    }

    public function testGetSetNom()
    {
        $user = new User();
        $nom = 'Doe';
        $user->setNom($nom);
        $this->assertEquals($nom, $user->getNom());
    }

    public function testAddRemoveTask()
    {
        $user = new User();
        $task = $this->createMock(\App\Entity\Tasks::class);
        
        // Expect the task to have setUser called twice (once for add, once for remove)
        $task->expects($this->exactly(2))
            ->method('setUser')
            ->withConsecutive(
                [$this->equalTo($user)], // First call with $user
                [$this->equalTo(null)]   // Second call with null
            );

        $user->addTask($task);
        $this->assertCount(1, $user->getTask());
        $this->assertTrue($user->getTask()->contains($task));

        $task->expects($this->once())
            ->method('getUser')
            ->willReturn($user);

        $user->removeTask($task);
        $this->assertCount(0, $user->getTask());
        $this->assertFalse($user->getTask()->contains($task));
    }
}
