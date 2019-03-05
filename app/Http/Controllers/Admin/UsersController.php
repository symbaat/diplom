<?php

namespace App\Http\Controllers\Admin;

use App\Group;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

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
            return view('admin.users.index2', compact('users', 'role'));

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

        $groups = Group::all();

        return view('admin.users.create', compact('role', 'groups'));
    }

    /**
     * @param CreateUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
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

    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, User $user)
    {
        $role_id = ($request->role == null) ? 3 : $request->role;
        $role = Role::find($role_id);

        $groups = Group::all();

        return view('admin.users.edit', compact('role', 'user', 'groups'));
    }

    /**
     * @param UpdateUserRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->only([
            'name', 'surname', 'lastname', 'parent_name', 'gender', 'address', 'email'
        ]));


        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $img = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/img');
            $image->move($destinationPath, $img);
            if (File::exists('img/' . $user->image)) {
                unlink(public_path('img/' . $user->image));
                File::delete('img/' . $user->image);
            }
            $user->image = $img;
        }

        $user->birthday = Carbon::createFromFormat('d/m/Y', $request->birthday);
        $user->save();

        return redirect()->route('admin.users.index', ['role' => $user->role_id]);
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index', ['role' => $user->role_id]);
    }
}
