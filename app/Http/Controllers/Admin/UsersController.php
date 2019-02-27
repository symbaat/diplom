<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateUserRequest;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $role_id = ($request->role == null) ? 3 : $request->role;

        $users = User::where('role_id', $role_id)->get();

        $role = Role::find($role_id);

        if ($request->view == 2)
            return view('admin.users.index2', compact('users'));

        return view('admin.users.index', compact('users', 'role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $role_id = ($request->role == null) ? 3 : $request->role;
        $role = Role::find($role_id);

        return view('admin.users.create', compact('role'));
    }


    /**
     * @param CreateUserRequest $request
     */
    public function store(CreateUserRequest $request)
    {
        $img = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $img = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/img');
            $image->move($destinationPath, $img);
        }

        $user = User::create([
            'role_id'       => $request->role_id,
            'name'          => $request->name,
            'surname'       => $request->surname,
            'lastname'      => $request->lastname,
            'birthday'      => Carbon::createFromFormat('d/m/Y', $request->birthday),
            'parent_name'   => $request->parent_name,
            'gender'        => $request->gender,
            'phone_number'  => $request->phone_number,
            'address'       => $request->address,
            'email'         => $request->email,
            'password'      => bcrypt($request->password),
            'image'         => $img
        ]);

        dd($user);
        return redirect()->route('admin.users.index', ['role' => $request->role_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
