<?php

namespace App\Http\Controllers;

use App\Enums\RoleTypes;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UserController extends Controller
{
    protected array $roles;

    public function __construct()
    {
        $this->roles = RoleTypes::toOptions();
    }

    public function index(): Response
    {
        return Inertia::render('User/IndexPage', [
            'users' => UserResource::collection(
                User::query()->whereNot('id', Auth::user()?->id)->get()
            )->resource,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('User/CreatePage', [
            'roles' => $this->roles,
        ]);
    }

    public function edit(User $user): Response
    {
        return Inertia::render('User/EditPage', [
            'roles' => $this->roles,
            'user' => UserResource::make($user),
        ]);
    }

    public function store(UserRequest $request): RedirectResponse
    {
        User::query()->updateOrCreate(
            [
                'id' => $request->input('id'),
            ],
            [
                'first_name' => $request->input('firstName'),
                'last_name' => $request->input('lastName'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'role' => $request->input('role'),
            ]
        );

        return redirect()->back();
    }

    public function delete(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->back();
    }
}
