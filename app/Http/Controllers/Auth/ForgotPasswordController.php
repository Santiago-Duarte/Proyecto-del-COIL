<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Send a reset link to the given user.
     *
     * On the local environment the generated link is also flashed to the
     * session, so it can be displayed on screen instead of relying on an
     * email delivery service.
     */
    public function sendResetLinkEmail(Request $request): JsonResponse|RedirectResponse
    {
        $this->validateEmail($request);

        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        if ($response === Password::RESET_LINK_SENT && app()->environment('local')) {
            $this->flashResetLink($request);
        }

        return $response == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($request, $response)
            : $this->sendResetLinkFailedResponse($request, $response);
    }

    /**
     * Store the password reset link of the given user on the session.
     */
    private function flashResetLink(Request $request): void
    {
        $user = User::query()->where('email', $request->input('email'))->first();

        if ($user === null) {
            return;
        }

        $token = $this->broker()->createToken($user);

        session()->flash(
            'reset_link',
            route('password.reset', ['token' => $token, 'email' => $user->email]),
        );
    }
}
