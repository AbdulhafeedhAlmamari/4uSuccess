<?php

namespace App\Http\Controllers;

use App\Models\Consultant;
use App\Models\ConsultationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultationRequestController extends Controller
{
    public function index($status)
    {
        // Get all consultation requests for the logged-in consultant
        $consultationRequests = ConsultationRequest::where('consultant_id', Auth::id())
            ->where('status', $status)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboards.consultants.orders', compact('consultationRequests', 'status'));
    }
    /**
     * Display the consultation request form.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get all active consultants
        $consultants = User::where('role', 'consultant')->where('is_approved', 1)->get();
        // $consultants = Consultant::whereHas('user', function ($query) {
        //     $query->where('is_approved', 1)
        //     ->where('role', 'consultant');
        // })->get();
        // dd($consultants);

        return view('consultants.consultation-request', compact('consultants'));
    }

    /**
     * Store a newly created consultation request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'specialization' => 'required|string|max:255',
            'gender' => 'required|string|in:ذكر,أنثى',
            'consultant_id' => 'required|exists:users,id',
            'consultation_type' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'يجب تسجيل الدخول أولاً لإرسال طلب استشارة');
        }

        // Create the consultation request
        ConsultationRequest::create([
            'student_id' => Auth::id(),
            'consultant_id' => $validated['consultant_id'],
            'specialization' => $validated['specialization'],
            'gender' => $validated['gender'] === 'ذكر' ? '1' : '0',
            'type' => $validated['consultation_type'],
            'subject' => $validated['subject'],
            'description' => $validated['message'],
            'request_date' => now(),
            'status' => 'pending', // Default status
        ]);

        return redirect()->back()->with('success', 'تم إرسال طلب الاستشارة بنجاح');
    }

    /**
     * Filter consultants based on specialization and gender.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function filterConsultants(Request $request)
    {
        $specialization = $request->input('specialization');
        $gender = $request->input('gender');

        $consultants = Consultant::whereHas('user', function ($query) use ($gender) {
            $query->where('gender', $gender)
                ->where('is_active', true);
        })
            ->where('specialization', $specialization)
            ->get()
            ->map(function ($consultant) {
                return [
                    'id' => $consultant->id,
                    'name' => $consultant->user->name
                ];
            });

        return response()->json([
            'consultants' => $consultants
        ]);
    }

    /**
     * Accept a consultation request.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function accept($id)
    // {
    //     $consultationRequest = ConsultationRequest::findOrFail($id);

    //     // Check if the consultant is authorized to update this request
    //     if ($consultationRequest->consultant_id != Auth::id()) {
    //         return redirect()->back()->with('error', 'غير مصرح لك بتحديث هذا الطلب');
    //     }

    //     $consultationRequest->status = 'accepted';
    //     $consultationRequest->save();

    //     return redirect()->back()->with('success', 'تم قبول الطلب بنجاح');
    // }
    public function accept(Request $request, $id)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'response' => 'required|string|max:1000',
        ]);

        // جلب الطلب من قاعدة البيانات
        $consultationRequest = ConsultationRequest::findOrFail($id);

        // تحديث حالة الطلب وإضافة الرد
        $consultationRequest->status = 'accepted';
        $consultationRequest->reply = $request->input('response');
        $consultationRequest->save();

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->back()->with('success', 'تم قبول الطلب وإضافة الرد بنجاح.');
    }

    /**
     * Reject a consultation request.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function reject($id)
    // {
    //     $consultationRequest = ConsultationRequest::findOrFail($id);

    //     // Check if the consultant is authorized to update this request
    //     if ($consultationRequest->consultant_id != Auth::id()) {
    //         return redirect()->back()->with('error', 'غير مصرح لك بتحديث هذا الطلب');
    //     }

    //     $consultationRequest->status = 'rejected';
    //     $consultationRequest->save();

    //     return redirect()->back()->with('success', 'تم رفض الطلب بنجاح');
    // }

    public function reject(Request $request, $id)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'reply' => 'required|string|max:1000',
        ]);

        // جلب الطلب من قاعدة البيانات
        $consultationRequest = ConsultationRequest::findOrFail($id);

        // تحديث حالة الطلب وإضافة سبب الرفض
        $consultationRequest->status = 'rejected';
        $consultationRequest->reply = $request->input('reply');
        $consultationRequest->save();

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->back()->with('success', 'تم رفض الطلب مع إضافة السبب بنجاح.');
    }
    public function updateStatus(Request $request, $id)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'reply' => 'required|string|max:1000',
        ]);

        // جلب الطلب من قاعدة البيانات
        $consultationRequest = ConsultationRequest::findOrFail($id);

        // تحديث حالة الطلب وإضافة سبب الرفض
        $consultationRequest->status = 'rejected';
        $consultationRequest->reply = $request->input('reply');
        $consultationRequest->save();

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->back()->with('success', 'تم رفض الطلب مع إضافة السبب بنجاح.');
    }

    /**
     * Complete a consultation request.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function complete($id)
    {
        $consultationRequest = ConsultationRequest::findOrFail($id);

        // Check if the consultant is authorized to update this request
        if ($consultationRequest->consultant_id != Auth::id()) {
            return redirect()->back()->with('error', 'غير مصرح لك بتحديث هذا الطلب');
        }

        $consultationRequest->status = 'completed';
        $consultationRequest->save();

        return redirect()->back()->with('success', 'تم إكمال الطلب بنجاح');
    }
}
