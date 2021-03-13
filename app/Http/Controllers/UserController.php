<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tb_user;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=Tb_user::latest()->get();
        return response()->json([
            'success' => true,
            'message' => 'List Data User',
            'data'    => $users  
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //set validation
    $validator = Validator::make($request->all(), [
        'staff_name'   => 'required|max:10',
        'staff_email' => 'required|email',
        'staff_password' => 'required',
        'staff_hp' => 'required',
        'staff_alamat' => 'required'
    ]);
    
    //response error validation
    if ($validator->fails()) {
        return response()->json($validator->errors(), 400);
    }

    //save to database
    $post = Tb_user::create([
        'staff_name'     => $request->staff_name,
        'staff_email'   => $request->staff_email,
        'staff_password'   => bcrypt($request->staff_password),
        'staff_hp'   => $request->staff_hp,
        'staff_alamat'   => $request->staff_alamat,
    ]);

    //success save to database
    if($post) {

        return response()->json([
            'success' => true,
            'message' => 'User Created',
            'data'    => $post  
        ], 201);

    } 

    //failed save to database
    return response()->json([
        'success' => false,
        'message' => 'User Failed to Save',
    ], 409);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Tb_user::where('staff_id', $id)->firstOrFail();
        if($user){
            //make response JSON
            return response()->json([
                'success' => true,
                'message' => 'Detail Data User',
                'data'    => $user 
            ], 200);

        }

        //data post not found
        return response()->json([
            'success' => false,
            'message' => 'User Not Found',
        ], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
       
      
        $validator = Validator::make($request->all(), [
            'staff_name'   => 'required|max:30',
            'staff_email' => 'required',
            'staff_password' => 'required',
            'staff_hp' => 'required',
            'staff_alamat' => 'required'
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //find post by ID
        $user = Tb_user::findOrFail($id);

        if($user) {

            //update post
            $user->update([
                'staff_name'     => $request->staff_name,
                'staff_email'   => $request->staff_email,
                'staff_password'   => bcrypt($request->staff_password),
                'staff_hp'   => $request->staff_hp,
                'staff_alamat'   => $request->staff_alamat
            ]);

            return response()->json([
                'success' => true,
                'message' => 'User Updated',
                'data'    => $user  
            ], 200);

        }

        //data post not found
        return response()->json([
            'success' => false,
            'message' => 'User Not Found',
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Tb_user::findOrfail($id);

        if($post) {

            //delete post
            $post->delete();

            return response()->json([
                'success' => true,
                'message' => 'User Deleted',
            ], 200);

        }

        //data post not found
        return response()->json([
            'success' => false,
            'message' => 'User Not Found',
        ], 404);
    }
}