<?php
namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class OrderApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // إعداد المستخدم والمنتجات للاختبارات
        $this->user = \App\Models\User::factory()->create();
        $this->products = Product::factory()->count(3)->create();
    }

    public function test_user_can_create_order_with_products()
    {
        $this->actingAs($this->user);

        $response = $this->postJson('/api/orders', [
            'total_amount' => 100.00,
            'products' => [
                ['id' => $this->products[0]->id, 'quantity' => 2],
                ['id' => $this->products[1]->id, 'quantity' => 1],
            ],
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('orders', [
            'user_id' => $this->user->id,
            'total_amount' => 100.00,
        ]);
        $this->assertDatabaseHas('order_product', [
            'order_id' => $response->json('id'),
            'product_id' => $this->products[0]->id,
            'quantity' => 2,
        ]);
    }

    public function test_user_can_view_his_orders()
    {
        $this->actingAs($this->user);

        $order = Order::create([
            'user_id' => $this->user->id,
            'total_amount' => 150.00,
        ]);
        
        $order->products()->attach($this->products[0]->id, ['quantity' => 1]);

        $response = $this->getJson('/api/orders');

        $response->assertStatus(200);
        $response->assertJsonFragment(['total_amount' => 150.00]);
    }

    public function test_user_can_view_specific_order_with_products()
    {
        $this->actingAs($this->user);

        $order = Order::create([
            'user_id' => $this->user->id,
            'total_amount' => 200.00,
        ]);
        
        $order->products()->attach($this->products[1]->id, ['quantity' => 1]);

        $response = $this->getJson('/api/orders/' . $order->id);

        $response->assertStatus(200);
        $response->assertJsonFragment(['total_amount' => 200.00]);
        $response->assertJsonFragment(['id' => $this->products[1]->id]);
    }

    public function test_user_can_delete_order()
    {
        $this->actingAs($this->user);

        $order = Order::create([
            'user_id' => $this->user->id,
            'total_amount' => 100.00,
        ]);

        $response = $this->deleteJson('/api/orders/' . $order->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('orders', ['id' => $order->id]);
    }

    public function test_order_requires_total_amount()
    {
        $this->actingAs($this->user);

        $response = $this->postJson('/api/orders', [
            'products' => [
                ['id' => $this->products[0]->id, 'quantity' => 2],
            ],
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['total_amount']);
    }

    public function test_order_requires_products()
    {
        $this->actingAs($this->user);

        $response = $this->postJson('/api/orders', [
            'total_amount' => 100.00,
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['products']);
    }
}
