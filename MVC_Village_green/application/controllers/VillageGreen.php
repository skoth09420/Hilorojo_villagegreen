<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VillageGreen extends CI_Controller {

	public function index() {

		$this->load->view('VillageGreen/header(1).php');

		$this->load->view('VillageGreen/VGFontHeader(a).php');
		$this->load->view('VillageGreen/VGFontAccueil(a).php');
		$this->load->view('VillageGreen/VGFontEspaceClient(a).php');
		$this->load->view('VillageGreen/VGFontFooter(a).php');

		$this->load->view('VillageGreen/back_header(b).php');
		$this->load->view('VillageGreen/back_accueil(b).php');
                $this->load->view('VillageGreen/back_rubriques(b).php');
                $this->load->view('VillageGreen/back_produits(b).php');
		$this->load->view('VillageGreen/back_clients(b).php');
		$this->load->view('VillageGreen/back_footer(b).php');

		$this->load->view('VillageGreen/footer(1).php');
	}

        public function rubrique($rid) {
                if ($rid == 0) {
                        $requete = $this->db->get('rubriques');
                        $rlist = $requete->result();
                        $this->output->set_content_type('application/json');
                        $this->output->set_header('Access-Control-Allow-Origin: *');
                        $this->output->set_output(json_encode($rlist));
                }
                else {
                        $this->db->where('RubID',$rid);
                        $requete = $this->db->get('rubriques');
                        $rlist = $requete->result();
                        $this->output->set_content_type('application/json');
                        $this->output->set_header('Access-Control-Allow-Origin: *');
                        $this->output->set_output(json_encode($rlist));
                }
        }

        public function rubrique_add() {
                $input_data = json_decode(trim($this->input->raw_input_stream), true);
                //echo ">>>" . $_SERVER['REQUEST_METHOD']."\n\r";
                //var_dump($input_data);
                $this->db->insert('rubriques', $input_data);
        }

        public function rubrique_mod() {
                $input_data = json_decode(trim($this->input->raw_input_stream), true);
                //$titre = $input_data["titre"];
                $this->db->where('RubID', $input_data["RubID"]);
                $this->db->update('rubriques', $input_data);
        }

        public function rubrique_del($rid) {
                $this->db->where('RubID', $rid);
                $this->db->delete('rubriques');
        }



        public function sous_rubrique($srid) {
                if ($srid == 0) {
                        $requete = $this->db->get('sous_rubriques');
                        $srlist = $requete->result();
                }
                else {
                        $this->db->where('SRubID',$srid);
                        $requete = $this->db->get('sous_rubriques');
                        $srlist = $requete->result();
                }
                $this->output->set_content_type('application/json');
                $this->output->set_header('Access-Control-Allow-Origin: *');
                $this->output->set_output(json_encode($srlist));
        }

        public function rsous_rubrique($rsrid) {
                $this->db->where('RubID',$rsrid);
                $requete = $this->db->get('sous_rubriques');
                $rsrlist = $requete->result();
                
                $this->output->set_content_type('application/json');
                $this->output->set_header('Access-Control-Allow-Origin: *');
                $this->output->set_output(json_encode($rsrlist));
        }

        public function sous_rubrique_add() {
                $input_data = json_decode(trim($this->input->raw_input_stream), true);
                $this->db->insert('sous_rubriques', $input_data);
        }

        public function sous_rubrique_mod() {
                $input_data = json_decode(trim($this->input->raw_input_stream), true);
                $this->db->where('SRubID', $input_data["SRubID"]);
                $this->db->update('sous_rubriques', $input_data);
        }

        public function sous_rubrique_del($srid) {
                $this->db->where('SRubID', $srid);
                $this->db->delete('sous_rubriques');
        }



        public function produit($pid) {
                if ($pid == "null") {
                        $requete = $this->db->get('produit');
                        $plist = $requete->result();
                }
                else {
                        $this->db->where('ProCode',$pid);
                        $requete = $this->db->get('produit');
                        $plist = $requete->result();
                }
                $this->output->set_content_type('application/json');
                $this->output->set_header('Access-Control-Allow-Origin: *');
                $this->output->set_output(json_encode($plist));
        }

        public function srproduit($srpid) {
                $this->db->where('SRubID',$srpid);
                $requete = $this->db->get('produit');
                $plist = $requete->result();

                $this->output->set_content_type('application/json');
                $this->output->set_header('Access-Control-Allow-Origin: *');
                $this->output->set_output(json_encode($plist));
        }

        public function produit_add() {
                $input_data = json_decode(trim($this->input->raw_input_stream), true);
                $this->db->insert('produit', $input_data);
        }

        public function produit_mod() {
                $input_data = json_decode(trim($this->input->raw_input_stream), true);
                $this->db->where('ProCode', $input_data["ProCode"]);
                $this->db->update('produit', $input_data);
        }

        public function produit_del($pid) {
                $this->db->where('ProCode', $pid);
                $this->db->delete('produit');
        }



        public function client($clid) {
                if ($clid == 0) {
                        $requete = $this->db->get('client');
                        $cllist = $requete->result();
                }
                else {
                        $this->db->where('CliID',$clid);
                        $requete = $this->db->get('client');
                        $cllist = $requete->result();
                }
                $this->output->set_content_type('application/json');
                $this->output->set_header('Access-Control-Allow-Origin: *');
                $this->output->set_output(json_encode($cllist));
        }

        public function client_add() {
                $input_data = json_decode(trim($this->input->raw_input_stream), true);
                $this->db->insert('client', $input_data);
        }

        public function client_mod() {
                $input_data = json_decode(trim($this->input->raw_input_stream), true);
                $this->db->where('CliID', $input_data["CliID"]);
                $this->db->update('client', $input_data);
        }

        public function client_del($clid) {
                $this->db->where('CliID', $clid);
                $this->db->delete('client');
        }



        public function commande($cmid) {
                if ($cmid == 0) {
                        $requete = $this->db->get('commande');
                        $cmlist = $requete->result();
                }
                else {
                        $this->db->where('ComID',$cmid);
                        $requete = $this->db->get('commande');
                        $cmlist = $requete->row();
                }
                $this->output->set_content_type('application/json');
                $this->output->set_header('Access-Control-Allow-Origin: *');
                $this->output->set_output(json_encode($cmlist));
        }

        public function commande_add() {
                $input_data = json_decode(trim($this->input->raw_input_stream), true);
                $this->db->insert('commande', $input_data);
        }

        public function commande_mod() {
                $input_data = json_decode(trim($this->input->raw_input_stream), true);
                $this->db->where('ComID', $input_data["ComID"]);
                $this->db->update('commande', $input_data);
        }

        public function commande_del($cmid) {
                $this->db->where('ComID', $cmid);
                $this->db->delete('commande');
        }



        public function livraison($lid) {
                if ($lid == 0) {
                        $requete = $this->db->get('livraison');
                        $llist = $requete->result();
                }
                else {
                        $this->db->where('LivID',$lid);
                        $requete = $this->db->get('livraison');
                        $llist = $requete->row();
                }
                $this->output->set_content_type('application/json');
                $this->output->set_header('Access-Control-Allow-Origin: *');
                $this->output->set_output(json_encode($llist));
        }

        public function livraison_add() {
                $input_data = json_decode(trim($this->input->raw_input_stream), true);
                $this->db->insert('livraison', $input_data);
        }

        public function livraison_mod() {
                $input_data = json_decode(trim($this->input->raw_input_stream), true);
                $this->db->where('LivID', $input_data["LivID"]);
                $this->db->update('livraison', $input_data);
        }

        public function livraison_del($lid) {
                $this->db->where('LivID', $lid);
                $this->db->delete('livraison');
        }



        public function fournisseur($fid) {
                if ($fid == 0) {
                        $requete = $this->db->get('fournisseur');
                        $flist = $requete->result();
                        $this->output->set_content_type('application/json');
                        $this->output->set_header('Access-Control-Allow-Origin: *');
                        $this->output->set_output(json_encode($flist));
                }
                else {
                        $this->db->where('FouID',$fid);
                        $requete = $this->db->get('fournisseur');
                        $flist = $requete->result();
                        $this->output->set_content_type('application/json');
                        $this->output->set_header('Access-Control-Allow-Origin: *');
                        $this->output->set_output(json_encode($flist));
                }
        }

        public function commercial($crid) {
                if ($crid == 0) {
                        $requete = $this->db->get('commercial');
                        $crlist = $requete->result();
                        $this->output->set_content_type('application/json');
                        $this->output->set_header('Access-Control-Allow-Origin: *');
                        $this->output->set_output(json_encode($crlist));
                }
                else {
                        $this->db->where('FouID',$fid);
                        $requete = $this->db->get('commercial');
                        $crlist = $requete->result();
                        $this->output->set_content_type('application/json');
                        $this->output->set_header('Access-Control-Allow-Origin: *');
                        $this->output->set_output(json_encode($crlist));
                }
        }


}
