<?php

namespace App\Services\Admin\Auth;

use stdClass;
use Exception;
use App\Dto\RegisterDto;
use App\Services\BaseService;
use App\Repositories\Interface\AdminRepositoryInterface;
use App\Http\Requests\Auth\Admin\AdminRegisterFormRequest;

class AdminRegisterService extends BaseService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected AdminRepositoryInterface $adminRepository
    ){}

    public function register(AdminRegisterFormRequest $request):stdClass
    {
        $validated = $request->validated();
        try{
            $registerDto = RegisterDto::formData($validated);
            $this->adminRepository->create($registerDto->toArray());
            return $this->successMsg("registration success");
        }catch(Exception $e){
            return $this->errorMsg($e->getMessage(), 422);
        }
    }
}
