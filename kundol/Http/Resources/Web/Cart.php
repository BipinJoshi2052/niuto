<?php

namespace App\Http\Resources\Web;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Admin\ProductDetail as ProductDetailResource;
use App\Http\Resources\Admin\ProductCategory as ProductCategoryResource;
use App\Http\Resources\Admin\Gallary as GallaryResource;
use App\Models\Admin\Gallary;
use App\Models\Admin\Product;
use App\Models\Admin\ProductCombinationDtl;
use App\Http\Resources\Admin\ProductCombinationDtl as ProductCombinationDtlResource;
use App\Http\Resources\Admin\ProductCombination as ProductCombinationResource;
use App\Models\Admin\Currency;

class Cart extends JsonResource
{
    public function toArray($request)
    {
        $this->exchange_rate = 1;
        $currency = [];
        $product = Product::findOrFail($this->product_id);
        if (isset($request->currency) && $request->currency != '') {
            $currency = Currency::findByCurrencyId($request->currency)->select('exchange_rate', 'symbol_position', 'code')->first();
            $this->exchange_rate = $currency->exchange_rate;
        }
        return [
            'session' => $this->session_id,
            'product_id' => $this->product_id,
            'product_slug' => $this->product->product_slug,
            'product_weight' => $this->product->product_weight ? $this->product->product_weight : 0,
            'product_type' => $this->product->product_type,
            'product_combination_id' => $this->product_combination_id,
            'product_combination' => ProductCombinationDtlResource::collection(ProductCombinationDtl::where('product_combination_id', $this->product_combination_id)->get()),
            'combination' => ProductCombinationResource::collection($this->when($this->product->product_type == 'variable', $this->product->product_combination)),
            'qty' => $this->qty,
            'product_detail' => ProductDetailResource::collection($this->product->detail),
            'product_gallary' => new GallaryResource(Gallary::with('detail')->find($this->product->gallary_id)),
            'customer' => $this->customer,
            'category_detail' => ProductCategoryResource::collection($this->product->category),
            'price' => $this->product->price * $this->exchange_rate,
            'product_price_symbol' => !isset($currency->symbol_position) ? $this->prices * $this->exchange_rate : ($currency->symbol_position == 'right' ? ($this->prices * $this->exchange_rate) . ' ' . $currency->code : $currency->code . ' ' . ($this->prices * $this->exchange_rate)),
            'discount_price' => $product->discount_price * $this->exchange_rate,
            'product_discount_price_symbol' => !isset($currency->symbol_position) ? $product->discount_price * $this->exchange_rate : ($currency->symbol_position == 'right' ? ($product->discount_price * $this->exchange_rate) . ' ' . $currency->code : $currency->code . ' ' . ($product->discount_price * $this->exchange_rate)),
            'total' => (($this->prices * $this->exchange_rate) - ($this->discounts * $this->exchange_rate)) * $this->qty,
            'currency' => $currency,
            // 'availableQty' => $this->availableQty,
        ];
    }
}
