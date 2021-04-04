<?php

namespace Tests\Feature\Models;

use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use DatabaseMigrations;

    public function testList()
    {
        factory(Category::class, 1)->create();
        $categories = Category::all();
        $this->assertCount(1, $categories);
        $cateKey = array_keys($categories->first()->getAttributes());
        $this->assertEqualsCanonicalizing(
            [
                'id',
                'name',
                'description',
                'created_at',
                'is_active',
                'updated_at',
                'deleted_at'
            ],
            $cateKey);
    }

    public function testeCreate(){
        $category = Category::create([
            'name' => 'test1'
        ]);

        $category->refresh();
        $this->assertEquals('test1', $category->name);
        $this->assertNull( $category->description);
        $this->assertTrue($category->is_active);

        $category = Category::create([
            'name' => 'test1',
            'description' => null
        ]);

        $this->assertNull($category->description);
        $category = Category::create([
            'name' => 'test1',
            'is_active' => false
        ]);

        $this->assertFalse($category->is_active);
        $this->assertNull($category->description);
        $category = Category::create([
            'name' => 'test1',
            'is_active' => true
        ]);

        $this->assertTrue($category->is_active);


        $category = Category::create([
            'name' => 'test1',
            'description' => 'test_description'
        ]);

        $this->assertEquals('test_description', $category->description);
    }

}
