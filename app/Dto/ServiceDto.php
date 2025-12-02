<?php

namespace App\Dto\Service;

use App\Http\Requests\ServiceFormRequest;
use App\Dto\BaseDto;

readonly class ServiceDto extends BaseDto
{
    public function __construct(
        public string  $title,
        public string  $slug,
        public string  $description,
        public ?string $details,
        public ?string $image,
        public ?float  $price,
        public bool    $is_active = true,
    ) {}

    /**
     * Convert DTO to array for persistence.
     */
    public function toArray(): array
    {
        return $this->extractToArray([
            'title'       => $this->title,
            'slug'        => $this->slug,
            'description' => $this->description,
            'details'     => $this->details,
            'image'       => $this->image,
            'price'       => $this->price,
            'is_active'   => $this->is_active,
        ]);
    }

    /**
     * Build DTO from validated form request.
     */
    public static function formData(ServiceFormRequest $request): ServiceDto
    {
        $data = $request->validated();

        return new self(
            title: $data['title'],
            slug: $data['slug'],
            description: $data['description'],
            details: $data['details'] ?? null,
            image: $data['image'] ?? null,
            price: isset($data['price']) ? (float)$data['price'] : null,
            is_active: isset($data['is_active']) ? (bool)$data['is_active'] : true,
        );
    }
}
