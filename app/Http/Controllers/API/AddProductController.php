<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class AddProductController extends Controller
{
    public function addProduct(Request $request)
    {
        // Xử lý dữ liệu từ yêu cầu và thêm sản phẩm vào cơ sở dữ liệu
        // Lưu ý: Bạn cần xử lý lưu file ảnh vào thư mục phù hợp

        // Ví dụ: Lưu ảnh vào thư mục public/images
        // $imagePath = $request->file('image')->store('storage/images');

        // $products = new Product([
        //     'name' => $request->input('name'),
        //     'size' => $request->input('size'),
        //     'description' => $request->input('description'),
        //     'category_id' => $request->input('categoryId'),
        //     'image' => $imagePath, // Lưu đường dẫn của ảnh
        //     'quantity' => $request->input('quantity'),
        //     'price' => $request->input('price'),
        // ]);
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move('storage/images', $imageName);
      
        $products = new Product([
          'name' => $request->input('name'),
          'size' => $request->input('size'),
          'description' => $request->input('description'),
          'category_id' => $request->input('categoryId'),
          'image' => $image->hashName(), // chỉ lưu tên ảnh
          'quantity' => $request->input('quantity'),
          'price' => $request->input('price'),
        ]);

        $products->save();

        return response()->json(['message' => 'Product added successfully', 'product' => $products]);
    }
}
