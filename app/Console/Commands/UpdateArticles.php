<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class UpdateArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:articles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command update the table articles';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $qtyArticles = $this->getArticleQuantity();

           $articlesSpaceNews = Http::get(env('URL_SPACE_FLIGHT_NEWS') . "/articles?_limit={$qtyArticles}");
           $articlesLocal = Article::all();

           //Get Ids as array of existing na API da Space Flight News
           $idsSpaceNews = Arr::pluck($articlesSpaceNews->json(), 'id');
           //Get Ids as array of existing na API Local
           $idsSpaceNewsLocal = Arr::pluck($articlesLocal, 'id');

           //Find articles to add (in other words - have at the 'idsSpaceNews' and there (is not) at the 'idsSpaceNewsLocal')
           // - Return array of ids
           $toAdd = array_diff($idsSpaceNews, $idsSpaceNewsLocal);

           foreach ($toAdd as $articleId) {
               //searching on the basis of the article (ID) the position of the array that contains the article data of that (ID)
               $id = array_search($articleId, array_column($articlesSpaceNews->json(), 'id'));

               $data = $articlesSpaceNews->json()[$id];

               $data['publishedAt'] = Carbon::parse($data['publishedAt'])->format('Y-m-d H:i:s');
               $data['updatedAt'] = Carbon::parse($data['updatedAt'])->format('Y-m-d H:i:s');
               $data['launches'] = is_array($data['launches']) ? json_encode($data['launches']) : $data['launches'];
               $data['events'] = is_array($data['events']) ? json_encode($data['events']) : $data['events'];
               Article::create($data);
           }

        } catch (\Exception $e) {
            Mail::send('error_email', [], function ($m) {
                $m->subject('Falha ao atualizar os artigos.');
                $m->from('giovani.alves.glv@gmail.com');
                $m->to('giovani.alves.glv@gmail.com');
            });
        }

        return 0;
    }

    /**
     * @return int
     */
    private function getArticleQuantity() : int
    {
        $quantity = Http::get(env('URL_SPACE_FLIGHT_NEWS'). '/articles/count');

        return intval($quantity->body());
    }
}
