<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client as ClientGoutte;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        //Pocket
        $client = new ClientGoutte;
        $crawler = $client->request('GET', 'https://www.pocketgamer.com/news');
        $pocket = $crawler->filter("[class='fence']")->html();
        $pocket2 = $crawler->filter("[class='fence']")->eq(1)->html();

        $pocket = str_replace('href="/', 'class="col-md-6 pb-5 pe-3" target="_blank" href="https://www.pocketgamer.com/', $pocket);
        $pocket2 = str_replace('href="/', 'class="col-md-6 pb-5 pe-3" target="_blank" href="https://www.pocketgamer.com/', $pocket2);

        //pag2
        $crawler2 = $client->request('GET', 'https://www.pocketgamer.com/news/?page=2');
        $pocket3 = $crawler2->filter("[class='fence']")->html();
        $pocket4 = $crawler2->filter("[class='fence']")->eq(1)->html();

        $pocket3 = str_replace('href="/', 'class="col-md-6 pb-5 pe-3" target="_blank" href="https://www.pocketgamer.com/', $pocket3);
        $pocket4 = str_replace('href="/', 'class="col-md-6 pb-5 pe-3" target="_blank" href="https://www.pocketgamer.com/', $pocket4);

        $site = $request->query('site');

        //NERD
        $crawlerNerd = $client->request('GET', 'https://jovemnerd.com.br/nerdbunker/');
        $nerd = $crawlerNerd->filter("main")->html();

            $nerd = str_replace('<img', '<img class="img-fluid"', $nerd);


        return view('news', ['pocket'=>$pocket, 'pocket2'=>$pocket2, 'pocket3'=>$pocket3, 'pocket4'=>$pocket4, 'site'=> $site, 'nerd'=>$nerd]);
    }
}
