<?php

namespace Rumguru\Repositories;


class RumTypeRepository extends BaseRepository
{

    public function getRumTypes()
    {
        return $this->database->query("SELECT * FROM type")->fetchAll();
    }

}