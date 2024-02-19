<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ResponseBuilderHelper;
use App\Helpers\ResponseMessageHelper;

class CredentialController extends Controller
{
    public function onLogin(Request $request)
    {
        $fields = $request->validate([
            'employee_id' => 'required',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt(['employee_id' => $fields['employee_id'], 'password' => $fields['password']])) {
            $token = auth()->user()->createToken('appToken')->plainTextToken;
            $data = [

            ];
            return ResponseBuilderHelper::dataResponse('success', 200, ResponseMessageHelper::onAuthenticate('Login', 1), $data);
        } else {
            return ResponseBuilderHelper::dataResponse('error', 404, ResponseMessageHelper::onAuthenticate('Login', 0), null);
        }
    }

    public function onLogout(Request $request)
    {
        try {
            auth()->user()->tokens()->delete();
            return ResponseBuilderHelper::dataResponse('success', 200, ResponseMessageHelper::onAuthenticate('Logout', 1), null);
        } catch (Exception $exception) {
            $response = [
                'message' => 'Logout unsuccessful',
                'errors' => $exception->getMessage()
            ];
            return ResponseBuilderHelper::dataResponse('error', 400, ResponseMessageHelper::onAuthenticate('Logout', 0), null);
        }
    }
}
