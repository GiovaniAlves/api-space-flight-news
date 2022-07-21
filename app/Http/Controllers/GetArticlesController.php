<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GetArticlesController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function obtainArticles()
    {
        $articlesQuantity = $this->getArticleQuantity();
        $articles = Http::get(env('URL_SPACE_FLIGHT_NEWS') . "/articles?_limit={$articlesQuantity}");

        $this->registerArticles($articles->json());

        return response('Registered with success!', 200);
    }

    /**
     * @return int
     */
    public function getArticleQuantity() : int
    {
        $quantity = Http::get(env('URL_SPACE_FLIGHT_NEWS'). '/articles/count');

        return intval($quantity->body());
    }

    /**
     * @param mixed $articles
     * @return void
     */
    public function registerArticles(mixed $articles) : void
    {
        foreach ($articles as $value) {
            $data = $value;

            $data['publishedAt'] = Carbon::parse($data['publishedAt'])->format('Y-m-d H:i:s');
            $data['updatedAt'] = Carbon::parse($data['updatedAt'])->format('Y-m-d H:i:s');
            $data['launches'] = is_array($data['launches']) ? json_encode($data['launches']) : $data['launches'];
            $data['events'] = is_array($data['events']) ? json_encode($data['events']) : $data['events'];
            Article::create($data);
        }
    }
}
