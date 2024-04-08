<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Enums\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = $this
            ->getAppropriateQuery(News::query())
            ->latest('published_at')
            ->paginate(3);
        return $news;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $storeNewsData = $request->validate([
            'title' => ['required', 'string'],
            'content' => ['required', 'string'],
            'published_at' => ['nullable', 'date']
        ]);

        $news = new News([
            'title' => $storeNewsData['title'],
            'content' => $storeNewsData['content'],
            'published_at' => $storeNewsData['published_at'] ?? now(),
        ]);

        if ($news->save()) {
            return response()->json(
                ['message' => 'Successfully created news!'],
                201
            );
        }
        return response()->json(
            ['error' => 'Unable to create news'],
            400
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $news = $this
            ->getAppropriateQuery(News::query())
            ->findOrFail($id);
        return $news;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        $updateNewsData = $request->validate([
            'title' => ['required', 'string'],
            'content' => ['required', 'string'],
        ]);
        $news->title = $updateNewsData['title'];
        $news->content = $updateNewsData['content'];

        if ($news->save()) {
            return response()->json(
                ['message' => 'Successfully updated news!'],
                200
            );
        }
        return response()->json(
            ['error' => 'Unable to update news'],
            400
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        if ($news->delete()) {
            return response()->json(
                ['message' => 'Successfully deleted news!'],
                200
            );
        }
        return response()->json(
            ['error' => 'Unable to delete news'],
            400
        );
    }

    private function getAppropriateQuery(Builder $query): Builder
    {
        if (Auth::user()->role === UserRole::USER) {
            $query = $query->published();
        }
        return $query;
    }
}
