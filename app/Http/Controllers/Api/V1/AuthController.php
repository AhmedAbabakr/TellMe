<?php

namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Branches;
use Validator;
class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
   
     public function login(Request $request)
    {
        $rules = [
            'branch_code'       =>  'required|numeric|exists:branches,branch_code',
        ];
        $names = [
            'branch_code'       =>  'Branch Code',
        ];
        $validate=Validator::make($request->all(),$rules,[],$names);
        if($validate->fails())
        {
            $errorString = implode(",",$validate->messages()->all());
            $responseData = array('success'=>'0', 'data'=>json_decode("{}"), 'message'=> $errorString);
            return $responseData;
        }else{
 
            $credentials = Branches::where('branch_code',$request->branch_code)->with('company')->firstOrFail();

            if (! $token = auth('api')->fromUser($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            return $this->respondWithToken($token);
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
       
        $branch = Branches::with('company')->find(auth('api')->user()->branch_id);
        return response()->json($branch);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            // 'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}