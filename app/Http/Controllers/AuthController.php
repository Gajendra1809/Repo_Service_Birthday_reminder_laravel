<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserUpdateRequest;

/**
 * Class AuthController
 *
 * This controller handles the authentication and profile management processes.
 * It includes methods for user registration, login, logout, and profile updates.
 */
class AuthController extends Controller
{

    /**
    * @var UserService
    */
    protected $userService;

    /**
    * AuthController constructor.
    *
    * @param UserService $userService
    */
    public function __construct(UserService $userService){
        $this->userService=$userService;
    }

    /**
    * Handle the register request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function register(UserRegisterRequest $request){
        $request->validated();

        try {
            
            $this->userService->create($request->all());

            return redirect(route('login'))->with('success', 'User Registered!');

        } catch(\Exception $e){

            return redirect(route('register'))->with('error', 'Not Registered! May be email already exists');

        }
    }

    /**
    * Handle the login request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function login(UserLoginRequest $request){
        $request->validated();
        
        if ($this->userService->login($request)){

            return redirect('home');

        }else{

            return redirect(route('login'))->with('error','Invalid crediantials!');

        }
    }

    /**
    * Handle the logout request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function logout(Request $request)
    {
        
        return $this->userService->logout()? redirect(route('login'))->with('success','Logged Out!') : '';

    }


    /**
    * Display the profile view.
    *
    * @param  Request  $request
    * @return \Illuminate\View\View
    */
    public function profile(Request $request){
        return view('profile');
    }


    /**
    * Handle the profile update request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function updateProfile(UserUpdateRequest $request){
        $request->validated();

        try {

            $user=auth()->user();
            $this->userService->update($user->id,$request->all());

            return redirect(route('profile'))->with('success','Changes saved!');

        } catch(\Exception $e){

            return redirect(route('profile'))->with('success','Changes Not saved!');

        }
    }

    /**
    * Handle the profile delete request.
    *
    * @return \Illuminate\Http\RedirectResponse
    */
    public function delete(){

        try {

            $user=auth()->user();
            $this->userService->logout();
            $this->userService->delete($user->id);

            return redirect(route('login'))->with('error','User deleted');

        } catch(\Exception $e){
            
            return redirect(route('profile'))->with('error','User not deleted');

        }

    }
}
