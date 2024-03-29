<?php




namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\UserLoginRequest;
use App\Http\Resources\user\UserResource;
use App\Models\users\User;
use App\Traits\General\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use ResponseTrait;

    /**
     * Handles user login requests.
     *
     * @param UserLoginRequest $request Validated user login data
     * @return Response
     */
    public function login(UserLoginRequest $request) :JsonResponse
    {
        $credentials = $request->only('email', 'password');
        $user = User::where('email',$request->email)->first();

        if ( $this->checkCredentials($user,$credentials)) {


            $token = $user->createToken($user->name . '-AuthToken')->plainTextToken;

            return $this->formatResponse(
                true,
                [
                    'user' => new UserResource($user),
                    'access_token' => $token,
                ],
                'Login successful',
                200,
                ''
            );
        }

        return $this->formatResponse(false, '', 'Invalid credentials', 401, '');
    }



    //check user Credentials match user data
    private function checkCredentials($user,$credentials) :bool{
        return $user && Hash::check($credentials['password'],$user->password);
    }
}
