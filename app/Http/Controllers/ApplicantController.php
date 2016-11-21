<?php

namespace App\Http\Controllers;

use App\Applicant;
use App\Documentation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Validator;
use App\Http\Requests;
use Carbon\Carbon;
use App\Fundme;

class ApplicantController extends Controller
{
    public function index()
    {
        $applicants = Applicant::with('user')->orderBy('updated_at', 'desc')->get();

        $parameters = [
            'applicants' => $applicants,
        ];

        return view('applicants.index')->with($parameters);
    }

    public function create()
    {

        $parameters = [
        ];

        return view('applicants.create')->with($parameters);
    }

    public function handleCreate(Request $request)
    {
        $post = $request->all();

        $rules = [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'student_number' => 'required|max:255',
            'cellphone' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'address_line_1' => 'max:255',
            'address_line_2' => 'max:255',
            'address_line_3' => 'max:255',
            'address_line_4' => 'max:255',
        ];
        $valid = Validator::make($post, $rules);

        if (!$valid->passes()) {
            return back()->withErrors($valid)->withInput();
        }

        $applicant = new Applicant();
        $applicant->student_number = $request->input('student_number');
        $applicant->cellphone = $request->input('cellphone');
        $applicant->address_line_1 = $request->input('address_line_1');
        $applicant->address_line_2 = $request->input('address_line_2');
        $applicant->address_line_3 = $request->input('address_line_3');
        $applicant->address_line_4 = $request->input('address_line_4');
        $applicant->save();

        $password = str_random(8);
        $files = \Illuminate\Support\Facades\Storage::files('defaultavatars');
        $file = $files[rand(0,count($files))];

        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = Hash::make($password);
        $user->avatar = $file;
        $user->userable_id = $applicant->id;
        $user->userable_type = 'App\Applicant';
        $user->save();

        Fundme::sendNewUserMail($user,$password);

        return redirect()->route('applicants')->with('flash_success', trans('string.new_applicant_success'));
    }

    public function view(Applicant $applicant)
    {
        $parameters = [
            'applicant' => $applicant,
        ];

        return view('applicants.view')->with($parameters);
    }

    public function edit(Applicant $applicant)
    {

        $parameters = [
            'applicant' => $applicant,
        ];

        return view('applicants.edit')->with($parameters);
    }

    public function handleEdit(Request $request, Applicant $applicant)
    {
        $post = $request->all();

        $rules = [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'student_number' => 'required|max:255',
            'cellphone' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,id,' . $applicant->id,

            'address_line_1' => 'max:255',
            'address_line_2' => 'max:255',
            'address_line_3' => 'max:255',
            'address_line_4' => 'max:255',
        ];
        $valid = Validator::make($post, $rules);

        if (!$valid->passes()) {
            return back()->withErrors($valid)->withInput();
        }

        $applicant->student_number = $request->input('student_number');
        $applicant->cellphone = $request->input('cellphone');
        $applicant->address_line_1 = $request->input('address_line_1');
        $applicant->address_line_2 = $request->input('address_line_2');
        $applicant->address_line_3 = $request->input('address_line_3');
        $applicant->address_line_4 = $request->input('address_line_4');
        $applicant->save();

        $user = $applicant->user;
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->save();

        return redirect()->route('applicants')->with('flash_success', trans('string.edit_applicant_success'));
    }

    public function handleDelete(Applicant $applicant)
    {
        $applicant->user->delete();
        $applicant->delete();

        return redirect()->back()->with('flash_success', trans('string.delete_applicant_success'));
    }

    public static function getDashboardString()
    {
        $new_count = Applicant::where('created_at','>', Carbon::now()->subDay())->count();
        if($new_count!=0){
            return $new_count.' new '.trans_choice('string.applicant',$new_count).'.';
        } else {
            return "No new applicants.";
        }
    }

    public function handleDocumentation(Request $request, Applicant $applicant)
    {
        $post = $request->all();

        $rules = [
            'documentation' => 'required|file|mimes:jpeg,bmp,png,pdf',
        ];
        $valid = Validator::make($post, $rules);

        if (!$valid->passes()) {
            return Redirect::to(URL::previous() . "#profile")->withErrors($valid)->withInput();
        }

        $path = $request->file('documentation')->store('documentations');

        $documentation = new Documentation();
        $documentation->applicant_id = $applicant->id;
        $documentation->attachment = $path;
        $documentation->save();

        return Redirect::to(URL::previous() . "#profile")->with('flash_success', trans('string.new_documentation_success'));
    }

    public function handleDocumentationDelete(Documentation $documentation)
    {
        $documentation->delete();

        return Redirect::to(URL::previous() . "#profile")->with('flash_success', trans('string.delete_documentation_success'));
    }
}
