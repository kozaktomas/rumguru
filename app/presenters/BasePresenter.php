<?php

namespace Rumguru\Presenters;


use Nette\Application\UI\Presenter;
use Rumguru\Model\Authenticator;

class BasePresenter extends Presenter
{
    protected function beforeRender()
    {
        parent::beforeRender();

        $isAdmin = false;
        if ($this->getUser()->getIdentity()) {
            $roles = $this->getUser()->getIdentity()->getRoles();
            if (in_array(Authenticator::ROLE_ADMIN, $roles)) {
                $isAdmin = true;
            }
        }

        $this->template->imageDir = UPLOAD_DIR_WWW;
        $this->template->isLoggedIn = $this->getUser()->isLoggedIn();
        $this->template->isAdmin = $isAdmin;
    }


}