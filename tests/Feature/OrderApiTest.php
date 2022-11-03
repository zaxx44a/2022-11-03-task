<?php

namespace Tests\Feature;

use App\Mail\RunOutMail;
use App\Models\Ingredient;
use App\Models\Order;
use Tests\Tools\AuthedRequestSuite;
use Illuminate\Support\Facades\Mail;

class OrderApiTest extends AuthedRequestSuite
{

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_accept_orders_sucessfully()
    {
        $this->authenticate();
        $emptyOrder = Order::all();
        $response = $this->postJson('/api/orders', [
            "products" =>[
                ["product_id" => 1, "quantity" => 2]
            ]
        ]);

        $fullOrder = Order::all();
        $this->assertEquals($emptyOrder->count(), 0);
        $this->assertEquals($fullOrder->count(), 1);
        $this->assertEquals($fullOrder->first()->product->count(), 1);
        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_products_ingredients_quantity_should_be_subtracted()
    {
        $this->authenticate();

        $this->postJson('/api/orders', [
            "products" =>[
                ["product_id" => 1, "quantity" => 2]
            ]
        ]);

        $requestSubtracted = Ingredient::all()->keyBy('name');
        $this->assertEquals($requestSubtracted['Beef']->current, 19700);
        $this->assertEquals($requestSubtracted['Cheese']->current, 4940);
        $this->assertEquals($requestSubtracted['Onion']->current, 960);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_should_send_one_email_if_ingredient_less_than_threshold()
    {
        $this->authenticate();
        Mail::fake();
        $ingredients = Ingredient::all()->keyBy('name');
        $ingredients['Beef']->current = 10001;
        $ingredients['Beef']->save();
        $response = $this->postJson('/api/orders', [
            "products" =>[
                ["product_id" => 1, "quantity" => 2]
            ]
        ]);
        $this->assertEquals($ingredients['Beef']->refresh()->current, 9701);
        Mail::assertSent(RunOutMail::class, 1);

        $response = $this->postJson('/api/orders', [
            "products" =>[
                ["product_id" => 1, "quantity" => 2]
            ]
        ]);
        Mail::assertSent(RunOutMail::class, 1);
        $this->assertEquals($ingredients['Beef']->refresh()->current, 9401);

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_should_return_401_for_un_authed_users()
    {
        $response = $this->postJson('/api/orders', [], ['headers' => ['Accept' => 'application/json'] ]);
        $response->assertStatus(401);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_return_422_for_validation()
    {
        $this->authenticate();
        $response = $this->postJson('/api/orders', []);
        $response->assertStatus(422);
        $response2 = $this->postJson('/api/orders', [ "products" =>[ ["product_id" => 1] ] ]);
        $response2->assertStatus(422);
        $response3 = $this->postJson('/api/orders', [ "products" =>[ ["quantity" => 1] ] ]);
        $response3->assertStatus(422);
        $response4 = $this->postJson('/api/orders', [ "productss" =>[ ["product_id" => 1, "quantity" => 1] ] ]);
        $response4->assertStatus(422);
        $response5 = $this->postJson('/api/orders', [ "products" =>[ ["product_ids" => 1, "quantity" => 1] ] ]);
        $response5->assertStatus(422);
        $response6 = $this->postJson('/api/orders', [ "products" =>[ ["product_id" => 1, "quantitys" => 1] ] ]);
        $response6->assertStatus(422);
    }
}
