<?php

namespace LAFramework\Auth;

interface IAuthHandler {
    
    public function onSuccess();
    public function onFail();
    public function onUserIsAuth();
    
}