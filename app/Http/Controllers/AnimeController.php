<?php

namespace App\Http\Controllers;

use App\Services\AnilistService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AnimeController extends Controller
{
    public function __construct(protected AnilistService $anilist)
    {
    }

    public function dashboard(Request $request)
    {
        $trending = $this->anilist->getTrendingAnime(perPage: 12);

        return Inertia::render('Dashboard', [
            'trending' => $trending['media'] ?? [],
        ]);
    }

    public function show(Request $request, int $id)
    {
        $anime = $this->anilist->getAnimeDetail($id);

        return Inertia::render('Anime/Show', [
            'anime' => $anime,
        ]);
    }
}