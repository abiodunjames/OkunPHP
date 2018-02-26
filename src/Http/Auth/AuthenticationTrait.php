<?php
declare(strict_types = 1);

namespace App\Http\Auth;

use App\Entities\User;
use App\Service\UserService;
use Symfony\Component\HttpFoundation\Request;

trait  AuthenticationTrait
{
    /**
     * @var User
     */
    protected $authUser;

    /**
     * Resolve TokenService from application controller
     *
     * @return TokenService
     */
    public function getTokenService()
    {
        return $this->container->get('app.token_service');
    }

    /**
     * Resolve UserService from application container
     *
     * @return UserService
     */
    public function getUserService()
    {
        return $this->container->get('app.user_service');
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return mixed
     */
    public function getBearerToken(Request $request)
    {
        if ($request->headers->has('Authorization')) {
            $tokenBearer = $request->headers->get('Authorization');
            if ($tokenBearer != null) {
                return $this->getToken($tokenBearer);
            }
        }

        return null;
    }

    /**
     * @param $authBearer
     * @return mixed
     */
    public function getToken($tokenBearer)
    {
        if (preg_match('/Bearer\s(\S+)/', $tokenBearer, $token)) {
            return $token[1];
        }
        return null;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return bool
     */
    public function isAuthenticated(Request $request)
    {
        $token = $this->getBearerToken($request);

        if ($token != null && $this->getTokenService()->isValid($token)) {
            $user_id = $this->getTokenService()->getUserIdFromToken($token);
            $user = $this->getUserService()->findById($user_id);

            if ($user) {
                $this->authUser = $user;

                return true;
            }
        }

        return false;
    }

    public function getUserIdFromToken($token)
    {
        return $this->getTokenService()->parse($token)->getClaim('uid');
    }
}
