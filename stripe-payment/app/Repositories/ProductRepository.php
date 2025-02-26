<?php

namespace App\Repositories;

use App\Models\Product;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class ProductRepository implements ProductRepositoryInterface
{
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function getAllProducts()
    {
        return $this->model->all();
    }

    public function getProduct($id)
    {
        return $this->model->find($id);
    }

    public function createPaymentIntent($product)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $intent =  PaymentIntent::create([
            'amount' => $product->price * 100,
            'currency' => 'usd',
        ]);

        return $intent;
    }
}