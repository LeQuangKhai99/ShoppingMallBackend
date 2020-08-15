<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;

use App\Category;
use App\Component\Recusive;
use App\Http\Requests\ProductAddRequest;
use App\Product;
use App\ProductImage;
use App\ProductTag;
use App\Tag;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Component\MultipleImage;
use App\Component\LoadTagOption;

class ProductController extends Controller
{
    use StorageImageTrait;
    private $product, $productImage, $cate, $tag, $productTag, $multipleImage, $loadingTag;
    public function __construct(Product $product, ProductImage $productImage, Category $cate, Tag $tag, ProductTag  $productTag, MultipleImage $multipleImage, LoadTagOption $loadingTag){
        $this->product = $product;
        $this->productImage = $productImage;
        $this->cate = $cate;
        $this->tag = $tag;
        $this->productTag = $productTag;
        $this->multipleImage = $multipleImage;
        $this->loadingTag = $loadingTag;
    }

    public function index(){
        $products = $this->product
            ->latest()->paginate(5);
        return view('admin.product.index', ['products'=>$products]);
    }

    public function create(){
        $data = $this->cate->all();
        $recusive = new Recusive($data);
        $html = $recusive->Option('', 0, null);
        return view('admin.product.create', ['html'=>$html]);
    }

    public function postCreate(ProductAddRequest $request){
        try {
            DB::beginTransaction();
            $dataCreateProduct = [
                'name'=>$request->name,
                'price'=>$request->price,
                'content'=>$request->content1,
                'user_id'=>\auth()->user()->id ,
                'category_id'=>$request->cate,
                'slug'=>str_slug($request->name),
            ];
            $data = $this->Upload($request, 'image', 'product');
            if ($data != null){

                $dataCreateProduct['feature_image_path'] = $data['file_path'];
                $dataCreateProduct['feature_image_name'] = $data['file_name'];
            }
            $product = $this->product->create($dataCreateProduct);

            // insert data to product_images
            if ($request->hasFile('images')){
                foreach ($request->images as $image){
                    $dataCreateProductImages = $this->UploadMultiple($image, 'product');
                    $product->images()->create([
                        'image_path'=>$dataCreateProductImages['file_path'],
                        'image_name'=>$dataCreateProductImages['file_name']
                    ]);
                }
            }

            // insert data to tags
            $tagIds = array();
            foreach ($request->tags as $tag){
                $tagInstance = $this->tag->firstOrCreate([
                    'name'=>$tag
                ]);

                $tagIds[] = $tagInstance->id;
            }

            $product->tags()->attach($tagIds);
            DB::commit();

            return redirect()->route('products.index');
        }
        catch (\Exception $exception){
            DB::rollBack();
        }

    }

    public  function edit($id){
        $product = $this->product->find($id);

        $imgs = $product->images()->get();
        $htmlListImg = $this->multipleImage->RenderImage($imgs);

        $data = $this->cate->all();
        $recusive = new Recusive($data);
        $htmlOptionCate = $recusive->Option('', 0, $product->category_id);

        $tags = $product->tags()->get();
        $htmlOPtionTag = $this->loadingTag->RenderTag($tags);
        return view('admin.product.edit', ['product'=>$product, 'htmlImg'=>$htmlListImg, 'htmlOptionCate'=>$htmlOptionCate, 'htmlOptionTag'=>$htmlOPtionTag]);
    }

    public function postEdit(Request $request, $id){
        try {
            DB::beginTransaction();
            $dataUpdateProduct = [
                'name'=>$request->name,
                'price'=>$request->price,
                'content'=>$request->content1,
                'user_id'=>1,
                'category_id'=>$request->cate,
                'slug'=>str_slug($request->name),
            ];
            $data = $this->Upload($request, 'image', 'product');
            if ($data != null){

                $dataUpdateProduct['feature_image_path'] = $data['file_path'];
                $dataUpdateProduct['feature_image_name'] = $data['file_name'];
            }
            $this->product->find($id)->update($dataUpdateProduct);
            $product = $this->product->find($id);
            // insert data to product_images
            if ($request->hasFile('images')){
                $this->productImage->where('product_id', '=', $id)->delete();
                foreach ($request->images as $image){
                    $dataCreateProductImages = $this->UploadMultiple($image, 'product');
                    $product->images()->create([
                        'image_path'=>$dataCreateProductImages['file_path'],
                        'image_name'=>$dataCreateProductImages['file_name']
                    ]);
                }
            }

            // insert data to tags
            $tagIds = [];
            if (!empty($request->tags)){
                foreach ($request->tags as $tag){
                    $tagInstance = $this->tag->firstOrCreate([
                        'name'=>$tag
                    ]);

                    $tagIds[] = $tagInstance->id;
                }
            }

            $product->tags()->sync($tagIds);
            DB::commit();

            return redirect()->route('products.index');
        }
        catch (\Exception $exception){
            DB::rollBack();

        }
    }

    public function delete($id){
        try {
            $this->product->find($id)->delete();
            return response()->json([
                'code'=>200,
                'mess'=>'success',
            ], 200);
        }
        catch (\Exception $e){
            return response()->json([
                'code'=>500,
                'message'=>'fail'
            ], 500);
        }
    }
}
