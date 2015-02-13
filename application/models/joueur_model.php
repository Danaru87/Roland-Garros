<?php
class Joueur_model extends CI_Model {


    $id = '';
    $nom = '';
    $prenom = '';
    
    function __construct($pId = null, $pNom = null, $pPrenom = null)
    {
        parent::__construct();
        $id = $pId;
        $nom = $pNom;
        $prenom = $pPrenom;
    }

    /* 
    ** Liste l'ensemble des joueurs du tournois
    ** return la liste des joueurs
    */
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
    
    /* 
    ** Recupère un joueur
    ** @param $pid: id du joueur
    ** return le joueur
    */
    function GetJoueur($pid)
    {
        $this->db->where("id_joueur", $pid);
        $query = $this->db->get('joueur');
        return $query->result();
    }
    
    /* 
    ** Création d'un joueur
    ** @param $pdata: les champs du joueur
    ** return le nombre de lignes affectées
    */
    function NewJoueur($pdata)
    {
        $data = array('nom_joueur' => $pdata['nom'],
                      'prenom_joueur' => $pdata['prenom']);
        $this->db->insert('joueur', $data);
        
        return $this->db->affected_rows();
    }

    /* 
    ** Recupère un joueur
    ** @param $pID: id du joueur
    ** @param $data: les champs du joueur (hors id)
    ** return le nombre de lignes affectées
    */
    function UpdateJoueur($data, $pID)
    {
        
        $this->db->where('id_joueur', $pID);
        $this->db->update('joueur', $data);
        $result = $this->db->affected_rows();
        return $result;
    }
    
    /* 
    ** Supprime un joueur
    ** @param $pID: id du joueur
    ** return le nombre de lignes affectées
    */
    function DeleteJoueur($pID)
    {
        
        $this->db->where('id_joueur', $pID);
        $this->db->delete('joueur');
    }

}