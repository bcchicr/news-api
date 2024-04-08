<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Services\NewsService;
use App\Http\Requests\News\StoreNewsRequest;
use App\Http\Requests\News\UpdateNewsRequest;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(NewsService $newsService)
    {
        $news = $newsService
            ->index()
            ->paginate(3);
        return $news;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        StoreNewsRequest $request,
        NewsService $newsService
    ) {
        if (!$newsService->store($request->getDTO())) {
            return response()->json(
                ['error' => 'Unable to create news'],
                400
            );
        }
        return response()->json(
            ['message' => 'Successfully created news!'],
            201
        );
    }
    /**
     * Display the specified resource.
     */
    public function show(
        NewsService $newsService,
        string $id
    ) {
        return $newsService->getById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateNewsRequest $request,
        NewsService $newsService,
        News $news
    ) {
        if (!$newsService->update($request->getDTO(), $news)) {
            return response()->json(
                ['error' => 'Unable to update news'],
                400
            );
        }
        return response()->json(
            ['message' => 'Successfully updated news!'],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        NewsService $newsService,
        News $news
    ) {
        if (!$newsService->destroy($news)) {
            return response()->json(
                ['error' => 'Unable to delete news'],
                400
            );
        }
        return response()->json(
            ['message' => 'Successfully deleted news!'],
            200
        );
    }
}
