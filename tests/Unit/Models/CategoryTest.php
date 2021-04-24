<?php

namespace Tests\Unit\Models;

use Tests\Stubs\Models\CategoryStub;
use Tests\Stubs\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    private $category;

    protected function setUp(): void
    {
        parent::setUp();
        $this->category = new CategoryStub();
    }

    public function testIfUseTraits()
    {

        $traits = [
            SoftDeletes::class, Uuid::class
        ];
        $categoryTraits = array_keys(class_uses(CategoryStub::class));
        $this->assertEquals($traits, $categoryTraits);

    }

    public function testDatesAttribute()
    {
        $dates = ['deleted_at', 'created_at', 'updated_at'];

        foreach ($dates as $date) {
            $this->assertContains($date, $this->category->getDates());
        }
        $this->assertCount(count($dates), $this->category->getDates());
    }

    public function testCats()
    {
        $casts = ["id" => 'string', 'is_active' => 'boolean'];

        $this->assertEquals($casts, $this->category->getCasts());

    }

    public function testIncrementing()
    {
        $category = new CategoryStub();
        $this->assertFalse($this->category->incrementing);

    }
}
