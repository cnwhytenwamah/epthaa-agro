<?php

namespace App\Dto;

use App\Enum\PaymentMethod;
use App\Enum\PaymentStatus;
use App\Enum\PaymentReference;


readonly class OrderDto extends BaseDto
{
    /**
     * @param OrderItemDto[] $items
     */
    public function __construct(
        public ?int $user_id,
        public string $order_number,
        public string $customer_name,
        public string $customer_email,
        public string $customer_phone,
        public string $delivery_address,
        public string $city,
        public string $state,
        public float $subtotal,
        public float $delivery_fee,
        public float $total,
        public PaymentMethod $payment_method,
        public PaymentStatus $payment_status,
        public ?PaymentReference $payment_reference,
        public string $order_status,
        public ?string $notes,
        public array $items
    ) {}

    public function toArray(): array
    {
        return $this->extractToArray([
            'user_id' => $this->user_id,
            'order_number' => $this->order_number,
            'customer_name' => $this->customer_name,
            'customer_email' => $this->customer_email,
            'customer_phone' => $this->customer_phone,
            'delivery_address' => $this->delivery_address,
            'city' => $this->city,
            'state' => $this->state,
            'subtotal' => $this->subtotal,
            'delivery_fee' => $this->delivery_fee,
            'total' => $this->total,
            'payment_method' => $this->payment_method,
            'payment_status' => $this->payment_status,
            'payment_reference' => $this->payment_reference,
            'order_status' => $this->order_status,
            'notes' => $this->notes,
        ]);
    }

    public static function formData(BookingFormRequest $request): BookingDto
    {
        return new self(
            user_id: $request->validated('user_id') ?? null,
            order_number: $request->validated('order_number'),
            customer_name: $request->validated('customer_name'),
            customer_email: $request->validated('customer_email'),
            customer_phone: $request->validated('customer_phone'),
            delivery_address: $request->validated('delivery_address'),
            city: $request->validated('city'),
            state: $request->validated('state'),
            subtotal: $request->validated('subtotal'),
            delivery_fee: $request->validated('delivery_fee'),
            total: $request->validated('total'),
            payment_method: PaymentMethod::from($data['payment_method']),
            payment_status: PaymentStatus::from(['payment_status']),
            payment_reference: PaymentReference::from(['payment_reference']),
            order_status: $request->validated('order_status'),
            notes: $request->validated('notes'),
        );
    }
}
