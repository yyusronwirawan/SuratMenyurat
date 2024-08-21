<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\StudyProgram;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $departments = Department::where('status', 'Active')
            ->orderBy('department_name')
            ->get();
        $programStudi = StudyProgram::where('status', 'Active')
            ->orderBy('study_program_name')
            ->get();

        return view('auth.register')
            ->with(compact('departments'))
            ->with(compact('programStudi'));
    }
    public function register(Request $request)
    {
        $currentYear = Carbon::now()->format('y');
        // $allowedYears = range($currentYear - 6, $currentYear);
        $allowedYears = range($currentYear - 8, $currentYear);

        $allowedYearString = implode('|', $allowedYears);

        $request->validate([
            'first_name' => ['required', 'string', 'max:255', 'regex:/^[^\/\*\|:"\'<>?\$%]+$/'],
            'last_name' => ['required', 'string', 'max:255', 'regex:/^[^\/\*\|:"\'<>?\$%]+$/'],
            'department_id' => ['required', 'string'],
            'study_program_id' => ['required', 'string'],
            'gender' => ['required'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'npm' => ['required', 'string', 'regex:/^(' . $allowedYearString . ')06\d{6}$/'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'role_id' => 2,
            'email' => $request->email,
            'department_id' => $request->department_id,
            'study_program_id' => $request->study_program_id,
            'npm' => $request->npm,
            'gender' => $request->gender,
            'status' => 'Active',
            'created_by' => 'REGISTER',
            'password' => Hash::make($request->password),
        ]);


        // $user->sendEmailVerificationNotification();

        return redirect()->route('login')->with('success', 'Selamat anda berhasil terdaftar, silakan login!');
        // return redirect()->route('register')->with('status', 'Register Berhasil, Silakan verifikasi alamat email Anda!');
    }
}

/*

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    use RegistersUsers;
    protected $redirectTo = RouteServiceProvider::HOME;
    public function __construct()
    {
        $this->middleware('guest');
    }
    protected function validator(array $data)
    {
        return Validator::make($data,  [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'npm' => ['required', 'string', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
    protected function create(array $data)
    {
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone' => $data['phone'],
            'role_id' => 2,
            'email' => $data['email'],
            'npm' => $data['npm'],
            'gender' => $data['gender'],
            'status' => 'Active',
            'created_by' => 'REGISTER',
            'password' => Hash::make($data['password']),
        ]);


        $user->sendEmailVerificationNotification();
        return redirect()->intended('/login');
        return $user;
    }
}
*/
