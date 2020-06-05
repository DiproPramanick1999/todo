<?php
  /**
   *
   */
  class Abcd extends CI_Controller
  {

    function index()
    {
      // echo base_url();
      $this->load->library('encryption');
      $this->encryption->initialize(
          array(
            'cipher' => 'aes-256',
            'mode' => 'ctr',
          )
      );
      // $pass =  $this->encryption->decrypt("078a671dc5005790dcb25dbd2d632af954c60814b2e96c0b996585d60d45fa85d87b2a8e4156573292b29ab460fe6aa52982293f5a215ff820669fa86df63239TOxWr29DJPTmiiDeJkoS2sbogYypla9Za3M=");
      $pass = $this->encryption->encrypt("pranav1503");
      echo $pass."<br>";
      $pass = $this->encryption->decrypt($pass);
      echo $pass;
    // }

    // $this->load->helper('url');
    // $this->session->set_flashdata('signup',true);
    // redirect(base_url()."home/login");
    // print_r($this->session->userdata('userid'));

  }

  function test()
  {
    echo "this is test page";
  }

  function getInfo()
  {
    $curl = curl_init();
    curl_setopt($curl,CURLOPT_URL,'https://www.amazon.in/');
    curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
    curl_exec($curl);
    curl_close($curl);
  }

}

//  class Abcd extends MY_Controller {
//  public function index() {
//     $this->load->view('test');
//  }
// }

 ?>
