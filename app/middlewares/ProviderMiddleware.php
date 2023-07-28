<?php
class ProviderMiddleware
{
    public function providerData()
    {
        $userData = new UserLogin();
        View::share($userData->get());
    }
}
