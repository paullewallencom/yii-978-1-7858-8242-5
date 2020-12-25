<?php

namespace app\filters\auth;

use yii\filters\auth\AuthMethod;
use yii\web\UnauthorizedHttpException;
/**
 * HeaderParamAuth is an action filter that supports the authentication based on the access token passed through a query parameter.
 */
class HeaderParamAuth extends AuthMethod
{
    /**
     * @var string the parameter name for passing the access token
     */
    public $tokenParam = 'x-auth-token';

    /**
     * @inheritdoc
     */
    public function authenticate($user, $request, $response)
    {
        $accessToken = $request->getHeaders()[$this->tokenParam];

        if (is_string($accessToken))
        {
            $identity = $user->loginByAccessToken($accessToken, get_class($this));

            if ($identity !== null)
                return $identity;
        }

        if ($accessToken !== null)
            $this->handleFailure($response);
        
        return null;
    }

    /**
     * @inheritdoc
     */
    public function handleFailure($response)
    {
        throw new UnauthorizedHttpException('The token you are using has is either invalid, or has expired. Please re-authenticate to continue your session.');
    }
}