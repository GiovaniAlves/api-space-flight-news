<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function message()
    {
        return response('Fullstack Challenge 2022 🏅 - Space Flight News', 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $articles = Article::paginate(15);

        return response()->json($articles, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $data['launches'] = is_array($data['launches']) ? json_encode($data['launches']) : $data['launches'];
        $data['events'] = is_array($data['events']) ? json_encode($data['events']) : $data['events'];

        $article = Article::create($data);

        return response()->json($article, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $article = Article::find($id);

        return response()->json($article, 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $article = Article::find($id);

        $data = $request->all();

        $data['launches'] = is_array($data['launches']) ? json_encode($data['launches']) : $data['launches'];
        $data['events'] = is_array($data['events']) ? json_encode($data['events']) : $data['events'];

        $article->update($data);

        return response()->json($article, 200);
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
    }
}
