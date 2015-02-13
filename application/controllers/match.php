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

class Match extends REST_Controller
{
	function __construct()
    {
        // Construct our parent class
        parent::__construct();
        $this->load->model('Match_model'); 
        
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
            $result = $this->Match_model->ListMatch();
        
            if($result)
            {
                $this->response($result, 200);
            }
            else
            {
                $this->response(array("error" => "Aucun match dans la base"), 404);
            }
        }
        
        /* 
        ** un match (/match/$id)
        */
        $joueur = $this->Match_model->GetMatch( $this->get('id') );
        
        if ($joueur)
        {
            $this->response($joueur, 200);
        }
        else
        {
            $this->response(array('error' => 'Match non trouvé'), 404);
        }
        
    }
    
    /*
    ** Création d'un Match, /Match
    ** EN POST
    */
    public function index_post()
    {
        $data['terrain'] = $this->post('terrain');
        $data['joueur1'] = $this->post('joueur1');
        $data['joueur2'] = $this->post('joueur2');
        if (!$data['terrain'] or !$data['joueur1'] or !$data['joueur2'])
        {
            $this->response('Paramêtre(s) manquant(s)', 400);
        }
        
        $saved = $this->Match_model->NewMatch($data);
        if ($saved == 0)
        {
            $this->response(array("error" => "Enregistrement échoué"), 400);
        }
        else
        {
            $message = array('message' => 'ADDED!');
            $this->response($message, 201);
        }
        
    }
    
    /* 
    ** Update d'un match, /match
    ** EN PUT
    */
    
    public function index_put()
	{
        $data['id_terrain'] = $this->put('terrain');
        $data['id_joueur1'] = $this->put('joueur1');
        $data['id_joueur2'] = $this->put('joueur2');
        $data['id_joueur_gagnant'] = $this->put('gagnant');
        $id = $this->put('id');
        
        $result = $this->Match_model->UpdateMatch($data, $id);
        if ($result == 0)
        {
            $this->response(array("error" => "Enregistrement échoué"), 400);
        }
        else
        {
            $message = array('message' => 'UPDATED!');
            $this->response($message, 201);
        }
	}
    
    /*
    ** Suppression d'un match, /match/$id
    ** EN DELETE
    */
    function index_delete()
    {
        $this->Match_model->DeleteMatch($this->get('id'));
        $message = array('id' => $this->get('id'), 'message' => 'DELETED!');
        
        $this->response($message, 200); // 200 being the HTTP response code
    }
    
}