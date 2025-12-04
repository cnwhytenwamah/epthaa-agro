<?php

namespace App\Dto;

use App\Dto\BaseDto;
use Illuminate\Support\Str;
use App\Http\Requests\CategoryFormRequest;

readonly class CategoryDto extends BaseDto
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public string $name,
        public ?string $slug = null,
        public ?string $description = null,
        public ?string $image = null,
        public bool $isActive = true
    ) {
        if ($this->slug === null) {}
    }

    /**
     * Convert DTO to array
     */
    public function toArray(): array
    {
        return $this->extractToArray([
            'slug'        => $this->slug ?? Str::slug($this->name),
            'name'        => $this->name,
            'description' => $this->description,
            'image'       => $this->image,
            'is_active'  => $this->isActive,
        ]);
    }

    /**
     * Create DTO from validated form request
     */
    public static function formData(CategoryFormRequest $request): self
    {
        $name = $request->validated(key: 'name');
        $slug = $request->validated(key: 'slug') ?? Str::slug($name);

        return new self(
            name: $name,
            slug: $slug,
            description: $request->validated(key: 'description'),
            image: $request->validated(key: 'image'),
            isActive: $request->validated(key: 'is_active') ?? true,
        );
    }
}
