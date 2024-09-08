<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LinkEmailRequest;
use App\Mail\ResetPasswordLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class PasswordResetController extends Controller
{

    public function sendResetLinkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $url = \URL::temporarySignedRoute('password.reset', now()->addMinute(30), ['email' => $request->email]);
        $url = str_replace(env('APP_URL'), env('FRONTEND_URL'), $url);

        Mail::to($request->email)->send(new ResetPasswordLink($url));

        return response()->json([
            'message' => 'Link para redefinir sua senha foi enviado por e-mail.',
        ]);
    }

    public function reset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::whereEmail($request->email)->first();
        if (!$user){
            return response()->json([
                'message' => 'Usuário não encontrado em nosso sistema.'
            ], 404);
        }

        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json([
            'message' => 'Senha alterada com sucesso.'
        ]);

    }
}
