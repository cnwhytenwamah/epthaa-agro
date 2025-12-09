<?php

namespace App\Dto;

use App\Dto\BaseDto;
use App\Dto\ProductDto;
use Illuminate\Support\Str;
use App\Http\Requests\ProductFormRequest;

readonly class ProductDto extends BaseDto
{
    public function __construct(
        public int $category_id,
        public string $name,
        public ?string $slug = null,
        public string $description,
        public ?string $usage_instructions,
        public ?string $dosage_info,
        public ?string $safety_info,
        public float $price,
        public int $stock_quantity,
        public string $sku,
        // public ?array $images,
        public ?string $packaging_info,
        public bool $is_featured,
        public bool $is_active,
    ) {
        if ($this->slug === null) {}
    }

    public function toArray(): array
    {
        return $this->extractToArray([
            'category_id' => $this->category_id,
            'name' => $this->name,
            'slug' => $this->slug ?? Str::slug($this->name),
            'description' => $this->description,
            'usage_instructions' => $this->usage_instructions,
            'dosage_info' => $this->dosage_info,
            'safety_info' => $this->safety_info,
            'price' => $this->price,
            'stock_quantity' => $this->stock_quantity,
            'sku' => $this->sku,
            // 'images' => $this->images,
            'packaging_info' => $this->packaging_info,
            'is_featured' => $this->is_featured,
            'is_active' => $this->is_active,
        ]);
    }

    public static function formData(ProductFormRequest $request): ProductDto
    {
        $name = $request->validated(key: 'name');
        $slug = $request->validated(key: 'slug') ?? Str::slug($name);

        return new self(
            name: $name,
            slug: $slug,
            category_id: $request->validated('category_id'),
            description: $request->validated('description'),
            usage_instructions: $request->validated('usage_instructions'),
            dosage_info: $request->validated('dosage_info'),
            safety_info: $request->validated('safety_info'),
            price: (float) $request->validated('price'),
            stock_quantity: $request->validated('stock_quantity', 0),
            sku: $request->validated('sku'),
            // images: $request->validated('images'),
            packaging_info: $request->validated('packaging_info'),
            is_featured: $request->validated('is_featured', false),
            is_active: $request->validated('is_active', true),
        );
    }
}
