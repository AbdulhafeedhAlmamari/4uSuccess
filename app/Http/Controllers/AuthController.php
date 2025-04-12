<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Consultant;
use App\Models\FinancingCompany;
use App\Models\HousingCompany;
use App\Models\TransportationCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    // login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'يرجى إدخال بريد إلكتروني صالح',
            'password.required' => 'كلمة المرور مطلوبة',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Check if user is approved (except for admin)
            if ($user->role !== 'admin' && $user->is_approved !== '1') {
                Auth::logout();
                return response()->json([
                    'success' => false,
                    'message' => 'حسابك قيد المراجعة من قبل الإدارة'
                ], 401);
            }

            // Redirect based on user role
            $redirect = $this->getRedirectRouteBasedOnRole($user->role);

            session()->flash('success', 'تم تسجيل الدخول بنجاح');

            return response()->json([
                'success' => true,
                'redirect' => $redirect,
                'message' => 'تم تسجيل الدخول بنجاح'
            ]);
        }

        // session()->flash('error', 'البريد الإلكتروني او كلمة المرور غير صحيحة');

        return response()->json([
            'success' => false,
            'message' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة'
        ], 401);
    }

    // Redirect based on user role
    private function getRedirectRouteBasedOnRole($role)
    {
        switch ($role) {
            case 'admin':
                return route('dashboard.admin');
            case 'student':
                return route('home');
            case 'consultant':
                return route('dashboard.consultants');
            case 'financing':
                return route('dashboard.finances');
            case 'housing':
                return route('dashboard.houses');
            case 'transportation':
                return route('dashboard.transportations');
            default:
                return route('home');
        }
    }

    // logout
    public function logout()
    {
        Auth::logout();

        return redirect()->route('home')->with('success', 'تم تسجيل الخروج بنجاح');
    }

    public function studentRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'university_number' => 'required|string|max:255|unique:students',
            'university_name' => 'required|string|max:255',
            'student_address' => 'required|string|max:255',
            'student_phone_number' => 'required|string|max:20',
        ], [
            'required' => 'حقل :attribute مطلوب.',
            'string' => 'حقل :attribute يجب أن يكون نصًا.',
            'email' => 'حقل :attribute يجب أن يكون بريدًا إلكترونيًا صالحًا.',
            'max' => 'حقل :attribute يجب ألا يتجاوز :max حرفًا.',
            'min' => 'حقل :attribute يجب أن يكون على الأقل :min أحرف.',
            'unique' => 'هذا :attribute مستخدم بالفعل.',
        ], [
            'name' => 'الاسم الكامل',
            'email' => 'البريد الإلكتروني',
            'password' => 'كلمة المرور',
            'university_number' => 'الرقم الجامعي',
            'university_name' => 'اسم الجامعة',
            'student_address' => 'عنوان السكن',
            'student_phone_number' => 'رقم الهاتف',
        ]);

        // بدء المعاملة
        DB::beginTransaction();

        try {
            // إنشاء المستخدم
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'student',
                'is_approved' => '1',
            ]);

            // إنشاء ملف الطالب
            Student::create([
                'user_id' => $user->id,
                'university_number' => $request->university_number,
                'university_name' => $request->university_name,
                'student_address' => $request->student_address,
                'student_phone_number' => $request->student_phone_number,
            ]);

            // إذا نجح كل شيء، نؤكد المعاملة
            DB::commit();

            // تسجيل دخول المستخدم
            Auth::login($user);

            session()->flash('success', 'تم إنشاء الحساب بنجاح!');
            return response()->json([
                'success' => true,
                'redirect' => route('home'),
                'message' => 'تم إنشاء الحساب بنجاح!'
            ]);
        } catch (\Exception $e) {
            // في حالة حدوث خطأ، نرجع عن المعاملة
            DB::rollBack();

            session()->flash('error', 'حدث خطأ أثناء التسجيل. يرجى المحاولة مرة أخرى.');

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء التسجيل. يرجى المحاولة مرة أخرى.'
            ], 500);
        }
    }

    public function consultantRegister(Request $request)
    {
        $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:20',
            'activityType' => 'required|string|max:255',
            'consultationDuration' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'idUpload' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'certificateUpload' => 'required|image|mimes:jpeg,png,jpg,pdf|max:2048',
        ], [
            'required' => 'حقل :attribute مطلوب.',
            'string' => 'حقل :attribute يجب أن يكون نصًا.',
            'email' => 'حقل :attribute يجب أن يكون بريدًا إلكترونيًا صالحًا.',
            'max' => 'حقل :attribute يجب ألا يتجاوز :max حرفًا.',
            'image' => 'حقل :attribute يجب أن يكون صورة.',
            'mimes' => 'حقل :attribute يجب أن يكون من نوع: :values.',
            'unique' => 'هذا :attribute مستخدم بالفعل.',
            'confirmed' => 'تأكيد كلمة المرور غير متطابق.',
        ], [
            'fullName' => 'الاسم الرباعي',
            'email' => 'البريد الإلكتروني',
            'phone' => 'رقم الهاتف',
            'activityType' => 'نوع النشاط',
            'consultationDuration' => 'مدة الاستشارة',
            'specialization' => 'التخصص',
            'idUpload' => 'صورة الهوية الوطنية',
            'certificateUpload' => 'صورة الشهادة العلمية',
        ]);

        // بدء المعاملة
        DB::beginTransaction();

        try {
            // معالجة الملفات المرفوعة
            $identityImagePath = $request->file('idUpload')->store('identity_images', 'public');
            $certificateImagePath = $request->file('certificateUpload')->store('certificate_images', 'public');

            // إنشاء المستخدم
            $user = User::create([
                'name' => $request->fullName,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'consultant',
                'is_approved' => '0', // بانتظار الموافقة
            ]);

            // إنشاء ملف المستشار
            Consultant::create([
                'user_id' => $user->id,
                'phone_number' => $request->phone,
                'specialization' => $request->specialization,
                'consultation_duration' => $request->consultationDuration,
                'activity_type' => $request->activityType,
                'identity_image' => $identityImagePath,
                'certificate_image' => $certificateImagePath,
            ]);

            // إذا نجح كل شيء، نؤكد المعاملة
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'تم إرسال طلب التسجيل بنجاح! سيتم مراجعته من قبل الإدارة.'
            ]);
        } catch (\Exception $e) {
            // في حالة حدوث خطأ، نرجع عن المعاملة
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء التسجيل. يرجى المحاولة مرة أخرى.'
            ], 500);
        }
    }

    public function financingRegister(Request $request)
    {
        $request->validate([
            'companyName' => 'required|string|max:255',
            'commercialReg' => 'required|string|max:255',
            'companyEmail' => 'required|string|email|max:255|unique:users,email',
            'companyPassword' => 'required|string|min:8|confirmed',
            'companyPhone' => 'required|string|max:20',
            'companyIdUpload' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'commercialRegUpload' => 'required|image|mimes:jpeg,png,jpg,pdf|max:2048',
        ], [
            'required' => 'حقل :attribute مطلوب.',
            'string' => 'حقل :attribute يجب أن يكون نصًا.',
            'email' => 'حقل :attribute يجب أن يكون بريدًا إلكترونيًا صالحًا.',
            'max' => 'حقل :attribute يجب ألا يتجاوز :max حرفًا.',
            'image' => 'حقل :attribute يجب أن يكون صورة.',
            'mimes' => 'حقل :attribute يجب أن يكون من نوع: :values.',
            'unique' => 'هذا :attribute مستخدم بالفعل.',
            'confirmed' => 'تأكيد كلمة المرور غير متطابق.',
        ], [
            'companyName' => 'اسم الشركة',
            'commercialReg' => 'السجل التجاري',
            'companyEmail' => 'البريد الإلكتروني',
            'companyPhone' => 'رقم الهاتف',
            'companyIdUpload' => 'صورة الهوية الوطنية',
            'commercialRegUpload' => 'صورة السجل التجاري',
        ]);

        // بدء المعاملة
        DB::beginTransaction();

        try {
            // معالجة الملفات المرفوعة
            // Make sure the directory exists
            if (!file_exists(public_path('images/finances'))) {
                mkdir(public_path('images/finances'), 0755, true);
            }

            $identityImage = $request->file('companyIdUpload');
            $identityImage->move(public_path('images/finances'), $identityImage->getClientOriginalName());
            $identityImagePath = 'images/finances/' . $identityImage->getClientOriginalName();

            $commercialRegImage = $request->file('commercialRegUpload');
            $commercialRegImage->move(public_path('images/finances'), $commercialRegImage->getClientOriginalName());
            $commercialRegImagePath = 'images/finances/' . $commercialRegImage->getClientOriginalName();

            // إنشاء المستخدم
            $user = User::create([
                'name' => $request->companyName,
                'email' => $request->companyEmail,
                'password' => Hash::make($request->companyPassword),
                'role' => 'financing',
                'is_approved' => '0', // بانتظار الموافقة
            ]);

            // إنشاء ملف شركة التمويل
            FinancingCompany::create([
                'user_id' => $user->id,
                'commercial_register_number' => $request->commercialReg,
                'phone_number' => $request->companyPhone,
                'identity_image' => $identityImagePath,
                'commercial_register_image' => $commercialRegImagePath,
            ]);

            // إذا نجح كل شيء، نؤكد المعاملة
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'تم إرسال طلب التسجيل بنجاح! سيتم مراجعته من قبل الإدارة.'
            ]);
        } catch (\Exception $e) {
            // في حالة حدوث خطأ، نرجع عن المعاملة
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء التسجيل. يرجى المحاولة مرة أخرى.'
            ], 500);
        }
    }

    public function housingRegister(Request $request)
    {
        $request->validate([
            'companyName' => 'required|string|max:255',
            'commercialReg' => 'required|string|max:255',
            'companyEmail' => 'required|string|email|max:255|unique:users,email',
            'companyPassword' => 'required|string|min:8|confirmed',
            'companyPhone' => 'required|string|max:20',
            'companyIdUpload' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'commercialRegUpload' => 'required|image|mimes:jpeg,png,jpg,pdf|max:2048',
        ], [
            'required' => 'حقل :attribute مطلوب.',
            'string' => 'حقل :attribute يجب أن يكون نصًا.',
            'email' => 'حقل :attribute يجب أن يكون بريدًا إلكترونيًا صالحًا.',
            'max' => 'حقل :attribute يجب ألا يتجاوز :max حرفًا.',
            'image' => 'حقل :attribute يجب أن يكون صورة.',
            'mimes' => 'حقل :attribute يجب أن يكون من نوع: :values.',
            'unique' => 'هذا :attribute مستخدم بالفعل.',
            'confirmed' => 'تأكيد كلمة المرور غير متطابق.',
        ], [
            'companyName' => 'اسم الشركة',
            'commercialReg' => 'السجل التجاري',
            'companyEmail' => 'البريد الإلكتروني',
            'companyPhone' => 'رقم الهاتف',
            'companyIdUpload' => 'صورة الهوية الوطنية',
            'commercialRegUpload' => 'صورة السجل التجاري',
        ]);

        // بدء المعاملة
        DB::beginTransaction();

        try {
            // Make sure the directory exists
            if (!file_exists(public_path('images/houses'))) {
                mkdir(public_path('images/houses'), 0755, true);
            }

            $identityImage = $request->file('companyIdUpload');
            $identityImage->move(public_path('images/houses'), $identityImage->getClientOriginalName());
            $identityImagePath = 'images/houses/' . $identityImage->getClientOriginalName();

            $commercialRegImage = $request->file('commercialRegUpload');
            $commercialRegImage->move(public_path('images/houses'), $commercialRegImage->getClientOriginalName());
            $commercialRegImagePath = 'images/houses/' . $commercialRegImage->getClientOriginalName();

            // إنشاء المستخدم
            $user = User::create([
                'name' => $request->companyName,
                'email' => $request->companyEmail,
                'password' => Hash::make($request->companyPassword),
                'role' => 'housing',
                'is_approved' => '0', // بانتظار الموافقة
            ]);

            // إنشاء ملف شركة الإسكان
            HousingCompany::create([
                'user_id' => $user->id,
                'commercial_register_number' => $request->commercialReg,
                'phone_number' => $request->companyPhone,
                'identity_image' => $identityImagePath,
                'commercial_register_image' => $commercialRegImagePath,
            ]);

            // إذا نجح كل شيء، نؤكد المعاملة
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'تم إرسال طلب التسجيل بنجاح! سيتم مراجعته من قبل الإدارة.'
            ]);
        } catch (\Exception $e) {
            // في حالة حدوث خطأ، نرجع عن المعاملة
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء التسجيل. يرجى المحاولة مرة أخرى.'
            ], 500);
        }
    }

    public function transportationRegister(Request $request)
    {
        $request->validate([
            'companyName' => 'required|string|max:255',
            'commercialReg' => 'required|string|max:255',
            'companyEmail' => 'required|string|email|max:255|unique:users,email',
            'companyPassword' => 'required|string|min:8|confirmed',
            'companyPhone' => 'required|string|max:20',
            'companyIdUpload' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'commercialRegUpload' => 'required|image|mimes:jpeg,png,jpg,pdf|max:2048',
        ], [
            'required' => 'حقل :attribute مطلوب.',
            'string' => 'حقل :attribute يجب أن يكون نصًا.',
            'email' => 'حقل :attribute يجب أن يكون بريدًا إلكترونيًا صالحًا.',
            'max' => 'حقل :attribute يجب ألا يتجاوز :max حرفًا.',
            'image' => 'حقل :attribute يجب أن يكون صورة.',
            'mimes' => 'حقل :attribute يجب أن يكون من نوع: :values.',
            'unique' => 'هذا :attribute مستخدم بالفعل.',
            'confirmed' => 'تأكيد كلمة المرور غير متطابق.',
        ], [
            'companyName' => 'اسم الشركة',
            'commercialReg' => 'السجل التجاري',
            'companyEmail' => 'البريد الإلكتروني',
            'companyPhone' => 'رقم الهاتف',
            'companyIdUpload' => 'صورة الهوية الوطنية',
            'commercialRegUpload' => 'صورة السجل التجاري',
        ]);

        // بدء المعاملة
        DB::beginTransaction();

        try {
            // Make sure the directory exists
            if (!file_exists(public_path('images/transportations'))) {
                mkdir(public_path('images/transportations'), 0755, true);
            }

            $identityImage = $request->file('companyIdUpload');
            $identityImage->move(public_path('images/transportations'), $identityImage->getClientOriginalName());
            $identityImagePath = 'images/transportations/' . $identityImage->getClientOriginalName();

            $commercialRegImage = $request->file('commercialRegUpload');
            $commercialRegImage->move(public_path('images/transportations'), $commercialRegImage->getClientOriginalName());
            $commercialRegImagePath = 'images/transportations/' . $commercialRegImage->getClientOriginalName();

            // إنشاء المستخدم
            $user = User::create([
                'name' => $request->companyName,
                'email' => $request->companyEmail,
                'password' => Hash::make($request->companyPassword),
                'role' => 'transportation',
                'is_approved' => '0', // بانتظار الموافقة
            ]);

            // إنشاء ملف شركة النقل
            TransportationCompany::create([
                'user_id' => $user->id,
                'commercial_register_number' => $request->commercialReg,
                'phone_number' => $request->companyPhone,
                'identity_image' => $identityImagePath,
                'commercial_register_image' => $commercialRegImagePath,
            ]);

            // إذا نجح كل شيء، نؤكد المعاملة
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'تم إرسال طلب التسجيل بنجاح! سيتم مراجعته من قبل الإدارة.'
            ]);
        } catch (\Exception $e) {
            // في حالة حدوث خطأ، نرجع عن المعاملة
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء التسجيل. يرجى المحاولة مرة أخرى.'
            ], 500);
        }
    }
}
