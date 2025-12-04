<?php

namespace App\Dto;

use App\Dto\BaseDto;
use App\Enum\Status;
use App\Http\Requests\BookingFormRequest;

readonly class BookingDto extends BaseDto
{
    public function __construct(
        public int $service_id,
        public ?int $user_id,
        public string $client_name,
        public string $client_phone,
        public ?string $client_email,
        public string $animal_type,
        public string $location,
        public string $preferred_date,
        public ?string $preferred_time,
        public string $issue_description,
        public Status   $status,
        public ?string $admin_notes = null,
    ) {}

    public function toArray(): array
    {
        return $this->extractToArray([
            'service_id' => $this->service_id,
            'user_id' => $this->user_id,
            'client_name' => $this->client_name,
            'client_phone' => $this->client_phone,
            'client_email' => $this->client_email,
            'animal_type' => $this->animal_type,
            'location' => $this->location,
            'preferred_date' => $this->preferred_date,
            'preferred_time' => $this->preferred_time,
            'issue_description' => $this->issue_description,
            'status'         => $this->status->value,
            'admin_notes' => $this->admin_notes,
        ]);
    }

    public static function formData(BookingFormRequest $request): BookingDto
    {
        return new self(
            service_id: $request->validated('service_id'),
            user_id: $request->validated('user_id') ?? null,
            client_name: $request->validated('client_name'),
            client_phone: $request->validated('client_phone'),
            client_email: $request->validated('client_email') ?? null,
            animal_type: $request->validated('animal_type'),
            location: $request->validated('location'),
            preferred_date: $request->validated('preferred_date'),
            preferred_time: $request->validated('preferred_time') ?? null,
            issue_description: $request->validated('issue_description'),
            status: Status::from($data['status']),
            admin_notes: $request->validated('admin_notes') ?? null,
        );
    }
}