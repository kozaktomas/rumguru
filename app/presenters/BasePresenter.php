<?php

namespace Rumguru\Presenters;


use Nette\Application\UI\Presenter;

class BasePresenter extends Presenter
{
    protected function beforeRender()
    {
        parent::beforeRender();
        $this->template->isLoggedIn = $this->getUser()->isLoggedIn();
    }


}