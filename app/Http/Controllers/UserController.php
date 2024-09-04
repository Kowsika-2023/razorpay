<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Events\UserDetail;
use App\Interfaces\UserInterface;
use Log;
use Yajra\DataTables\DataTables;
use App\Helpers\ImageSave;
use App\Exports\UsersExport;
use Illuminate\Support\Facades\Log as FacadesLog;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File; // Import the File facade
use App\Helpers\FileManagement;
class UserController extends Controller
{


    protected $user;

    public function __construct(UserInterface $user)
    {

        $this->user = $user;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {



        if ($request->ajax()) {
            $data = User::join('user_profiles', 'users.id', '=', 'user_profiles.user_id')
                     ->leftJoin('user_addresses', function($join) {
                         $join->on('users.id', '=', 'user_addresses.user_id')
                              ->whereRaw('user_addresses.id = (select id from user_addresses where user_addresses.user_id = users.id limit 1)');
                     })
                     ->select('users.name', 'users.email', 'user_profiles.first_name','user_addresses.address');

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {

                        $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                        $check_box = '<input type="checkbox" class="row-checkbox" id="vehicle1" name="excel" value="' . $row->id . '">
                        <br>';
                        return $btn.$check_box;
                    })
                    ->filterColumn('first_name', function($query, $keyword) {
                        $query->where('user_profiles.first_name', 'like', '%' . $keyword . '%');
                    })

                    ->filterColumn('address', function($query, $keyword) {
                        $query->where('user_addresses.address', 'like', '%' . $keyword . '%');
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        // Create the HTML for the button
        // $button = '<a href="export-selected-users" class="btn btn-primary mb-2">Export</a>';
    //  $button = '<button id="exportBtn" class="btn btn-primary mb-2">Export Selected Users</button>';

        return view('backendviews.yajra.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backendviews.yajra.add_user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = new User;
        $user->name = "cropper";
        $user->email = "cropper3@gmail.com";
        $user->password = "Crop@123";
        $user->image = ImageSave::withoutCrop($request->image,'user-image','banner/');
        $user->save();
        return $user;
        // return $request;
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'address' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
        ]);


       $userRecord =  $this->user->userStore($request->all());

       return response()->json(['status'=>'User Created Successfully','User'=>$userRecord]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function login(Request $request){
        $user_mail = User::where('email',$request->email)->first();
        if($user_mail){

        }
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }


    public function exportSelectedUsers(Request $request)
{
        Log::info("request");
        Log::info($request);
    $selectedUserIds = $request->input('selectedUsers');

        Log::info($selectedUserIds);
    $usersssss = User::whereIn('id', $selectedUserIds)->get();
        Log::info("usersssss");
        Log::info($usersssss);
        $users = User::whereIn('id', $selectedUserIds)->get();


        $export = new UsersExport($selectedUserIds);
        $fileName = 'users-' . now()->format('YmdHis') . '.xlsx';
        Log::info("export");
        $url = FileManagement::exportExcel($export, $fileName);
        Log::info("url");
        Log::info($url);
        return response(['status'=>'success','url'=>$url]);
}


// public static function exportExcel($export,$fileName)
//     {

//           // Generate the Excel file
//           Excel::store($export, 'temp/' . $fileName);

//           // Define the destination directory
//           $destinationDirectory = public_path('export-excel');

//           // Create the destination directory if it doesn't exist
//           if (!File::exists($destinationDirectory)) {
//               File::makeDirectory($destinationDirectory, 0755, true);
//           }

//           // Move the file to the public/excel directory
//           File::move(storage_path('app/temp/' . $fileName), $destinationDirectory . '/' . $fileName);

//           // Generate the full download URL
//           $url = url('export-excel/' . $fileName);


//         return $url;

//     }


    // public function adminExports(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'type' => 'required'
    //         // Add other validation rules as needed
    //     ]);
    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => $validator->errors()->first(),
    //         ], 400);
    //     }
    //     $type = $request->type;
    //     if ($type == 1) {
    //         $export = new AdminProfileExport();
    //         $fileName = 'admins-profiles-' . now()->format('YmdHis') . '.xlsx';
    //     } elseif ($type == 2) {
    //         $export = new AdminCategoryRoleExport();
    //         $fileName = 'admin-category-roles-' . now()->format('YmdHis') . '.xlsx';
    //     } elseif ($type == 3) {
    //         $export = new AdminRoleExport();
    //         $fileName = 'admins-roles-' . now()->format('YmdHis') . '.xlsx';
    //     } elseif ($type == 4) {
    //         $export = new AdminCategoryExport();
    //         $fileName = 'category-settings-' . now()->format('YmdHis') . '.xlsx';
    //     } elseif ($type == 5) {
    //         $export = new AdminNavigationExport();
    //         $fileName = 'navigations-' . now()->format('YmdHis') . '.xlsx';
    //     } elseif ($type == 6) {
    //         $export = new AdminDecorativeMethodExport();
    //         $fileName = 'decorative-methods-' . now()->format('YmdHis') . '.xlsx';
    //     } elseif ($type == 7) {
    //         $export = new AdminHsnExport();
    //         $fileName = 'hsns-' . now()->format('YmdHis') . '.xlsx';
    //     } elseif ($type == 8) {
    //         $export = new AdminAttributeExport();
    //         $fileName = 'admins-attributes-' . now()->format('YmdHis') . '.xlsx';
    //     }elseif ($type == 9) {
    //         $export = new ColorExport();
    //         $fileName = 'admins-colors-' . now()->format('YmdHis') . '.xlsx';
    //     }elseif ($type == 10) {
    //         $export = new CurrencyExport();
    //         $fileName = 'admins-currencies-' . now()->format('YmdHis') . '.xlsx';
    //     } elseif ($type == 11) {
    //         $export = new CustomerExport();
    //         $fileName = 'ecommerce-customers-' . now()->format('YmdHis') . '.xlsx';
    //     } elseif ($type == 12) {
    //         $export = new EventCategoryExport();
    //         $fileName = 'event-categories-' . now()->format('YmdHis') . '.xlsx';
    //     } else {
    //         # code...
    //     }
    //     // Return the download link to the frontend
    //     return response()->json([
    //         'status' => 'success',
    //         'download_link' => $url,
    //     ], 200);
    // }


}
