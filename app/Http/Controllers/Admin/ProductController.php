<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Contracts\BrandContract;
use App\Contracts\CategoryContract;
use App\Contracts\ProductContract;
use App\Http\Controllers\BaseController;

class ProductController extends BaseController
{
    protected $brandRepository;

    protected $categoryRepository;

    protected $productRepository;

    public function __construct(
        BrandContract $brandRepository,
        CategoryContract $categoryRepository,
        ProductContract $productRepository
    )
    {
        $this->brandRepository = $brandRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products = $this->productRepository->listProducts();

        $this->setPageTitle('Products', 'Products List');
        return view('admin.products.index', compact('products'));
    }
    public function store(Request $request)
{
    $params = $request->except('_token');

    $product = $this->productRepository->createProduct($params);

    if (!$product) {
        return $this->responseRedirectBack('Error occurred while creating product.', 'error', true, true);
    }
    return $this->responseRedirect('admin.products.index', 'Product added successfully' ,'success',false, false);
}
public function update(Request $request)
{
    $params = $request->except('_token');

    $product = $this->productRepository->updateProduct($params);

    if (!$product) {
        return $this->responseRedirectBack('Error occurred while updating product.', 'error', true, true);
    }
    return $this->responseRedirect('admin.products.index', 'Product updated successfully' ,'success',false, false);
}
}

