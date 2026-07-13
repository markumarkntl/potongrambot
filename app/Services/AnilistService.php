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

    public function getAnimeDetail(int $id): array
    {
        $cacheKey = "anilist.anime.detail.{$id}";

        return Cache::remember($cacheKey, now()->addHours(6), function () use ($id) {
            $query = <<<'GRAPHQL'
            query ($id: Int) {
                Media(id: $id, type: ANIME) {
                    id
                    title {
                        romaji
                        english
                        native
                    }
                    description(asHtml: false)
                    coverImage {
                        large
                        extraLarge
                        color
                    }
                    bannerImage
                    averageScore
                    meanScore
                    popularity
                    favourites
                    episodes
                    duration
                    status
                    format
                    season
                    seasonYear
                    genres
                    studios(isMain: true) {
                        nodes {
                            name
                        }
                    }
                    characters(sort: [ROLE, RELEVANCE], perPage: 18) {
                        edges {
                            role
                            node {
                                id
                                name {
                                    full
                                    native
                                }
                                image {
                                    large
                                    medium
                                }
                            }
                            voiceActors(language: JAPANESE) {
                                id
                                name {
                                    full
                                }
                                image {
                                    large
                                    medium
                                }
                            }
                        }
                    }
                }
            }
            GRAPHQL;

            $response = Http::timeout(15)->post($this->endpoint, [
                'query' => $query,
                'variables' => [
                    'id' => $id,
                ],
            ]);

            if ($response->failed()) {
                throw new \RuntimeException('Gagal ambil detail anime dari AniList: '.$response->status());
            }

            return $response->json('data.Media');
        });
    }
}