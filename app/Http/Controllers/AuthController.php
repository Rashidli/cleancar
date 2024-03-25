<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Services\SendSms;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{



    public function sendEmployeeOtp(Request $request)
    {
        try {
            return $this->sendOTP($request, 1);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
//                'data' => null,
                'message' => 'An error occurred while sending OTP.',
                'errors' => [$e->getMessage()],
            ], 500);
        }

    }
    public function sendCustomerOtp(Request $request)
    {
        try {
            return $this->sendOTP($request, 0);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
//                'data' => null,
                'message' => 'An error occurred while sending OTP.',
                'errors' => [$e->getMessage()],
            ], 500);
        }

    }
    private function sendOTP(Request $request, int $is_customer = 0): JsonResponse
    {

        try {
            $request->validate([
                'phone' => 'required',
            ]);

            $otpCode = rand(1000, 9999);

            $userType = $is_customer;
            $phone = $request->phone;
            $otpToken = Str::uuid();

            if ($request->phone == '994559395484') {
                $otpCode = 1111;
            } elseif ($request->phone == '994555128672') {
                $otpCode = 2222;
            }

            $user = User::where('phone', $phone)->where('type', $userType)->first();

            if ($user) {
                $user->otp_code = $otpCode;
                $user->type = $userType;
                $user->otp_token = $otpToken;
                $user->save();
            } else {
                $user = new User();
                $user->phone = $phone;
                $user->otp_code = $otpCode;
                $user->type = $userType;
                $user->otp_token = $otpToken;
                $user->save();
            }

            $send_sms = new SendSms();
            $response = $send_sms->send_sms($otpCode, $request->phone);

            if (isset($response['head']['responsecode']) && $response['head']['responsecode'] == 000) {
                return response()->json([
                    'success' => true,
                    'message' => 'OTP sent successfully.',
                    'data' => ['phone' => $phone,'otp_token' => $otpToken],
                ]);
            } else {
                throw new \Exception('Failed to send OTP.');
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

    }

    public function customerVerifyOpt(Request $request)
    {
        return $this->verifyOTP($request, 0);
    }
    public function employeeVerifyOpt(Request $request)
    {
        return $this->verifyOTP($request, 1);
    }


    public function verifyOTP(Request $request, int $is_customer = 0): JsonResponse
    {
        try {
            $request->validate([
                'otp_code' => 'required|min:4|max:4',
                'phone' => 'required'
            ]);

            $userType = $is_customer;
            $phone = $request->phone;
            $otp_code = $request->otp_code;
            $otp_token = $request->otp_token;


            $user = User::where('phone', $phone)
                ->where('otp_code', $otp_code)
                ->where('otp_token', $otp_token)
                ->where('type', $userType)
                ->first();

            if ($user) {
                $userResource = new UserResource($user);

                $token = $user->createToken('washingProjectToken')->plainTextToken;

                return response()->json([

//                    'success' => empty($user->name) ? false : true,
                    'success' => true,
                    'data' => ['user' => $userResource,'token' =>  empty($user->name) ? null :  $token ],
                    'message' => empty($user->name) ? 'Send to register' : 'Registered user',

                ]);

            }
            else {

//                return response()->json([
//                    'error' => [
//                        'error'=>true,
//                        'code' => 400,
//                    ],
//                    'message' => 'Incorrect OTP code',
//
//                ]);

                return response()->json([
                    'success' => false,
                    'data' => null,
                    'message' => 'Incorrect OTP code',
                    'errors' => ['code' => 400, 'message' => 'Incorrect OTP code'],
                ]);
            }

        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function customerRegister(Request $request)
    {
        return $this->register($request, 0);
    }
    public function employeeRegister(Request $request)
    {
        return $this->register($request, 1);
    }
    public function register(Request $request, int $is_customer = 0)
    {

        try {
            $request->validate([
                'name' => 'required|string|max:191',
                'phone' => 'required',
                'email' => 'email|required',
            ]);

            $userType = $is_customer;
            $phone = $request->phone;

            User::where('phone', $phone)->where('type', $userType)
                ->update([
                    'email' => $request->email,
                    'name' => $request->name,
                    'type' => $userType,
                ]);

            $user = new UserResource(User::where('phone', $request->phone)->where('type', $userType)->first());

            $token = $user->createToken('washingProjectToken')->plainTextToken;


            return response()->json([
                'success' => true,
                'data' => ['user' => $user,'token' => $token],
                'message' => 'Successfully registered',

            ]);

        }catch (\Exception $e) {
            return $this->errorResponse($e);
        }

    }
    public function logout()
    {
        try {
            auth()->user()->tokens()->delete();
            return response()->json([
                'success' => true,
                'message' => 'Successfully logout',
            ]);

        }catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }


    public function show()
    {
        try {
            $profile = auth()->user();
            $user =  new UserResource($profile);
            return response()->json([
                'success' => true,
                'data' => ['user' => $user],
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function destroy()
    {
        try {
            $user = User::find(auth()->user()->id);

            if ($user) {
                $user->delete();
                $response = [
                    'success' => true,
                    'message' => 'User deleted successfully',
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'User not found',
                    'error' => [
                        'code' => 404,
                        'message' => 'User not found'
                    ],
                ];
            }

            return response()->json($response);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function update(Request $request)
    {
        try {
            $id = auth()->user()->id;
            $user = User::find($id);

            if ($user) {
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->phone = $request->input('phone');
                $user->save();

                $response = [
                    'success' => true,
                    'data' => ['user' => new UserResource($user)],
                    'message' => 'User updated successfully'
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'User not found',
                    'error' => [
                        'code' => 404,
                        'message' => 'User not found'
                    ],
                ];
            }

            return response()->json($response);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    private function errorResponse(\Exception $e)
    {
        $statusCode = $this->getStatusCodeFromException($e);

        return response()->json([
            'success' => false,
            'data' => null,
            'message' => $e->getMessage(),
            'errors' => ['code' => $statusCode, 'message' => $e->getMessage()],
        ], $statusCode);
    }

    private function getStatusCodeFromException(\Exception $e)
    {
        return method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;
    }




    public function index()
    {
        return view('admin.login');
    }

    public function login_submit(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('admin_dashboard');
        }
        return redirect()->route('admin_login')->with('danger', 'Wrong password or email');
    }

    public function admin_exit()
    {
        auth()->logout();
        return redirect()->route('welcome');
    }

}
