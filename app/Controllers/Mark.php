<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Mark extends ResourceController
{
    protected $modelName = 'App\Models\Mark';
    protected $format    = 'json';
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data =[
            'message' => 'success',
            'data_mark' => $this->model->findAll()
        ];
        return $this->respond($data, 200);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $data = [
            'message' => 'success',
            'mark_byid' => $this->model->find($id)

        ];

        if ($data['mark_byid'] == null) {
           
            return $this->failNotFound('id not found'.$id);
           
        }

        return $this->respond($data, 200);
    
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $rules =$this->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'bidang' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'upload' => 'upload'
        ]);

        if (!$rules) {
           $response = [
               'message' => $this->validator->getErrors()
                
            ];

            return $this->failValidationErrors($response);
            
        }

        $this->model->insert([
            'nama'  => esc($this->request->getVar('nama')),
            'jabatan'  => esc($this->request->getVar('jabatan')),
            'bidang'  => esc($this->request->getVar('bidang')),
            'alamat'  => esc($this->request->getVar('alamat')),
            'email'  => esc($this->request->getVar('email')),
        ]);
    
        $response = [
            'message' => 'success created data',
        ];
    
        return $this->respondCreated($response);
    }
    

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $rules =$this->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'bidang' => 'required',
            'alamat' => 'required',
            'email' => 'required',
        ]);

        if (!$rules) {
           $response = [
               'message' => $this->validator->getErrors()
                
            ];

            return $this->failValidationErrors($response);
            
        }

        $this->model->update( $id, [
            'nama'  => esc($this->request->getVar('nama')),
            'jabatan'  => esc($this->request->getVar('jabatan')),
            'bidang'  => esc($this->request->getVar('bidang')),
            'alamat'  => esc($this->request->getVar('alamat')),
            'email'  => esc($this->request->getVar('email')),
        ]);
    
        $response = [
            'message' => 'success update data',
        ];
    
        return $this->respond($response);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $this->model->delete($id);

        $response = [
            'message' => 'success delete data',
        ];

        return $this->respondDeleted($response);
    }
}
