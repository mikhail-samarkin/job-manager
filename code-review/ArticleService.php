<?php

class ArticlesService
{
    private $dispatcher;
    protected $db;
    protected $lockManager;

    public function __construct( Dispatcher $dispatcher, DatabaseInterface $db, LockManagerInterface $lockManager )
    {

        $this->lockManager = $lockManager;
        $this->dispatcher = $dispatcher;
        $this->db = $db;
    }

    public function create($body) {
        $article = new Article;
        $article->load($request);

        if (!$article->validate())
        {
            throw new BadRequestHttpException;
        }

        $dispatcher->trigger('article_created', $article);

        $article->save();

        return $article;
    }

    public function update($id, $request) {
        $this->lockManager->lock($id);

        try {
            $this->db->startTransaction();

            $article = Article::findOne($id);
            $article->load($request);
            $dispatcher->trigger("articleUpdate", $article);
            $article->save();

            $this->db->commitTransaction();
        } catch (\Exception $e) {
            $this->db->rollbackTransaction();
            throw $e;
        }

        $this->lockManager->unlock($id);
    }
}
