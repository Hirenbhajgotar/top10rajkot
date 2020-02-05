<?php 
class Testing extends CI_Controller
{
    public function test()
    {
        echo 'File name:'. ' ' .__FILE__;
        echo '<br>';
        echo 'Line no.:'. ' '.__LINE__;
        echo 'djfkdjkdjf';
        echo 'djfkdjkdjf';
        echo 'djfkdjkdjf';
        exit;
    }

    public function index()
    {
        $data['metaData'] = $this->Settings_model->get_settings();

        // * set metadata
        $data['metaData']['title'] = $data['metaData'][7]->value;
        $data['metaData']['description'] = $data['metaData'][11]->value;
        $data['metaData']['keywords'] = $data['metaData'][6]->value;
        $data['metaData']['icon'] = $data['metaData'][5]->value;
        $data['metaData']['logo'] = $data['metaData'][4]->value;

        $this->load->view('frontend/theme/default/templates/header', $data);
        $this->load->view('test/test');
        $this->load->view('frontend/theme/default/templates/footer');
    }
}

?>