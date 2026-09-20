<?php
$cnx=mysqli_connect("localhost","root","","bacfedi.sql");
$i=$_POST["i"];
$np=$_POST["np"];
$req="select * from utilisateur where '$i'=idUtil";
$res=mysqli_query($cnx,$req);
if(mysqli_num_rows($cnx,$res)=0)
{
	echo("impossible dinserer");
	
}
else{
	$req="insert into utilisateur values('$i','$np')";
	if(mysqli_affected_rows($cnx)>0)
	{
		echo("ajout avec succes");
	}
}