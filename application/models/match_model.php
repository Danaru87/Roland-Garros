<?php
class Match_model extends CI_Model {


    function __construct()
    {
        parent::__construct();
    }

    /* 
    ** Liste l'ensemble des match du tournois
    ** return la liste des matchs
    */
    function ListMatch()
    {

        $result = $this->db->get('match')->result();
        $leMatch = null;
        foreach($result as $match)
        {
            $this->db->from('joueur');
            $this->db->where("id_joueur", $match->id_joueur1);
            $this->db->select("nom_joueur, prenom_joueur, Maj");
            $joueur = $this->db->get()->result();
            $match->Joueur1 = $joueur;

            $this->db->from('joueur');
            $this->db->where("id_joueur", $match->id_joueur2);
            $this->db->select("nom_joueur, prenom_joueur, Maj");

            $joueur = $this->db->get()->result();
            $match->Joueur2 = $joueur;

            $this->db->from('terrain');
            $this->db->where('id_terrain', $match->id_terrain);
            $terrain = $this->db->get()->result();
            $match->terrain = $terrain;

        }
        $this->db->close();
        return $result;
    }
    
    function ListMatchCurrent()
    {
        $this->db->where('termine', '0');
        $result = $this->db->get('match')->result();
        $leMatch = null;
        foreach($result as $match)
        {

            $this->db->from('joueur');
            $this->db->where("id_joueur", $match->id_joueur1);
            $this->db->select("nom_joueur, prenom_joueur, Maj");
            $joueur = $this->db->get()->result();
            $match->Joueur1 = $joueur;

            $this->db->from('joueur');
            $this->db->where("id_joueur", $match->id_joueur2);
            $this->db->select("nom_joueur, prenom_joueur, Maj");

            $joueur = $this->db->get()->result();
            $match->Joueur2 = $joueur;

            $this->db->from('terrain');
            $this->db->where('id_terrain', $match->id_terrain);
            $terrain = $this->db->get()->result();
            $match->terrain = $terrain;

        }
        $this->db->close();
        return $result;
        
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
        $this->db->close();

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
                     'id_joueur2' => $pdata['joueur2']);
        $this->db->insert('match', $data);
        $this->db->close();
        
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
        $this->db->close();

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
        $this->db->close();
    }

}