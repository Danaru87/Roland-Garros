<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
 */

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class Terrain extends REST_Controller
{
    function __construct()
    {
        // Construct our parent class
        parent::__construct();
        $this->load->model('Terrain_model');

        // Configure limits on our controller methods. Ensure
        // you have created the 'limits' table and enabled 'limits'
        // within application/config/rest.php
        //$this->methods['user_get']['limit'] = 500; //500 requests per hour per user/key
        //$this->methods['user_post']['limit'] = 100; //100 requests per hour per user/key
        //$this->methods['user_delete']['limit'] = 50; //50 requests per hour per user/key
    }

    /* 
    ** /match
    ** EN GET
    */
    public function index_get()
    {

        if (!$this->get('id'))
        {
            /* 
            ** liste des match (/match)
            */
            $result = $this->Terrain_model->ListTerrains();

            if($result)
            {
                $this->response($result, 200);
            }
            else
            {
                $this->response(array("error" => "Aucun terrains dans la base"), 404);
            }
        }


        $terrain = $this->Terrain_model->GetTerrain( $this->get('id') );

        if ($terrain)
        {
            $this->response($terrain, 200);
        }
        else
        {
            $this->response(array('error' => 'Terrains non trouvé'), 404);
        }

    }
}