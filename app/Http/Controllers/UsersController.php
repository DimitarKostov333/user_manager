<?php

namespace App\Http\Controllers;

use App\Mail\MailEvent;
use App\User;
use App\WorldLanguages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // If visitor is not verified send them to login
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Create user data array to be sent to front page
        $userData = [
            'allUsersDetails' => User::all()
        ];

        // Pass user name to the home page
        return view('index', $userData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // Create user data array to be sent to the edit page
        $userData = [
            'languages' => WorldLanguages::all(),
            'request' => ''
        ];

        // Pass user name to the home page
        return view('auth.add_user', $userData);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // Validate the input before updating the post.
        $validatedData = $request->validate([
            'name' => 'string|required|min:2|max:100',
            'surname' => 'string|required|min:2|max:100',
            'personal_id_number' => 'required|unique:users,personal_id_number|min:10|max:13',
            'mobile_number' => 'required|unique:users,mobile_number|min:8|max:10',
            'email' => 'required|unique:users,email|email'
        ]);

        // Create a new user record
        $user = new User();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->personal_id_number = $request->personal_id_number;
        $user->mobile_number = $request->mobile_number;
        $user->birth_date = date('Y-m-d', strtotime($request->birth_date));
        $user->language = $request->language ? $request->language : "English";
        $user->email = $request->email;
        $user->created_by_user = Auth::id();
        $user->save();

        // If a new password was entered by the user validate and update it.
        if($request->password){
            $user->password = Hash::make($request->password);
        }

        // Refresh the user model and send back the new information
        if($user->save()){
            $email = $user->email;

            $body = [
                'name'=>$user->name
            ];

            // Send email to user
            $sendEmail = Mail::send('email.email',['body' => $body],function($message) use ($email) {
                    $message->to($email)->subject('Successful ProPay Registration');
                }
            );

            if($sendEmail){
                return redirect()->back()->with('message', 'User ' . $user->name . ' ' . $user->surname . ' successfully added.');
            }else{
                return redirect()->back()->with('message', 'The profile was added successfully however a notification could not be sent.');
            }
        }else{
            return redirect()->back()->with('message', 'Oops, we encountered an error, please try again later.');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // Fetch user data by user id
        $userData = User::findOrFail(Auth::id());

        // Send user's data back to view
        return response()->json($userData);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        // Create user data array to be sent to the edit page
        $userData = [
            'allUsersDetails' => User::find($id),
            'languages' => WorldLanguages::all()
        ];

        // Pass user name to the home page
        return view('auth.edit_user', $userData);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the input before updating the post.
        $validatedData = $request->validate([
            'name' => 'string|required|min:2|max:100',
            'surname' => 'string|required|min:2|max:100'
        ]);

        // If there are no validation errors, find the user by id and edit the profile.
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->personal_id_number = $request->personal_id_number;
        $user->mobile_number = $request->mobile_number;
        $user->birth_date = $request->birth_date;
        $user->language = $request->language;
        $user->email = $request->email;
        $user->updated_by_user = Auth::id();

        // If a new password was entered by the user validate and update it.
        if($request->password){
            $user->password = Hash::make($request->password);
        }

        // Refresh the user model and send back the new information
        if($user->save()){
            return redirect()->back()->with('message', 'User ' . $request->name . ' ' . $request->surname . '\'s profile edited successfully');
        }else{
            return redirect()->back()->with('message', 'Oops, we encountered an error, please try again later.');
        }
    }

}
