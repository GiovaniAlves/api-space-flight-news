<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * @OA\Get(
     *     tags={"/"},
     *     path="/",
     *     summary="Displaying the welcome message",
     *     security={{"bearerAuth": {}}},
     *     description="Displaying the welcome message",
     *     @OA\Response(
     *          response="200", description="Welcome Message"
     *     )
     * )
     *
     * @return \Illuminate\Http\Response
     */
    public function message()
    {
        return response('Fullstack Challenge 2022 🏅 - Space Flight News', 200);
    }

    /**
     * @OA\Get(
     *     tags={"/articles"},
     *     path="/articles",
     *     summary="Displaying all articles",
     *     security={{"bearerAuth": {}}},
     *     description="Displaying all articles",
     *     @OA\Response(
     *          response="200", description="All articles - Paged every 15 items"
     *     )
     * )
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $articles = Article::paginate(15);

        return response()->json($articles, 200);
    }

    /**
     * @OA\Post(
     *     tags={"/articles"},
     *     summary="Store a newly created article in storage.",
     *     description="Store a new article on databse",
     *     path="/articles",
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *          description="Article to create",
     *          required=true,
     *          @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *                  @OA\Property(property="title", type="string"),
     *                  @OA\Property(property="url", type="string"),
     *                  @OA\Property(property="imageUrl", type="string"),
     *                  @OA\Property(property="newsSite", type="string"),
     *                  @OA\Property(property="summary", type="string"),
     *                  @OA\Property(property="publishedAt", type="string", format="date-time"),
     *                  @OA\Property(property="updatedAt", type="string", format="date-time"),
     *                  @OA\Property(property="launches", type="object"),
     *                  @OA\Property(property="events", type="object"),
     *              )
     *          )
     *     ),
     *     @OA\Response(
     *          response="201", description="New article created"
     *     )
     * )
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
     * @OA\Get(
     *     tags={"/articles"},
     *     path="/articles/{article}",
     *     summary="Displaying the specified article",
     *     security={{"bearerAuth": {}}},
     *     description="Show article",
     *     @OA\Parameter(
     *          description="Article Id",
     *          in="path",
     *          name="article",
     *          required=true,
     *          @OA\Schema(type="integer", format="int64")
     *     ),
     *     @OA\Response(
     *          response="200", description="Show article"
     *     )
     * )
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $article = Article::findorfail($id);

        return response()->json($article, 200);
    }


    /**
     * @OA\Put(
     *     tags={"/articles"},
     *     summary="Update the specified article in storage.",
     *     description="Update a article on databse",
     *     path="/articles/{article}",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *          description="Article Id",
     *          in="path",
     *          name="article",
     *          required=true,
     *          @OA\Schema(type="integer", format="int64" )
     *     ),
     *     @OA\RequestBody(
     *          description="Article to update",
     *          required=true,
     *          @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *                  @OA\Property(property="title", type="string"),
     *                  @OA\Property(property="url", type="string"),
     *                  @OA\Property(property="imageUrl", type="string"),
     *                  @OA\Property(property="newsSite", type="string"),
     *                  @OA\Property(property="summary", type="string"),
     *                  @OA\Property(property="publishedAt", type="string", format="date-time"),
     *                  @OA\Property(property="updatedAt", type="string", format="date-time"),
     *                  @OA\Property(property="launches", type="object"),
     *                  @OA\Property(property="events", type="object"),
     *              )
     *          )
     *     ),
     *     @OA\Response(
     *          response="200", description="Article updated"
     *     )
     * )
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
     * @OA\Delete(
     *     tags={"/articles"},
     *     path="/articles/{article}",
     *     summary="Remove the specified article.",
     *     security={{"bearerAuth": {}}},
     *     description="Remove article on database",
     *     @OA\Parameter(
     *          description="Article Id",
     *          in="path",
     *          name="article",
     *          required=true,
     *          @OA\Schema(type="integer", format="int64")
     *     ),
     *     @OA\Response(
     *          response="204", description="Article deleted"
     *     )
     * )
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();

        return response('', 204);
    }
}
