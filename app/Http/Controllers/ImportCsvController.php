<?php

namespace App\Http\Controllers;

use App\Contact;
use App\CsvData;
use App\Http\Requests\CsvImportRequest;
use App\Models\Center;
use App\Models\SubCenter;
use App\User;
use App\Utility\ElasticsearchUtility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use mysql_xdevapi\Collection;

class ImportCsvController extends Controller
{
    public $usersData = [];
    public $departments = [];
    public $is_department_inserted = false;
    public function __construct()
    {
        ini_set('memory_limit', '-1');
        set_time_limit(0);
    }

    public function getImportAjax()
    {
        return view('csv_upload');
    }

    public function getImport()
    {
        return view('csv_upload');
        //return view('import');
    }

    public function upload_csv(Request $request)
    {
        $file = request()->file('file');
        if($file->getClientOriginalExtension() !="csv")
            return ["status"=>false,"message"=>"Please upload csv file"];

        $filename = "member_csv_".time().".".$file->getClientOriginalExtension();
        $res = $file->move(public_path(), $filename);

        return $this->importDataFromCsv($filename);

    }

    public function importDataFromCsv($fileName=""){

        $file_name = public_path()."/csv.csv";

        if(!file_exists(public_path()."/csv.csv"))
            return "File not exist $file_name";

        $allData = $this->get_file_data($file_name);
        return $allData;
    }

    public function uploadCsv()
    {


    }

    public function importDataFromFile(request $request)
    {
        $fileName = "csv.csv";//$request->fileName;
        $file_name = public_path()."/$fileName";

        if(!file_exists(public_path()."/$fileName"))
            return "File not exist $file_name";

        $allData = $this->get_file_data($file_name);
        return $allData;

    }


    //    read file
    public function get_file_data($p_Filepath="")
    {
        $file = fopen($p_Filepath,"r");

        $i = 0;
        $count=0;
        $head_array = array();
        $data_array = array();
        while(! feof($file))
        {
            if($i == 0){
                $head_array = fgetcsv($file);
            }else{
                $temp = array();
                $data = fgetcsv($file);

                if($data !=''){
                    for($k = 0; $k <count($head_array); $k++){
                        $temp[$head_array[$k]] = $data[$k];
                    }
                    $data_array[] = $temp;
                }

                if($i == 500){
                    $this->processData($data_array);
                    $data_array = array();
                    $i = 0;
                }

            }
            $i++;
            $count++;

        }
        $this->processData($data_array);
        return ["status"=>true,"message"=>"Total $count records are dumped to database"];
    }




    public function processData($allData)
    {
        $allDatas = collect($allData);

        $subset = $allDatas->map(function ($data) {
            return collect($data)
                ->only(['Badge No', 'Name',"F/H Name","New Department","C/SC/P","CENTRE","Gender","MOBILE NO","TTL"])
                ->all();
        });
        $this->departments = DB::table("weekly_department")->get();

        //........ insert department here ........//
        if(!$this->is_department_inserted){
            $departments = [];
            foreach ($subset as $key => $value) {
                $department = [
                    'name' => $value['New Department'],
                ];
                array_push($departments,$department);
            }
            DB::table("weekly_department")->insertOrIgnore($departments);
            $this->departments = DB::table("weekly_department")->get();
            $this->is_department_inserted = true;
        }

        //......... end of insert departments  .......//
        $dataCount = 0;
        $userCollection = collect([]);

        $centers = [];
        foreach ($subset as $key => $value){
            $datas = [
                'annual_badge_no'          =>$value['Badge No'],
                'name'          =>$value['Name'],
                'fname'        =>$value['CENTRE'],
                'sex'        => $value['Gender'],
                'contact'     => ($value['MOBILE NO'] == "n" || $value['MOBILE NO']=="NA") ? "" :$value['MOBILE NO'] ,
                'weekly_department_id'        => $this->departments->where("name",$value['New Department'])->first()->id ?? 0,
                'center_id'        => $value['CENTRE'],
            ];
            $department = [
                'name'        => $value['New Department'],
            ];
            $center = [
                'name'        => $value['CENTRE'],
            ];
            $dataCount ++;
            array_push($this->usersData,$datas);

            array_push($centers,$center);
            $userCollection [] = (object) $datas;

            if($dataCount == 500){
                DB::table("users")->insertOrIgnore($this->usersData);
                DB::table("centers")->insertOrIgnore($centers);
                $this->usersData = [];
                $userCollection = collect([]);
                $dataCount = 0;
            }
        }

        $getcenters = DB::table("centers")->get();
        $subCentersArray = [];
        $tot = 0;
        foreach ($getcenters as $key => $value){
            array_push($subCentersArray,["center_id"=>$value->id,"name"=>$value->name]);
            $tot = $tot + 1;
            if($tot == 100){
                SubCenter::insertOrIgnore($subCentersArray);
                $subCentersArray = [];
                $tot = 0;
            }
        }
        if(!empty($subCentersArray))
            SubCenter::insertOrIgnore($subCentersArray);


        return array(
            'status' => true,
            'total' => count($allData)
        );
    }

    public function normalizeString($str) {
        $str = str_replace(".","",$str);
        $str = str_replace("~","",$str);
        $str = str_replace("-","",$str);
        return trim($str);
    }





}//.... end of class  .....//
