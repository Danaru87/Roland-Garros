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

class Joueur extends REST_Controller
{
	function __construct()
    {
        // Construct our parent class
        parent::__construct();
        $this->load->model('Joueur_model'); 
        
        // Configure limits on our controller methods. Ensure
        // you have created the 'limits' table and enabled 'limits'
        // within application/config/rest.php
        $this->methods['user_get']['limit'] = 500; //500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; //100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; //50 requests per hour per user/key
    }
    
    // Affiche tous les joueurs
    public function index_get()
    {
         // Affiche un joueur
        if (!$this->get('id'))
        {
            $result = $this->Joueur_model->ListJoueur();
        
            if($result)
            {
                $this->response($result, 200);
            }
            else
            {
                $this->response(array("error" => "Aucun joueur dans la base"), 404);
            }
        }
        
        $joueur = $this->Joueur_model->GetJoueur( $this->get('id') );
        
        if ($joueur)
        {
            $this->response($joueur, 200);
        }
        else
        {
            $this->response(array('error' => 'Joueur non trouvé'), 404);
        }
        
    }
    
    // Création d'un joueur
    public function index_post()
    {
        $data['prenom'] = $this->post('prenom');
        $data['nom'] = $this->post('nom');
        if (!$data['prenom'] or !$data['nom'])
        {
            $this->response('Paramêtre(s) manquant(s)', 400);
        }
        
        $saved = $this->Joueur_model->NewJoueur($data);
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
    public function index_put()
	{
        
        $data['id'] = $this->put('id');
        $data['prenom_joueur'] = $this->put('prenom');
        $data['nom_joueur'] = $this->put('nom');
        var_dump($data);
        $result = $this->Joueur_model->UpdateJoueur($data);
        var_dump($result);
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
    
    /**function index_put()
    {
        
        //$this->some_model->updateUser( $this->get('id') );
        $message = array('id' => $this->get('id'), 'name' => $this->post('name'), 'email' => $this->post('email'), 'message' => 'ADDED!');
        
        $this->response($message, 200); // 200 being the HTTP response code
    }**/
    
    function user_delete()
    {
    	//$this->some_model->deletesomething( $this->get('id') );
        $message = array('id' => $this->get('id'), 'message' => 'DELETED!');
        
        $this->response($message, 200); // 200 being the HTTP response code
    }
    
    function users_get()
    {
        //$users = $this->some_model->getSomething( $this->get('limit') );
        $users = array(
			array('id' => 1, 'name' => 'Some Guy', 'email' => 'example1@example.com'),
			array('id' => 2, 'name' => 'Person Face', 'email' => 'example2@example.com'),
			3 => array('id' => 3, 'name' => 'Scotty', 'email' => 'example3@example.com', 'fact' => array('hobbies' => array('fartings', 'bikes'))),
		);
        
        if($users)
        {
            $this->response($users, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }


	public function send_post()
	{
		var_dump($this->request->body);
	}


	
}