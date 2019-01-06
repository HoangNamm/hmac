<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use DB;
use Carbon\Carbon;
use App\Http\Controllers\Api\ApiController;
use PhilipBrown\Signature\Token;
use PhilipBrown\Signature\Request as MakeRequest;

class HmacController extends ApiController
{
    /**
     * Login as user
     *
     * @return json authentication code
     */
    public function hmac(Request $request)
    {
        $accesskeyId = $request->AccessKeyId;
        $data = [
            'username' => $request->username,
            'password' => $request->password
        ];
        $method = $request->method();
        $uri = $request->path();
        $token   = new Token($accesskeyId, 'secret');
        $requestToken = new MakeRequest($method, $uri, $data);

        $auth = $requestToken->sign($token);
        $query_params = array_merge($data, $auth);
        return $this->successResponse($query_params, Response::HTTP_OK);
    }

    /**
     * Login as user
     *
     * @return json authentication code
     */
    public function getHmac(Request $request)
    {
        dd($request);
    }
}
