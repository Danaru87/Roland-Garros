<?php
class Joueur_model extends CI_Model {


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function ListJoueur()
    {
        $result = $this->db->get('joueur')->result();
        if($result)
        {
            return $result;
        }
        else
        {
            return null;
        }
    }
    function GetJoueur($pid)
    {
        $this->db->where("id_joueur", $pid);
        $query = $this->db->get('joueur');
        return $query->result();
    }
    
    function NewJoueur($pdata)
    {
        $data = array('nom_joueur' => $pdata['nom'],
                      'prenom_joueur' => $pdata['prenom']);
        $this->db->insert('joueur', $data);
        
        return $this->db->affected_rows();
    }

    function UpdateJoueur($data, $pID)
    {
        var_dump($data);
        var_dump($pID);
        $this->db->where('id_joueur', $pID);
        $this->db->update('joueur', $data);
        /*$result = $this->db->affected_rows();
        return $result;*/
    }

}