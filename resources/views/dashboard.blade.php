<x-app-layout>
    <style>
        form input {
            color: black;
        }
    </style>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(\Illuminate\Support\Facades\Auth::user()->admin)
                        <div style="border: 1px solid black; padding: 20px">
                            <form action="/event/add" method="post">
                                @csrf
                                <p>Add a discount</p>
                                <input type="number" name="id" placeholder="Enter the productID">
                                <input type="number" placeholder="Enter the discount %" name="discount">
                                <input type="date" name="date" placeholder="enter the until date">
                                <button type="submit">Submit</button>
                            </form>
                        </div>
                        <div>
                            <p>All products: </p>
                            @foreach($products as $product)
                                <div style="padding: 15px; border: 1px solid black; margin-top: 15px">
                                    <p>Product Name: {{ $product->name }}</p>
                                    <p>Product Description: {{ $product->description }}</p>
                                    <img style="width: 100px" src="{{ str_replace(public_path(), $product->image_path, "") }}" alt="">
                                    <p>Buyers: {{ $product->buyers }}</p>
                                    <p>Price: {{ $product->price }}</p>
                                    <img style="width: 100px" src="{{ str_replace(public_path(), "", $product->image_path) }}" alt="{{ $product->image_path }}">
                                </div>
                            @endforeach
                        </div>
                        <div>
                            <p>Add a product</p>
                            <form action="/product-add" method="post" enctype="multipart/form-data">
                                @csrf
                                <input style="color: black" type="text" placeholder="Product Name" name="name">
                                <input style="color: black" type="text" placeholder="Product Description" name="description">
                                <input type="file" placeholder="Product image" name="file">
                                <input style="color: black" type="number" placeholder="Price" name="price">
                                <input type="submit" style="padding: 15px; background-color: black; color: white; cursor: pointer;">
                            </form>
                        </div>
                    @endif
                    @if(count($yourProducts) > 0)
                        @foreach($yourProducts as $order)
                            @php
                              if($order["completed"]) {
                                $styleForDiv = "background-color: #185b00;";
                              } else {
                                $styleForDiv = "background-color: #5b0000;";
                              }
                            @endphp
                            <div style="margin: 10px; background-color: #373b31; padding: 15px; {{ $styleForDiv }}">
                                <p>Product name: {{ $order["name"] }}</p>
                                <p>Product description: {{ $order["description"] }}</p>
                                <p>Product price: {{ $order["price"] }}</p>
                                <p>Product Location: {{ $order["location"] }}</p>
                                <p>Completed: {{ $order["completed"] }}</p>
                                @if($order["completed"])
                                    <form action="">
                                        <button style="margin-top: 10px; padding: 10px; background-color: white; color: black" type="submit">Add a review</button>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
