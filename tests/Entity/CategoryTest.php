<?php

namespace App\Tests\Entity;

use App\Entity\Category;
use App\Entity\Lesson;
use PHPUnit\Framework\TestCase;

final class CategoryTest extends TestCase
{
    public function testCategoryTitleCanBeSet(): void
    {
        $category = new Category();

        $category->setTitle('ADHD');

        self::assertSame('ADHD', $category->getTitle());
    }

    public function testCategoryCanContainLesson(): void
    {
        $category = new Category();
        $lesson = new Lesson();

        $category->addLesson($lesson);

        self::assertTrue($category->getLessons()->contains($lesson));
        self::assertSame($category, $lesson->getCategory());
    }
}
