<?php

namespace App\Http\Controllers;

use App\Components\Recusive;
use App\Http\Requests\ProductAddRequest;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductDetails;
use App\Models\ProductImage;
use App\Models\ProductTag;
use App\Models\Size;
use App\Models\Tag;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class AdminProductController extends Controller
{
    private $product, $productImage, $tag, $productTag, $size;
    public function __construct(Product $product, ProductImage $productImage, ProductTag $productTag, Tag $tag, Size $size) {
        $this->product = $product;
        $this->productImage = $productImage;
        $this->tag = $tag;
        $this->productTag = $productTag;
        $this->size = $size;
    }

    use StorageImageTrait;
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $data = $this->product->orderBy('id', 'desc')->paginate(4);

        return view('admin.product.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sizes = Size::all();
        $recusive = new Recusive();
        $htmlOption = $recusive->CategoryRecusiveAdd();
        return view("admin.product.add", compact('htmlOption', 'sizes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductAddRequest $request)
    {
        try {
            DB::beginTransaction();
            $dataProductCreate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->description,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id
            ];
            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image', 'product');
            if (!(empty($dataUploadFeatureImage))) {
                $dataProductCreate['feature_image'] = $dataUploadFeatureImage['file_path'];
                $dataProductCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
            }
            $product = $this->product->create($dataProductCreate);

            // insert data to product image
            if ($request->hasFile('image_path')) {
                foreach ($request->image_path as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMultiple($fileItem, 'product');
                    $product->images()->create([
                        'image' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name']
                    ]);
                }
            }

            // insert bang tags va product tag
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    // insert bang tags
                    $tagInstance = $this->tag::firstOrCreate(['name' => $tagItem]);
                    $tagId[] = $tagInstance->id;
                }
                $product->tags()->attach($tagId);
            }

            // insert product_details
            foreach($request->size_id as $index => $size_id) {
                if(!empty($request->quantity[$index])) {
                    $product->productDetails()->create([
                        'size_id' => $size_id,
                        'quantity' =>  $request->quantity[$index]
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('product.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message' . $exception->getMessage() . 'Line: ' . $exception->getLine());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $recusive = new Recusive;
        $data = $this->product->find($id);
        $sizes = Size::all();
        $htmlOption = $recusive->categoryProductEdit($data->category_id);
        return view('admin.product.edit', compact('htmlOption', 'data', 'sizes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();
            $dataProductUpdate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->description,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id
            ];
            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image', 'product');
            if (!(empty($dataUploadFeatureImage))) {
                $dataProductUpdate['feature_image'] = $dataUploadFeatureImage['file_path'];
                $dataProductUpdate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
            }
            $this->product->find($id)->update($dataProductUpdate);
            $product = $this->product->find($id);

            // update data to product image
            if ($request->hasFile('image_path')) {
                $this->productImage->where('product_id', $id)->delete();
                foreach ($request->image_path as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMultiple($fileItem, 'product');
                    $product->images()->create([
                        'image' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name']
                    ]);
                }
            }

            // update bang tags va product tag
            if (!empty($request->tags)) {

                foreach ($request->tags as $tagItem) {
                    // insrt bang tags
                    $tagInstance = $this->tag::firstOrCreate(['name' => $tagItem]);
                    $tagId[] = $tagInstance->id;
                }
                $product->tags()->sync($tagId);
            }

            // update product_deatail
            foreach($request->size_id as $index => $size_id) {
                // Kiểm tra nếu quantity không rỗng
                if (!empty($request->quantity[$index])) {
                    // Tìm chi tiết sản phẩm theo product_id và size_id
                    $productDetail = $product->productDetails()->where('size_id', $size_id)->first();

                    if ($productDetail) {
                        // Nếu chi tiết sản phẩm đã tồn tại, cập nhật nó
                        $productDetail->update([
                            'quantity' => $request->quantity[$index]
                        ]);
                    } else {
                        // Nếu chi tiết sản phẩm không tồn tại, tạo mới
                        $product->productDetails()->create([
                            'size_id' => $size_id,
                            'quantity' => $request->quantity[$index]
                        ]);
                    }
                }
            }
            DB::commit();
            return redirect()->route('product.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message' . $exception->getMessage() . 'Line: ' . $exception->getLine());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product_detail = ProductDetails::where('product_id', $id)->first()->id;
        $check = OrderDetail::where('product_id', $product_detail)->count();
//        dd($check);
        if($check != 0) {
            return redirect()->route('product.index')->with('error', 'Product cannot be deleted!');
        } else {
            $this->product->find($id)->delete();
        }
        return redirect()->route('product.index')->with('success', 'Product is deleted!');
    }

    public function history() {
        $data = Product::onlyTrashed()->paginate(4);
        return view('admin.product.history', compact('data'));
    }

    public function restore(string $id) {
        $product = Product::withTrashed()->find($id);

        if ($product && $product->trashed()) {
            $product->restore();
            return redirect()->route('product.history')->with('success', 'Product restored successfully.');
        } else {
            return redirect()->route('product.history')->with('error', 'Product not found or not trashed.');
        }
    }
}
