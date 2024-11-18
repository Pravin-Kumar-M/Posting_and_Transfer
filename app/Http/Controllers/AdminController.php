<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cadre;
use App\Models\Office;
use App\Models\Subject;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;


class AdminController extends Controller
{

    public function index()
    {
        return view('admin.index');
    }
    // cadre
    public function cadre()
    {
        $cadres = Cadre::all();

        return view('admin.cadre', compact('cadres'));
    }
    // store cadre
    public function storeCadre(Request $request)
    {
        $messages = [];
        $allSuccess = true;
        $allExists = true;

        foreach ($request->cadre_name as $index => $cadre_name) {
            $cadre_name = trim($cadre_name);

            if (!empty($cadre_name)) {
                $existingCadre = Cadre::where('cadre_name', $cadre_name)->first();

                if ($existingCadre) {
                    $messages[] = "Row " . ($index + 1) . ":'$cadre_name' already exists.";
                    $allSuccess = false;
                } else {
                    Cadre::create(['cadre_name' => $cadre_name]);
                    $messages[] = "Row " . ($index + 1) . ":'$cadre_name' added successfully!";
                    $allExists = false;
                }
            }
        }

        // Use Flasher to send Toastr messages with an array of options
        if ($allSuccess) {
            Flasher::success('All rows were added successfully!', [
                'position' => 'top-center',
                'closeButton' => true,
                'closeDuration' => 15
            ]);
        } elseif ($allExists) {
            Flasher::error('All rows already exist.', [
                'position' => 'top-center',
                'closeButton' => true,
                'closeDuration' => 15
            ]);
        } else {
            // Flash individual messages for success/error cases
            foreach ($messages as $message) {
                if (strpos($message, 'added successfully') !== false) {
                    Flasher::success($message, [
                        'position' => 'top-center',
                        'closeButton' => true,
                        'closeDuration' => 15
                    ]);
                } else {
                    Flasher::error($message, [
                        'position' => 'top-center',
                        'closeButton' => true,
                        'closeDuration' => 15
                    ]);
                }
            }
        }

        // Flash messages for regular session output (if any)
        session()->flash('messages', $messages);

        return redirect()->route('admin.cadre');
    }
    // delete cadre
    public function destroy($id)
    {
        $cadre = Cadre::find($id);

        if ($cadre) {
            // Delete the cadre
            $cadre->delete();

            // Flash success message
            Flasher::success('Designation removed successfully!', [
                'position' => 'top-center',
                'closeButton' => true,
                'closeDuration' => 15
            ]);
        } else {
            // Flash error message if not found
            Flasher::error('Cadre not found!', [
                'position' => 'top-center',
                'closeButton' => true,
                'closeDuration' => 15
            ]);
        }

        return redirect()->route('admin.cadre'); // Redirect back to the cadre list
    }


    // office
    public function office()
    {
        // Retrieve all offices to pass to the view
        $offices = Office::all();

        return view('admin.office', compact('offices'));
    }
    // store office
    public function storeOffice(Request $request)
    {
        $messages = [];
        $allSuccess = true;
        $allExists = true;

        foreach ($request->office_name as $index => $office_name) {
            $office_name = trim($office_name);

            if (!empty($office_name)) {
                $existingOffice = Office::where('office_name', $office_name)->first();

                if ($existingOffice) {
                    $messages[] = "Row " . ($index + 1) . ":'$office_name' already exists.";
                    $allSuccess = false;
                } else {
                    Office::create(['office_name' => $office_name]);
                    $messages[] = "Row " . ($index + 1) . ":'$office_name' added successfully!";
                    $allExists = false;
                }
            }
        }

        // Use Flasher to send Toastr messages with an array of options
        if ($allSuccess) {
            Flasher::success('All rows were added successfully!', [
                'position' => 'top-center',
                'closeButton' => true,
                'closeDuration' => 15
            ]);
        } elseif ($allExists) {
            Flasher::error('All rows already exist.', [
                'position' => 'top-center',
                'closeButton' => true,
                'closeDuration' => 15
            ]);
        } else {
            // Flash individual messages for success/error cases
            foreach ($messages as $message) {
                if (strpos($message, 'added successfully') !== false) {
                    Flasher::success($message, [
                        'position' => 'top-center',
                        'closeButton' => true,
                        'closeDuration' => 15
                    ]);
                } else {
                    Flasher::error($message, [
                        'position' => 'top-center',
                        'closeButton' => true,
                        'closeDuration' => 15
                    ]);
                }
            }
        }

        // Flash messages for regular session output (if any)
        session()->flash('messages', $messages);

        return redirect()->route('admin.office');
    }
    // office destroy
    public function destroyOffice($id)
    {
        $office = Office::find($id);

        if ($office) {
            // Delete the cadre
            $office->delete();

            // Flash success message
            Flasher::success('Designation removed successfully!', [
                'position' => 'top-center',
                'closeButton' => true,
                'closeDuration' => 15
            ]);
        } else {
            // Flash error message if not found
            Flasher::error('Cadre not found!', [
                'position' => 'top-center',
                'closeButton' => true,
                'closeDuration' => 15
            ]);
        }

        return redirect()->route('admin.office');
    }


    // subject
    public function subject()
    {
        // Retrieve all offices to pass to the view
        $subjects = Subject::all();

        return view('admin.subject', compact('subjects'));
    }
    // store subject
    public function storeSubject(Request $request)
    {
        $messages = [];
        $allSuccess = true;
        $allExists = true;

        foreach ($request->subject_name as $index => $subject_name) {
            $subject_name = trim($subject_name);

            if (!empty($subject_name)) {
                $existingSubject = Subject::where('subject_name', $subject_name)->first();

                if ($existingSubject) {
                    $messages[] = "Row " . ($index + 1) . ":'$subject_name' already exists.";
                    $allSuccess = false;
                } else {
                    Subject::create(['subject_name' => $subject_name]);
                    $messages[] = "Row " . ($index + 1) . ":'$subject_name' added successfully!";
                    $allExists = false;
                }
            }
        }

        // Use Flasher to send Toastr messages with an array of options
        if ($allSuccess) {
            Flasher::success('All rows were added successfully!', [
                'position' => 'top-center',
                'closeButton' => true,
                'closeDuration' => 15
            ]);
        } elseif ($allExists) {
            Flasher::error('All rows already exist.', [
                'position' => 'top-center',
                'closeButton' => true,
                'closeDuration' => 15
            ]);
        } else {
            // Flash individual messages for success/error cases
            foreach ($messages as $message) {
                if (strpos($message, 'added successfully') !== false) {
                    Flasher::success($message, [
                        'position' => 'top-center',
                        'closeButton' => true,
                        'closeDuration' => 15
                    ]);
                } else {
                    Flasher::error($message, [
                        'position' => 'top-center',
                        'closeButton' => true,
                        'closeDuration' => 15
                    ]);
                }
            }
        }

        // Flash messages for regular session output (if any)
        session()->flash('messages', $messages);

        return redirect()->route('admin.subject');
    }

    // office destroy
    public function destroySubject($id)
    {
        $subject = Subject::find($id);

        if ($subject) {
            // Delete the cadre
            $subject->delete();

            // Flash success message
            Flasher::success('Section removed successfully!', [
                'position' => 'top-center',
                'closeButton' => true,
                'closeDuration' => 15
            ]);
        } else {
            // Flash error message if not found
            Flasher::error('Cadre not found!', [
                'position' => 'top-center',
                'closeButton' => true,
                'closeDuration' => 15
            ]);
        }

        return redirect()->route('admin.subject');
    }
}
