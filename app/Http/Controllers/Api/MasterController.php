<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\Main;
use App\Models\Api\Validation;

class MasterController extends Controller
{
    protected $Main;
    protected $Validation;
    
    public function __construct()
    {
        $this->Main = new Main();
        $this->Validation = new Validation();
    }

    public function ApiCallData(Request $req)
    {
        $validation_data = $this->Validation->ApiCallData($req);
        if ($validation_data->original['statuscode'] == 1) {
            $data = $this->Main->ApiCallData($req);
            return response()->json([
                "statuscode" => 1,
                "msg" => "Api Call successfully.",
                "data" => $data
            ]);
        } else {
            return $validation_data;
        }
    }

    public function StatusStickerCategoryData(Request $req)
    {
        $validation_data = $this->Validation->StatusStickerCategoryData($req);
        if ($validation_data->original['statuscode'] == 1) {
            $data = $this->Main->StatusStickerCategoryData($req);
            return response()->json([
                "statuscode" => 1,
                "msg" => "success!!.",
                "data" => $data
            ]);
        } else {
            return $validation_data;
        }
    }

    public function StatusStickersData(Request $req)
    {
        $validation_data = $this->Validation->StatusStickersData($req);
        if ($validation_data->original['statuscode'] == 1) {
            $data = $this->Main->StatusStickersData($req);
            return response()->json([
                "statuscode" => 1,
                "msg" => "success!!.",
                "data" => $data
            ]);
        } else {
            return $validation_data;
        }
    }

    public function StatusTextCategoryData(Request $req)
    {
        $validation_data = $this->Validation->StatusTextCategoryData($req);
        if ($validation_data->original['statuscode'] == 1) {
            $data = $this->Main->StatusTextCategoryData($req);
            return response()->json([
                "statuscode" => 1,
                "msg" => "success!!.",
                "data" => $data
            ]);
        } else {
            return $validation_data;
        }
    }

    public function StatusTextData(Request $req)
    {
        $validation_data = $this->Validation->StatusTextData($req);
        if ($validation_data->original['statuscode'] == 1) {
            $data = $this->Main->StatusTextData($req);
            return response()->json([
                "statuscode" => 1,
                "msg" => "success!!.",
                "data" => $data
            ]);
        } else {
            return $validation_data;
        }
    }
    
    public function AppByStickerCategoryData(Request $req)
    {
        $validation_data = $this->Validation->AppByStickerCategoryData($req);
        if ($validation_data->original['statuscode'] == 1) {
            $data = $this->Main->AppByStickerCategoryData($req);
            return response()->json([
                "statuscode" => 1,
                "msg" => "success!!.",
                "data" => $data
            ]);
        } else {
            return $validation_data;
        }
    }

    public function AppByTextCategoryData(Request $req)
    {
        $validation_data = $this->Validation->AppByTextCategoryData($req);
        if ($validation_data->original['statuscode'] == 1) {
            $data = $this->Main->AppByTextCategoryData($req);
            return response()->json([
                "statuscode" => 1,
                "msg" => "success!!.",
                "data" => $data
            ]);
        } else {
            return $validation_data;
        }
    }
}
