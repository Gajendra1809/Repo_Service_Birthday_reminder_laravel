<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddDateRequest;
use App\Services\BirthdayService;

/**
 * Class DateController
 *
 * This controller handles the birthday management processes.
 * It includes methods for displaying the home page with birthday information,
 * creating new birthday records, and deleting existing birthday records.
 */
class DateController extends Controller
{

    /**
    * @var BirthdayService
    */
    protected $birthdayService;

    /**
    * DateController constructor.
    *
    * @param BirthdayService $birthdayService
    */
    public function __construct(BirthdayService $birthdayService){
        $this->birthdayService=$birthdayService;
    }

    /**
    * Display the user's home page with birthday information.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\View\View
    */
    public function index(Request $request){

        $birthday = $this->birthdayService->getUpComing();
        $data = $this->birthdayService->allWhereUserId(auth()->user()->id);
        
        return view("home",compact("birthday","data"));
    }


    /**
    * Create a new birthday record for the user.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function create(AddDateRequest $request){
        $request->validated();

        try {

            $this->birthdayService->create($request->all());
            return redirect(route('home'))->with('success','Birthdate Added!');
            
        } catch(\Exception $e){

            return redirect(route('home'))->with('error','Birthdate Not Added!');

        }
    }

    /**
    * Delete a birthday record.
    *
    * @param  int  $id
    * @return \Illuminate\Http\RedirectResponse
    */
    public function delete($id){

        try {

            $this->birthdayService->delete($id);
            return redirect(route('home'))->with('success','Birthdate Deleted!');

        } catch(\Exception $e){

            return redirect(route('home'))->with('error','Birthdate Not Deleted!');

        }
    }

}
