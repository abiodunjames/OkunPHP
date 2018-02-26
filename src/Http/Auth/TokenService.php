<?php
declare(strict_types = 1);

namespace App\Http\Auth;

use App\Entities\User;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;

class TokenService
{
    /**
     * @var string
     */
    private $tokenId = "56857cfc709d3996f057252c16ec4656f5292802";

    /**
     * @var string
     */
    private $app_url = 'architrave.dev';

    /**
     * @param \App\Entities\User $user
     * @return string
     */
    public function createTokenForUser(User $user)
    {
        $token = (new Builder())
            ->setIssuer($this->app_url)
            ->setAudience($this->app_url)
            ->setId($this->tokenId, true)
            ->setIssuedAt(time())
            ->setNotBefore(time())
            ->setExpiration(time() + 36000)
            ->set('uuid', $user->getId())
            ->getToken();

        return (string) $token;
    }

    /**
     * Validate token authenticity
     *
     * @param string $token
     * @return bool
     */
    public function isValid(string $token)
    {

        $token = (new Parser())->parse($token);
        $validationData = new ValidationData();

        $validationData->setIssuer($this->app_url);
        $validationData->setAudience($this->app_url);
        $validationData->setId($this->tokenId);

        return $token->validate($validationData);
    }

    /**
     * @param string $token
     * @return mixed
     */
    public function getUserIdFromToken(string $token)
    {
        return (new Parser())
            ->parse((string) $token)
            ->getClaim('uuid');
    }

    /**
     * @param $url
     * @return void
     */
    public function setAppUrl($url)
    {
        $this->app_url = $url;
    }

    /**
     * @return string
     */
    public function getAppUrl()
    {
        return $this->app_url;
    }
}
