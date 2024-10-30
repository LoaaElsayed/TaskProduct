<?php

namespace App\Repositories\Products;

use App\Helper\ApiResponse;
use App\Http\resources\ProductResource;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;
use App\Models\ProductImage;
use Exception;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class ProductRepository implements ProductInterface
{
    public function __construct(
        protected Product $model,
        protected ProductAttribute $productAttribute,
        protected ProductImage $productImage,
        protected ProductAttributeValue $productAttributeValue
    ){}


    public function index($request) {
        $collection = QueryBuilder::for(Product::class)
            ->allowedFilters(['name', 'price'])
            ->allowedSorts(['name', 'price'])
            ->paginate(10);

        return ProductResource::collection($collection);
    }

    public function store($request){
        DB::beginTransaction();
        try{
            $product = $this->model->create([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'quantity' => $request->quantity,
            ]);
            foreach($request->attribute_name as $key => $attribuets){
                $attribute = $this->productAttribute->create([
                    'name' => $attribuets,
                    'product_id' => $product->id,
                ]);
            }
            if (isset($request->attribute_values[$key])) {
                foreach ($request->attribute_values[$key] as $valueIndex => $attributeValue) {
                    $this->productAttributeValue->create([
                        'value' => $attributeValue,
                        'price' => $request->attribute_prices[$key][$valueIndex] ?? null,
                        'product_attribute_id' => $attribute->id,
                    ]);
                }
            }
            if($request->image){
                $file = $request->image;
                $file_name = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('upload/prpduct'), $file_name);
                $this->productImage->create([
                    'image' => $file_name,
                    'product_id' => $product->id,
                ]);
            }else{
                $this->productImage->create([
                    'image' => 'upload/product/image.jpg',
                    'product_id' => $product->id,
                ]);
            }
            $data = new ProductResource($product);
            DB::commit();
            return ApiResponse::sendresponse(200,'Added successfully',$data);
        }catch(Exception $e){
            DB::rollBack();
            return ApiResponse::sendresponse(500,'Error while adding product');
        }
    }




}
