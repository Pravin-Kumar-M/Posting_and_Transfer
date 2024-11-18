<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Flasher\Toastr\Prime\ToastrInterface;


class StaffController extends Controller
{
    // home

    public function index()
    {
        return view('staff.index');
    }

    public function staff_entry()
    {
        return view('staff.staff');
    }


    // store data
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string',
            'father_name' => 'required|string',
            'email' => 'required|email|unique:staff,email',
            'dob' => 'required|date',
            'aadhar_number' => 'required|numeric|digits:12',
            'phone_number' => 'required|numeric|digits:10|unique:staff,phone_number',
            'gender' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:1024',
            'cadre' => 'required|array|min:1',
            'office' => 'required|array|min:1',
            'subject' => 'required|array|min:1',
            'joining_date' => 'required|array|min:1',
            'relieving_date' => 'required|array|min:1',
            'cadre.*' => 'required',
            'office.*' => 'required',
            'subject.*' => 'required',
            'joining_date.*' => 'required|date',
            'relieving_date.*' => 'required|date',
        ]);

        try {
            $image = $request->file('image');
            $imagename = null;

            if ($image) {

                $imagename = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imagename);
            }


            // Insert into 'staff' table
            $staff = Staff::create([
                'name' => $request->name,
                'father_name' => $request->father_name,
                'email' => $request->email,
                'dob' => $request->dob,
                'aadhar_number' => $request->aadhar_number,
                'phone_number' => $request->phone_number,
                'gender' => $request->gender,
                'image' => $imagename,
            ]);

            // Insert into 'experiences' table
            $experiences = [];
            foreach ($request->cadre as $index => $cadreId) {
                if (
                    !isset($request->office[$index], $request->subject[$index], $request->joining_date[$index], $request->relieving_date[$index])
                ) {
                    return back()->withErrors(['error' => 'All fields must be filled for each experience row.']);
                }

                $experiences[] = [
                    'staff_id' => $staff->id,
                    'cadre_id' => $cadreId,
                    'office_id' => $request->office[$index],
                    'subject_id' => $request->subject[$index],
                    'joining_date' => $request->joining_date[$index],
                    'relieving_date' => $request->relieving_date[$index],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Bulk insert the experiences
            Experience::insert($experiences);

            toastr()
                ->timeOut(1000)
                ->closeButton()
                ->addSuccess('Your details are added successfully');

            // Redirect with success message
            return redirect()->route('staff.view_detail', ['id' => $staff->id]);
        } catch (\Exception $e) {
            Log::error('Error saving staff data: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Something went wrong while saving the data.']);
        }
    }

    public function view_detail($id)
    {
        // Fetch staff details along with experiences using Eloquent relationships
        $staff = Staff::with('experiences.office', 'experiences.cadre', 'experiences.subject')
            ->findOrFail($id);

        // Pass the data to the view
        return view('staff.view_detail', compact('staff'));
    }

    public function printPdf($id)
    {
        $staff = Staff::with('experiences.office', 'experiences.cadre', 'experiences.subject')->findOrFail($id);

        $pdf = Pdf::loadView('staff.print_pdf', compact('staff'));
        $filename = strtolower(str_replace(' ', '_', $staff->name)) . '.pdf';
        return $pdf->download($filename);
    }
}
