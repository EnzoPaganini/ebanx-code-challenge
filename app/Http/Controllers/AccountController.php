<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\AccountService;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function __construct() { }

    public function getBalance(AccountService $account_service, Request $request) {
        $response = $account_service->getBalance(json_decode($request->getContent(), true));
        if($response == 0){
            return $this->errorResponse("Account not found", 404);
        }else{
            return $this->successResponse($response, 200);
        }
    }

    public function createAccount(AccountService $account_service, Request $request) {
        $response = $account_service->createAccount(json_decode($request->getContent(), true));
        return $this->successResponse($response);
    }

    public function createEvent(AccountService $account_service, Request $request) {
        $response = $account_service->createEvent(json_decode($request->getContent(), true));
        if(!$response){
            return $this->errorResponse("Account not found", 404);
        }else{
            return $this->successResponse($response, 201);
        }
    }

    public function reset(AccountService $account_service) {
        $response = $account_service->reset();
        return $this->successResponse($response, 200);
    }
}
