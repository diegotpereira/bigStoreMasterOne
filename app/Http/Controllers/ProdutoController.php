<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Client\ResponseSequence;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(Produto::all(), 200);
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
        $produto = Produto::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'unidades' => $request->unidades,
            'preco' => $request->preco,
            'image' => $request->image
        ]);

        return response()->json([
            'status' => (bool) $produto,
            'data' => $produto,
            'message' => $produto ? 'Produto Criado:' : 'Erro ao Criar Produto'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        //
        return response()->json($produto, 200);
    }

    public function uploadFile(Request $request)
    {
        if ($request->hasFile('image')) {
            # code...
            $nome = time()."_".$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $nome);
        }
        return response()->json(asset("iamges/$nome"), 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {
        //
        $status = $produto->update(
            $request->only(['nome', 'descricao', 'unidades', 'preco', 'image'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Produto Atualizado!' : 'Erro ao atualizar Produto'
        ]);
    }

    public function atualizarUnidades(Request $request, Produto $produto) 
    {
        $produto->unidades = $produto->unidades + $request->get('unidades');
        $status = $produto->save();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Unidade adicionada!' : 'Erro ao adicionar unidade ao produto'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        //
        $status = $produto->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Produto excluído!' : 'Erro ao excluir produto'
        ]);
    }
}
