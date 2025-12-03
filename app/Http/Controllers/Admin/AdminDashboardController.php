<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Services\Admin\ProductService;
use App\Http\Controllers\BaseController;
use App\Services\Admin\Auth\AdminLoginService;


class AdminDashboardController extends BaseController
{
    public function __construct(
        protected AdminLoginService $loginService,
        protected ProductService $productService,
    ){}

    public function index():View
    {
        $title = "EPTHAA AGRO LIMITED | Dashboard";
        $description = "Estate Surveyors and valuers";
        $keywords = "Ken, blog, news";
        $totalproducts = $this->productService->totalPublishedproducts();
        $totalproductCatgories = $this->productService->totalRecords();
       
        return view('admin.dashboard.index', compact('title', 'description', 'keywords', 'totalproducts', 'totalproductCatgories' ));
    }

    public function logout():RedirectResponse
    {
        $response = $this->loginService->logout();

        return redirect()->route('admin.login')->with('success', $response->message);
    }
}
