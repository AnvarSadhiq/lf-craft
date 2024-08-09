<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;
use App\Models\Order;

class AdminController extends Controller
{

    // Category View Function
    public function view_category()
    {
        $data = Category::all();
        return view('admin.category', compact('data'));
    }


    // Adding Category function
    public function add_category(Request $request)
    {
        $category = new Category;

        $category->category_name = $request->category;

        $category->save();

        toastr()->timeOut(10000)->closeButton()->addSuccess('Category Added Successfully');

        return redirect()->back();
    }

    // Edit Category function
    public function edit_category($id)
    {

        $data = Category::find($id);
        return view('admin.edit_category', compact('data'));
    }

    // Update Category function
    public function update_category(Request $request, $id)
    {
        $data = Category::find($id);
        $data->category_name = $request->category;
        $data->save();

        toastr()->timeOut(10000)->closeButton()->addSuccess('Category Edit Successfully');

        return redirect('/view_category');
    }

    // Deleting Category function

    public function delete_category($id)
    {
        $data = Category::find($id);
        $data->delete();

        toastr()->timeOut(10000)->closeButton()->addSuccess('Category Deleted Successfully');

        return redirect()->back();
    }

    // Add Product function

    public function add_product()
    {

        $category = Category::all();
        return view('admin.add_product', compact('category'));
    }

    // Upload Product function

    public function upload_product(Request $request)
    {

        $data = new Product;
        $data->title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->quantity = $request->qty;
        $data->category = $request->category;

        $image = $request->image;
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('products', $imagename);

            $data->image = $imagename;
        }
        $data->save();

        toastr()->timeOut(10000)->closeButton()->addSuccess('Product Uploaded Successfully');

        return redirect()->back();
    }

    // View Product function

    public function view_product()
    {
        $product = Product::all();
        return view('admin.view_product', compact('product'));
    }

    // Deleting Product tableColumn function

    public function delete_product($id)
    {
        $product = Product::find($id);
        $image_path = public_path('products/' . $product->image);

        if (file_exists($image_path)) {
            unlink($image_path);
        }

        $product->delete();

        toastr()->timeOut(10000)->closeButton()->addSuccess('Product Deleted Successfully');

        return redirect()->back();
    }

    // Edit Product function
    public function edit_product($id)
    {

        $product = Product::find($id);

        $category = Category::all();

        return view('admin.edit_product', compact('product', 'category'));
    }

    // Update Product function

    public function update_product(Request $request, $id)
    {
        $product = Product::find($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category = $request->category;

        $image = $request->image;
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('products', $imagename);

            $product->image = $imagename;
        }

        $product->save();

        toastr()->timeOut(10000)->closeButton()->addSuccess('Product Updated Successfully');

        return redirect('/view_product');
    }

    // Search Products Function
    public function product_search(Request $request)
    {
        $search = $request->search;
        $product = Product::where('title', 'LIKE', '%' . $search . '%')->orWhere('category', 'LIKE', '%' . $search . '%')->paginate(3);

        return view('admin.view_product', compact('product'));
    }

    // Orders View Function

    public function view_orders()
    {

        $data = Order::all();
        return view('admin.order', compact('data'));
    }


    // Order Status change to on the way

    public function on_the_way($id)
    {

        $data = Order::find($id);
        $data->status = 'on the way';

        $data->save();

        return redirect('/view_orders');
    }

    // Order Status change to Delivered

    public function delivered($id)
    {

        $data = Order::find($id);
        $data->status = 'Delivered';

        $data->save();

        return redirect('/view_orders');
    }
}
