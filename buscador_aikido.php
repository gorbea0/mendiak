<!-- buscador_aikido.htm -->

<?php include("header.php"); ?>
 <style>
 
.boton:hover{color:red;}
  
 </style>
 
<div dir="ltr" style="text-align: left;" trbidi="on">
<!-- Autor Oscar Unzueta Salazar   Dojo Gazalbide Vitoria-Gasteiz 2020 -->
 
<body onload="inicio()" onoffline="ofline()">
<h4> Buscador de tecnicas de Aikido por técnica o por ataque </h4>
<section>
<form>
	<select id="ataque_seleccionado" onchange="capturarataque()">
	<option disabled="" hidden="" selected="" value="">Selecciona el ataque deseado</option>
	<optgroup label="agarres">
	<option>Aihanmikatatedori</option>
	<option>Gyakuhanmikatatedori</option>
	<option>Ryotedori</option>
	<option>Ryotemochi</option>
	</optgroup>
	<optgroup label="agarres por detrás">
	<option>Ushiroryotedori</option>
	<option>Ushiro ryokatadori</option>
	<option>Ushirokubishime</option>
	<option>Ushiroeridorimenuchi</option>
	</optgroup>
	<optgroup label="golpes">
	<option>Shomenuchi</option>
	<option>Shomenuchi_Gyaku</option>
	<option>Yokomenuchi</option>
	<option>Jodantsuki</option>
	<option>Katadorimenuchi</option>
	</optgroup>
	</select>
	<select id="tecnica_seleccionada" onchange="capturartecnica()">
	<option disabled="" hidden="" selected="" value="">Selecciona la técnica deseada</option>
	<optgroup label="control _ katame waza">
	<option>IKKYO</option>
	</optgroup>
	<optgroup label="proyección _ nage waza">
	<option>AIKINAGE</option>
	<option>SHIHONAGE</option>
	<option>UDEKIMENAGE</option>
	<option>USHIROKIRIOTOSHI</option>
	<option>KOTEGAESHI</option>
	</optgroup>
	</select>
</form>
</section>

<div id="infoataque"></div>  <!-- aqui se podría poner información adicional -->
<em>listado de tecnicas disponibles:</em>
<ul id="listado"></ul>  <!-- estas son todas las técnicas o ataques disponibles según lo seleccionado -->
<embed frameborder="0" height="1500" id="iframe" scrolling="yes" src="https://aikidotecnicas.blogspot.com/search?q=convenciones" type="text/html" width="100%"></embed>

</div>



<?php include('footer.php'); ?>

<script>

/**
$(document).ready(function(){
  $('#listado').click(function(){
    alert($(this).attr('id'));
  })
})

**/

$(document).ready(function(){
      $('body #listado').on('click', 'input', function(){   //cuando se clicke en un elemento del listado se llama a la función cargar
      cargar($(this).attr('id'));                           // el id corresponde al listado
      });
    });

//var tecnicas_all=["AIKINAGE","SHIHONAGE","UDEKIMENAGE","IKKYO","NYKKIO","SANKYO","YONKYO","GOKYO","HIJIKIMEOSAE","UDEGARAMI","USHIROKIRIOTOSHI","TENCHINAGE","KOTEGAESHI","IRIMINAGE","KOKYUNAGE","KOKYUHO","KOSHINAGE","JUJIGARAMI","SUMIOTOSHI","UCHIKAITENNAGE","SOTOKAITENNAGE"];
//var ataques_all= ["Aihanmikatatedori","Gyakuhanmikatatedori","Shomenuchi","Yokomenuchi","Ryotedori","Ryotemochi","Katadori","Ryokatadori","Katadorimenuchi","Jodantsuki","Chudantsuki","Gedantsuki","Shomenuchi_Gyaku","Ushirokubishime","Ushiroryotedori","Ushiroryokatadori","Ushiroeridorimenuchi"];
var numtec;  // puntero para almacenar el numero de la técnica
var numataq;  // idem para el ataque

var tec = new Array(21);
tec[0]=["Shomenuchi_Gyaku"]; // IKKYO
tec[1]=[];//nikio
tec[2]=[];//sankyo
tec[3]=[];//yonkyo
tec[4]=[];//gokyo
tec[5]=[]; //hijikimeosae
tec[6]=[];//udegarami
tec[7]=["Aihanmikatatedori","Gyakuhanmikatatedori","Shomenuchi","Yokomenuchi","Ryotedori","Ryotemochi","Jodantsuki","Ushiroeridorimenuchi","Ushiroryotedori","Ushiroryokatadori","Ushirokubishime","Katadorimenuchi"]; //Shihonage
tec[8]=["Ushiroryokatadori","Ushirokubishime","Katadorimenuchi","Ryotemochi"]; // Udekiminage
tec[9]=[];//jujigarami
tec[10]=["Aihanmikatatedori","Gyakuhanmikatatedori"];//kotegaeshi
tec[11]=[];//iriminage
tec[12]=[];//sumiotoshi
tec[13]=["Gyakuhanmikatatedori","Ryotedori","Gedantsuki"];//ushirokiriotoshi
tec[14]=[];//Uchikaiten
tec[15]=[];//sotokaiten
tec[16]=[];//tenchinage
tec[17]=[];//kokyunage
tec[18]=[];//kokyuho
tec[19]=["Shomenuchi","Yokomenuchi"]; // Aikinage
tec[20]=[];//koshinage

var ataq = new Array (20);
ataq[0]=["KOTEGAESHI","SHIHONAGE"];//aihanmikatatedori
ataq[1]=["KOTEGAESHI","SHIHONAGE","USHIROKIRIOTOSHI"];//gyakuhanmikatatedori
ataq[2]=["KOTEGAESHI","SHIHONAGE","USHIROKIRIOTOSHI"];//ryotedori
ataq[3]=["SHIHONAGE","UDEKIMENAGE"];//ryotemochi
ataq[4]=[];//katadori
ataq[5]=[];//ryokatadori
ataq[6]=[];//munadori
ataq[7]=[];//sodedori
ataq[8]=["SHIHONAGE"];//ushiroryotedori
ataq[9]=["SHIHONAGE","UDEKIMENAGE"];//ushiroryokatadori
ataq[10]=["UDEKIMENAGE","SHIHONAGE"];//ushirokubishime
ataq[11]=["SHIHONAGE"];//ushiroeridorimenuchi
ataq[12]=["AIKINAGE","SHIHONAGE"]; //Shomenuchi
ataq[13]=["IKKYO"]; //Shomenuchi_Gyaku
ataq[14]=["AIKINAGE","SHIHONAGE"]; //yokomen
ataq[15]=["SHIHONAGE"];//jodantsuki
ataq[16]=[];//chudantsuki
ataq[17]=["USHIROKIRIOTOSHI"];//gedantsuki
ataq[18]=["UDEKIMENAGE"];//katadorimenuchi
ataq[19]=[];//Munadorimenuchi


function inicio(){
}
function ofline(){
window.alert ("Esta aplicación requiere una conexión de Internet");
}

var url_base= "https://aikidotecnicas.blogspot.com/search/label/";
var listado=document.getElementById("listado");
var textoataque;
var textotecnica;
var flagataque=false;     // saber si es un ataque
var flagtecnica= false;   // saber si es una técnica



function cargar(e){  //carga la página con la consulta del usuario e es el item del boton pulsado por usuario

var seleccion_usuario= document.getElementById("tecnica_seleccionada").value;   
if (flagataque) seleccion_usuario= document.getElementById("ataque_seleccionado").value; 
var url=url_base+e+"+"+seleccion_usuario;       //en x creamos la URL

  $('#iframe').attr('src', url);  
  $('#iframe').reload();
}



function listaataques(numtec){   // recibe el numero de la técnica 1 ikyo 2 nikyo etc

$("#listado").html("<input id='" +tec[numtec][0]+ "' type='button' class='boton' value='" +tec[numtec][0]+ "' >");

for (i=1;i<tec[numtec].length;i++){

$("#listado").append("<input id='" +tec[numtec][i]+ "' type='button' class='boton' value='" +tec[numtec][i]+ "' >");

}
}


function listatecnicas(numataq){

$("#listado").html("<input id='" +ataq[numataq][0]+ "' type='button' class='boton' value='" +ataq[numataq][0]+ "' >");

for (i=1;i<ataq[numataq].length;i++){

$("#listado").append("<input id='" +ataq[numataq][i]+ "' type='button' class='boton' value='" +ataq[numataq][i]+ "' >");
}
}

//función principal llama a las funciones listatecnicas o listaataques según corresponda
function capturartecnica(){
flagtecnica=true;
flagataque=false;
textotecnica="";
var tecnica=document.getElementById("tecnica_seleccionada").value;


if (tecnica=="IKKYO") { 
numtec=0;
listaataques(numtec);
textotecnica="IKKYO, IKYO O UDE OSAE. Primer principio del Aikido, control simple del brazo sin luxaciones.";
}

if (tecnica=="SHIHONAGE") { 
numtec=7;
listaataques(numtec);
textotecnica="SHIHO NAGE:  Proyección en las 4 direcciones, cortando como con un bokken.";
}

if (tecnica=="UDEKIMENAGE") { 
numtec=8;
listaataques(numtec);
textotecnica="UDEKIMI NAGE o Udekime nage:  Proyección luxando el codo.";
}

if (tecnica=="AIKINAGE") { 
numtec=19;
listaataques(numtec);
textotecnica="AIKI NAGE:  Proyección sin tocar.";
}

if (tecnica=="KOTEGAESHI") { 
numtec=10;
listaataques(numtec);
textotecnica="KOTE GAESHI: Luxación de muñeca hacia el exterior.";
}

if (tecnica=="USHIROKIRIOTOSHI") { 
numtec=13;
listaataques(numtec);
textotecnica="USHIRO-KIRI-OTOSHI: Proyección cortando desde atrás.";
}

document.getElementById("infoataque").innerHTML=textotecnica;
}



function capturarataque(){
flagataque=true;
flagtecnica=false;
textoataque="";
var ataque=document.getElementById("ataque_seleccionado").value;

if (ataque=="Aihanmikatatedori") { 
numataq=0;
listatecnicas(numataq);
textoataque="Aihanmikatate dori: Agarre de la muñeca adelantada de uke (dcha con izda o vicebersa). Se ejecuta en ai hanmi, de ahí su nombre.";
}

if (ataque=="Gyakuhanmikatatedori") { 
numataq=1;
listatecnicas(numataq);
textoataque="Gyakuhanmi katate dori: Agarre de la muñeca adelantada de uke en relación especular (izda con izda o vcbsa). Se ejecuta siempre en gyakuhanmi.";
}

if (ataque=="Ryotedori") { 
numataq=2;
listatecnicas(numataq);
textoataque="RYOTE DORI o KATATE RYOTE DORI: Agarre de ambas muñecas de uke. Se ejecuta siempre en aihanmi";
}

if (ataque=="Ryotemochi") { 
numataq=3;
listatecnicas(numataq);
textoataque="RYOTEMOCHI o RYO KATATE DORI o MOROTE DORI: Agarre de la muñeca adelantada de uke con tus dos manos. Se ejecuta siempre en gyakuhanmi.";
}

if (ataque=="Katadori") { 
numataq=4;
listatecnicas(numataq);
textoataque="KATA DORI: Agarre del hombro adelantado de uke con una mano Se realiza en aihanmi.";
}

if (ataque=="Ryokatadori") { 
numataq=5;
listatecnicas(numataq);
textoataque=". Se realiza en aihanmi.";
}

if (ataque=="Munadori") { 
numataq=6;
listatecnicas(numataq);
textoataque="..";
}

if (ataque=="Sodedori") { 
numataq=7;
listatecnicas(numataq);
textoataque="..";
}

if (ataque=="Ushiroryotedori") { 
numataq=8;
listatecnicas(numataq);
textoataque="Ushiro ryote dori: Agarre por detrás de ambas muñecas";
}

if (ataque=="Ushiro ryokatadori") { 
numataq=9;
listatecnicas(numataq);
textoataque="USHIRO RYO KATA DORI: Agarre por detrás de ambos hombros";
}

if (ataque=="Ushirokubishime") { 
numataq=10;
listatecnicas(numataq);
textoataque="Ushiro Kubi Shime: Ataque por detrás agarrando una muñeca y a la vez estrangulación por agarre de solapa.";
}

if (ataque=="Ushiroeridorimenuchi") { 
numataq=11;
listatecnicas(numataq);
textoataque="Ushiro eridori menuchi: Agarre del cuello (chaqueta) por detrás con una mano mientras con la otra se hace shomenchi por detrás.";
}

if (ataque=="Shomenuchi") { 
numataq=12;
listatecnicas(numataq);
textoataque="SHOMEN UCHI: Corte central a la cabeza de arriba a abajo con el canto de la mano. Se ejecuta en aihanmi normalmente";
}
if (ataque=="Shomenuchi_Gyaku") { 
numataq=13;
listatecnicas(numataq);
textoataque="SHOMEN UCHI EN GYAKU: Corte con el canto cubital de la mano a la cabeza de uke realizado en posición gyaku hanmi.";
}

if (ataque=="Yokomenuchi") { 
numataq=14;
listatecnicas(numataq);
textoataque="YOKOMEN UCHI: Corte lateral a la cabeza con el canto de la mano. Se ejecuta siempre en gyakuhanmi";
}

if (ataque=="Jodantsuki") { 
numataq=15;
listatecnicas(numataq);
textoataque="JODAN TSUKI: Puñetazo a la cara. Se puede ejecutar tanto en aihanmi como en gyakuhanmi. En Aikido no se usa gyaku tsuki ni hikite";
}

if (ataque=="Chudantsuki") { 
numataq=16;
listatecnicas(numataq);
textoataque="CHUDAN TSUKI: Puñetazo al pecho. No se usa gyaku-tsuki ni hi-kite. Puede ejecutarse tanto en aihanmi como gyakuhanmi.";
}

if (ataque=="Gedantsuki") { 
numataq=17;
listatecnicas(numataq);
textoataque="GEDAN TSUKI: Puñetazo al abdomen. No se usa gyaku-tsuki ni hikite. Puede ser en aihanmi o en gyakuhanmi";
}

if (ataque=="Katadorimenuchi") { 
numataq=18;
listatecnicas(numataq);
textoataque="KATA DORI MENUCHI: Agarre del hombro adelantado de uke con una mano mientras con la otra se ejecuta shomenuchi (corte con borde la mano a la cabeza). Se realiza en aihanmi.";
}

if (ataque=="Munadorimenuchi") { 
numataq=19;
listatecnicas(numataq);
textoataque="MUNA DORI MENUCHI:. Se realiza en aihanmi.";
}


document.getElementById("infoataque").innerHTML=textoataque;  

} 

</script>




