<div class="products">
    @foreach($products as $product)
        <a href="/product/{{ $product[0]->name }}">
            <div class="product_categ">
                <img src="{{ str_replace(public_path(), "", $product[0]->image_path) }}" alt="{{ $product[0]->image_path }}">
                <p class="productName">{{ $product[0]->name }}</p>
                @if($product["isEvent"])
                    @php
                        $additionalInfo = "/ " . "$" . $product[0]->price;
                    @endphp
                @else
                    @php
                      $additionalInfo = "";
                    @endphp
                @endif
                <p style="text-align: center; font-weight: bold; font-size: 20px">${{ $product["realPrice"] }} <del>{{ $additionalInfo }}</del></p>
                @if($product["isEvent"])
                    <div style="width: 100%;display: flex; justify-content: center; position: absolute; bottom: 15px;">
                        <div style="text-align: center; width: 150px; background-color: darkred; color: white; padding: 15px; border-radius: 5px">
                            <p style="margin: 0">Discount {{ $product["discount"] }}% off!</p>
                        </div>
                    </div>
                @endif
            </div>
        </a>
    @endforeach
</div>

<style>
    a{
        color: black;
        text-decoration: none;
    }
    .productName{
        font-size: 19px;
        text-align: center;
        font-family: Arial;
    }
    .product_categ{
        margin-top: 20px;
        cursor: pointer;
        width: 300px;
        height: 500px;
        background-color: #E2FFBD;
        padding: 15px;
        position: relative;
    }
    .products {
        width: 70%;
        height: 100%;
        display: grid;
        grid-template-columns: auto auto auto;
        justify-content: center;
        gap: 0 20px;
    }
    .product_categ img {
        width: 100%;
    }
</style>
