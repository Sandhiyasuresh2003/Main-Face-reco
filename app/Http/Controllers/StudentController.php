<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    //show student dashboard
    public function index(){

    }
    //match face and mark attendance
    public function matchFace($faceToken1, $faceToken2)
    {
        $client = new Client();
        $response = $client->post('https://api-us.faceplusplus.com/facepp/v3/compare', [
            'multipart' => [
                [
                    'name' => 'api_key',
                    'contents' => 'YNcmf1kATfYDSqTFsMGue5yMHRH3uXZn'
                ],
                [
                    'name' => 'api_secret',
                    'contents' => 'SEcus_zIEb0dZSj_HRdq_-MKpbsKdQj-'
                ],
                [
                    'name' => 'face_token1',
                    'contents' => $faceToken1
                ],
                [
                    'name' => 'face_token2',
                    'contents' => $faceToken2
                ]
            ]
        ]);

        $body = $response->getBody();
        $data = json_decode($body, true);

        return $data['confidence'] ?? 0;    
    }
    public function mark_attendance(Request $request){
        $client = new Client();
        $validator = Validator::make($request->all(), [
            'captured_image' => 'required|image|mimes:jpg,jpeg,png'
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->first());
        }
        $request_data = $validator->validate();

        $user = Auth::user();
        $image = $request->file('captured_image');
        $reg_no = $user->reg_no;

        if (!$image->isValid()) {
            return back()->with('error', 'Invalid image');
        }

        $response = $client->post('https://api-us.faceplusplus.com/facepp/v3/detect', [
            'multipart' => [
                [
                    'name' => 'api_key',
                    'contents' => 'YNcmf1kATfYDSqTFsMGue5yMHRH3uXZn'
                ],
                [
                    'name' => 'api_secret',
                    'contents' => 'SEcus_zIEb0dZSj_HRdq_-MKpbsKdQj-'
                ],
                [
                    'name' => 'image_file',
                    'contents' => fopen($image->getRealPath(), 'r'),
                    'filename' => $image->getClientOriginalName()
                ],
                [
                    'name' => 'return_landmark',
                    'contents' => '1'
                ],
                [
                    'name' => 'return_attributes',
                    'contents' => 'gender,age'
                ]
            ]
        ]);

        $body = $response->getBody();
        $data = json_decode($body, true);

        $faceId = $data['faces'][0]['face_token'] ?? null;

        if ($faceId) {
            $student = DB::table('students')->where('reg_no', $reg_no)->first();
            if(empty($student)){
                return back()->with('error', 'Your are not students in admin students list . Please contact adminstrator');
            }
            $confidence = $this->matchFace($student->face_id, $faceId);
            if ($confidence && $confidence > 80) {  
                Attendance::create([
                    'student_id' => $reg_no,
                    'stud_name' => $user->username,
                    'date_of_attendance' => now(),
                    'attendance' => 'present'
                ]); 
                return back()->with('success', 'Matched, Attendance Marked Successfully');
            } else {
                return back()->with('error', 'Not Matched, Try Again Later');
            }
        }
        return back()->with('error', 'Failed to detect face');
    }
}

