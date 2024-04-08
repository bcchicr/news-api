<?php

namespace App\Services;

use App\DTO\News\StoreNewsDTO;
use App\DTO\News\UpdateNewsDTO;
use App\Models\News;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

final class NewsService
{
    public function index()
    {
        return $this
            ->getAppropriateQuery(News::query())
            ->latest('published_at');
    }

    public function store(StoreNewsDTO $request): bool
    {
        $news = new News([
            'title' => $request->title,
            'content' => $request->content,
            'published_at' => $request->publishedAt ?? now(),
        ]);
        return $news->save();
    }

    public function getById(string $id)
    {
        return $this
            ->getAppropriateQuery(News::query())
            ->findOrFail($id);
    }

    public function update(
        UpdateNewsDTO $request,
        News $news
    ): bool {

        $news->title = $request->title;
        $news->content = $request->content;

        if (null !== $request->publishedAt) {
            $news->published_at = $request->publishedAt;
        }

        return $news->save();
    }

    public function destroy(News $news): bool
    {
        return $news->delete();
    }

    private function getAppropriateQuery(Builder $query): Builder
    {
        if (Auth::user()->role === UserRole::USER) {
            $query = $query->published();
        }
        return $query;
    }
}
