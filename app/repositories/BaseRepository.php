<?php

namespace Rumguru\Repositories;


use Nette\Database\Context;

class BaseRepository
{

    /** @var Context */
    protected $database;

    /**
     * BaseRepository constructor.
     * @param Context $databaseContext
     */
    public function __construct(Context $databaseContext)
    {
        $this->database = $databaseContext;
        $this->startup();
    }

    protected function startup()
    {

    }
}