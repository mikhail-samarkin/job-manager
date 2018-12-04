<?php

class ArticleController
{
    protected $article_service;

    public function __construct(
        ArticlesService $service
    ) {
        $this->article_service = $service;
    }

    public function create(Request $request) {
        $article = $this->article_service->create($request->getBody());

        return $article->id;
    }

    public function update($id, Request $request)
    {
        $this->article_service->update($request->getBody());

        return true;
    }
}
