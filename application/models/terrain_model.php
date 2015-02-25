<?php
class Terrain_model extends CI_Model {


    function __construct()
    {
        parent::__construct();
    }

    /* 
    ** Recupère les scores d'un match
    ** @param $pid: id du match
    ** return le match
    */
    function ListTerrains()
    {
        // Recupération du Match
        $terrains = $this->db->get('terrain')->result();

        return $terrains;
    }

    function GetTerrain($id)
    {
        $this->db->where('id_terrain', $id);
        $terrain = $this->db->get('terrain')->result();

        return $terrain;
    }

}