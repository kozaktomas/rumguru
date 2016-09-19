<?php

namespace Rumguru\Presenters;

use Nette;
use Rumguru\Repositories\RumRepository;


class HomepagePresenter extends BasePresenter
{

    /** @var RumRepository */
    private $rumRepository;

    /**
     * HomepagePresenter constructor.
     * @param RumRepository $rumRepository
     */
    public function __construct(RumRepository $rumRepository)
    {
        parent::__construct();
        $this->rumRepository = $rumRepository;
    }


    public function renderDefault()
    {
        $this->template->rums = $this->rumRepository->getRumsToHomepage();
    }


}
