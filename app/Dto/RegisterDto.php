<?php

namespace App\Dto;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\RegisterFormRequest;

readonly class RegisterDto extends BaseDto
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
    ){}


    public function toArray():array
    {
        return $this->extractToArray([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
    }

    public static function formData(array $request):RegisterDto
    {
        return new self(
            name: $request['name'],
            email: $request['email'],
            password: $request['password']
        );
    }
}
