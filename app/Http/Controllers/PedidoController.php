<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(Pedido::with(['produto'])->get(), 200);
        // return response()->json(Pedido::with('produto')->orderBy('id','DESC')->paginate(10) , 200);
    }

    public function entregarPedido(Pedido $pedido)
    {
        $pedido->entregue = true;
        $status = $pedido->save();

        return response()->json([
            'status' => $status,
            'data' => $pedido,
            'message' => $status ? 'Pedido Entregue!' : 'Erro ao entregar pedido'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $pedido = Pedido::create([
             'produto_id' => $request->produto,
             'user_id' => Auth::id(),
             'quantidade' => $request->quantidade,
             'endereco' => $request->endereco
        ]);

        return response()->json([
            'status' => (bool) $pedido,
            'data' => $pedido,
            'message' => $pedido ? 'Pedido Criado!' :  'Erro ao criar pedido'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedido)
    {
        //
        return response()->json($pedido,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedido $pedido)
    {
        //
        $status = $pedido->update(
            $request->only(['quantidade'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Pedido Atualizado' : 'Erro ao atualizar produto'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
        //
        $status = $pedido->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Pedido excluído!' : 'Erro ao excluir pedido'
        ]);
    }
    public function json(Pedido $pedido)
    {
        $produtos = $pedido->line_items;
        $produtosId = array_column($produtos, 'produto_id');
        $orderedProducts = Produto::whereIn('id', $produtosId)->get()->groupBy('id');
        return response()->json(['pedidos' => $pedido, 'orderedProducts' =>$orderedProducts->toArray() ]);
    }
}
