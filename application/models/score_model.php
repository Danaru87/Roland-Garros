<?php
class Score_model extends CI_Model {


    function __construct()
    {
        parent::__construct();
        $this->load->model('Match_model');
    }

    /* 
    ** Recupère les scores d'un match
    ** @param $pid: id du match
    ** return le match
    */
    function GetScores($idMatch)
    {
        // Recupération du Match
        $match = $this->Match_model->getMatch($idMatch)[0];

        // Récupération du score du joueur 1
        $this->db->where("id_match", $match->id_match);
        $this->db->where("id_joueur", $match->id_joueur1);
        $this->db->from('score');
        $match->ScoreJoueur1 = $this->db->get()->result();

        // Recupération du score du joueur 2
        $this->db->where("id_match", $match->id_match);
        $this->db->where("id_joueur", $match->id_joueur2);
        $this->db->from('score');
        $match->Score_Joueur2 = $this->db->get()->result();

        return $match;
    }

}