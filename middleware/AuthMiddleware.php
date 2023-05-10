<?php
namespace middleware;

use bor\Auth;
use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;

class AuthMiddleware implements IMiddleware {

    public function handle(Request $request): void
    {

        $request->user = Auth::identity();

        // If authentication failed, redirect request to user-login page.
        if($request->user) {
            $request->setRewriteUrl(url('forbidden'));
        }

    }
}