<?php
header('Access-Control-Allow-Origin: *');
try
{
  // initilisation de PDO
     	// On stocke la connection à MySQL dans une variable en précisant le type de table, l'hote, le mon de la bdd, le pseudo et mot de passe
  $bdd = new PDO('mysql:host=localhost;dbname=labo_lavilleverte', 'labo_lavillevert', 'L@villeVerte@32');
}

catch (Exception $e)
{
        // En cas d'erreur, on affiche un message et on arrête tout
  die('Erreur : ' . $e->getMessage());
}


if(isset($_POST['ajout_user']))
{

$nom=$_POST['nomw'];
$email=$_POST['emailw'];
$password=$_POST['passwordw'];
$tel=$_POST['telw'];

$nomresidence=$_POST['nomresidencew'];
$choixbien=$_POST['choixbienw'];
$numimmeuble=$_POST['numimmeublew'];
$numvillaappart=$_POST['numvillaappartw'];
$status="0";
$date="";
$heure="";
$x="";
$y="";




$tab = array(
':nom' => $nom,
':email' => $email,
':password' => $password,
':tel' => $tel,

':nomresidence' => $nomresidence,
':choixbien' => $choixbien,
':numimmeuble' => $numimmeuble,
':numvillaappart' => $numvillaappart,
':status' => $status,
':date' => $date,
':heure' => $heure,
':x' => $x,
':y' => $y,


);

// On ajoute une entrée dans la table jeux_video
$sql= "INSERT INTO user_villeverte VALUES(null, :nom, :email, :password, :tel, :nomresidence, :choixbien, :numimmeuble, :numvillaappart, :status, :x, :y, :date, :heure)";
$req = $bdd->prepare($sql);
$req->execute($tab);
echo trim('ok');
}


if(isset($_POST['modif_user']))
{
$iduser=$_POST['iduser'];
$nom=$_POST['nomw'];
$email=$_POST['emailw'];
$password=$_POST['passwordw'];
$tel=$_POST['telw'];
$nomresidence=$_POST['nomresidencew'];
$choixbien=$_POST['choixbienw'];
$numimmeuble=$_POST['numimmeublew'];
$numvillaappart=$_POST['numvillaappartw'];
$status="0";
$date="";
$heure="";
$x="";
$y="";




$tab = array(
':iduser' => $iduser,
':nom' => $nom,
':email' => $email,
':password' => $password,
':tel' => $tel,
':nomresidence' => $nomresidence,
':choixbien' => $choixbien,
':numimmeuble' => $numimmeuble,
':numvillaappart' => $numvillaappart,
':status' => $status,
':date' => $date,
':heure' => $heure,
':x' => $x,
':y' => $y,
);

// On ajoute une entrée dans la table jeux_video
$sql= "UPDATE `labo_lavilleverte`.`user_villeverte` SET `nom_user` = '$nom', `email_user` = '$email', `pass_user` = '$password', `tel_user` = '$tel', `nom_residence` = '$nomresidence', `appart_villa` = '$choixbien', `num_immeuble` = '$numimmeuble', `num_appart_villa` = '$numvillaappart', `status` = '$status', `x_user` = '$x', `y_user` = '$y' WHERE `user_villeverte`.`id_user` = '$iduser'";
$req = $bdd->prepare($sql);
$req->execute();
echo trim('ok');
}

else if(isset($_POST['afficheservice']))
{

	  $sql = 'SELECT * FROM service_parrent where valid_sp=1 ORDER BY id_sp ASC';
    foreach ($bdd->query($sql) as $row) {
	?>
  <div style="width:33.33%;float:left;" class="ui-grid-b">
	<a data-transition="slide" onclick="affiche1('<?php print $row['id_sp']; ?>')" href="#page2"><div class="biba"><img style="width:80px;" src="http://labseo.net/villeverte/upload/<?php print $row['photo_sp']; ?>"><br/><span style="font-weight:bold;"><?php print $row['nom_sp']; ?></span></div></a>

</div>

	<?php
	}
	
	?>
	<div style="margin:8px auto;float:left;width: 100%;">
	
						<a data-transition="slide" onclick="affiche11('35')" href="#nouveautes"><div style="background-color:#ff9f41;" class="promobadg">
	<img class="imgpromobadg" src="promotions.png">
	<div style="width:100%;">
	<div class="texd">Promotions</div></div>
	</div></a>
	
	<a data-transition="slide" onclick="affiche11('36')" href="#nouveautes">
		<div style="background-color:#a0d704;" class="promobadg">
		<div style="width:100%;">
	<img class="imgpromobadg" src="badgg.png">
	</div>
	
	<div class="texd">Nouveaux</div>
	</div></a>
</div>
	<?php
	}
	
else if(isset($_POST['affichesservice']))
{
$id=$_POST['affichesservice'];
	  $sql = "SELECT * FROM service_sparrent where id_sp2='$id' and valid_ssp=1 ORDER BY id_ssp ASC";
    foreach ($bdd->query($sql) as $row) {
	?>
  <div style="width:33.33%;float:left;" class="ui-grid-b">
 <?php   if($row['final_ssp'] !='oui') { ?> <a data-transition="slide" href="#page2"> 	<?php } ?>
 
<div onclick="addtocart('<?php print $row['id_ssp']; ?>', 'http://labseo.net/villeverte/upload/<?php print $row['photo_ssp']; ?>','<?php print $row['nom_ssp']; ?>','<?php print $row['prixfinal_ssp']; ?>')" class="biba">
<img style="width:80px;" src="http://labseo.net/villeverte/upload/<?php print $row['photo_ssp']; ?>"><br/><span style="font-size:15px;"><?php print $row['nom_ssp']; ?></span><br/><?php if ($row['final_ssp'] == 'oui') { ?><span style="color:#f86a3b;font-size:15px;font-weight:bold;"><?php print $row['prixfinal_ssp'].'DH'; ?></span><?php } ?></div>
<div style="display:none;" id="pilo<?php print $row['id_ssp']; ?>"><?php print rtrim($row['descrip_ssp']); ?></div> 
<?php  if($row['final_ssp'] !='oui') { ?></a> <?php } ?>
</div>

<?php }
} 

else if(isset($_POST['affichesservice1']))
{
$id=$_POST['affichesservice1'];
	  $sql = "SELECT * FROM service_sparrent where id_sp2='$id' and valid_ssp=1 ORDER BY id_ssp ASC";
    foreach ($bdd->query($sql) as $row) {
	?>
	
	<div class="promotionb">
 <?php   if($row['final_ssp'] !='oui') { ?> <a data-transition="slide" href="#page2"> 	<?php } ?>
<div onclick="addtocart('<?php print $row['id_ssp']; ?>', 'http://labseo.net/villeverte/upload/<?php print $row['photo_ssp']; ?>','<?php print $row['nom_ssp']; ?>','<?php print $row['prixfinal_ssp']; ?>','')" class="biba">
<div style="display:none;" id="pilo<?php print $row['id_ssp']; ?>"><?php print rtrim($row['descrip_ssp']); ?></div>
<img style="width:100%;" src="http://labseo.net/villeverte/upload/<?php print $row['photo_ssp']; ?>"></div>
 <?php  if($row['final_ssp'] !='oui') { ?></a> <?php } ?>
</div>

<?php 
}
} 
else if (isset($_POST['mescommandes']))
{
$panier=$_POST['panier'];
$sql="select * from jecommande where codemonpanier='$panier'";
 
	?>
	 <table class="tg">
  <tr>
    <th class="tg-yw4l">Les Commandes</th>
	<th class="tg-yw4l">Produit</th>
	    <th class="tg-yw4l">Livraison</th>
		<th class="tg-yw4l">Total/Dh</th>
		
		
  </tr>
  
	<?php
	   foreach ($bdd->query($sql) as $row) {
	   ?>
	   <tr>
    <td class="tg-yw4l"><?php print 'Le : '.$row['datepanier'].' '.$row['heurepanier']; ?></td>
  <td style="font-weight: bold;" class="tg-yw4l"><?php print $row['totalpanier'].' DH'; ?></td>
	<td style="color: #97cd0a;font-weight: bold;" class="tg-yw4l"><?php print $row['livraisonpanier']. ' DH'; ?></td>
	<td style="color: #e84511;font-weight: bold;" class="tg-yw4l"><?php print $row['totalpanier']+$row['livraisonpanier'].' DH'; ?></td>
  </tr>
	   <?php
	}
}

else if(isset($_POST['lepanier']))
{
$id=$_POST['lepanier'];
	  $sql = "select id_cmd, code_panier, id_clientp, id_produitp, qt_produit, etat_cmd, id_ssp, nom_ssp, prixfinal_ssp from service_sparrent, monpanier where id_produitp = id_ssp and code_panier ='panier1' and id_clientp='174' and etat_cmd='0'";
	  $sql2="SELECT sum(total_product) AS somme FROM monpanier where etat_cmd='0'";
	  

	  
  foreach ($bdd->query($sql2) as $row33)
  if ($row33['somme'] > 0)
  {
	  

	  
	  
	  ?>
	    <table class="tg">
  <tr>
    <th class="tg-yw4l">Produit</th>
    <th class="tg-yw4l">Prix/Dh</th>
    <th class="tg-yw4l">QT</th>
	    <th class="tg-yw4l">Total/Dh</th>
    <th class="tg-yw4l">Action</th>
  </tr>
	  <?php
    foreach ($bdd->query($sql) as $row) {
	?>

  <tr class="pr<?php print $row['id_cmd']; ?>">
    <td class="tg-yw4l"><?php print $row['nom_ssp']; ?></td>
    <td class="tg-yw4l"><?php print $row['prixfinal_ssp']; ?></td>
    <td class="tg-yw4l"><?php print $row['qt_produit']; ?></td>
	<td class="tg-yw4l"><?php print intval($row['qt_produit']*$row['prixfinal_ssp']); ?></td>
    <td class="tg-yw4l"><img onclick="checkalerte('<?php print $row['id_cmd']; ?>')" class="imgclose" src="remove.png"></td>
  </tr>
  
   

<?php }
 foreach ($bdd->query($sql2) as $row2) {

?>

<tr class="pr8w">
    <td style="background:#f1f1f1;" class="tg-yw4l2">Livraison</td>
    <td  style="background:#f1f1f1;" class="tg-yw4l2"></td>
    <td  style="background:#f1f1f1;" class="tg-yw4l2"></td>
	 <td  style="background:#f1f1f1;" class="tg-yw4l2"><?php print $row2['somme']*10/100; ?> DH</td>
    <td  style="background:#f1f1f1;" class="tg-yw4l2"></td>
  </tr>
  

   <tr class="pr8w">
    <td class="tg-yw4l2">Total</td>
    <td class="tg-yw4l2"></td>
    <td class="tg-yw4l2"></td>
	 <td class="tg-yw4l2"><?php print $row2['somme']+$row2['somme']*10/100; ?> DH</td>
    <td class="tg-yw4l2"></td>
  </tr>
  
 

<?php
}
?>
 
</table>
<table>
   <tr class="pr8w">

	 <td style="width:33%;" class="tg-yw4l2"></td>
    <td style="width:33%;padding:10px;"  class="tg-yw4l2"><div onclick="jecommande('<?php print $row2['somme'];?>','<?php print $row2['somme']*10/100; ?>')" class="buttonx">Commander</div></td>
	 <td style="width:33%" class="tg-yw4l2"></td>
  </tr>
</table>
<?php
}

else
{
echo "<div style='padding:20px;font-size:17px;font-weight:bold;'>Votre panier est vide pour l'instant; merci de commander des produits pour les voir sur le panier.</div>";
}
}

else if(isset($_POST['jecommande']))
{
$total=$_POST['total'];
$livraison=$_POST['livraison'];
$client=$_POST['client'];
$panier=$_POST['panier'];
$etat="0";
$date=date("Y-m-d");
$heure=date("H:i");
$sql = "INSERT INTO `labo_lavilleverte`.`jecommande` VALUES (NULL, '$panier', '$client', '$total', '$livraison', '$etat', '$date', '$heure')";
$bdd->exec($sql);
$sql2="UPDATE `labo_lavilleverte`.`monpanier` SET `etat_cmd` = '1' WHERE `monpanier`.`code_panier` = '$panier'";
$bdd->exec($sql2);
}

else if(isset($_POST['ajouteraupanier']))
{
$idproduct=$_POST['idproduct'];
$valqt=$_POST['valqt'];
$code_panier="panier1";
$id_clientp="174";
$prixfinalo=$_POST['finalo'];
$etat="0";
$total=intval($valqt*$prixfinalo);
$date=date("Y-m-d");
$heure=date("H:i");

$sql = "INSERT INTO monpanier VALUES(null, '$code_panier', '$id_clientp', '$idproduct', '$valqt', '$total', '$etat', '$date', '$heure')";
$bdd->exec($sql);



}

else if (isset($_POST['supppanier']))
{
$id=$_POST['supppanier'];
$sql = "DELETE FROM `labo_lavilleverte`.`monpanier` WHERE `monpanier`.`id_cmd` = $id";
$bdd->exec($sql);
}

else if(isset($_POST['loadpanier']))
{
$panier=$_POST['panier'];
$client=$_POST['client'];
	  $sql = "select count(id_cmd) from monpanier where code_panier ='$panier' and id_clientp='$client' and etat_cmd='0'";
	foreach ($bdd->query($sql) as $row) {
	print $row['count(id_cmd)'];
	}
	  }
	  
	  
	  else if(isset($_POST['getuserinfo']))
{
$user=$_POST['getuserinfo'];
	$sql = "SELECT * FROM `user_villeverte` where email_user = '$user' limit 1";
	   foreach ($bdd->query($sql) as $row) {
	  ?>
	  
	  
	  
			<div role="main" style="text-align:left;'Exo 2', sans-serif !important" class="ui-content">
	<div class="jelly-form" style="width:100%;margin-top:5px !important;">
	   <input onclick="biza('iduser')" value="<?php print $row['id_user']; ?>" type="hidden" id="iduser" style="border-radius:0px !important;" placeholder="">
	<label>Nom & Prénom</label>
    <input onclick="biza('nom')" value="<?php print $row['nom_user']; ?>" type="text" id="nom" style="border-radius:0px !important;" placeholder="">
</div>

<div class="jelly-form" style="width:100%">
	<label>Email</label>
    <input onclick="biza('email')" type="text" value="<?php print $row['email_user']; ?>" id="email" style="border-radius:0px !important;" placeholder="">
</div>
<div class="jelly-form" style="width:100%">
	<label>Mot de passe</label>
    <input onclick="biza('password')" type="text" value="<?php print $row['pass_user']; ?>" id="password" style="border-radius:0px !important;" placeholder="">
</div>


<div class="jelly-form" style="width:100%">
	<label>N° Telephone</label>
    <input onclick="biza('tel')" type="text" id="tel" value="<?php print $row['tel_user']; ?>" style="border-radius:0px !important;" placeholder="">
</div>


<label style="margin:40px 0px 20px 0px !important" id="choixc" class="top-label">Choisissez votre Résidence</label>
    <input type="hidden" value="" id="popo">
    <input id="how-friend" name="how" onclick="$('#popo').val('Green Town')" type="radio" <?php if ($row['nom_residence'] == "Green Town") echo "checked"; ?>>
    <label for="how-friend" style="font-weight:normal !important;" onclick="$('#popo').val('Green Town')" class="side-label2">Green Town</label>

    <input id="how-internet" onclick="$('#popo').val('Serena')" name="how" type="radio" <?php if ($row['nom_residence'] == "Serena") echo "checked"; ?>>
    <label for="how-internet" style="font-weight:normal !important;" onclick="$('#popo').val('Serena')" class="side-label2">Serena</label>

    <input id="how-other" name="how" onclick="$('#popo').val('California')" type="radio" <?php if ($row['nom_residence'] == "California") echo "checked"; ?>>
    <label for="how-other" style="font-weight:normal !important;" onclick="$('#popo').val('California')" class="side-label2">California</label>
    
	 <input id="how-other2" name="how" onclick="$('#popo').val('Prestigia')" type="radio" <?php if ($row['nom_residence'] == "Prestigia") echo "checked"; ?>>
    <label for="how-other2" style="font-weight:normal !important;" onclick="$('#popo').val('Prestigia')" class="side-label2">Prestigia</label>

   <label style="margin-top: 30px !important;margin-left: 30px !important;" class="top-label2">
   <div style="border-bottom-left-radius: 4px;border-top-left-radius: 4px;" onclick="choixbien('reda1','Appartement')" class="reda1 <?php if ($row['appart_villa'] == "Appartement") echo "bgbg"; ?>">Appartement</div>
   <div style="margin-left:-1px;border-bottom-right-radius: 4px;border-top-right-radius: 4px;" onclick="choixbien('reda2','Villa')" class="reda2 <?php if ($row['appart_villa'] == "Villa") echo "bgbg";?>">Villa</div>
   <input type="hidden" value="<?php print $row['appart_villa']; ?>" id="choixbien">
   </label>
   
  <div style="margin-top:135px;">
   <div id="numero1" class="jelly-form" style=" <?php if ($row['appart_villa'] == "Appartement") echo "display:block;"; else echo "display:none;" ?>width:100%;">
	<label>N° Immeuble</label>
    <input onclick="biza2('emailo')" value="<?php print $row['num_immeuble']; ?>" type="text" id="emailo" style="border-radius:0px !important;" placeholder="">
</div>

   <div id="numero2" class="jelly-form" style="width:100%">
	<label>N° Villa / Appartement</label>
    <input onclick="biza2('nappart')" value="<?php print $row['num_appart_villa']; ?>" type="text" id="nappart" style="border-radius:0px !important;" placeholder="">
</div>
</div>

			<div style="text-align:center;margin-top:35px;margin-bottom: 50px;padding-bottom:100px;float:left;margin-left:auto;margin-right:auto;width:100%;left:0;right:0;">
	<div onclick="modifier()" style="margin-top:20px;margin-bottom:8px;" class="swiper-button-next activeo btsuivant2 tti2">
			<i class="flaticon-success"></i> Modifier<span class="glyphicon glyphicon-menu-right"></span>
			</div>
		
		</div>
	</div>
	
	<?php
	}
	}
	?>



