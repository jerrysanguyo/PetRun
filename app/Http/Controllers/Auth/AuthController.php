<?php

namespace App\Http\Controllers\Auth;

use App\DataTables\PawRunDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\accountRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(LoginRequest $request)
    {
        $user = $this->authService->authenticate($request->validated());

        $ip = $request->ip();
        $agent = $request->header('User-Agent');

        activity()
            ->performedOn($user)
            ->causedBy($user)
            ->withProperties([
                'ip'     => $ip,
                'agent'  => $agent,
            ])
            ->log('User ' . $user->name . ' successfully logged in');

        return redirect()
            ->route(Auth::user()->getRoleNames()->first() . '.dashboard.index')
            ->with('success', 'You have successfully logged in!');
    }

    public function logout()
    {
        $user = Auth::user();
        $ip = request()->ip();
        $agent = request()->header('User-Agent');

        $this->authService->logout();

        if ($user) {
            activity()
                ->performedOn($user)
                ->causedBy($user)
                ->withProperties([
                    'ip'    => $ip,
                    'agent' => $agent,
                ])
                ->log('User ' . $user->name . ' successfully logged out');
        }

        return redirect()
            ->route('login')
            ->with('success', 'You have successfully logged out!');
    }

    public function accountIndex(PawRunDataTable $dataTable)
    {
        $page_title = 'User Accounts';
        $resource = 'account';
        $data = User::getAllUsers();
        $columns = ['name', 'email', 'contact number', 'role', 'action'];
        $roles = Role::query()
            ->where('guard_name', 'web')
            ->orderBy('name')
            ->get(['id', 'name']);

        return $dataTable->render('table.index', compact(
            'dataTable',
            'data',
            'resource',
            'page_title',
            'columns',
            'roles',
        ));
    }

    public function accountStore(accountRequest $request)
    {
        $record = $this->authService->accountStore($request->validated());

        activity()
            ->performedOn($record)
            ->causedBy(Auth::user())
            ->log('User ' . Auth::user()->name . 'successfully created ' . $record->getRoleNames()->first() . ' account for ' . $record->name);

        return redirect()
            ->route(Auth::user()->getRoleNames()->first() . '.account.index')
            ->with('success', 'You have succesfullly created ' . $record->getRoleNames()->first() . ' account for ' . $record->name);
    }

    public function accountUpdate(AccountRequest $request, $uuid)
    {
        $record = $this->authService->accountUpdate($request->validated(), $uuid);

        $old = $record->oldValues ?? [];

        activity()
            ->performedOn($record)
            ->causedBy(Auth::user())
            ->withProperties([
                'old' => $old,
                'new' => $record->only(['name', 'email', 'contact_number']),
            ])
            ->log('User ' . Auth::user()->name . ' successfully updated ' . $record->getRoleNames()->first() . ' account for ' . $record->name);

        return redirect()
            ->route(Auth::user()->getRoleNames()->first() . '.account.index')
            ->with('success', 'You have successfully updated ' . $record->getRoleNames()->first() . ' account for ' . $record->name);
    }

    public function accountDestroy(string $uuid)
    {
        $record = $this->authService->accountDestroy($uuid);

        $old = $record->oldValues ?? [];

        activity()
            ->performedOn($record)
            ->causedBy(Auth::user())
            ->withProperties([
                'old' => $old,
            ])
            ->log(
                'User ' . Auth::user()->name . ' deleted ' . ($record->getRoleNames()->first() ?? 'account') . ' for ' . ($old['name'] ?? 'unknown')
            );

        return redirect()
            ->route(Auth::user()->getRoleNames()->first() . '.account.index')
            ->with('success', 'Successfully deleted ' . ($old['name'] ?? 'the account') . '.');
    }
}