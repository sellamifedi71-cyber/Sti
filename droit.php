<?php
$cnx=mysqli_connect("localhost","root","","bacfedi.sql");
$i=$_POST["id"];
$doc=$_POST["doc"];
$ec="N";
if(isset($_POST["r"])==true)
{$ec="O";}
$lec="N";
if(isset($_POST["r"])==true)
{$lec="O";}
$imp="N";
if(isset($_POST["r"])==true)
{$imp="O";}
$req="select * from utilisateur where '$id'=idUtil";
$res=mysqli_query($cnx,$req);
if(mysqli_num_rows($res)==0)
{echo("utilisateur inexistant");}
else{
	$req2="select * from utlisateur u,droit d.idutil='$i' and d.doc=$doc";
	$res2=mysqli_query($cnx,$req2);
	if(mysqli_num_rows($cnx,$res2)==1)
	{$req3="update droit set idUtil='$i' ,iddoc='$doc',lecture='$lecture',impression='$impression'
	where idUtil='$i' and iddoc=$doc";
	 $res3=mysqli_query($cnx,$req3);
	 if(mysql_affected_rows($cnx)>0)
	 {echo("mise a jour avec succes");}
		
	}
	
}