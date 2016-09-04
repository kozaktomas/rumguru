<?php

namespace Rumguru\Presenters;


use Nette\Application\UI\Form;
use Nette\Database\UniqueConstraintViolationException;
use Nette\Security\AuthenticationException;
use Rumguru\Repositories\UserRepository;

class SignPresenter extends BasePresenter
{

    /** @var UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
    }

    public function createComponentSignInForm()
    {
        $form = new Form();
        $form->addText('email', 'Email')
            ->setRequired();
        $form->addPassword('password', 'Heslo')
            ->setRequired();
        $form->addSubmit('ok', 'Přihlásit se');
        $form->onSuccess[] = [$this, 'signInFormSubmitted'];
        return $form;
    }

    public function signInFormSubmitted(Form $form)
    {
        $values = $form->getValues();
        try {
            $this->getUser()->login($values->email, $values->password);
        } catch (AuthenticationException $exception) {
            $form->addError($exception->getMessage());
        }

        $this->redirect("Homepage:default");
    }

    public function createComponentRegistrationForm()
    {
        $form = new Form();
        $form->addText('nickname', 'Nick')
            ->setRequired();
        $form->addText('email', 'Email')
            ->setRequired();
        $form->addPassword('password', 'Heslo');
        $form->addPassword('passwordCheck', 'Heslo pro kontrolu:')
            ->setRequired('Zadejte prosím heslo ještě jednou pro kontrolu')
            ->addRule(Form::EQUAL, 'Hesla se neshodují', $form['password']);
        $form->addSubmit('ok', 'Zaregistrovat se');
        $form->onSuccess[] = [$this, 'registrationFormSubmitted'];
        return $form;
    }

    public function registrationFormSubmitted(Form $form)
    {
        $values = $form->getValues();
        try {
            $this->userRepository->createUser($values->email, $values->nickname, $values->password);
            try {
                $this->getUser()->login($values->email, $values->password);
                $this->redirect("Homepage:default");
            } catch (AuthenticationException $exception) {
                $form->addError($exception->getMessage());
            }
        } catch (UniqueConstraintViolationException $exception) {
            $form->addError($exception->getMessage());
        }
    }

    public function actionOut()
    {
        $this->getUser()->logout(true);
        $this->redirect("Homepage:default");
    }

}