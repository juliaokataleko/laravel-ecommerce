@extends('layouts.admin')

@section('title', config('app.name', 'Laravel').' - Pedidos de Compra')

@section('content')
<div class="container bg-white p-3 border" style="width: 97%;">
    <h2>Lista de pedidos</h2>

    @if(Session::has('success'))
        <p class="mt-4  alert alert-success">{{ Session::get('success') }}</p>
    @elseif(Session::has('warning'))
        <p class="mt-4 alert alert-warning">{{ Session::get('warning') }}</p>
    @endif

    @if(count($purchases) > 0)

        <table class="table table-striped table-responsive-xl">
            <thead>
                <tr>
                    <td>ID PEDIDO</td>
                    <td>Usuário</td>
                    <td>Valor Total</td>
                    <td>Desconto</td>
                    <td>A Pagar</td>
                    <td>Data</td>
                    <td>Estado</td>
                    <td>Acção</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchases as $purchase)
                    <tr>
                        <td>{{ $purchase->id }}</td>
                        <td>{{ $purchase->user->name }}</td>
                        <td>{{ currencyFormat($purchase->total).' Akz' }}</td>
                        <td>{{ currencyFormat($purchase->discount).' Akz' }}</td>
                        <td>{{ currencyFormat($purchase->to_pay).' Akz' }}</td>
                        <td>{{ dateFormat($purchase->created_at) }}</td>
                        <td> 
                            {!! ($purchase->status == 0) ? 
                             '<span class="text-danger">Pendente</span>' : '<span class="text-success">Finalizado</span>' 
                            !!}
                        </td>
                        <td> {!! ($purchase->status == 0 )
                             ? '<a href="'. BASE_URL .'/admin/purchase/finish/'.$purchase->id.'">Finalizar</a>'
                             : '<a href="'. BASE_URL .'/admin/purchase/finish/'.$purchase->id.'">Concluída</a>' 
                             !!} 

                             <br>
                             <a href="#"  data-toggle="modal" 
                             data-target="#produtos{{ $purchase->id }}">
                             Ver Produtos</a>

                             <!-- Modal -->
                            <div class="modal fade" 
                            id="produtos{{ $purchase->id }}" tabindex="-1" 
                                role="dialog" aria-labelledby="exampleModalCenterTitle" 
                                aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="">
                                    ID: {{ $purchase->id }} <br>
                                    Total: {{ $purchase->to_pay }}
                                    </h5>
                                    <button type="button" class="close" 
                                    data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" style="max-height: 180px; overflow-y: auto;">
                                    <ul class="list-group">
                                    @foreach ($purchase->items as $item)
                                    <li class="list-group-item">
                                        {{ $item->product->name }} <br>
                                        <b>Quantidade</b> {{ $item->quantity }} <br>
                                        <b>Desconto</b> {{currencyFormat($item->discount) }} Akz <br>
                                        <b>Preço</b> {{currencyFormat($item->price) }} Akz <br>
                                        <b>A Pagar</b> {{currencyFormat($item->total) }} Akz
                                    </li>
                                    @endforeach
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" 
                                    data-dismiss="modal">Fechar</button>
                                    <button type="button" class="btn btn-primary">Imprimir</button>
                                </div>
                                </div>
                            </div>
                            </div>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $purchases->links() }}

        @else
        <hr>
        <h4>Sem Compras de Momento.</h4>
        @endif
</div>
@endsection
