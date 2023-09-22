@extends('layouts.app')

@section('content')
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-start">
                <h2>Products List</h2>
            </div>
            <div class="float-end mb-3">
                <a class="btn btn-success" href="{{route('add_product')}}"> Add New Product</a>
            </div>
        </div>
    </div>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
     
    <table class="table table-bordered">
        <tr>
            <th>Sr.No.</th>
            <th>Image</th>
            <th>Name</th>
            <th>Description</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($products as $product)
        <tr>
            <td>{{ ++$i }}</td>
            <td><img src="/image/{{ $product->image }}" width="100px"></td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->description }}</td>
            <td>
                <form action="{{ route('delete_product',['id'=>$product->id]) }}" method="POST">
     
                    <a class="btn btn-info" href="{{ route('show_product',['id'=>$product->id]) }}">View</a>
      
                    <a class="btn btn-primary" href="{{ route('edit_product',['id'=>$product->id]) }}">Edit</a>
     
                    @csrf
                    @method('DELETE')
        
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    
    {!! $products->links() !!}
        
@endsection
