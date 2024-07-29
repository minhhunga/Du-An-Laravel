<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MemberRequest;
use App\Http\Requests\LoginMemberRequest;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    

    public function register()
    {
        return view('Frontend.member.register');

    }

    public function postRegister(MemberRequest $request){
        $member=new Member();
        $member->name=$request->input('name');
        $member->email=$request->input('email');
        $member->password=$request->input('password');
         $member->phone=$request->input('phone');
         
          $member->level = 0;
         
         if ($member['password']) {
            $member['password'] = bcrypt($member['password']);
        }else{
            $member['password'] = $member->password;
        }
        $member->save();
        return redirect()->route('Registerr');   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function login()
    {
        //
        return view('Frontend.member.login');
    }

    public function postLogin(LoginMemberRequest $request)
    {
        $login=[
            'email'=> $request->email,
            'password'=> $request->password,
            'level'=>0
        ];
        $remember=false;
        if($request->remember_me){
            $remember=true;
        }
        if(Auth::attempt($login, $remember)){
            return redirect('/Frontend/index');
        }else{
            return redirect()->back()->withErrors('Email hoặc mật khẩu sai');
        }
        
    }
    public function logout(Request $request){
        Auth::logout();

        return redirect()->route('Loginn');
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        //
    
            
    }
}
