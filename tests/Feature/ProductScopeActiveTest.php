<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductScopeActiveTest extends TestCase
{
    use RefreshDatabase;

    public function test_scope_active_returns_only_active_products(): void
    {
        Product::factory()->create(['status' => 'active']);
        Product::factory()->create(['status' => 'inactive']);

        $this->assertEquals(1, Product::active()->count());
    }
}
