var g = new Vue({
		el: '#global',

		data: {
			titrelistepro: "",
			titressrub: "",

			rublist: [],
			srublist: [],
			prolist: [],
			foulist: [],
			clilist:[],
			cmrlist: [],

			a:true,
			b:false,

			affsousrubriques:false,
			admaccueil:true,

			admrubrique:false,
			admnewrubrique:false,
			admrenamerubrique:false,

			admnewsousrubrique: false,
			admmodifsousrubrique:false,

			admproduit:false,
			admmodifproduit:false,
			admnewproduit:false,

			infosclient:false,
			modifinfosclient:false,


			admclient:false,
			admmodifclient:false,
			admnewclient:false,

			detrub: 0,
			detsrub: 0,
			detpro: 0,
			srdetpro: 0,
			idrub: 0,
			detcli:0,
			temp: 0,
			lfproduit:"",

			rform: { RubLibelle: ""},
			srform: { SRubLibelle: "", RubID: 0},
			pform: { ProCode: "", ProLibelle: "", ProDescription: "", ProPhoto: "", ProAffichage: 1, ProPrixAchat: 0, ProStockPhysique: 0, ProStockAlerte: 0, apprQuantite: 0, FouID: 0, SRubID: 0 },
			cform: { CliType: 1, CliNom: "", CliPrenom: "", CliAdresse: "", CliCP: "", CliVille: "", CliMail: "", CmrID: 0 },

			mailnewsletter: "",
		},

		// mounted: function() { },

		methods: {
	// Accueil

		// Pages accueil
			btnretouracc: function(evt){
				g.infosclient=false;

				g.btnadmaccueil();
			},
			btnadmaccueil: function(evt){
				g.admproduit=false;
				g.admrubrique=false;
				g.admclient=false;
				g.admaccueil=true;
			},

		// Navig Visiteur - Admin
			btnpageadmin:function(evt) {
				g.a=false;
				g.b=true;
				g.btnadmaccueil();
			},
			btnpagevisit:function(evt) {
				g.a=true;
				g.b=false;
				g.btnadmaccueil();
			},

		// Menu sous rubriques
			hovaffsousrubriques:function()	{ g.affsousrubriques = true;	},
			hovcachsousrubriques:function()	{ g.affsousrubriques = false;	},

	// Rubriques

		// Liste rubriques et sous-rubriques
			btnadmrubrique: function(rid){
				g.admaccueil=false;
				g.admnewrubrique=false;
				//g.detrub = rid;
				axios.get("http://127.0.0.1/Travaux/sites/MVC_Village_Green/index.php/VillageGreen/rubrique/"+rid)
				.then(function(reponse) {
					g.rublist = reponse.data;
					axios.get("http://127.0.0.1/Travaux/sites/MVC_Village_Green/index.php/VillageGreen/sous_rubrique/0")
					.then(function(reponse) {
						g.srublist = reponse.data;
						g.admproduit=false;
						g.admrubrique=true;
						g.admaccueil=false;
						g.admclient=false;
						g.admnewclient=false;
					});
				});
			},

		// New rubrique
			btnadmnewrubrique:function(evt){
				g.rform = { RubLibelle: ""};
				g.admnewrubrique=true;
				g.admrubrique=false;
				g.admrenamerubrique=false;
				g.admmodifsousrubrique=false;
			},
			btnadmnewrubriqueconfirm:function(evt){
				if (g.rform.RubLibelle != "") {
					axios.post("http://127.0.0.1/Travaux/sites/MVC_Village_Green/index.php/VillageGreen/rubrique_add", g.rform)
					.then(function(reponse) {
						console.log("ok add rubrique");
						g.admnewrubrique=false;
						g.btnadmrubrique(0);
						alert("Nouvelle rubrique '" + g.rform.RubLibelle + "' ajoutée !");
					});
				} else alert("Libellé manquant ou incorrect");
			},
			btnadmnewrubriquecancel:function(evt){
				g.rform = { RubLibelle: ""};
				g.admnewrubrique=false;
			},

		// Modif rubrique
			btnadmrenamerubrique: function(rid){
				axios.get("http://127.0.0.1/Travaux/sites/MVC_Village_Green/index.php/VillageGreen/rubrique/"+rid)
				.then(function(reponse) {
					console.log(reponse.data);
					g.rform = reponse.data[0];
					//g.rform.RubLibelle = reponse.data.RubLibelle;
					g.admrenamerubrique=true;
				});
			},
			btnadmrenamerubriqueconfirm:function(evt){
				if (g.rform.RubLibelle != "") {
					axios.post("http://127.0.0.1/Travaux/sites/MVC_Village_Green/index.php/VillageGreen/rubrique_mod", g.rform)
					.then(function(reponse) {
						console.log("ok mod rubrique");
						g.admrenamerubrique=false;
						g.btnadmrubrique(0);
						alert("Rubrique modifiée !");
					});
				} else alert("Libellé manquant ou incorrect");
			},
			btnadmrenamerubriquecancel:function(evt){
				g.rform = { RubLibelle: ""};
				g.admrenamerubrique=false;
			},

		// Del rubrique
			btnadmdeleterubrique:function(rid){
				axios.get("http://127.0.0.1/Travaux/sites/MVC_Village_Green/index.php/VillageGreen/rsous_rubrique/" + rid)
				.then(function(reponse) {
					if (reponse.data != 0)  alert("Impossible : cette rubrique contient des sous-rubriques !");
					else {
						if (confirm("Êtes-vous sûr.e ?") == true) {
							axios.get("http://127.0.0.1/Travaux/sites/MVC_Village_Green/index.php/VillageGreen/rubrique_del/" + rid)
							.then(function(reponse) {
								g.btnadmrubrique(0);
							});
						}
					}
				});
			},

	// Sous-rubriques

		// New sous-rubrique
			btnadmnewsousrubrique: function(rid) {
				g.srform = { SRubLibelle: "", RubID: rid};
				g.admnewsousrubrique = true;
			},
			btnadmnewsousrubriqueconfirm: function(evt) {
				if (g.srform.SRubLibelle != "") {
					axios.post("http://127.0.0.1/Travaux/sites/MVC_Village_Green/index.php/VillageGreen/sous_rubrique_add", g.srform)
					.then(function(reponse) {
						console.log("ok add sous_rubrique");
						g.admnewsousrubrique=false;
						g.btnadmrubrique(0);
						alert("Sous-rubrique '" + g.srform.SRubLibelle + "' ajoutée !");
						g.srform = { SRubLibelle: "", RubID: 0};
					});
				} else alert("Libellé manquant ou incorrect");
			},
			btnadmnewsousrubriquecancel: function(evt) {
				g.srform = { SRubLibelle: "", RubID: 0};
				g.admnewsousrubrique = false;
			},

		// Modif sous-rubrique
			btnadmmodifsousrubrique: function(srid){
				axios.get("http://127.0.0.1/Travaux/sites/MVC_Village_Green/index.php/VillageGreen/sous_rubrique/"+srid)
				.then(function(reponse) {
					g.srform = reponse.data[0];
					g.admrubrique=false;
					g.admmodifsousrubrique=true;
				});
			},
			btnadmmodifsousrubriqueconfirm:function(evt){
				if (g.srform.SRubLibelle != "") {
					axios.post("http://127.0.0.1/Travaux/sites/MVC_Village_Green/index.php/VillageGreen/sous_rubrique_mod", g.srform)
					.then(function(reponse) {
						g.admmodifsousrubrique=false;
						g.btnadmrubrique(0);
						alert("Sous-rubrique modifiée !");
						g.srform = { SRubLibelle: "", RubID: 0};
					});
				}
				else alert("Libellé manquant ou incorrect");

			},
			btnadmmodifsousrubriquecancel:function(evt){
				g.admrubrique=true;
				g.srform = { SRubLibelle: "", RubID: 0};
				g.admmodifsousrubrique=false;
			},

		// Del sous-rubrique
			btnadmdeletesousrubrique:function(srid){
				axios.get("http://127.0.0.1/Travaux/sites/MVC_Village_Green/index.php/VillageGreen/srproduit/" + srid)
				.then(function(reponse) {
					if (reponse.data != 0)  alert("Impossible : cette sous-rubrique contient des produits !");
					else {
						if (confirm("Êtes-vous sûr.e ?") == true) {
							axios.get("http://127.0.0.1/Travaux/sites/MVC_Village_Green/index.php/VillageGreen/sous_rubrique_del/" + srid)
							.then(function(reponse) {
								g.btnadmrubrique(0);
							});
						}
					}
				});
			},

	// Produits

		// Liste produits

			btnadmproduit: function(rlib,srid,srlib){
				//g.pform.ProCode = pid;
				//g.srform.SRubID = srid;
				if (srid != 0) {
					g.titrelistepro = rlib + " : " + srlib;
					axios.get("http://127.0.0.1/Travaux/sites/MVC_Village_Green/index.php/VillageGreen/srproduit/" + srid)
					.then(function(reponse) {
						g.prolist = reponse.data;
						g.admproduit=true;
						g.admrubrique=false;
						g.admaccueil=false;
						//g.admclient=false;
						//g.admnewclient=false;
					});
				}
				else {
					g.titrelistepro = "Tous les produits";
					axios.get("http://127.0.0.1/Travaux/sites/MVC_Village_Green/index.php/VillageGreen/produit/null")
					.then(function(reponse) {
						g.prolist = reponse.data;
						g.admproduit=true;
						g.admrubrique=false;
						//g.admclient=false;
						g.admaccueil=false;
					});
				}
				axios.get("http://127.0.0.1/Travaux/sites/MVC_Village_Green/index.php/VillageGreen/rubrique/0")
				.then(function(reponse) { g.rublist = reponse.data; });
				axios.get("http://127.0.0.1/Travaux/sites/MVC_Village_Green/index.php/VillageGreen/sous_rubrique/0")
				.then(function(reponse) { g.srublist = reponse.data; });
			},
			// Rechercher un produit
			search: function() {
					var lfp =g.lfproduit;
					var find=[];
					axios.get("http://127.0.0.1/Travaux/sites/MVC_Village_Green/index.php/VillageGreen/produit/null")
					.then(function(reponse) {
						g.prolist = reponse.data;
						g.prolist.forEach(function(valeur){
							if (valeur.ProLibelle.toLowerCase().indexOf(lfp.toLowerCase())!=-1)
							{
								find.push(valeur);
							}
						});
						g.prolist=find;
						if (find.length == 0)
						{
							g.lfproduit = "";
							g.btnadmproduit('null',0,'null');
							alert("404 Notte Founde");
						}
					});
			},

		// New produit
			btnadmnewproduit: function(evt) {
				g.pform = { ProCode: "", ProLibelle: "", ProDescription: "", ProPhoto: "", ProAffichage: 1, ProPrixAchat: 0, ProStockPhysique: 0, ProStockAlerte: 0, apprQuantite: 0, FouID: 0, SRubID: 0 },
				g.admproduit = false;
				g.admnewproduit = true;
				g.detrub = 0;
				axios.get("http://127.0.0.1/Travaux/sites/MVC_Village_Green/index.php/VillageGreen/fournisseur/0")
				.then(function(reponse) {
					g.foulist = reponse.data;
				});
				axios.get("http://127.0.0.1/Travaux/sites/MVC_Village_Green/index.php/VillageGreen/rubrique/0")
				.then(function(reponse) {
					g.rublist = reponse.data;
				});
				axios.get("http://127.0.0.1/Travaux/sites/MVC_Village_Green/index.php/VillageGreen/sous_rubrique/0")
				.then(function(reponse) {
					g.srublist = reponse.data;
				});
			},
			btnadmnewproduitconfirm: function(evt){
				var message = "Erreur : saisies suivantes manquantes ou incorrectes :";
				var ok = true;
				if (/^[a-zA-Z]{2}[0-9]{4}$/.test(g.pform.ProCode) == false)
					{ message += "\n- Code produit"; ok = false; }
				if (/^.{1,50}$/.test(g.pform.ProLibelle) == false)
					{ message += "\n- Libellé"; ok = false; }
				if (/^http(s)?\:\/\/[\S]+\.[\w]{2,3}(.+)?$/.test(g.pform.ProPhoto) == false)
					{ message += "\n- URL photo"; ok = false; }
				if (/^[0-9]+$/.test(g.pform.ProPrixAchat) == false)
					{ message += "\n- Prix d'achat"; ok = false; }
				if (/^[0-9]+$/.test(g.pform.ProStockPhysique) == false || g.pform.ProStockPhysique == 0)
					{ message += "\n- Stock physique"; ok = false; }
				if (/^[0-9]+$/.test(g.pform.ProStockAlerte) == false || g.pform.ProStockAlerte == 0 || parseInt(g.pform.ProStockAlerte) > parseInt(g.pform.ProStockPhysique))
					{ message += "\n- Stock d'alerte"; ok = false; }
				if (/^[0-9]+$/.test(g.pform.apprQuantite) == false || g.pform.apprQuantite == 0)
					{ message += "\n- quantité d'approvsionnement"; ok = false; }
				if (g.pform.FouID == 0)
					{ message += "\n- Fournisseur"; ok = false; }
				if (g.pform.SRubID == 0)
					{ message += "\n- Rubrique et sous rubrique"; ok = false; }

				if (ok == false) { alert(message); }
				else {
					axios.post("http://127.0.0.1/Travaux/sites/MVC_Village_Green/index.php/VillageGreen/produit_add", g.pform)
					.then(function(reponse) {
						g.admnewproduit = false;
						g.titrelistepro = "Tous les produits";
						g.btnadmproduit('null',0,0);
						alert("Produit '" + g.pform.ProLibelle + "' ajouté !");
						g.pform = { ProCode: "", ProLibelle: "", ProDescription: "", ProPhoto: "", ProAffichage: 1, ProPrixAchat: 0, ProStockPhysique: 0, ProStockAlerte: 0, apprQuantite: 0, FouID: 0, SRubID: 0 };
					});
				}
			},
			btnadmnewproduitcancel: function(evt){
				g.pform = { ProCode: "", ProLibelle: "", ProDescription: "", ProPhoto: "", ProAffichage: 1, ProPrixAchat: 0, ProStockPhysique: 0, ProStockAlerte: 0, apprQuantite: 0, FouID: 0, SRubID: 0 };
				g.admnewproduit = false;
				g.admproduit = true;
			},

		// Modif produit
			btnadmmodifproduit: function(pid){
				axios.get("http://127.0.0.1/Travaux/sites/MVC_Village_Green/index.php/VillageGreen/fournisseur/0")
				.then(function(reponse) {
					g.foulist = reponse.data;
				});
				axios.get("http://127.0.0.1/Travaux/sites/MVC_Village_Green/index.php/VillageGreen/produit/" + pid)
				.then(function(reponse) {
					g.pform = reponse.data[0];
					g.detpro = g.pform.ProCode;
					axios.get("http://127.0.0.1/Travaux/sites/MVC_Village_Green/index.php/VillageGreen/sous_rubrique/" + g.pform.SRubID)
					.then(function(reponse) {
						g.srform.SRubID = reponse.data[0].SRubID;
						g.detrub = reponse.data[0].RubID;
						g.admmodifproduit=true;
					});
				});
			},
			changerub: function(rid){
				g.detrub = rid;
				g.srform.RubID = rid;
				g.temp=0;
			},
			changesrub: function(srid){
				g.srform.SRubID = srid;
				if (srid != 0) {
					g.pform.SRubID = srid;
				}
			},
			changefou: function(fid) { g.pform.FouID = fid; },

			btnadmmodifproduitconfirm:function(evt){
				var message = "Erreur : saisies suivantes manquantes ou incorrectes :";
				var ok = true;
				if (/^[a-zA-Z]{2}[0-9]{4}$/.test(g.pform.ProCode) == false)
					{ message += "\n- Code produit"; ok = false; }
				if (/^.{1,50}$/.test(g.pform.ProLibelle) == false)
					{ message += "\n- Libellé"; ok = false; }
				if (/^http(s)?\:\/\/[\S]+\.[\w]{2,3}(.+)?$/.test(g.pform.ProPhoto) == false)
					{ message += "\n- URL photo"; ok = false; }
				if (/^[0-9]+$/.test(g.pform.ProPrixAchat) == false)
					{ message += "\n- Prix d'achat"; ok = false; }
				if (/^[0-9]+$/.test(g.pform.ProStockPhysique) == false || g.pform.ProStockPhysique == 0)
					{ message += "\n- Stock physique"; ok = false; }
				if (/^[0-9]+$/.test(g.pform.ProStockAlerte) == false || g.pform.ProStockAlerte == 0 || parseInt(g.pform.ProStockAlerte) > parseInt(g.pform.ProStockPhysique))
					{ message += "\n- Stock d'alerte"; ok = false; }
				if (/^[0-9]+$/.test(g.pform.apprQuantite) == false || g.pform.apprQuantite == 0)
					{ message += "\n- quantité d'approvsionnement"; ok = false; }
				if (g.pform.FouID == 0)
					{ message += "\n- Fournisseur"; ok = false; }
				if (g.pform.SRubID == 0)
					{ message += "\n- Rubrique et sous rubrique"; ok = false; }

				if (ok == false) { alert(message); }
				else {
					axios.post("http://127.0.0.1/Travaux/sites/MVC_Village_Green/index.php/VillageGreen/produit_mod", g.pform)
					.then(function(reponse) {
						g.admmodifproduit = false;
						alert("Produit modifié !");
						g.pform = { ProCode: "", ProLibelle: "", ProDescription: "", ProPhoto: "", ProAffichage: 1, ProPrixAchat: 0, ProStockPhysique: 0, ProStockAlerte: 0, apprQuantite: 0, FouID: 0, SRubID: 0 };
					});
				}
			},
			btnadmmodifproduitcancel:function(evt){
				g.pform = { ProCode: "", ProLibelle: "", ProDescription: "", ProPhoto: "", ProAffichage: 1, ProPrixAchat: 0, ProStockPhysique: 0, ProStockAlerte: 0, apprQuantite: 0, FouID: 0, SRubID: 0 };
				g.admmodifproduit=false;
			},

		// Del produit
			btnadmdeleteproduit:function(pid){
				// à écrire : si la rubrique contient des sous-rubriques, interdit de supprimer
				// else
				if (confirm("Êtes-vous sûr.e ?") == true) {
					axios.get("http://127.0.0.1/Travaux/sites/MVC_Village_Green/index.php/VillageGreen/produit_del/" + pid)
					.then(function(reponse) {
						g.titrelistepro = "Tous les produits";
						g.btnadmproduit('null',0,0);
						alert("Produit supprimé !");
					});
				}
			},

	// Clients

		// Liste clients
			btnadmclient:function(cid){
				g.detcli=cid;
				axios.get("http://127.0.0.1/Travaux/sites/MVC_Village_Green/index.php/VillageGreen/client/0")
				.then(function(reponse) {
					g.clilist = reponse.data;
					g.admclient=true;
					g.admrubrique=false;
					g.admproduit=false;
					g.admaccueil=false;
					g.admnewproduit=false;

				});
			},

		// Infos Clients
			btninfosclient:function(evt){
				axios.get("http://127.0.0.1/Travaux/sites/MVC_Village_Green/index.php/VillageGreen/client/1")
				.then(function(reponse) {
				g.clilist = reponse.data;
				g.admaccueil=false;
				g.infosclient=true;
				g.modifinfosclient=false;
				});
			},
			btnmodifinfosclient:function(evt){
				axios.get("http://127.0.0.1/Travaux/sites/MVC_Village_Green/index.php/VillageGreen/client/1")
				.then(function(reponse) {
				g.cform=reponse.data[0];
				g.infosclient=false;
				g.modifinfosclient=true;
				console.log(reponse.data);

				});
			},
			btnloadinfosclient:function(evt){
				var nom = /^[^0-9]{1,20}$/.test(g.cform.CliNom);
				var prenom = /^[^0-9]{1,20}$/.test(g.cform.CliPrenom);
				var adresse = /^[0-9]{1,4}[^0-9]{1,50}$/.test(g.cform.CliAdresse);
				var cp = /^[0-9]{5}$/.test(g.cform.CliCP);
				var ville = /^[a-zA-Z]{1,50}$/.test(g.cform.CliVille);
				var tel = /^[0-9]{10}$/.test(g.cform.CliTel);
				var mail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-_]+\.[a-zA-Z]{2,3}$/.test(g.cform.CliMail);
				if (nom == false) {
					alert("Nom manquant ou incorrect");
				}
				else if (prenom == false){
					alert("Prénom manquant ou incorrect");
				}
				else if (adresse == false){
					alert("Adresse manquante ou incorrecte");
				}
				else if (cp == false){
					alert("Code Postal manquant ou incorrect");
				}
				else if (ville == false){
					alert("Ville manquante ou incorrecte");
				}
				else if (tel == false){
					alert("Numéro de Téléphone manquant ou incorrect");
				}
				else if (mail == false){
					alert("E-mail manquant ou incorrect");
				}
				else
				axios.post("http://127.0.0.1/Travaux/sites/MVC_Village_Green/index.php/VillageGreen/client_mod", g.cform)
				.then(function(reponse) {
					g.modifinfosclient=false;
					g.btninfosclient(0);
					alert("Coordonnées mises à jour avec succès !");
				});
			},

		// New client
			btnadmnewclient:function(evt){
				g.cform = { CliType: 1, CliNom: "", CliPrenom: "", CliAdresse: "", CliCP: "", CliVille: "", CliMail: "", CmrID: 0 };
				g.admclient=false;
				g.admnewclient=true;
				axios.get("http://127.0.0.1/Travaux/sites/MVC_Village_Green/index.php/VillageGreen/commercial/0")
				.then(function(reponse) {
					g.cmrlist = reponse.data;
				});
			},
			btnadmnewclientconfirm:function(evt){
				var message = "Erreur : saisies suivantes manquantes ou incorrectes :";
				var ok = true;
				if (/^[^0-9]{1,20}$/.test(g.cform.CliNom) == false)
					{ message += "\n- Nom"; ok = false; }
				if (/^[^0-9]{1,20}$/.test(g.cform.CliPrenom) == false)
					{ message += "\n- Prénom"; ok = false; }
				if (/^[0-9]{1,4}[^0-9]{1,50}$/.test(g.cform.CliAdresse) == false)
					{ message += "\n- Adresse"; ok = false; }
				if (/^[0-9]{5}$/.test(g.cform.CliCP) == false)
					{ message += "\n- Code Postal"; ok = false; }
				if (/^[a-zA-Z]{1,50}$/.test(g.cform.CliVille) == false)
					{ message += "\n- Ville"; ok = false; }
				if (/^[0-9]{10}$/.test(g.cform.CliTel) == false)
					{ message += "\n- Numéro de Téléphone"; ok = false; }
				if (/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-_]+\.[a-zA-Z]{2,3}$/.test(g.cform.CliMail) == false)
					{ message += "\n- E-mail"; ok = false; }
				if (g.cform.CmrID == 0)
					{ message += "\n- Commercial"; ok = false; }

				if (ok == false) { alert(message); }
				else {
					axios.post("http://127.0.0.1/Travaux/sites/MVC_Village_Green/index.php/VillageGreen/client_add", g.cform)
					.then(function(reponse) {
						g.admnewclient = false;
						g.btnadmclient();
						alert("Client '" + g.cform.CliNom + "' ajouté !");
						g.cform = { CliType: 1, CliNom: "", CliPrenom: "", CliAdresse: "", CliCP: "", CliVille: "", CliMail: "", CmrID: 0 };
					});
				}
			},
			btnadmnewclientcancel:function(evt){
				g.admnewclient=false;
				g.admclient=true;
				g.cform = { CliType: 1, CliNom: "", CliPrenom: "", CliAdresse: "", CliCP: "", CliVille: "", CliMail: "", CmrID: 0 };
			},

		// Modif Client
			btnadmmodifclient:function(cid){
				axios.get("http://127.0.0.1/Travaux/sites/MVC_Village_Green/index.php/VillageGreen/commercial/0")
				.then(function(reponse) {
					g.cmrlist = reponse.data;
				});
				axios.get("http://127.0.0.1/Travaux/sites/MVC_Village_Green/index.php/VillageGreen/client/" + cid)
				.then(function(reponse) {
					g.cform = reponse.data[0];
					g.admmodifclient=true;
				});
			},
			btnadmmodifclientconfirm:function(evt){
				var message = "Erreur : saisies suivantes manquantes ou incorrectes :";
				var ok = true;
				if (/^[^0-9]{1,20}$/.test(g.cform.CliNom) == false)
					{ message += "\n- Nom"; ok = false; }
				if (/^[^0-9]{1,20}$/.test(g.cform.CliPrenom) == false)
					{ message += "\n- Prénom"; ok = false; }
				if (/^[0-9]{1,4}[^0-9]{1,50}$/.test(g.cform.CliAdresse) == false)
					{ message += "\n- Adresse"; ok = false; }
				if (/^[0-9]{5}$/.test(g.cform.CliCP) == false)
					{ message += "\n- Code Postal"; ok = false; }
				if (/^[a-zA-Z]{1,50}$/.test(g.cform.CliVille) == false)
					{ message += "\n- Ville"; ok = false; }
				if (/^[0-9]{10}$/.test(g.cform.CliTel) == false)
					{ message += "\n- Numéro de Téléphone"; ok = false; }
				if (/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-_]+\.[a-zA-Z]{2,3}$/.test(g.cform.CliMail) == false)
					{ message += "\n- E-mail"; ok = false; }
				if (g.cform.CmrID == 0)
					{ message += "\n- Commercial"; ok = false; }

				if (ok == false) { alert(message); }
				else {
					axios.post("http://127.0.0.1/Travaux/sites/MVC_Village_Green/index.php/VillageGreen/client_mod", g.cform)
					.then(function(reponse) {
						g.admmodifclient = false;
						alert("Client modifié !");
						g.cform = { CliType: 1, CliNom: "", CliPrenom: "", CliAdresse: "", CliCP: "", CliVille: "", CliMail: "", CmrID: 0 };
						g.btnadmclient();
					});
				}
			},
			btnadmmodifclientcancel:function(evt){
				g.admmodifclient=false;
				g.cform = { CliType: 1, CliNom: "", CliPrenom: "", CliAdresse: "", CliCP: "", CliVille: "", CliMail: "", CmrID: 0 };
			},
			changecmr:function(crid){ g.cform.CmrID = crid; },

		// Del Client
			btndeleteclient:function(cid){
				// à écrire : si la rubrique contient des sous-rubriques, interdit de supprimer
				// else
				if (confirm("Êtes-vous sûr.e ?") == true) {
					axios.get("http://127.0.0.1/Travaux/sites/MVC_Village_Green/index.php/VillageGreen/client_del/" + cid)
					.then(function(reponse) {
						g.btnadmclient(0);
						alert("Client supprimé !");
					});
				}
			},

	// Newsletter footer
			btnnewsletter:function(evt) {
				if (/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-_]+\.[a-zA-Z]{2,3}$/.test(g.mailnewsletter) == false) alert("E-mail manquant ou incorrect");
				else alert("Vous avez été inscrit.e à notre newsletter. Merci !");
			},


		},
});
