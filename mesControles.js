function alpha(ch)
{
    let cp=0;
    ch=ch.toUpperCase();
	let valid=true;
    do{
        if(ch[cp]>="A" && ch[cp]<="Z" ||ch[cp]==" " )
        {
            cp=cp+1;
        }
        else
        {
            valid=false;
        }
    }
    while(valid==true && cp<ch.length);
    return valid;
}
function verif1()
{i=document.getElementById("i").value
 np=document.getElementById("np").value
 if(i[0]!="U" || isNaN(i.substring(1))==true||i.length!=4)
	 {alert("identifiant incorrect")
	  return false
	 
	 }
 else if(alpha(np)==false||np.length<5 && np.length>50)
	 {
		 alert("nom invalide")
		 return false
	 }
 else
 {return true}
	
}
function verif2()
{n=document.getElementById("n").selectedIndex
 t=document.getElementsByName("r")
 if(n==1)
	 {alert("selection obligatoire")
	  return false
	 
	 }
 else if(droit(t)==false)
	 {alert("selecion obligatoire des droits")
	  return false
	 
	 }
 else{
	 return true
	 
 }
	
	
}
function droit(x)
{ok=false
	for(i=0;i<x.length;i++)
		{if (x[i].checked=true)
			{
				ok=true
			}
		
		}
 return ok
	
}
function choix1()
{t=document.getElementsByName("r")
 if (t[0].checked=true)
	 {t[1].checked=true}
	
	
	
	
}
function choix2()
{t=document.getElementsByName("r")
 if (t[1].checked=false)
	 {t[0].checked=false
	 t[2].checked=false}
		
}
function choix3()
{t=document.getElementsByName("r")
 if (t[2].checked=true)
	 {t[1].checked=true}
	
	
	
	
}