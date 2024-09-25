<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $categories=Categorie::all();
            return response()->json($categories);

        }catch(\Exception $e){
            return response()->json("impossible d'afficher la liste des categories");
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    try

    {
        $categorie = new Categorie([
            "nomcategorie"=>$request->input("nomcategorie"),
            "imagecategorie"=>$request -> input("imagecategorie")]);
        $categorie->save();
        return response()-> json($categorie);
    }catch(\Throwable $th)
    }


    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        try{
            $categorie=Categorie::findOrFail($id);
            return response()->json($categorie);
        }catch(\Exception $e){
            return response()->json("Probleme d'affichage");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        try {
            $categorie=Categorie::findOrFail($id);
            $categorie->update($request->all());
            return response()->json($categorie);
        
        } catch (\Exception $e) {
            return response()->json("Modification impossible");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        try {
            $categorie=Categorie::findOrFail($id);
            $categorie-delete();
            return response()->json("Categorie supprimee avec succes");
        } catch (\Exception $e) {
            return response()->json("Supprimer impossible");
        }
    }
}
