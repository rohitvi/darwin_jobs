<?php
namespace App\Controllers;
use App\Models\AdminModel;

class Admin extends BaseController
 {
    public function __construct()
 {
        $this->am = new AdminModel();
    }

    public function index()
 {
        return view( 'admin/dashboard' );

    }

    public function list_category()
 {
        $session = \Config\Services::session();
        $data['session'] = $session;

        $data['categories'] = $this->am->get_all_categories();
        return view( 'admin/category/list_category', $data );
    }

    public function add_category()
    {
        $session = \Config\Services::session();
        helper( 'form' );
        $data = [];

        if ( $this->request->getMethod() == 'post' ) {
            $input = $this->validate( [
                'category' => 'required|min_length[5]',
            ] );

            if ( $input == true ) {
                //form validated successfully, so we can save values to database
                $model = new AdminModel();
                $model->save( [
                    'name' => $this->request->getPost( 'category' ),
                    'slug' => $this->request->getPost( 'category' )
                ] );

                $session->setFlashdata( 'success', 'Category Added successfully' );
                return redirect()->to( '/admin/list_category' );
                //redirect( base_url( 'admin/category' ) );

            } else {
                //form not validated successfully
                $data['validation'] = $this->validator;
            }

        }

        return view( 'admin/category/add_category', $data );
    }

    public function edit_category( $id ) {

        $session = \Config\Services::session();
        helper( 'form' );

        $model = new AdminModel();
        $category_row = $model->get_row_category( $id );

        if ( empty( $category_row ) ) {
            $session->setFlashdata( 'error', 'Record Not Found.' );
            return redirect()->to( '/admin/list_category' );
        }

        $data = [];
        $data['category_row'] = $category_row;

        if ( $this->request->getMethod() == 'post' ) {
            $input = $this->validate( [
                'category' => 'required|min_length[5]',
            ] );

            if ( $input == true ) {
                //form validated successfully, so we can save values to database
                $model = new AdminModel();
                $model->update( $id, [
                    'name' => $this->request->getPost( 'category' ),
                    'slug' => $this->request->getPost( 'category' )
                ] );

                $session->setFlashdata( 'success', 'Category Update successfully' );
                return redirect()->to( '/admin/list_category' );
                //redirect( base_url( 'admin/category' ) );

            } else {
                //form not validated successfully
                $data['validation'] = $this->validator;
            }

        }
        // pre( $data );
        return view( 'admin/category/edit_category', $data );
    }

    public function del_category( $id = null ) {
        $model = new AdminModel();
        $data['user'] = $model->where( 'id', $id )->delete();
        return redirect()->to( base_url( 'admin/list_category' ) );
    }


    public function list_industry()
    {
      //echo 'hello';    $data['categories'] = $this->am->get_all_categories();
     $data['industry'] = $this->am->get_all_industry();
     return view('admin/industry/list_industry',$data);
    }

    public function add_industry()
    {
      if ($this->request->getMethod() == 'post') {
        $input = $this->validate([  
          'category' => 'required|min_length[5]',
        ]);

          

      }
      return view('admin/industry/add_industry');
    }
}