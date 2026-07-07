<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class AnilistService
{
    protected string $endpoint = 'https://graphql.anilist.co';

    public function getTrendingAnime(int $page = 1, int $perPage = 12): array
    {
        $cacheKey = "anilist.trending.anime.{$page}.{$perPage}";

        return Cache::remember($cacheKey, now()->addMinutes(30), function () use ($page, $perPage) {
            $query = <<<'GRAPHQL'
            query ($page: Int, $perPage: Int) {
                Page(page: $page, perPage: $perPage) {
                    pageInfo {
                        total
                        currentPage
                        lastPage
                        hasNextPage
                    }
                    media(sort: TRENDING_DESC, type: ANIME) {
                        id
                        title {
                            romaji
                            english
                            native
                        }
                        coverImage {
                            large
                            extraLarge
                            color
                        }
                        bannerImage
                        averageScore
                        popularity
                        episodes
                        format
                        status
                        genres
                        season
                        seasonYear
                    }
                }
            }
            GRAPHQL;

            $response = Http::timeout(15)->post($this->endpoint, [
                'query' => $query,
                'variables' => [
                    'page' => $page,
                    'perPage' => $perPage,
                ],
            ]);

            if ($response->failed()) {
                throw new \RuntimeException('Gagal ambil data dari AniList: '.$response->status());
            }

            return $response->json('data.Page');
        });
    }
}