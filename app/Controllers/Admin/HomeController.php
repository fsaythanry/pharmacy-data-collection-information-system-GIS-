<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DistrictModel;
use App\Models\PharmaciesModel;

class HomeController extends BaseController
{
    public  function __construct()
    {
        $this->model = new DistrictModel();
        $this->modelPharmacies = new PharmaciesModel();
    }
    public function index()
    {
        $did = $this->request->getVar('did');
        if ($did) {
            $districtData = $this->model->getWithTotalPharmacies($did)->getResultArray();
        } else {
            $districtData = $this->model->getWithTotalPharmacies()->getResultArray();
        }

        $districts = $this->model->findAll();
        $pharmacies = $this->modelPharmacies->findAll();

        return view('admin/home/home', [
            'page' => 'home',
            'geojson' => $districtData,
            'pharmacies' => $pharmacies,
            'districts' => $districts,
            'did' => $did
        ]);
    }
}
