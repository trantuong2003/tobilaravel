<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }
    public function show($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

    
public function addProduct(Request $request)
{


    // Lưu ảnh vào thư mục storage/app/public/images
    $imagePath = $request->file('image')->store('public/images');
    $fileName = basename($imagePath);
    
    $product = new Product([
        'name' => $request->input('name'),
        'size' => $request->input('size'),
        'description' => $request->input('description'),
        'category_id' => $request->input('categoryId'),
        'image' => $fileName, // Lưu tên tệp của ảnh
        'quantity' => $request->input('quantity'),
        'price' => $request->input('price'),
    ]);

    $product->save();

    return response()->json(['message' => 'Product added successfully', 'product' => $product]);
}

public function edit($id)
{
    $product = Product::find($id);



    return response()->json([
        "product" => $product,
    ]);
}

    
public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string',
        'size' => 'nullable|string',
        'description' => 'required|string',
        // 'categoryId' => 'required|exists:categories,id',
        'quantity' => 'required|integer',
        'price' => 'required|numeric',
        // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $product = Product::find($id);

    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    $product->name = $request->input('name');
    $product->size = $request->input('size');
    $product->description = $request->input('description');
    // $product->categoryId = $request->input('categoryId');
    $product->quantity = $request->input('quantity');
    $product->price = $request->input('price');

    // Kiểm tra xem có file hình ảnh được tải lên không
    // if ($request->hasFile('image')) {
    //     $uploadedFile = $request->file('image');
    //     $imageName = time() . '.' . $uploadedFile->getClientOriginalExtension();
        
    //     // Lưu ảnh với tên tệp mới
    //     $uploadedFile->storeAs('products', $imageName, 'public');
        
    //     // Cập nhật tên tệp ảnh trong cơ sở dữ liệu
    //     $product->image = $imageName;
    // }

    $product->save();

    return response()->json(['message' => 'Product updated successfully', 'product' => $product]);
}



    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được xóa thành công.');
    }

}
