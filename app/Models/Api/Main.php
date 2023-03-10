<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Main extends Model
{
    use HasFactory;

    function get_client_ip()
    {
        $ipAddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipAddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipAddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipAddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipAddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipAddress = 'UNKNOWN';
        return $ipAddress;
    }

    public function ApiCallData($req)
    {
        $request_token = $req->header('request-token');
        $data = DB::table('settings')->where('request_token', $request_token)->first();

        $ipAddress = $this->get_client_ip();
        $app_token = Str::random(15);
        $Api_CallData = array(
            'app_id' => $data->id,
            'device_id' => $req['device_id'],
            'package_name' => $req['package_name'],
            'app_version' => $req['app_version'],
            'version_code' => $req['app_version_code'],
            'app_token' => $app_token,
            'ip_address' => $ipAddress
        );
        $register = DB::table('api_calls')
            ->insert($Api_CallData);
        return $Api_CallData;
    }

    public function StatusStickerCategoryData($req)
    {
        $CategoryData = DB::table('status_sticker_category')
            ->where('is_deleted', 0)
            ->get();
        if (empty(json_decode($CategoryData))) {
            $data = [];
        } else {
            foreach ($CategoryData as $key => $Category) {
                $data[] = array([
                    'id' => $Category->catId,
                    'category_name' => $Category->catName,
                    'category_image' => asset('images/statussticker/' . $Category->slug_name . '/' . $Category->image),
                ]);
            }
            return $data;
        }
    }

    public function StatusStickersData($req)
    {
        $ImagesData = DB::table('status_sticker as im')
            ->join('status_sticker_category as ca', 'ca.catId', '=', 'im.catId')
            ->select('im.*', 'ca.catName', 'ca.slug_name')
            ->where('im.is_deleted', 0)
            ->get();

        if (empty(json_decode($ImagesData))) {
            $data = [];
        } else {
            foreach ($ImagesData as $Images) {
                $data[] = array([
                    'id' => $Images->id,
                    'category_name' => $Images->catName,
                    'image' => asset('images/statussticker/' . $Images->slug_name . '/' . $Images->images),
                    'is_new' => $Images->is_new,
                ]);
            }
        }
        return $data;
    }

    public function StatusTextCategoryData($req)
    {
        $CategoryData = DB::table('status_text_category')
            ->where('is_deleted', 0)
            ->get();
        if (empty(json_decode($CategoryData))) {
            $data = [];
        } else {
            foreach ($CategoryData as $key => $Category) {
                $data[] = array([
                    'id' => $Category->catId,
                    'category_name' => $Category->catName,
                    'category_image' => asset('images/statustext/' . $Category->slug_name . '/' . $Category->image),
                ]);
            }
            return $data;
        }
    }

    public function StatusTextData($req)
    {
        $ImagesData = DB::table('status_text as im')
            ->join('status_text_category as ca', 'ca.catId', '=', 'im.catId')
            ->select('im.*', 'ca.catName', 'ca.slug_name')
            ->where('im.is_deleted', 0)
            ->get();

        if (empty(json_decode($ImagesData))) {
            $data = [];
        } else {
            foreach ($ImagesData as $Images) {
                $data[] = array([
                    'id' => $Images->id,
                    'category_name' => $Images->catName,
                    'text' => $Images->text,
                    'is_new' => $Images->is_new,
                ]);
            }
        }
        return $data;
    }

    public function AppByStickerCategoryData($req)
    {
        $ImagesData = DB::table('app_by_sticker_category')
            ->select('id', 'category_id', 'name', 'image')
            ->where('category_id', $req->main_category_id)
            ->where('is_del', 0)
            ->get();

        if (empty(json_decode($ImagesData))) {
            $data = [];
        } else {
            foreach ($ImagesData as $Images) {
                $data[] = array([
                    'id' => $Images->id,
                    'main_category_id' => $Images->category_id,
                    'name' => $Images->name,
                    'image' => asset('images/appbystickercategory/'  . $Images->image),
                ]);
            }
        }
        return $data;
    }

    public function AppByTextCategoryData($req)
    {
        $ImagesData = DB::table('app_by_text_category')
            ->select('id', 'category_id', 'name', 'image')
            ->where('category_id', $req->main_category_id)
            ->where('is_del', 0)
            ->get();

        if (empty(json_decode($ImagesData))) {
            $data = [];
        } else {
            foreach ($ImagesData as $Images) {
                $data[] = array([
                    'id' => $Images->id,
                    'main_category_id' => $Images->category_id,
                    'name' => $Images->name,
                    'image' => asset('images/appbytextcategory/'  . $Images->image),
                ]);
            }
        }
        return $data;
    }
}
