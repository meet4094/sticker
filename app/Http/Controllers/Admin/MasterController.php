<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\MasterModel;
use DataTables;
use File;

use function GuzzleHttp\Promise\all;

class MasterController extends Controller
{
    protected $MasterModel;
    public function __construct()
    {
        $this->MasterModel = new MasterModel();
    }

    // Status Sticker Category Data

    public function add_status_sticker_category(Request $req)
    {
        if (empty($req->catId)) {
            $rules = array(
                'category' => 'required|unique:status_sticker_category,catName',
                'image' => 'required|mimes:jpeg,jpg,png,gif',
            );
        } else {
            $rules = array(
                'category' => 'required',
                'image' => 'mimes:jpeg,jpg,png,gif',
            );
        }
        $validator = Validator::make($req->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $data = $this->MasterModel->add_status_sticker_category($req->all());
            return $data;
        }
    }

    public function status_sticker_category_list(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('status_sticker_category')->where(array('is_deleted' => 0));
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('image', function ($row) {
                    $url = asset('images/statussticker/' . $row->slug_name);
                    return '<a target="_blank" href="' . $url . '/' . $row->image . '"><img src="  ' . $url . '/' . $row->image . ' " height="100"></a>';
                })
                ->addColumn('action', function ($row) {
                    $update_btn = '<button title="' . $row->catName . '" class="btn btn-link" onclick="edit_status_sticker_category(this)" data-val="' . $row->catId . '"><i class="far fa-edit"></i></button>';
                    $delete_btn = '<button data-toggle="modal" target="_blank"  title="' . $row->catName . '" class="btn btn-link" onclick="editable_remove(this)" data-val="' . $row->catId . '" tabindex="-1"><i class="fa fa-trash-alt tx-danger"></i></button>';
                    return $update_btn . $delete_btn;
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
        }
    }

    public function delete_status_sticker_category(Request $req)
    {
        $data = $this->MasterModel->delete_status_sticker_category($req->all());
        return $data;
    }

    public function get_status_sticker_category_data(Request $request)
    {
        if ($request->ajax()) {
            $categorydata = DB::table('status_sticker_category')->where(array('catId' => $request->id))->first();
        }
        $data = array();
        $data = ([
            'catId' => $categorydata->catId,
            'catName' => $categorydata->catName,
            'image' => asset('images/statussticker/' . $categorydata->slug_name) . '/' . $categorydata->image,
        ]);
        $response = array('st' => "success", "msg" => $data);
        return response()->json($response);
    }

    public function get_status_sticker_Category(Request $request)
    {
        $search = $request->searchTerm;
        if ($search == '') {
            $categories = DB::table('status_sticker_category')->where(array('is_deleted' => 0))->select('catId', 'catName')->get();
        } else {
            $categories = DB::table('status_sticker_category')->select('catId', 'catName')->where('catName', 'like', '%' . $search . '%')->where('is_deleted', 0)->limit(10)->get();
        }

        $response = array();
        foreach ($categories as $category) {
            $response[] = array(
                "id" => $category->catId,
                "text" => $category->catName
            );
        }
        return response()->json($response);
    }

    // Status Sticker Item Data

    public function add_status_stickers(Request $req)
    {
        if (empty($req->itemId)) {
            $rules = array(
                'category' => 'required',
                'images' => 'required',
            );
        } else {
            $rules = array(
                'category' => 'required',
            );
        }
        $validator = Validator::make($req->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $data = $this->MasterModel->add_status_stickers($req->all());
            return $data;
        }
    }

    public function status_stickers_list(Request $request)
    {
        if ($request->ajax()) {
            $builder = DB::table('status_sticker as ss');
            if ($request->category_id != '') {
                $builder->where('ss.catId', $request->category_id);
            }
            $builder->where('ss.is_deleted', '0');
            $builder->join('status_sticker_category as ssc', 'ssc.catId', '=', 'ss.catId');
            $builder->select('ss.id', 'ssc.catName', 'ssc.slug_name', 'ss.images');
            $result = $builder->get();
            return Datatables::of($result)
                ->addIndexColumn()
                ->editColumn('images', function ($row) {
                    $url = asset('images/statussticker/' . $row->slug_name);
                    return '<a target="_blank" href="' . $url . '/' . $row->images . '"><img src=" ' . $url . '/' . $row->images . ' " height="100"></a>';
                })
                ->addColumn('action', function ($row) {
                    $update_btn = '<button class="btn btn-link" onclick="edit_status_sticker(this)" data-val="' . $row->id . '"><i class="far fa-edit"></i></button>';
                    $delete_btn = '<button data-toggle="modal" target="_blank" class="btn btn-link" onclick="editable_remove(this)" data-val="' . $row->id . '" tabindex="-1"><i class="fa fa-trash-alt tx-danger"></i></button>';
                    return $update_btn . $delete_btn;
                })
                ->rawColumns(['images', 'action'])
                ->make(true);
        }
    }

    public function delete_status_sticker(Request $req)
    {
        $data = $this->MasterModel->delete_status_sticker($req->all());
        return $data;
    }

    public function get_status_sticker_data(Request $request)
    {
        if ($request->ajax()) {
            $itemdata = DB::table('status_sticker as ss')
                ->join('status_sticker_category as ssc', 'ssc.catId', '=', 'ss.catId')
                ->where(array('id' => $request->id))
                ->select('ss.*', 'ssc.catName', 'ssc.slug_name')
                ->get();
        }
        foreach ($itemdata as $item) {
            $data = array();
            $data = ([
                'catId' => $item->catId,
                'id' => $item->id,
                'catName' => $item->catName,
                'image' => asset('images/statussticker/' . $item->slug_name) . '/' . $item->images,
            ]);
        }
        $response = array('st' => "success", "msg" => $data);
        return response()->json($response);
    }

    // Status Text Category Data

    public function add_status_text_category(Request $req)
    {
        if (empty($req->catId)) {
            $rules = array(
                'category' => 'required|unique:status_text_category,catName',
                'image' => 'required|mimes:jpeg,jpg,png,gif',
            );
        } else {
            $rules = array(
                'category' => 'required',
                'image' => 'mimes:jpeg,jpg,png,gif',
            );
        }
        $validator = Validator::make($req->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $data = $this->MasterModel->add_status_text_category($req->all());
            return $data;
        }
    }

    public function status_text_category_list(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('status_text_category')->where(array('is_deleted' => 0));
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('image', function ($row) {
                    $url = asset('images/statustext/' . $row->slug_name);
                    return '<a target="_blank" href="' . $url . '/' . $row->image . '"><img src="  ' . $url . '/' . $row->image . ' " height="100"></a>';
                })
                ->addColumn('action', function ($row) {
                    $update_btn = '<button title="' . $row->catName . '" class="btn btn-link" onclick="edit_status_text_category(this)" data-val="' . $row->catId . '"><i class="far fa-edit"></i></button>';
                    $delete_btn = '<button data-toggle="modal" target="_blank"  title="' . $row->catName . '" class="btn btn-link" onclick="editable_remove(this)" data-val="' . $row->catId . '" tabindex="-1"><i class="fa fa-trash-alt tx-danger"></i></button>';
                    return $update_btn . $delete_btn;
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
        }
    }

    public function delete_status_text_category(Request $req)
    {
        $data = $this->MasterModel->delete_status_text_category($req->all());
        return $data;
    }

    public function get_status_text_category_data(Request $request)
    {
        if ($request->ajax()) {
            $categorydata = DB::table('status_text_category')->where(array('catId' => $request->id))->first();
        }
        $data = array();
        $data = ([
            'catId' => $categorydata->catId,
            'catName' => $categorydata->catName,
            'image' => asset('images/statustext/' . $categorydata->slug_name) . '/' . $categorydata->image,
        ]);
        $response = array('st' => "success", "msg" => $data);
        return response()->json($response);
    }

    public function get_status_text_Category(Request $request)
    {
        $search = $request->searchTerm;
        if ($search == '') {
            $categories = DB::table('status_text_category')->where(array('is_deleted' => 0))->select('catId', 'catName')->get();
        } else {
            $categories = DB::table('status_text_category')->select('catId', 'catName')->where('catName', 'like', '%' . $search . '%')->where('is_deleted', 0)->limit(10)->get();
        }

        $response = array();
        foreach ($categories as $category) {
            $response[] = array(
                "id" => $category->catId,
                "text" => $category->catName
            );
        }
        return response()->json($response);
    }

    // Status Sticker Item Data

    public function add_status_texts(Request $req)
    {
        if (empty($req->itemId)) {
            $rules = array(
                'category' => 'required',
                'text' => 'required',
            );
        } else {
            $rules = array(
                'category' => 'required',
            );
        }
        $validator = Validator::make($req->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $data = $this->MasterModel->add_status_texts($req->all());
            return $data;
        }
    }

    public function status_texts_list(Request $request)
    {
        if ($request->ajax()) {
            $builder = DB::table('status_text as st');
            if ($request->category_id != '') {
                $builder->where('st.catId', $request->category_id);
            }
            $builder->where('st.is_deleted', '0');
            $builder->join('status_text_category as stc', 'stc.catId', '=', 'st.catId');
            $builder->select('st.id', 'stc.catName', 'st.text');
            $result = $builder->get();
            return Datatables::of($result)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $update_btn = '<button class="btn btn-link" onclick="edit_status_text(this)" data-val="' . $row->id . '"><i class="far fa-edit"></i></button>';
                    $delete_btn = '<button data-toggle="modal" target="_blank" class="btn btn-link" onclick="editable_remove(this)" data-val="' . $row->id . '" tabindex="-1"><i class="fa fa-trash-alt tx-danger"></i></button>';
                    return $update_btn . $delete_btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function delete_status_text(Request $req)
    {
        $data = $this->MasterModel->delete_status_text($req->all());
        return $data;
    }

    public function get_status_text_data(Request $request)
    {
        if ($request->ajax()) {
            $itemdata = DB::table('status_text as ss')
                ->join('status_text_category as ssc', 'ssc.catId', '=', 'ss.catId')
                ->where(array('id' => $request->id))
                ->select('ss.*', 'ssc.catName')
                ->get();
        }
        foreach ($itemdata as $item) {
            $data = array();
            $data = ([
                'catId' => $item->catId,
                'id' => $item->id,
                'catName' => $item->catName,
                'text' => $item->text,
            ]);
        }
        $response = array('st' => "success", "msg" => $data);
        return response()->json($response);
    }

    // App Setting Data

    public function app_data_list(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('settings')->where('is_del', 0)
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $update_btn = '<button class="btn btn-link" title="' . $row->app_name . '" onclick="edit_app_data(this)" data-val="' . $row->id . '"><i class="far fa-edit"></i></button>';
                    $delete_btn = '<button data-toggle="modal" target="_blank" title="' . $row->app_name . '" class="btn btn-link" onclick="editable_remove(this)" data-val="' . $row->id . '" tabindex="-1"><i class="fa fa-trash-alt tx-danger"></i></button>';
                    return $update_btn . $delete_btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function get_App(Request $request)
    {
        $search = $request->searchTerm;
        if ($search == '') {
            $apps = DB::table('settings')->where(array('is_del' => 0))->select('id', 'app_name')->get();
        } else {
            $apps = DB::table('settings')->select('id', 'app_name')->where('app_name', 'like', '%' . $search . '%')->where('is_del', 0)->limit(10)->get();
        }

        $response = array();
        foreach ($apps as $app) {
            $response[] = array(
                "id" => $app->id,
                "text" => $app->app_name
            );
        }
        return response()->json($response);
    }

    public function add_app(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'appname' => 'required',
            'packagename' => 'required',
            'accountname' => 'required',
            'appversion' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $data = $this->MasterModel->add_app($req->all());
            return $data;
        }
    }

    public function get_app_data(Request $request)
    {
        $id = $request->id;
        $app_Data = DB::table('settings')->Where('id', $id)->first();
        $response = array('st' => "success", "msg" => $app_Data);
        return response()->json($response);
    }

    public function delete_app_data(Request $req)
    {
        $data = $this->MasterModel->delete_appdata($req->all());
        return $data;
    }

    // App By Sticker Category
    public function add_app_by_sticker_category(Request $req)
    {
        if (empty($req->appbycatId)) {
            $rules = array(
                'appId' => 'required',
                'categoryId' => 'required',
                'category' => 'required',
                'image' => 'required',
            );
        } else {
            $rules = array(
                'category' => 'required',
            );
        }
        $validator = Validator::make($req->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $data = $this->MasterModel->add_app_by_sticker_category($req->all());
            return $data;
        }
    }

    public function app_by_sticker_category_list(Request $request)
    {
        if ($request->ajax()) {
            $builder = DB::table('app_by_sticker_category as ci');
            if ($request->app_id != '' && $request->category_id != '') {
                $builder->where('ci.app_id', $request->app_id);
                $builder->where('ci.category_id', $request->category_id);
            } else if ($request->app_id != '' || $request->category_id != '') {
                $builder->where('ci.app_id', $request->app_id);
                $builder->orwhere('ci.category_id', $request->category_id);
            }
            $builder->where(array('ci.is_del' => 0));
            $builder->join('status_sticker_category as c', 'c.catId', '=', 'ci.category_id');
            $builder->join('settings as s', 's.id', '=', 'ci.app_id');
            $builder->select('ci.id', 's.app_name', 'c.catName', 'ci.name', 'ci.image');
            $result = $builder->get();
            return Datatables::of($result)
                ->addIndexColumn()
                ->editColumn('images', function ($row) {
                    $url = asset('images/appbystickercategory');
                    return '<a target="_blank" href="' . $url . '/' . $row->image . '"><img src=" ' . $url . '/' . $row->image . ' " height="100"></a>';
                })
                ->addColumn('action', function ($row) {
                    $update_btn = '<button class="btn btn-link" title="' . $row->name . '" onclick="edit_app_by_sticker_category(this)" data-val="' . $row->id . '"><i class="far fa-edit"></i></button>';
                    $delete_btn = '<button data-toggle="modal" title="' . $row->name . '" target="_blank" class="btn btn-link" onclick="editable_remove(this)" data-val="' . $row->id . '" tabindex="-1"><i class="fa fa-trash-alt tx-danger"></i></button>';
                    return $update_btn . $delete_btn;
                })
                ->rawColumns(['images', 'action'])
                ->make(true);
        }
    }

    public function delete_app_by_sticker_category(Request $req)
    {
        $data = $this->MasterModel->delete_app_by_sticker_category($req->all());
        return $data;
    }

    public function get_app_by_sticker_category_data(Request $request)
    {
        if ($request->ajax()) {
            $itemdata = DB::table('app_by_sticker_category as absc')
                ->join('status_sticker_category as ssc', 'ssc.catId', '=', 'absc.category_id')
                ->join('settings as s', 's.id', '=', 'absc.app_id')
                ->where(array('absc.id' => $request->id))
                ->select('absc.*', 'ssc.catName', 's.app_name')
                ->get();
        }
        foreach ($itemdata as $item) {
            $data = array();
            $data = ([
                'id' => $item->id,
                'appId' => $item->app_id,
                'appName' => $item->app_name,
                'catId' => $item->category_id,
                'catName' => $item->catName,
                'name' => $item->name,
                'image' => asset('images/appbystickercategory') . '/' . $item->image,
            ]);
        }
        $response = array('st' => "success", "msg" => $data);
        return response()->json($response);
    }

    // App By Sticker Category
    public function add_app_by_text_category(Request $req)
    {
        if (empty($req->appbycatId)) {
            $rules = array(
                'appId' => 'required',
                'categoryId' => 'required',
                'category' => 'required',
                'image' => 'required',
            );
        } else {
            $rules = array(
                'category' => 'required',
            );
        }
        $validator = Validator::make($req->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $data = $this->MasterModel->add_app_by_text_category($req->all());
            return $data;
        }
    }

    public function app_by_text_category_list(Request $request)
    {
        if ($request->ajax()) {
            $builder = DB::table('app_by_text_category as ci');
            if ($request->app_id != '' && $request->category_id != '') {
                $builder->where('ci.app_id', $request->app_id);
                $builder->where('ci.category_id', $request->category_id);
            } else if ($request->app_id != '' || $request->category_id != '') {
                $builder->where('ci.app_id', $request->app_id);
                $builder->orwhere('ci.category_id', $request->category_id);
            }
            $builder->where(array('ci.is_del' => 0));
            $builder->join('status_text_category as c', 'c.catId', '=', 'ci.category_id');
            $builder->join('settings as s', 's.id', '=', 'ci.app_id');
            $builder->select('ci.id', 's.app_name', 'c.catName', 'ci.name', 'ci.image');
            $result = $builder->get();
            return Datatables::of($result)
                ->addIndexColumn()
                ->editColumn('images', function ($row) {
                    $url = asset('images/appbytextcategory');
                    return '<a target="_blank" href="' . $url . '/' . $row->image . '"><img src=" ' . $url . '/' . $row->image . ' " height="100"></a>';
                })
                ->addColumn('action', function ($row) {
                    $update_btn = '<button class="btn btn-link" title="' . $row->name . '" onclick="edit_app_by_text_category(this)" data-val="' . $row->id . '"><i class="far fa-edit"></i></button>';
                    $delete_btn = '<button data-toggle="modal" title="' . $row->name . '" target="_blank" class="btn btn-link" onclick="editable_remove(this)" data-val="' . $row->id . '" tabindex="-1"><i class="fa fa-trash-alt tx-danger"></i></button>';
                    return $update_btn . $delete_btn;
                })
                ->rawColumns(['images', 'action'])
                ->make(true);
        }
    }

    public function delete_app_by_text_category(Request $req)
    {
        $data = $this->MasterModel->delete_app_by_text_category($req->all());
        return $data;
    }

    public function get_app_by_text_category_data(Request $request)
    {
        if ($request->ajax()) {
            $itemdata = DB::table('app_by_text_category as cs')
                ->join('status_text_category as c', 'c.catId', '=', 'cs.category_id')
                ->join('settings as s', 's.id', '=', 'cs.app_id')
                ->where(array('cs.id' => $request->id))
                ->select('cs.*', 'c.catName', 's.app_name')
                ->get();
        }
        foreach ($itemdata as $item) {
            $data = array();
            $data = ([
                'id' => $item->id,
                'appId' => $item->app_id,
                'appName' => $item->app_name,
                'catId' => $item->category_id,
                'catName' => $item->catName,
                'name' => $item->name,
                'image' => asset('images/appbytextcategory') . '/' . $item->image,
            ]);
        }
        $response = array('st' => "success", "msg" => $data);
        return response()->json($response);
    }

    // Api Call Data
    public function api_call_list(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('api_calls')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
    }
}
