<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhilipBrown\Signature\Auth;
use PhilipBrown\Signature\Token;
use PhilipBrown\Signature\Guards\CheckKey;
use PhilipBrown\Signature\Guards\CheckVersion;
use PhilipBrown\Signature\Guards\CheckTimestamp;
use PhilipBrown\Signature\Guards\CheckSignature;
use PhilipBrown\Signature\Exceptions\SignatureException;
use App\Http\Controllers\Api\ApiController;

class GetHmacController extends ApiController
{
    public function getHmac()
    {
        $auth  = new Auth('POST', 'users', $_POST, [
            new CheckKey,
            new CheckVersion,
            new CheckTimestamp,
            new CheckSignature
        ]);
        
        $token = new Token('abc123', 'qwerty');
        
        try {
            $auth->attempt($token);
        }
        
        catch (SignatureException $e) {
            // return 4xx
        }
    }
}
