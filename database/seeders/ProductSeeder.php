<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Products
        $product1 = Product::create(['name' => 'T-shirt', 'price' =>200,'quantity'=>5,'description'=> 'Coton T-shirt']);
        $product2 = Product::create(['name' => 'Phone', 'price' =>20000,'quantity'=>10,'description'=> 'Samsung phone 2 camera']);
        $product3 = Product::create(['name' => 'Book', 'price' =>50,'quantity'=>20,'description'=> 'romantic book']);

        // Product 1: Color, Size
        $colorAttr = ProductAttribute::create(['name' => 'Color','product_id' => $product1->id,]);
        $sizeAttr = ProductAttribute::create(['name' => 'Size','product_id' => $product1->id,]);


        // Product 2: Storage, Brand, RAM
        $storageAttr = ProductAttribute::create(['name' => 'Storage','product_id' => $product2->id,]);
        $brandAttr = ProductAttribute::create(['name' => 'Brand','product_id' => $product2->id,]);
        $ramAttr = ProductAttribute::create(['name' => 'RAM','product_id' => $product2->id,]);

        // Product 3: Custom Attributes (size)
        $materialAttr = ProductAttribute::create(['name' => 'Size','product_id' => $product3->id]);

        ProductAttributeValue::create(['product_attribute_id' => $colorAttr->id, 'value' => 'Red']);
        ProductAttributeValue::create(['product_attribute_id' => $sizeAttr->id, 'value' => 'Large']);


        ProductAttributeValue::create(['product_attribute_id' => $storageAttr->id, 'value' => '256GB']);
        ProductAttributeValue::create(['product_attribute_id' => $brandAttr->id, 'value' => 'Samsung']);
        ProductAttributeValue::create(['product_attribute_id' => $ramAttr->id, 'value' => '8GB']);


        ProductAttributeValue::create(['product_attribute_id' => $materialAttr->id, 'value' => 'small']);
    }
}
