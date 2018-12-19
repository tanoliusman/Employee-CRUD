<?php
class Employee extends CI_Controller {
    public function index($page = 'employee'){
        if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }
       
        $this->load->database();
        $this->load->helper('url'); 
        $data['title'] = ucfirst($page); // Capitalize the first lette
        $this->load->view('pages/'.$page, $data);
        $this->db->close();
    }

    public function save_userinput()
    {
      //code goes here
      // for example: getting the post values of the form:
      $form_data = $this->input->post();
      // or just the username:
      $name = $this->input->post("name");
      $phone = $this->input->post("phone");
      $email = $this->input->post("email");
      $address = $this->input->post("address");
      
      $this->load->database();
      $data = array(
        'name' => $name,
        'email' => $email,
        'address' => $address,
        'phone' => $phone
        );


      $msg ='Employee created successfully';
      $success = true;
      if ( ! $this->db->insert('employee', $data))
      {
              $msg = "Unable to cerate employee"; 
              $success = false;
      }
      $insert_id = $this->db->insert_id();
     $this->db->close();
     $arr = array('msg' => $msg, 'success' => $success,'id' => $insert_id);    

     //add the header here
      header('Content-Type: application/json');
      echo json_encode( $arr );

    }


    public function update_employee()
    {
      //code goes here
      // for example: getting the post values of the form:
      $form_data = $this->input->post();
      // or just the username:
      $name = $this->input->post("name");
      $phone = $this->input->post("phone");
      $email = $this->input->post("email");
      $address = $this->input->post("address");
      $id = $this->input->post("id");
      
      $this->load->database();
      $this->db->where('employee.id',intval($id));
      $data = array(
        'name' => $name,
        'email' => $email,
        'address' => $address,
        'phone' => $phone
        );


      $msg ='Employee Updated successfully';
      $success = true;
      if ( ! $this->db->update('employee', $data))
      {
              $msg = "Unable to Update employee"; 
              $success = false;
      }

   
   
    $this->db->close();
     
    $arr = array('msg' => $msg, 'success' => $success);    

    //add the header here
     header('Content-Type: application/json');
     echo json_encode( $arr );
    }

    public function delete_employees()
    {
      //code goes here
      // for example: getting the post values of the form:
      $form_data = $this->input->post();
      // or just the username:
      $ids = $this->input->post("ids");
      
      $ids_arr = preg_split ("/\,/", $ids);  
      
      $this->load->database();
      $msg='Employee deleted successfully';
      $success=true;
      foreach ($ids_arr as &$id) {
        $this->db->delete('employee', array('id' => $id)); 
        }
    $this->db->close();
    $arr = array('msg' => $msg, 'success' => $success);    

    //add the header here
     header('Content-Type: application/json');
     echo json_encode( $arr );
    }
}