<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
class AdminController extends BaseController
{
  protected $productModel;

    public function _construct()
    {
        $this->productModel = new ProductModel();
    }

    public function admin()
    {
      return view('admins/insert');
    }
    public function create()
    {
      if ($this->request->getMethod() ==='post'){
        $productModel = new ProductModel();



        $image = $this->request->getFile('image_url');
        $image->move(ROOTPATH  .  'public/uploads');
        $imagePath = 'uploads/' . $image->getName();

        $data = [
          'name' => $this->request->getPost('name'),
          'image_url' => $imagePath,
          'price' => $this->request->getPost('price'),
        ];
        $productModel->insert($data);
        return redirect()->to('ux')->with('success','Product created successfully');
      }
      $data  = [
        'name' => $this->request->getPost('name'),
        'description' => $this->request->getPost('description'),
        'image_url' => $this->request->getPost('image_url'),
        'price' => $this->request->getPost('price'),
        'reviews' => $this->request->getPost('reviews'),
      ];
      $this->productModel->insert($data);

      return redirect()->to('ux')->with('success','Product created successfully');
    }
}
