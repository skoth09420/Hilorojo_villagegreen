
/*------------------------------------------------------------
*        Script SQLSERVER 
------------------------------------------------------------*/

USE master
go

DROP DATABASE hilorojo
go

CREATE DATABASE hilorojo
go

USE hilorojo
go


/*------------------------------------------------------------
-- Table: Fournisseur
------------------------------------------------------------*/
CREATE TABLE Fournisseur(
	FouID      INT IDENTITY (1,1) NOT NULL ,
	FouNom     VARCHAR (50) NOT NULL ,
	FouAdresse VARCHAR (100)  ,
	FouCP      CHAR (5)   ,
	FouVille   VARCHAR (50) NOT NULL ,
	FouTel     VARCHAR (10) NOT NULL ,
	FouMail    VARCHAR (50) NOT NULL ,
	FouType    bit  NOT NULL ,
	CONSTRAINT prk_constraint_Fournisseur PRIMARY KEY NONCLUSTERED (FouID)
);


/*------------------------------------------------------------
-- Table: Produit
------------------------------------------------------------*/
CREATE TABLE Produit(
	ProCode          CHAR (6)  NOT NULL ,
	ProLibelle       VARCHAR (100) NOT NULL ,
	ProDescription   VARCHAR (250)  ,
	ProPhoto         VARCHAR (250)  ,
	ProAffichage     bit  NOT NULL ,
	ProPrixAchat     INT  NOT NULL ,
	ProStockPhysique INT  NOT NULL ,
	ProStockAlerte   INT   ,
	apprQuantite     INT  NOT NULL ,
	FouID            INT  NOT NULL ,
	SRubID           INT  NOT NULL ,
	CONSTRAINT prk_constraint_Produit PRIMARY KEY NONCLUSTERED (ProCode)
);


/*------------------------------------------------------------
-- Table: Client
------------------------------------------------------------*/
CREATE TABLE Client(
	CliID      INT IDENTITY (1,1) NOT NULL ,
	CliType    bit  NOT NULL ,
	CliNom     VARCHAR (50) NOT NULL ,
	CliPrenom  VARCHAR (50) NOT NULL ,
	CliAdresse VARCHAR (100)  ,
	CliCP      CHAR (5)  NOT NULL ,
	CliVille   VARCHAR (50) NOT NULL ,
	CliTel     VARCHAR (10)  ,
	CliMail    VARCHAR (50)  ,
	CmrID      INT   ,
	CONSTRAINT prk_constraint_Client PRIMARY KEY NONCLUSTERED (CliID)
);


/*------------------------------------------------------------
-- Table: Commercial
------------------------------------------------------------*/
CREATE TABLE Commercial(
	CmrID         INT IDENTITY (1,1) NOT NULL ,
	CmrNom        VARCHAR (50)  ,
	CmrPrenom     VARCHAR (50)  ,
	CmrMail       VARCHAR (50) NOT NULL ,
	CmrTypeClient bit  NOT NULL ,
	CONSTRAINT prk_constraint_Commercial PRIMARY KEY NONCLUSTERED (CmrID)
);


/*------------------------------------------------------------
-- Table: Commande
------------------------------------------------------------*/
CREATE TABLE Commande(
	ComID               INT IDENTITY (1,1) NOT NULL ,
	ComDateCommande     DATE NOT NULL ,
	ComDureePreparation INT  NOT NULL ,
	ComDateLivraison    DATE NOT NULL ,
	ComDateFacturation  DATE ,
	ComAdresseLivraison VARCHAR (100)  ,
	ComCPLivraison      CHAR (5)   ,
	ComVilleLivraison   VARCHAR (50)  ,
	ComEtatCommande     VARCHAR (25) NOT NULL ,
	ComEtatReglement    VARCHAR (25) NOT NULL ,
	ComEdiFacture       bit  NOT NULL ,
	ComReduc            FLOAT   ,
	ComTotal            FLOAT  NOT NULL ,
	passAdresseFac      VARCHAR (100) NOT NULL ,
	passCPFac           CHAR (5)  NOT NULL ,
	passVilleFac        VARCHAR (50) NOT NULL ,
	passAliasLiv        VARCHAR (50) NOT NULL ,
	CliID               INT  NOT NULL ,
	CONSTRAINT prk_constraint_Commande PRIMARY KEY NONCLUSTERED (ComID)
);


/*------------------------------------------------------------
-- Table: Livraison
------------------------------------------------------------*/
CREATE TABLE Livraison(
	LivID         INT IDENTITY (1,1) NOT NULL ,
	LivDate       DATETIME NOT NULL ,
	LivEditionBon bit  NOT NULL ,
	ComID         INT  NOT NULL ,
	CONSTRAINT prk_constraint_Livraison PRIMARY KEY NONCLUSTERED (LivID)
);


/*------------------------------------------------------------
-- Table: Rubriques
------------------------------------------------------------*/
CREATE TABLE Rubriques(
	RubID      INT IDENTITY (1,1) NOT NULL ,
	RubLibelle VARCHAR (50) NOT NULL ,
	CONSTRAINT prk_constraint_Rubriques PRIMARY KEY NONCLUSTERED (RubID)
);


/*------------------------------------------------------------
-- Table: Sous-rubriques
------------------------------------------------------------*/
CREATE TABLE Sous_rubriques(
	SRubID      INT IDENTITY (1,1) NOT NULL ,
	SRubLibelle VARCHAR (50) NOT NULL ,
	RubID       INT  NOT NULL ,
	CONSTRAINT prk_constraint_Sous_rubriques PRIMARY KEY NONCLUSTERED (SRubID)
);


/*------------------------------------------------------------
-- Table: compose
------------------------------------------------------------*/
CREATE TABLE compose(
	compQuantiteProduit INT  NOT NULL ,
	compPrixVentePar    FLOAT  NOT NULL ,
	compPrixVentePro    FLOAT  NOT NULL ,
	ProCode             CHAR (6)  NOT NULL ,
	ComID               INT  NOT NULL ,
	CONSTRAINT prk_constraint_compose PRIMARY KEY NONCLUSTERED (ProCode,ComID)
);


/*------------------------------------------------------------
-- Table: livre
------------------------------------------------------------*/
CREATE TABLE livre(
	livrQuantite INT  NOT NULL ,
	LivID        INT  NOT NULL ,
	ProCode      CHAR (6)  NOT NULL ,
	CONSTRAINT prk_constraint_livre PRIMARY KEY NONCLUSTERED (LivID,ProCode)
);



ALTER TABLE Produit ADD CONSTRAINT FK_Produit_FouID FOREIGN KEY (FouID) REFERENCES Fournisseur(FouID);
ALTER TABLE Produit ADD CONSTRAINT FK_Produit_SRubID FOREIGN KEY (SRubID) REFERENCES Sous_rubriques(SRubID);
ALTER TABLE Client ADD CONSTRAINT FK_Client_CmrID FOREIGN KEY (CmrID) REFERENCES Commercial(CmrID);
ALTER TABLE Commande ADD CONSTRAINT FK_Commande_CliID FOREIGN KEY (CliID) REFERENCES Client(CliID);
ALTER TABLE Livraison ADD CONSTRAINT FK_Livraison_ComID FOREIGN KEY (ComID) REFERENCES Commande(ComID);
ALTER TABLE Sous_rubriques ADD CONSTRAINT FK_Sous_rubriques_RubID FOREIGN KEY (RubID) REFERENCES Rubriques(RubID);
ALTER TABLE compose ADD CONSTRAINT FK_compose_ProCode FOREIGN KEY (ProCode) REFERENCES Produit(ProCode);
ALTER TABLE compose ADD CONSTRAINT FK_compose_ComID FOREIGN KEY (ComID) REFERENCES Commande(ComID);
ALTER TABLE livre ADD CONSTRAINT FK_livre_LivID FOREIGN KEY (LivID) REFERENCES Livraison(LivID);
ALTER TABLE livre ADD CONSTRAINT FK_livre_ProCode FOREIGN KEY (ProCode) REFERENCES Produit(ProCode);
GO

CREATE PROCEDURE CommandeNonSoldee
	@cnsEC	varchar(25)
AS
select ComID from Commande
Where  ComEtatCommande = @cnsEC ;
GO

CREATE PROCEDURE MoyDureePreparation
AS
select AVG(DATEDIFF(day, ComDateCommande, ComDateFacturation)) AS 'Temps' from Commande
WHERE ComDateFacturation is not null;
GO

create view Pronisseur
as
select ProCode, ProLibelle, ProDescription, ProPhoto, ProAffichage, ProPrixAchat, ProStockPhysique, ProStockAlerte, apprQuantite, SRubID, Fournisseur.FouID as 'ID Fournisseur', FouNom, FouAdresse, FouCP, FouVille, FouTel, FouMail, FouType from Produit
left join Fournisseur
on Produit.FouID = Fournisseur.FouID
GO




/* --- ALIMENTATION --- */

/*USE hilorojo
GO*/

INSERT INTO Commercial (CmrNom,CmrPrenom,CmrMail,CmrTypeClient)
VALUES		('Diot','Kelly','KellyDiot@adresse.fr','False'),
			('Cover','Harry','HarryCover@adresse.fr','True'),
			('Razé','Moussa','MoussaRazé@adresse.fr','True'),
			('Scott','Debby','DebbyScott@adresse.fr','True')
GO

INSERT INTO CLIENT (CliType,CliNom,CliPrenom,CliAdresse,CliCP,CliVille,CliTel,CliMail, CmrID)
 VALUES		('True','Doeuf','John','3 rue Alapoele','80000','Amiens','0987654321','JohnDoeuf@adresse.fr',2),
			('True','Fumé','Simon','12 rue DeLaRivière','80000','Amiens','0987654321','SimonFumé@adresse.fr',3),
			('True','PenneFlamme','Katy','7 rue DeNotreGalaxie','80000','Amiens','0987654321','PenneFlammeKaty@adresse.fr',2),
			('True','Honette','Camille','3 rue DeLaFourgonette','80000','Amiens','0987654321','HonetteCamille@adresse.fr',4),
			('False','Fonfek','Sophie','15 rue DuCochon','80000','Amiens','0987654321','SpohieFonfek@adresse.fr',1),
			('True','Bridou','Justin','12 rue DuCochon','80000','Amiens','0987654321','BridouJustin@adresse.fr',4),
			('True','Rigole','Jean','2 rue Delamalchance','80000','Amiens','0987654321','jeanRigole@adresse.fr',3),
			('True','Gratte','Sam','20 rue DeLaLoose','80000','Amiens','0987654321','GratteSam@adresse.fr',2),
			('False','Carena','Emma','21 rue DeLaDanse','80000','Amiens','0987654321','EmmaCarena@adresse.fr',1),
			('True','Lairbonca','Oussama','1 rue DeLapétit','80000','Amiens','0987654321','Oussama@adresse.fr',3)
GO

INSERT INTO Fournisseur (FouNom,FouAdresse,FouCP,FouVille,FouTel,FouMail,FouType)
VALUES		('Paschere','23 rue Lavente','80000','Amiens','0950505050','Paschere@adresse.fr','True'),
			('BonProduit','24 rue LeProduit','80000','Amiens','0951515151','BonProduit@adresse.fr','True'),
			('LaQualité','4 rue LaQualité','80000','Amiens','0952525252','LaQualité@adresse.fr','False')
GO

INSERT INTO Rubriques (RubLibelle)
VALUES		('Guitare'),('Batteries'),('Clavier'),('Studio'),('Sono'),('Eclairage')
GO

INSERT INTO Sous_rubriques (RubID,SRubLibelle)
VALUES		(1,'Electrique'),(1,'Classiques'),(1,'Accoustique et electro-Acoustiques'),(1,'Basses Electriques'),
			(2,'Electrique'),(2,'Accoustique'),(2,'Grosse caisse'),(2,'Caisses claires'),
			(3,'Synthétiseur'),(3,'Orgues'),(3,'Orgues electronique'),(3,'Claviers maitres'),
			(4,'Interface audio'),(4,'Monitoring'),(4,'Microphone'),(4,'Logiciel'),
			(5,'Set Sono complet'),(5,'Enceintes'),(5,'Table de mixage'),(5,'Amplificaeur'),
			(6,'Set d éclairage'),(6,'Projecteurs'),(6,'Projecteurs robotisés'),(6,'Technoled')
GO

INSERT INTO Produit (ProCode,ProLibelle,ProDescription,ProPhoto,ProAffichage,ProPrixAchat,ProStockPhysique,ProStockAlerte,apprQuantite,FouID,SRubID)
VALUES		
					 /*Rubrique Guitare*/
			/*Sous Rubriques 1 : Guitares Electriques*/
			('GU1231','Line6 Variax Shuriken','Splendide guitare de style métal ! Modèle baritone 6 cordes signé par Steve "Stevic" MacKay','https://www.thomann.de/pics/prod/407457.jpg','true',1000,12,4,8,1,1),
			('GU1232','Fender Jimi hendrix Strat OWH','Guitare éléctronique Jimi Hendrix Blanche','https://www.thomann.de/pics/prod/372488.jpg','true',650,14,5,9,2,1),	
			('GU1233','Fender Strandard Strat MN BK','Guitare éléctronique Standard che et Noir','https://www.thomann.de/pics/prod/270949.jpg','true',423,16,8,8,3,1),
			/*Sous Rubriques 2 : Guitares Classiques*/
			('GU1241','Gibson Explorer Elite 2018 AC','Guitare en Acajou','https://www.thomann.de/pics/prod/427705.jpg','true',1490,15,5,10,1,2),
			('GU1242','Yamaha C40','Guitare classique en épicéa','https://www.thomann.de/pics/prod/135317.jpg','true',94,135,26,10,2,2),
			('GU1243','Yamaha C40 BL','Guitare classique en épicéa Noir','https://www.thomann.de/pics/prod/247286.jpg','true',98,14,4,10,3,2),
			/*Sous Rubriques 3 : Guitares Accoustique et éléctro-acoustique*/
			('GU1251','Harley Benton D-120CE VS','Guitare électro-acoustique Dreadnought','https://www.thomann.de/pics/prod/416053.jpg','true',60,41,20,21,1,3),
			('GU1252','Fender CD-60SCE-12 Nat','Guitare forme Dreadnought en épicéa éléctro-accoustique','https://www.thomann.de/pics/prod/404778.jpg','true',210,19,8,11,2,3),
			('GU1253','Harley Benton HBO-850BK','Guitare éléctro-acoustique épicéa noir ','https://www.thomann.de/pics/prod/196798.jpg','true',61,40,10,30,3,3),
			/*Sous Rubriques 4 : Basses Electriques*/
			('GU1261','Marcus Miller V7 Alder-4 AWH','Basse éléctrique Blanche 4 cordes','https://www.thomann.de/pics/prod/351742.jpg','true',364,18,8,10,1,4),
			('GU1262','Marcus Miller V7 Swamp Ash-5 WB','Basse éléctrique Blanche 5 cordes','https://www.thomann.de/pics/prod/351752.jpg','true',497,16,6,10,2,4),
			('GU1263','Harley Benton BZ-6000 NT','Basse éléctrique couleur naturel 6 cordes','https://www.thomann.de/pics/prod/339378.jpg','true',279,22,9,13,3,4),

					 /*----Rubrique Batteries----*/
			/*Sous Rubriques 5 : Batterie éléctrique*/
			('BA1271','Roland TD 50KV','Batterie éléctrique','https://www.thomann.de/pics/bdb/398252/11947286_800.jpg','true',4500,4,1,3,1,5),
			('BA1272','Millenium MPS-750 E-Drum Mesh Set','Batterie éléctronique456 sons','https://www.thomann.de/pics/bdb/372716/10769055_800.jpg','true',345,19,7,12,2,5),
			('BA1273','Roland TD-25K V-Drum Set','Batterie éléctonique 200 sons SuperNATURAL','https://www.thomann.de/pics/bdb/360200/11774535_800.jpg','true',1543,25,8,17,3,5),
			/*Sous Rubriques 6 : Batterie accoustique--*/
			('BA1281','Millenium MX222WR','Batterie accoustique','https://www.thomann.de/pics/bdb/214451/4562014_800.jpg','true',120,14,5,9,1,6),
			('BA1282','Pearl EXX725BR/C Export Jet Black','Batterie accoustique noir standard','https://www.thomann.de/pics/bdb/313175/11844135_800.jpg','true',709,12,4,8,2,6),
			('BA1283','Pearl EXX725BR/C Export Arctic Spar','Batterie accoustique blanche standard','https://www.thomann.de/pics/bdb/313179/12248787_800.jpg','true',709,12,4,8,3,6),
			/*Sous Rubriques 7 : Grosse caisse--*/
			('BA1291','Yamaha Stage Custom 18"x15" BD CR','Grosse caisse 18x15 Custom Birch','https://www.thomann.de/pics/prod/357176.jpg','true',260,25,10,15,1,7),
			('BA1292','Yamaha Stage Custom Birch 18"x15" RB','Grosse caisse 18x15','https://www.thomann.de/pics/prod/347543.jpg','true',289,25,10,15,2,7),
			('BA1293','Gretsch 18"x14" BD Catalina Club GCB','Grosse caisse 18x14 Rouge','https://www.thomann.de/pics/prod/396715.jpg','true',385,25,10,15,3,7),
			/*Sous Rubriques 8 : Caisse claires--*/
			('BA1301','DW PDP 13x7Black','Caisse claires','https://www.thomann.de/pics/bdb/420081/12363162_800.jpg','true',40,150,25,125,1,8),
			('BA1302','Millenium SD105 10"x05" Steel Side Snare','Caisse claires 10x05 Acier','https://www.thomann.de/pics/bdb/159509/6243332_800.jpg','true',45,50,15,35,2,8),
			('BA1303','Millenium 10"x5,5" Brass Side Snare','Caisse claires en laiton','https://www.thomann.de/pics/bdb/333898/8543359_800.jpg','true',70,25,10,15,3,8),

					 /*----Rubrique Claviers----*/
			/*--Sous Rubriques 9 : Synthétiseur--*/
			('PI1311','Clavier synthétiseur','Clavier Synthétiseur','www.maphoto.fr','true',95,18,5,13,1,9),
			('PI1312','Dave Smith Instruments Prophet REV2-8','Synthétiseur analogique polyphonique 8 voix','https://www.thomann.de/pics/bdb/406556/12400632_800.jpg','true',1550,8,3,5,2,9),
			('PI1313','Moog Subsequent 37 CV','Synthétiseur analogique','https://www.thomann.de/pics/bdb/414489/12599141_800.jpg','true',1500,8,3,5,3,9),			
			/*--Sous Rubriques 10 : Orgues classique--*/
			('PI1321','Viscount Unico 500 Konkav','Orgues beaucoup trop chere','https://www.thomann.de/pics/bdb/243963/11998538_800.jpg','true',32000,3,1,25,1,10),
			('PI1322','Viscount Vivace 90 Laminated','Orgue liturgique','https://www.thomann.de/pics/bdb/243642/11998413_800.jpg','true',7400,6,2,4,2,10),
			('PI1323','Viscount Unico 400 Ago','Orgue liturgique','https://www.thomann.de/pics/bdb/243957/11998603_800.jpg','true',20000,4,2,2,3,10),			
			/*--Sous Rubriques 11 : Orgues Electronique--*/
			('PI1331','Crumar Mojo Black Limited Edition','Orgues un peu plus nul mais il est cool','https://www.thomann.de/pics/bdb/425250/12774137_800.jpg','true',1000,125,15,25,1,11),
			('PI1332','Viscount Legend live','2x61 touches Waterfall','https://www.thomann.de/pics/bdb/413065/12471442_800.jpg','true',1400,100,10,90,2,11),
			('PI1333','Roland VR-09 V-Combo B','61 touches dynamiques','https://www.thomann.de/pics/bdb/422183/12592656_800.jpg','true',700,150,25,125,3,11),			
			/*--Sous Rubriques 12 : Claviers maitres--*/
			('PI1341','Native Komplete Kontrol s61 MK2','Clavier maitre de ma foi, bonne facture...','https://www.thomann.de/pics/bdb/421566/12649276_800.jpg','true',457,12,4,8,1,12),
			('PI1342','Native Instruments Komplete Kontrol S25','Clavier maitre/controleur 25 touches','https://www.thomann.de/pics/bdb/348331/9854350_800.jpg','true',250,20,8,12,2,12),
			('PI1343','Arturia Keystep','Clavier maitre 32 touches "Slim key"','https://www.thomann.de/pics/bdb/380937/11121765_800.jpg','true',90,21,8,13,3,12),

					/* ----Rubrique Studio----*/
			/*--Sous Rubriques 13 : Interface audio--*/
			('ST1351','Yamaha THR10C','Interface audio 8 modèles amplis ','https://www.thomann.de/pics/bdb/298649/12063361_800.jpg','true',157,15,7,8,1,13),
			('ST1352','MOTU 828 Mk III Hybrid','Interface audio Firewire 800 et USB 2','https://www.thomann.de/pics/bdb/258919/10226818_800.jpg','true',650,12,5,7,2,13),
			('ST1353','Steinberg UR22 MK2','Interface audio USB 2.0','https://www.thomann.de/pics/bdb/373404/11369444_800.jpg','true',95,17,7,10,3,13),
			/*--Sous Rubriques 14 : Monitoring--*/
			('ST1361','Audient iD22','Interface audio USB 2/6 canaux et contrôleur d enceinte','https://www.thomann.de/pics/bdb/313951/6893540_800.jpg','true',340,12,4,8,2,14),
			('ST1362','Drawmer MC 2.1','Contrôleur de monitoring','https://www.thomann.de/pics/bdb/319278/7200542_800.jpg','true',415,9,3,6,2,14),
			('ST1363','Heritage Audio RAM System 2000','Contrôleur de moniteur de bureau avec fonctionnalité Bluetooth','https://www.thomann.de/pics/bdb/429379/12749262_800.jpg','true',840,7,3,4,3,14),
			/*--Sous Rubriques 15 : Microphone--*/
			('ST1371','The T.bone SC 300','Suberbe micro à large membrane','https://www.thomann.de/pics/bdb/165293/9322193_800.jpg','true',15,27,14,13,1,15),
			('ST1372','Rode NT1-A Complete Vocal Recording','Ensemble micro et accessoires','https://www.thomann.de/pics/bdb/235937/11669583_800.jpg','true',130,13,5,8,2,15),
			('ST1373','Shure SM 7 B','Micro dynamique large membrane','https://www.thomann.de/pics/bdb/105768/7930429_800.jpg','true',340,14,5,9,3,15),
			/*--Sous Rubriques 16 : Logiciels--*/
			('ST1381','Fl Studio 11','Meilleur logiciel de post-prod','https://www.thomann.de/pics/bdb/332964/11343117_800.jpg','true',999,150,25,25,1,16),
			('ST1382','Steinberg Cubase Artist 9.5','Logiciel séquenceur Audio / MIDI','https://www.thomann.de/pics/bdb/403886/11887251_800.jpg','true',270,150,75,75,2,16),
			('ST1383','Steinberg Wavelab Pro 9.5','Logiciel d édition et de mastering audio','https://www.thomann.de/pics/prod/383741.jpg','true',370,150,75,75,3,16),

					/* ----Rubrique Sono----*/
			/*--Sous Rubriques 17 : Set Sono Complet--*/
			('SO1391','DB Technologies B-Hype 12 Bundle II','Set Sono','https://www.thomann.de/pics/prod/417125.jpg','true',1550,9,3,6,1,17),
			('SO1392','The box CL 110/118MKII Basis Bundle','Set Sono','https://thumbs.static-thomann.de/thumb/thumb150x150/pics/prod/350778.jpg','true',650,20,7,13,2,17),
			('SO1393','The box pro Gala Set 404/112','Set Sono','https://www.thomann.de/pics/bdb/258112/8107659_800.jpg','true',1250,8,3,5,3,17),
			/*--Sous Rubriques 18 : Enceintes--*/
			('SO1401','Soundboks The Soundboks 2','Puissante enceinte mobile','https://www.thomann.de/pics/bdb/418052/12408447_800.jpg','true',785,14,8,6,1,18),
			('SO1402','Bose S1 Pro Stand Bundle','Millenium BS + Bose S1 PRO','https://www.thomann.de/pics/prod/431261.jpg','true',520,21,8,13,2,18),
			('SO1403','Sennheiser LSP 500 Pro','Système de sonorisation sans fil','https://www.thomann.de/pics/bdb/325500/8023383_800.jpg','true',2550,6,2,4,3,18),
			/*--Sous Rubriques 19 : Table de mixage--*/
			('SO1411','Yamaha EMX 5014C','Table de mixage','https://www.thomann.de/pics/bdb/191993/10351752_800.jpg','true',450,150,25,25,1,19),
			('SO1412','Dynacord Powermate 600-3','Table de mixage 2x 1000w / 4Ohm 6 entrées','https://www.thomann.de/pics/bdb/285441/5686517_800.jpg','true',1200,50,5,45,2,19),
			('SO1413','Mackie ProDX4','2 entrées XLR/jack 4 canaux sans-fil','https://www.thomann.de/pics/bdb/379936/11280678_800.jpg','true',100,100,20,80,3,19),
			/*--Sous Rubriques 20 : Amplificateurs--*/
			('SO1421','Crown XLS 1002','circuit classe D stéréo 2 canaux','https://www.thomann.de/pics/bdb/372524/10399437_800.jpg','true',230,80,15,65,1,20),
			('SO1422','The box pro Amprack M','Rack d amplification + 1 ampli TSA 4-700','https://www.thomann.de/pics/bdb/264836/4315926_800.jpg','true',920,30,8,22,2,20),
			('SO1423','Swissonic SA 125 CD','amplificateur mélangeur 120w 4Ohm','https://www.thomann.de/pics/bdb/277391/12746742_800.jpg','true',230,80,15,65,3,20),

					/*----Rubrique Eclairage----*/
			/*--Sous Rubriques 21 : Set d'éclairage--*/
			('EC1431','Stairville Stage Tri Led','7x3w RGB','https://www.thomann.de/pics/bdb/238663/8005002_800.jpg','true',230,80,15,65,1,21),
			('EC1432','Stairville CLB2.4 Compact LED','4 projecteurs x 108 leds - RGB','https://www.thomann.de/pics/prod/349574.jpg','true',120,100,20,80,2,21),
			('EC1433','Stairville MH-x30 LED Beam Moving Bundle','Thon case 2x stairville','https://www.thomann.de/pics/prod/427918.jpg','true',890,40,8,32,3,21),
			/*--Sous Rubriques 22 : Projecteurs--*/
			('EC1441','Starville PAR 16 GU10',' black - 230V max','https://www.thomann.de/pics/bdb/108295/12836032_800.jpg','true',5,200,30,170,1,22),
			('EC1442','Fun Generation LED Pot Strobe 100','stroboscope 126x0,2w','https://www.thomann.de/pics/bdb/383840/11503179_800.jpg','true',25,150,20,130,2,22),
			('EC1443','DTS Socket GX 9.5','socle GX9,5','https://www.thomann.de/pics/bdb/152600/10132120_800.jpg','true',12,180,20,160,3,22),
			/*--Sous Rubriques 23 : Projecteurs robotisés--*/
			('EC1451','Starville MH-100','36x 3 watts','https://www.thomann.de/pics/bdb/325876/8159292_800.jpg','true',170,100,25,25,1,23),
			('EC1452','Cameo HydraBeam 4000','RGBW Quad-led 32w','https://www.thomann.de/pics/bdb/422368/12877207_800.jpg','true',520,40,8,32,2,23),
			('EC1453','ADJ Ninja 5RX','3 modes DMW 1, 10, 13 canaux','https://www.thomann.de/pics/bdb/382261/10831956_800.jpg','true',590,30,8,22,3,23),
			/*--Sous Rubriques 24 : Techno LED--*/
			('EC1461','Stairville Outdoor Stage Par','12x3w Tricolore','https://www.thomann.de/pics/bdb/256293/11580709_800.jpg','true',105,50,10,40,1,24),
			('EC1462','Stairville led Bar 240/8','Technoled','https://www.thomann.de/pics/bdb/294835/11357997_800.jpg','true',50,150,25,25,2,24),
			('EC1463','Stairville outdoor Mains extension 5m','extension de 5m pour Stairville Outdoor Stage Par','https://www.thomann.de/pics/bdb/167677/12412712_800.jpg','true',12,80,15,65,3,24)
GO
INSERT INTO Commande (ComDateCommande, ComDureePreparation, ComDateLivraison,  ComDateFacturation, ComAdresseLivraison, ComCPLivraison, ComVilleLivraison, ComEtatCommande, ComEtatReglement, ComEdiFacture, ComReduc, ComTotal, passAdresseFac, passCPFac,passVilleFac, passAliasLiv, CliID)
VALUES				
			('15/02/2017', '3', '18/02/2017', '01/03/2017','7 rue DeNotreGalaxie', '80000', 'Amiens', 'Livré', 'Réglé', 'True', '10', 37440, '7 rue DeNotreGalaxie', '80000', 'Amiens', 'Maison', 3), 
			('18/02/2017', '3', '21/02/2017', '01/03/2017','66 rue de la zik', '80000', 'Amiens', 'Livré', 'Réglé', 'True', '0', 7354 , '12 Rue DuCochon', '80000', 'Amiens', 'Studio', 6),
			('21/02/2017', '5', '26/02/2017', '26/02/2017','21 rue DeLaDanse', '80000', 'Amiens', 'Livré', 'Réglé', 'True', '15', 1779.05, '21 rue DeLaDanse', '80000', 'Amiens', 'Concervatoire', 9),
			('12/03/2017', '1', '13/03/2017', '13/03/2017','37 rue DuFestival', '80000', 'Amiens', 'Livré', 'Réglé', 'True', '0', 3730.6 , '15 rue DuCochon', '80000', 'Amiens', 'Entrepôt', 5),
			('25/03/2017', '4', '29/03/2017',null,'66 rue de la zik', '80000', 'Amiens', 'En cours', 'Non réglé', 'True', '20', 3887, '66 rue de la zik', '80000', 'Amiens', 'Studio', 6)
GO
INSERT INTO compose (ProCode, compQuantiteProduit, compPrixVentePar, compPrixVentePro, ComID)
VALUES		
			('PI1321', 1, 41600, 0, 1),
			('GU1231', 1, 1300, 0, 2),
			('ST1351', 1, 204, 0, 2),
			('BA1271', 1, 5850, 0, 2),
			('GU1261', 5, 0, 418.6, 3),
			('ST1371', 3, 0, 17.25, 4),
			('ST1352', 1, 0, 747.5, 4),
			('ST1381', 1, 0, 1148.85, 4),
			('SO1391', 1, 0, 1782.5, 4),
			('SO1403', 1, 0, 2932.5, 5),
			('EC1433', 1, 0, 1023.5, 5),
			('SO1401', 1, 0, 902.75, 5)
GO

INSERT INTO Livraison (ComID, LivDate, LivEditionBon)
VALUES
	(1, '18/02/2017', 'True'),
	(2, '21/02/2017', 'true'),
	(3, '26/02/2017', 'true'),
	(3, '27/02/2017', 'true'),
	(4, '14/03/2017', 'true'),
	(4, '17/03/2017', 'true'),
	(4, '20/03/2017', 'true'),
	(5, '30/03/2017', 'true')
GO

INSERT INTO livre (LivID, ProCode, livrQuantite)
VALUES
	(1, 'PI1321', 1),
	(2, 'GU1231', 1),
	(2, 'ST1351', 1),
	(2, 'BA1271', 1),
	(3, 'GU1261', 2),
	(4, 'GU1261', 5),
	(5, 'ST1371', 3),
	(6, 'ST1352', 1),
	(6, 'ST1381', 1),
	(6, 'SO1391', 1),
	(7, 'EC1433', 1),
	(8, 'SO1403', 1)
GO



/* --- REQUETES --- */

select * from Client ORDER BY CliID
select * from Commercial
select * from Fournisseur
select * from Rubriques
select * from Sous_rubriques 
select * from Commande
select * from compose
select * from Livraison
select * from livre

select SUM(ProPrixAchat*ProStockPhysique) as "C.A" from Produit

select FouNom, SUM(ProPrixAchat*ProStockPhysique) as "C.A" from Fournisseur
join Produit
on Fournisseur.FouID = Produit.FouID
group by FouNom

select ProCode, Sum(compQuantiteProduit) as "Qte Commandé" from Commande
join compose
on Commande.ComID = compose.ComID
group by ProCode

select Client.CliID, ComDateCommande, ComTotal  from Client
join Commande
on Commande.CliID = Client.CliID
order by CliID

select CliType, Sum(ComTotal) from Commande
join Client
on Client.CliID = Commande.CliID
group by CliType
GO

EXEC dbo.CommandeNonSoldee @cnsEC = 'En cours';
GO

EXEC dbo.MoyDureePreparation;
GO

select * from Pronisseur


