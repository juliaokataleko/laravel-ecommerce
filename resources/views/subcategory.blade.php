@extends('layouts.app')

@section('title', config('app.name', 'Laravel').' - '.$subCategoryName)

@section('content')
<div class="container mt-4" id="app">

    @include('includes.categories')
    
    @if(count($products) > 0)
    <h5 style="background: #0097e6; padding:8px; 
    text-align: center; " 
    class="text-white mb-3">Produtos encontados na subcategoria {{ $subCategoryName }} </h5>
    <div class="row" >

        @foreach ($products as $product)
                        <div class="col-sm-4 mb-3">
	
                            <div class="card">
                                <div class="card-body" style="min-height: 200px;">
                                    <a href="{{ BASE_URL }}/product/{{ $product->slug }}">
                                        @if(count($product->images) > 0)
                                            @foreach ($product->images as $image)
                                                <img class="card-img" style="width:100%;
                                                height: 200px; object-fit: cover;" 
                                                src="{{ BASE_URL }}/uploads/products/{{ $image->file }}" alt="">
                                                @break
                                            @endforeach
                                        
                                        @else

                                        <span v-if="product.images.length == 0">
                                            <img class="card-img " style="width:100%;
                                        height: 200px; object-fit: cover;" src="{{ BASE_URL }}/images/product.png" alt="">
                                        </span>
                                        @endif
                                        
                                    </a>
                                </div>
                                <div class="card-footer" style="min-height: 160px; display: flex; 
                                flex-direction: column;">
                                    <span style="height: 60px;">
                                        <a href="{{ BASE_URL }}/product/{{ $product->slug }}">
                                            {{ $product->name }}
                                        </a>
                                    </span> 
                                    <span style="font-size: 14px">
                                        <b>
                                            {{ currencyFormat($product->price) }}
                                        </b>

                                        <span>
                                            @foreach ($product->discounts as $discount)
                                                @if($discount->status == 1)
                                                <span class="badge badge-danger">
                                                    - {{ currencyFormat($discount->discount) }}                                                    
                                                </span> 
                                                @endif
                                            @endforeach
                                            <br>
                                    
                                    </span>
                                    <span>
                                    <a class="btn btn-primary" href="javascript:void(0)" 
                                        onclick="addToCart({{ $product->id }})"> 
                                        <i class="fas fa-shopping-cart"></i> </a>
                                    </span> 
                                </div>
                            </div>
                        
                        </div>
                    @endforeach
    
    </div>

    @else
    <div class="alert alert-danger"> Nenhum produto nesta subcategoria </div>
    @endif

</div>
@endsection
