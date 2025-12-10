<?php

namespace App\Services\User\Auth;

use stdClass;
use Exception;
use App\Dto\RegisterDto;
use App\Services\BaseService;
use App\Http\Requests\Auth\User\RegisterFormRequest;
use App\Repositories\Interface\UserRepositoryInterface;

class RegisterService extends BaseService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ){}

    public function register(RegisterFormRequest $request):stdClass
    {
        $validated = $request->validated();
        try{
            $registerDto = RegisterDto::formData($validated);
            $this->userRepository->create($registerDto->toArray());
            return $this->successMsg("registration success");
        }catch(Exception $e){
            return $this->errorMsg($e->getMessage(), 422);
        }
    }
}
