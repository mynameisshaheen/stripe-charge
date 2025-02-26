<?php

namespace App\Repositories;

interface ProductRepositoryInterface
{
    public function getAllProducts();
    public function getProduct($id);
    public function createPaymentIntent($product);
}