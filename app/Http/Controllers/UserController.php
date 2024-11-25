<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return view('user-management');
    }

    public function getUsers(Request $request)
    {
        $search = $request->input('search');

        $users = User::select('id', 'name', 'email', 'no_hp', 'role', 'last_seen')
            ->when($search, function ($query) use ($search) {
                return $query->where('email', 'like', "%{$search}%");
            })
            ->get()
            ->map(function ($user) {
                $user->is_online = $user->last_seen && $user->last_seen->gt(now()->subMinutes(2));
                return $user;
            })
            ->sortBy(function ($user) {
                return [!$user->is_online, $user->name];
            })
            ->values();

        return response()->json($users);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
                'no_hp' => 'required|string',
                'role' => 'required|in:admin,karyawan',
            ]);

            $name = ucwords(strtolower($request->name));
            $no_hp = $request->no_hp;
            if (!str_starts_with($no_hp, '62')) {
                $no_hp = '62' . $no_hp;
            }

            $user = new User();
            $user->name = $name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->no_hp = $no_hp;
            $user->role = $request->role;
            $user->save();

            return response()->json(['success' => true, 'message' => 'User created successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
        }
    }

    public function edit($id)
    {
        try {
            $user = User::findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $user->toArray()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'User not found or error occurred'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'.$id,
                'no_hp' => 'required|string',
                'role' => 'required|in:admin,karyawan',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $no_hp = $request->no_hp;
            if (!str_starts_with($no_hp, '62')) {
                $no_hp = '62' . $no_hp;
            }

            $user = User::findOrFail($id);
            $user->name = ucwords(strtolower($request->name));
            $user->email = $request->email;
            $user->no_hp = $no_hp;
            $user->role = $request->role;
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'User updated successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the user.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(['success' => true, 'message' => 'User deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
        }
    }
}