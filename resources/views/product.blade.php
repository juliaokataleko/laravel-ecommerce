@extends('layouts.app')



@section('content')
<div class="container mt-4" id="app">

@section('title', $product->name . ' - ' . config('app.name', 'Laravel'))        
        
                
                <div class="row my-4-sm" v-if="loaded" style="">

                    <div class="col-sm-5">
                        <div class="carousel slide" data-ride="carousel" id="carouselExampleControls">
                            <div class="carousel-inner" role="listbox">
                                @if(count($product->images) > 0)
                                <?php $count = 0; ?>
                                @foreach ($product->images as $image)
                                
                                <div class="carousel-item <?php echo ($count == 0) ? 'active' : ''; ?>">
                                    <img class="d-block w-100" src="{{ BASE_URL }}/uploads/products/{{$image->file}}" alt="">
                                </div> 
                                <?php $count++; ?>                                   
                                @endforeach
                                @else
                                <div class="carousel-item active">
                                    <img class="d-block w-100" style="width:100%;
                                    " src="{{ BASE_URL }}/images/product.png" alt="">
                                </div>
                                @endif
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                        
                        @if(!$rate)
                            <a href="#" class="btn mt-3 mb-3 btn-primary 
                            form-control" data-toggle="modal" data-target="#exampleModal">Classificar</a>
                        @else
                            <span v-if="rate">
                                <p class="mt-3 text-success">Já classificaste o produto. Edite seu cometário</p>
                                <form action="{{ BASE_URL }}/rating/comment/{{ $rateId }}" method="post">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="text" name="message" 
                                    value="{{ $rateMessage }}"
                                    class="form-control" 
                                    placeholder="Comentário">
                                    <div class="input-group-append">
                                        <button class="btn btn-success" 
                                        type="submit">Enviar</button>
                                    </div>
                                    </div>

                                </form>
                            </span>

                        @endif

                            <div class="modal fade text-center" 
                            id="exampleModal" tabindex="-1" 
                            role="dialog" 
                            aria-labelledby="exampleModalLabel" 
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">                                    
                                <div class="modal-body">
                                    <a href="{{ BASE_URL }}/rating/{{ $product->id }}/1" style="font-size: 20px"><i class="fa fa-star"></i></a>
                                    <a href="{{ BASE_URL }}/rating/{{ $product->id }}/2" style="font-size: 20px"><i class="fa fa-star"></i></a>
                                    <a href="{{ BASE_URL }}/rating/{{ $product->id }}/3" style="font-size: 20px"><i class="fa fa-star"></i></a>
                                    <a href="{{ BASE_URL }}/rating/{{ $product->id }}/4" style="font-size: 20px"><i class="fa fa-star"></i></a>
                                    <a href="{{ BASE_URL }}/rating/{{ $product->id }}/5" style="font-size: 20px"><i class="fa fa-star"></i></a>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <div class="col-sm-7 ">


                        <div class="p-4" style="color: #444444">
                            

                            <div class="">
                                <div class="" 
                                style="">
                                    <h3 class="">{{ $product->name }}</h3>
                                    @if($product->video_frame !== null) 
                                        {!! $product->video_frame !!}
                                    @endif
                                    <br>
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
                                    <br>
                                    <h5> {{ $product->description }} </h5>
                                    <span>
                                    <a class="btn btn-primary" href="javascript:void(0)" 
                                        onclick="addToCart({{ $product->id }})"> 
                                        <i class="fas fa-shopping-cart"></i> </a>
                                    </span> 
                                </div>
                            </div>

                            <br> <br>
                            @if(isset($product->ratings))
                            @if(count($product->ratings) == 1)
                                1 Classificação, Média: {{ $media }}
                            @endif
                            @endif

                            @if(count($product->ratings) > 1)
                                {{ count($product->ratings) }} Classificações, Média: {{ $media }}
                            @endif

                            @if(count($product->ratings) > 0)
                                <ul class="list-group" style="max-height: 250px; overflow-y: auto;">
                                @foreach ($product->ratings as $rating)
                                                                    
                                    <li class="list-group-item" v-for="rating in product.ratings">

                                        <b> {{ ($rating->user->name ?? 'User desconhecido' ) }} </b> <br>
                                        <a href="{{ BASE_URL }}/rating/{{ $product->id }}/1'" 
                                        style="font-size: 20px; color: #F79F1F">
                                        <i class="fa fa-star"></i></a>
                                        

                                        @if($rating->stars >= 2)
                                        <a href="{{ BASE_URL }}/rating/{{ $product->id }}/2"
                                        style="font-size: 20px; color: #F79F1F"><i class="fa fa-star"></i></a>
                                        @endif

                                        @if($rating->stars < 2)
                                        <a href="{{ BASE_URL }}/rating/{{ $product->id }}/2" 
                                        style="font-size: 20px"><i class="fa fa-star"></i></a>
                                        @endif


                                        @if($rating->stars >= 3)
                                        <a href="{{ BASE_URL }}/rating/{{ $product->id }}/3"
                                            style="font-size: 20px; color: #F79F1F">
                                            <i class="fa fa-star"></i></a>
                                        @endif

                                        @if($rating->stars < 3)
                                        <a href="{{ BASE_URL }}/rating/{{ $product->id }}/3" 
                                        style="font-size: 20px">
                                        <i class="fa fa-star"></i></a>
                                        @endif

                                        @if($rating->stars >= 4)
                                        <a href="{{ BASE_URL }}/rating/{{ $product->id }}/4"
                                            style="font-size: 20px; color: #F79F1F">
                                            <i class="fa fa-star"></i></a>
                                        @endif

                                        @if($rating->stars < 4)
                                        <a href="{{ BASE_URL }}/rating/{{ $product->id }}/4"
                                        style="font-size: 20px"><i class="fa fa-star"></i></a>
                                        @endif

                                        @if($rating->stars >= 5)
                                        <a href="{{ BASE_URL }}/rating/{{ $product->id }}/5" 
                                            style="font-size: 20px; color: #F79F1F">
                                            <i class="fa fa-star"></i></a>
                                        @endif

                                        @if($rating->stars < 5)
                                        <a href="{{ BASE_URL }}/rating/{{ $product->id }}/5"
                                        style="font-size: 20px"><i class="fa fa-star"></i></a>
                                        @endif

                                        
                                        @if(null != $rating->message)
                                        <hr>
                                        <span>
                                            <span class="text-success">
                                             
                                            disse:</span> {{ $rating->message }}
                                        </span>
                                        @endif
                                        
                                        
                                        @if(Auth::check() && $rating->user_id == Auth::user()->id)
                                         <br>
                                         <span> 
                                             <a href="{{ BASE_URL }}/rating/{{$rating->id}}">Excluir</a> 
                                        </span>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                            @endif
                            </span>
                        </div>
                        
                    </div>
                </div>
                

                @if(count($otherProducts))
                <h5 style="padding:8px; 
                text-align: center; " 
                class="text-dark my-3 bg-yellow">Produtos Semelhantes</h5>
                
                <div class="row">

                    @foreach ($otherProducts as $product)
                        <div class="col-md-4 mb-3">
	
                        <div class="card text-center">
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

                                    <span>
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

                @endif

            </div>

@endsection
