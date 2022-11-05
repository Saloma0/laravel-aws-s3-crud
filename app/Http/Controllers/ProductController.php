<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::all();

        if($products->count() > 0){
            foreach($products as $item){
                $item->url = Storage::disk('s3')->temporaryUrl(
                    $item->image_path,
                    now()->addMinutes(5)
                );
            }
        }

        return view('welcome', compact('products'));
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
        $validate =$request->validate([
            'title' => 'required'
        ]);

        if($request->hasFile('photo')){

            $path = $request->file('photo')->store(
                'avatars', 's3'
            );

            $product = Product::insert([
                'title' => $request->title,
                'image_path' => $path,
            ]);

            return redirect()->back()->with(['success'=>'Produto adicionado com sucesso']);
        }

        return redirect()->back()->with(['error'=>'Erro ao cadastrar produto!']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $product = Product::findOrFail($id);

        $product->url = Storage::disk('s3')->temporaryUrl(
            $product->image_path,
            now()->addMinutes(5)
        );        

        return view('edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $product = Product::findOrFail($id);

        $validate = $request->validate([
            'title' => 'required'
        ]);

        $product->title = $request->title;

        if($request->hasFile('photo')){

            $delete = Storage::disk('s3')->delete($product->image_path);

            if(!$delete){
                return redirect()->back()->with(['error'=>'erro ao actualizar']);
            }

            $path = $request->file('photo')->store('avatars','s3');
            $product->image_path =$path;

        }

        $product->save();

        return redirect()->back()->with(['success'=>'sucesso ao actualizar']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $product = Product::findOrFail($id);

        $delete = Storage::disk('s3')->delete($product->image_path);

        if(!$delete){
            return redirect()->back()->with(['error'=>'erro ao deletar']);
        }

        $product->delete();

        return redirect()->back()->with(['success'=>'sucesso ao deletar']);

    }
}
