<?php

namespace App\Http\Controllers\API;

use App\Model\Kyc;
use Carbon\Carbon;
use File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
use Intervention\Image\ImageManagerStatic as Image;

class KycController extends Controller
{

    public function index(Request $request)
    {
        $kyc = Kyc::whereUid($request->user()->id)
            ->first();

        return getJSONSuccessResponse($kyc);
    }
    public function store(Request $request)
    {
        if(!is_dir("images/kycs/". auth()->user()->id ."/")) {
            File::makeDirectory("images/kycs/". auth()->user()->id ."/", $mode = 0777, true, true);
        }

        if (!$request->hasFile('upload_file') && !$request->has('upload_file')) {
            return getJSONErrorResponse('no_kyc_file', 'please select file before upload');
        }
        if (!in_array($request->input('file_type'), ['address', 'id_card', 'photo'])){
            return getJSONErrorResponse('invalid_file_type', 'only selected file type is allowed');
        }

        if ($request->input('file_type') == Kyc::$typeAddress){
            $filename = 'address.jpg';
        } else if ($request->input('file_type') == Kyc::$typeIdCard){
            $filename = 'id.jpg';
        } else if ($request->input('file_type') == Kyc::$typePhoto){
            $filename = 'photo.jpg';
        } else if ($request->input('file_type') == Kyc::$typePhoto2){
            $filename = 'photo2.jpg';
        } else {
            return getJSONErrorResponse('invalid_file_type', 'only selected file type is allowed');
        }
        $data = $request->input('upload_file');
        $data = base64_decode($data);
        Storage::disk('kycs')->put( auth()->user()->id . '/'.$filename, $data);

        $userKyc = Kyc::whereUid($request->user()->id)->first();
        if (!$userKyc){
            $userKyc = new Kyc();
            $userKyc->uid = $request->user()->id;
        }
        $filePath = "images/kycs/". auth()->user()->id ."/".$filename;
        $userKyc->{$request->input('file_type')} = $filePath;

        $img = Image::make(public_path() . '/' . $filePath);
        $exif = exif_read_data(public_path() . '/' . $filePath);
        $rotate = 0;
        if (isset($exif['Orientation']) && !empty($exif['Orientation'])) {
            switch ($exif['Orientation']) {
                case 8:
                    // 90
                    $rotate = 90;
                    break;
                case 3:
                    // 180
                    $rotate = 180;
                    break;
                case 6:
                    // -90
                    $rotate = -90;
                    break;
            }
        }
        if ($img->getHeight() > 800){
            $img->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }
        $img->rotate($rotate);
        $img->save(public_path() . '/' . $filePath, 90, 'jpg');

        // TODO for test we verify after 3 files , in future we will have admin to approve this
        if ($userKyc->photo2 && $userKyc->id_card && $userKyc->photo){
            $user = $request->user();
            $user->kyc_verified_at = Carbon::now();
            $user->save();
        }

        if ($request->input('id_name')){
            $userKyc->id_name = $request->input('id_name');
        }
        if ($request->input('id_number')){
            $userKyc->id_number = $request->input('id_number');
        }
        $userKyc->save();

        return getJSONSuccessResponse();
    }
}
