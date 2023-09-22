<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

   

    public function addProduct()
    {
        return view('products.addNewProductView');
    }

    public function insertProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'string',
            'price' => 'required|numeric|min:0.01',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
  
        $input = $request->all();
  
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
    
        Product::create($input);
     
        return redirect()->route('products')
                        ->with('success','Product created successfully.');
    }

    
    public function showProduct(Request $request)
    {
        $product = Product::find($request->id);
        return view('products.showProductView',compact('product'));
    }
    
    
    public function editProduct(Request $request)
    {
        $product = Product::find($request->id);
        return view('products.editProductView',compact('product'));
    }

    
    public function updateProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'string',
            'price' => 'required|numeric|min:0.01',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
  
        $input = $request->all();
  
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";

            Product::where('id', $input['id'])->update(['name' => $input['name'],'price' => $input['price'],'description' => $input['description'],'image' => $input['image']]);

        }else{
            unset($input['image']);
            Product::where('id', $input['id'])->update(['name' => $input['name'],'price' => $input['price'],'description' => $input['description']]);
        }
                  
        
    
        return redirect()->route('products')
                        ->with('success','Product updated successfully');
    }

    public function deleteProduct(Request $request)
    {

        $product = Product::find($request->id);
//    dd(__DIR__.'/image/'.$product->image);
        Product::where('id',$request->id)->delete();

        if(File::exists('image/'.$product->image)) {
            File::delete('image/'.$product->image);
        }
     
        return redirect()->route('products')
                        ->with('success','Product deleted successfully');
    }

    
}
