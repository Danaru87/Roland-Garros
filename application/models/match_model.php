<?php
class Match_model extends CI_Model {


    function __construct()
    {
        parent::__construct();
    }

    /* 
    ** Liste l'ensemble des match du tournois
    ** return la liste des joueurs
    */
    function ListMatch()
    {
        
        // A Faire
        $result = $this->db->get('match')->result();
        if($result)
        {
            return $result;
        }
        else
        {
            return null;
        }
    }
    
    /* 
    ** Recupère un match
    ** @param $pid: id du match
    ** return le match
    */
    function GetMatch($pid)
    {
        $this->db->where("id_match", $pid);
        $query = $this->db->get('match');
        return $query->result();
    }
    
    /* 
    ** Création d'un match
    ** @param $pdata: les champs du match
    ** return le nombre de lignes affectées
    */
    function NewMatch($pdata)
    {
        $data = array('id_terrain' => $pdata['terrain'],
                      'id_joueur1' => $pdata['joueur1'],
                     'id_joueur2' => $pdata['joueur2'],
                     'id_joueur_gagnant' => $pdata['gagnant']);
        $this->db->insert('match', $data);
        
        return $this->db->affected_rows();
    }

    /* 
    ** Recupère un match
    ** @param $pID: id du match
    ** @param $data: les champs du match (hors id)
    ** return le nombre de lignes affectées
    */
    function UpdateMatch($data, $pID)
    {
        
        $this->db->where('id_match', $pID);
        $this->db->update('match', $data);
        $result = $this->db->affected_rows();
        return $result;
    }
    
    /* 
    ** Supprime un match
    ** @param $pID: id du match
    ** return le nombre de lignes affectées
    */
    function DeleteMatch($pID)
    {
        
        $this->db->where('id_match', $pID);
        $this->db->delete('match');
    }

}