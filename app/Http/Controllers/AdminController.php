<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

use App\Models\Product;

use App\Models\Order;

use Flasher\Toastr\Prime\ToastrInterface;

use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function view_category()
    {
        $data = Category::all();
        return view('admin.category',compact('data'));
    }

    public function add_category(Request $request)
    {
        $category = new Category;
        
        $category->category_name = $request->category;
        
        $category->save();
        
        // Store message in session
        session()->flash('toastr', [
            'type' => 'success',
            'message' => 'Category Added Successfully.',
            'title' => 'Success!',
        ]);
        
        return redirect()->back();
    }

    public function delete_category($id)
    {
        $category = Category::find($id);
    
        if ($category) {
            $category->delete();
            return redirect()->back()->with('toastr', [
                'type' => 'success',
                'message' => 'Category deleted successfully.',
                'title' => 'Deleted!',
            ]);
        }
    
        return redirect()->back()->with('toastr', [
            'type' => 'error',
            'message' => 'Category not found.',
            'title' => 'Error!',
        ]);
    }
    

    public function edit_category($id)
    {
        $category = Category::find($id);

        return view('admin.editCategory',compact('category'));
    }

    public function update_category(Request $request, $id)
    {
        // Find the category by ID
        $category = Category::find($id);
    
        // Check if category exists
        if (!$category) {
            session()->flash('toastr', [
                'type' => 'error',
                'message' => 'Category not found.',
                'title' => 'Error!',
            ]);
            return redirect()->back();
        }
    
        // Update the category name
        $category->category_name = $request->category;
        $category->save();
    
        // Flash success message
        session()->flash('toastr', [
            'type' => 'success',
            'message' => 'Category Updated Successfully.',
            'title' => 'Success!',
        ]);
    
        // Redirect to the category view page
        return redirect('/view_category');
    }
    

    public function view_product()
    {
        $product = Product::paginate(3);
        return view('admin.view_product',compact('product'));
    }

    public function add_product()
    {
        $data = Category::all();
        return view('admin.add_product',compact('data'));
    }

    public function insert_product(Request $request)
    {
         // Create a new product instance and save to database
         $product = new Product;
         $product->product_name = $request->productname;
         $product->description = $request->productdescription;
         $product->price = $request->price;
         $product->quantity = $request->quantity;
         $product->category = $request->category;
        
         $image = $request->imageUpload;

        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $imagename);
            $product->image = $imagename;
        }                

        $product->save();

            // Store message in session
            // For Insert Product
            session()->flash('toastr', [
                'type' => 'success',
                'message' => 'Product Added Successfully.',
                'title' => 'Success!',
            ]);
    
        // Redirect back to the product view page 
        return redirect()->back();
    }

    public function delete_product($id)
    {
         // Find the product by ID
         $product = Product::find($id);
    
         // Check if product exists
         if ($product) {
             // Construct the image path
             $imagePath = public_path('uploads/products/' . $product->image);
     
             // Delete the image if it exists
             if (file_exists($imagePath)) {
                 unlink($imagePath);
             }
     
             // Delete the product record
             $product->delete();
     
             // Redirect with success message
            // For Delete Product
            return redirect()->back()->with('toastr', [
                'type' => 'success',
                'message' => 'Product deleted successfully.',
                'title' => 'Deleted!',
            ]);
         }
     
         // Redirect with error message if product is not found
         // For Error in Deleting Product
        return redirect()->back()->with('toastr', [
            'type' => 'error',
            'message' => 'Product not found.',
            'title' => 'Error!',
        ]);
    }

    public function edit_product($id)
    {
        $product = Product::find($id);
        $data = Category::all();
    
        return view('admin.edit_product', compact('product','data'));
    }

    public function update_product(Request $request, $id)
    {
        // Find the product by ID
        $product = Product::find($id);
    
        // Check if product exists
        if (!$product) {
            session()->flash('toastr', [
                'type' => 'error',
                'message' => 'Product not found.',
                'title' => 'Error!',
            ]);
            return redirect()->back();
        }
    
        // Update the product details
        $product->product_name = $request->productname;
        $product->description = $request->productdescription;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category = $request->category;
    
        // Handle image upload
        if ($request->hasFile('imageUpload')) {
            $image = $request->file('imageUpload');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $imagename);
            $product->image = $imagename;
        }
    
        // Save the updated product
        $product->save();
    
        // Flash success message with toastr
        session()->flash('toastr', [
            'type' => 'success',
            'message' => 'Product Updated Successfully.',
            'title' => 'Success!',
        ]);
    
        // Redirect to the product view page
        return redirect('/view_product');
    }

    public function search_product(Request $request)
    {
        $search = $request->search;

        $product = Product::where('product_name', 'LIKE', '%' . $search . '%')->orWhere('category', 'LIKE', '%' . $search . '%')->paginate(3);

        return view('admin.view_product', compact('product'));
    }

    public function view_orders()
    {
        $data = Order::paginate(3);
        return view('admin.view_order',compact('data'));
    }


    public function on_the_way($id)
    {
        $data = Order::find($id);

        $data->status = 'On the way';

        $data->save();

        return redirect('/view_orders');
    }

    public function delivered($id)
    {
        $data = Order::find($id);

        $data->status = 'Delivered';

        $data->save();

        return redirect('/view_orders');
    }

    public function print_pdf($id)
    {
        $data = Order::find($id);

        $pdf = Pdf::loadView('admin.invoice',compact('data'));

        return $pdf->download('invoice.pdf');
    }
   
    
}
