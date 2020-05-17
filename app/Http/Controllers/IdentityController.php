<?php

namespace App\Http\Controllers;

use App\Repositories\Exceptions\AccessDeniedEception;
use App\Repositories\Interfaces\IIdentityRepository;
use Illuminate\Http\Request;

class IdentityController extends Controller {
    private IIdentityRepository $identityRepository;

    /**
     * IdentityController constructor.
     * @param IIdentityRepository $identityRepository
     */
    public function __construct(IIdentityRepository $identityRepository) {
        $this->identityRepository = $identityRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function signin(Request $request) {
        try {
            return response()->json(
                $this->identityRepository->signin(
                    $request->input('email')
                    , $request->input('password')
                )
            );
        } catch (AccessDeniedEception $ex) {
            return response($ex->getMessage(), 400);
        }
    }
}
