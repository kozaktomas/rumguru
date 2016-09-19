<?php

namespace Rumguru\Model;


use Nette\Security\AuthenticationException;
use Nette\Security\IAuthenticator;
use Nette\Security\Identity;
use Nette\Security\IIdentity;
use Nette\Security\Passwords;
use Nette\Security\User;
use Rumguru\Repositories\UserRepository;

class Authenticator implements IAuthenticator
{

    const ROLE_USER = 'user';
    const ROLE_ADMIN = 'admin';

    /** @var User */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Performs an authentication against e.g. database.
     * and returns IIdentity on success or throws AuthenticationException
     * @return IIdentity
     * @throws AuthenticationException
     */
    function authenticate(array $credentials)
    {
        list($username, $password) = $credentials;
        $user = $this->userRepository->getUserForLogin($username);

        if (!$user) {
            throw new AuthenticationException("Uživatel neexistuje");
        }

        if (!Passwords::verify($password, $user['password'])) {
            throw new AuthenticationException("Špatné heslo");
        }

        if (Passwords::needsRehash($user['password'])) {
            $newPassword = Passwords::hash($password);
            $this->userRepository->updateUser($user['id'], [
                'password' => $newPassword,
            ]);
        }

        $role = self::ROLE_USER;
        if ($user['isAdmin']) {
            $role = self::ROLE_ADMIN;
        }

        $userId = $user['id'];
        unset($user['password']);
        unset($user['isAdmin']);
        unset($user['id']);
        return new Identity($userId, [$role], $user);
    }
}