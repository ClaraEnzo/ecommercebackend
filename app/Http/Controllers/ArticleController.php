<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Scategorie;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $article=Article::with("scategorie")->get();
            return response()->json($article);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $article= new Article ([
                "designation"=> $request->input("designation"),
                "reference"=> $request->input("reference"),
                "marque"=> $request->input("marque"),
                "prix" => $request->input("prix"),
                "qtestock"=>$request->input("qtestock"),
                "scategorieID"=>$request->input("imageart")
            ]);
            $article->save();
            return response()->json($article);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try
        {
        $article=Article::with("scategorie")->findOrFail($id);
        return response()->json($article);
        }catch (\Exception $e) {
            return response()->json($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $article=Article::findOrFail($id);
            $article->update($request->all());
            return response()->json($article);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $article=Article::findOrFail($id);
            $article->delete();
            return response()->json("sous categorie supprimee avec succees");
        } catch (\Exception $e) {
            return response()->json($e->getMessage(),$e->getCode());
        }
    }
    public function articlesPaginate()
{
try {
$perPage = request()->input('pageSize', 2);
// Récupère la valeur dynamique pour la pagination
$articles = Article::with('scategorie')->paginate($perPage);
// Retourne le résultat en format JSON API
return response()->json([
'products' => $articles->items(), // Les articles paginés
'totalPages' => $articles->lastPage(), // Le nombre de pages
]);
} catch (\Exception $e) {
return response()->json("Selection impossible {$e->getMessage()}");
}
}
}
