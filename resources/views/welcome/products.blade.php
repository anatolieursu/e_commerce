<div class="products">
    @foreach($products as $product)
        <a href="/product/{{ $product[0]->name }}">
            <div class="product_categ">
                <img src="{{ str_replace(public_path(), "", $product[0]->image_path) }}" alt="{{ $product[0]->image_path }}">
                <p class="productName">{{ $product[0]->name }}</p>
                <p style="text-align: center; font-weight: bold; font-size: 20px">${{ $product["realPrice"] }}</p>
                @if($product["isEvent"])
                    <p>Is event</p>
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
    .products {
        width: 70%;
        height: 100%;
        display: grid;
        grid-template-columns: auto auto auto;
        justify-content: center;
        gap: 0 20px;
    }
    .product_categ{
        margin-top: 20px;
        cursor: pointer;
        width: 300px;
        height: 400px;
        background-color: #E2FFBD;
        padding: 15px;
    }
    .product_categ img {
        width: 100%;
    }
</style>
