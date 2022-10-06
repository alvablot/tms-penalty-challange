<!--
//////////////////////////////////////////////////////
// 													//
// 	Copyright Petter karlsson PK-Multimedia 2004	//
//													//
// 	www.pkm.nu										//
//													//
//	webmaster@tokigamasar.st						//
//													//
//////////////////////////////////////////////////////
-->
<?php
//header("Cache-Control: max-age=1, must-revalidate");

$level = $_GET['level'];
$grad = $_GET['grad'];
$spelarensNamn = $_GET['valnamn'];
$spelarensGrad = $_GET['hidden1'];
$spelarensBild = $_GET['hidden2'];
?>
<html>

<head>
	<title></title>
	<style>
		.info {
			background-color: white;
			font: 15px arial;
			color: #000000;
			border: 1px solid #cccccc;
			padding: 8px;
		}
	</style>
	<script>
		function disableselect(e) {
			return false
		}

		function reEnable() {
			return true
		}
		//if IE4+
		document.onselectstart = new Function("return false")
		//if NS6
		if (window.sidebar) {
			document.onmousedown = disableselect
			document.onclick = reEnable
		}

		function avbryt() {
			return false
		}
		document.oncontextmenu = avbryt

		var NN = (navigator.appName == "Netscape")
		var IE = (navigator.appName == "Microsoft Internet Explorer")

		function objekt(left, top, width, height, right, bottom, border, type, index) {
			this.left = left
			this.top = top
			this.width = width
			this.height = height
			this.right = right
			this.bottom = bottom
			this.border = border
			this.type = type
			this.index = index
		}

		function spelare(sense, speed, hard, image) {
			this.speed = speed
			this.hard = hard
			this.image = image
			this.sense = sense
		}
		var ospelare = new Array()
		//NORMAL
		ospelare[0] = new spelare(20, 2, 8, <?php print "'" . $spelarensBild . "'" ?>)

		//SNABB
		ospelare[1] = new spelare(10, 5, 6, <?php print "'" . $spelarensBild . "'" ?>)

		//H�RD
		ospelare[2] = new spelare(35, 1.5, 13, <?php print "'" . $spelarensBild . "'" ?>)

		vilkenSpelare = <?php print $spelarensGrad; ?>

		var bild = new Array()
		var pryl = new Array()
		var odiv = new Array()
		var stegX = new Array()
		var stegY = new Array()
		var hit = false
		var skott = false
		var startad = false
		var level = <?php print $level . ",grad =" . $grad; ?>

		var namn = <?php print "'" . $spelarensNamn . "'" ?>

		var omissar
		var ostolptraffar
		var omal
		var oomgang
		var omatch
		var onamn
		var ospeed
		var oskott
		var opoang
		var maltext
		var misstext
		var stolptext
		var raddtext
		var ormiss

		var malcheck
		var alla
		var malvaktsbild = new Array()
		malvaktsbild[0] = "liv.gif"
		malvaktsbild[1] = "bales.gif"
		malvaktsbild[2] = "lund.gif"
		malvaktsbild[3] = "bjur.gif"
		malvaktsbild[4] = "bales.gif"
		malvaktsbild[5] = "skagg.gif"
		malvaktsbild[6] = "nor.gif"
		malvaktsbild[7] = "abris.gif"
		malvaktsbild[8] = "wallen.gif"
		malvaktsbild[9] = "abris.gif"
		malvaktsbild[10] = "modo.gif"
		malvaktsbild[11] = "malmo.gif"
		malvaktsbild[12] = "kapanen.gif"
		malvaktsbild[13] = "hen.gif"
		malvaktsbild[14] = "hedberg.gif"
		malvaktsbild[15] = "bryn.gif"
		malvaktsbild[16] = "backlund.gif"
		malvaktsbild[17] = "aslin.gif"

		bild[2] = malvaktsbild[0]

		var malvaktmoment = 0
		// JU L�GRE DESSTO SNABBARE M�LVAKT
		if (level == 1) {
			if (grad == 1 && parent.frames[0].document.getElementById("alla").innerHTML == "1") {
				bild[2] = malvaktsbild[6]
				var malvaktsense = 100
				var malvaktsutgang = 270
				var malvakthastighetX = 0.3
				var malvakthastighetY = 0
				var slot = 20
			} else if (grad == 1 && parent.frames[0].document.getElementById("alla").innerHTML != "1") {
				alert("Fuskare där!")
			}
			if (grad == 2) {
				bild[2] = malvaktsbild[5]
				var malvaktsense = 70
				var malvaktsutgang = 100
				var malvakthastighetX = 0.1
				var malvakthastighetY = 0
				var slot = 30
			}
			if (grad == 3) {
				bild[2] = malvaktsbild[4]
				var malvaktsense = 30
				var malvaktsutgang = 250
				var malvakthastighetX = 0.4
				var malvakthastighetY = 0
				var slot = 75
			}
			if (grad == 4) {
				bild[2] = malvaktsbild[3]
				var malvaktsense = 15
				var malvaktsutgang = 300
				var malvakthastighetX = 0.8
				var malvakthastighetY = 0
				var slot = 20
			}
			if (grad == 5) {
				bild[2] = malvaktsbild[2]
				var malvaktsense = 2
				var malvaktsutgang = 100
				var malvakthastighetX = 0.5
				var malvakthastighetY = 0
				var slot = 80
			}
			if (grad == 6) {
				bild[2] = malvaktsbild[1]
				var malvaktsense = 2
				var malvaktsutgang = 200
				var malvakthastighetX = 2
				var malvakthastighetY = 2
				var slot = 25
			}
			if (grad == 7) { // ABRISS!! SISTA!
				bild[2] = malvaktsbild[7]
				var malvaktsense = 20
				var malvaktsutgang = 300
				var malvakthastighetX = 4
				var malvakthastighetY = 2
				var slot = 25
			}
		}
		if (level == 2) {
			if (grad == 1 && parent.frames[0].document.getElementById("alla").innerHTML == "2") {
				bild[2] = malvaktsbild[1]
				var malvaktsense = 15
				var malvaktsutgang = 150
				var malvakthastighetX = 2
				var malvakthastighetY = 1
			} else if (grad == 1 && parent.frames[0].document.getElementById("alla").innerHTML != "2") {
				alert("Fuskare där!")
			}
			if (grad == 2) {
				bild[2] = malvaktsbild[0]
				var malvaktsense = 15
				var malvaktsutgang = 320
				var malvakthastighetX = 0.8
				var malvakthastighetY = 3.5
			}
			if (grad == 3) {
				bild[2] = malvaktsbild[12]
				var malvaktsense = 15
				var malvaktsutgang = 300
				var malvakthastighetX = 6
				var malvakthastighetY = 4
			}
			if (grad == 4) {
				bild[2] = malvaktsbild[11]
				var malvaktsense = 15
				var malvaktsutgang = 400
				var malvakthastighetX = 4
				var malvakthastighetY = 2
			}
			if (grad == 5) {
				bild[2] = malvaktsbild[10]
				var malvaktsense = 15
				var malvaktsutgang = 450
				var malvakthastighetX = 5
				var malvakthastighetY = 5
			}
			if (grad == 6) {
				bild[2] = malvaktsbild[9]
				var malvaktsense = 10
				var malvaktsutgang = 550
				var malvakthastighetX = 8
				var malvakthastighetY = 10
			}
			if (grad == 7) {
				bild[2] = malvaktsbild[8]
				var malvaktsense = 30
				var malvaktsutgang = 250
				var malvakthastighetX = 2
				var malvakthastighetY = 10
			}
		}
		if (level == 3) {
			if (grad == 1 && parent.frames[0].document.getElementById("alla").innerHTML == "3") {
				bild[2] = malvaktsbild[13]
				var malvaktsense = 300
				var malvaktsutgang = 500
				var malvakthastighetX = 0.8
				var malvakthastighetY = 4
				var steg1 = 2
				var steg2 = 2
			} else if (grad == 1 && parent.frames[0].document.getElementById("alla").innerHTML != "3") {
				alert("Fuskare där!")
			}
			if (grad == 2) {
				bild[2] = malvaktsbild[14]
				var malvaktsense = 70
				var malvaktsutgang = 200
				var malvakthastighetX = 2
				var malvakthastighetY = 4
				var steg1 = 0.8
				var steg2 = 0.1
			}
			if (grad == 3) {
				bild[2] = malvaktsbild[15]
				var malvaktsense = 40
				var malvaktsutgang = 400
				var malvakthastighetX = 0.8
				var malvakthastighetY = 4
				var steg1 = 1
				var steg2 = 1
			}
			if (grad == 4) {
				bild[2] = malvaktsbild[16]
				var malvaktsense = 50
				var malvaktsutgang = 400
				var malvakthastighetX = 0.8
				var malvakthastighetY = 4
				var steg1 = 4
				var steg2 = 4
			}
			if (grad == 5) {
				bild[2] = malvaktsbild[17]
				var malvaktsense = 30
				var malvaktsutgang = 400
				var malvakthastighetX = 0.8
				var malvakthastighetY = 4
				var steg1 = 1.5
				var steg2 = 1.5
			}
			if (grad == 6) {
				bild[2] = malvaktsbild[6]
				var malvaktsense = 10
				var malvaktsutgang = 400
				var malvakthastighetX = 3
				var malvakthastighetY = 5
				var steg1 = 1.5
				var steg2 = 1.5
			}
		}
		// westlund
		bild[0] = ospelare[vilkenSpelare].image
		bild[1] = "puck.gif"
		bild[3] = "rink.gif"
		bild[4] = "mal.gif"
		bild[5] = "trans.gif"
		bild[6] = "trans.gif"


		var sense = ospelare[vilkenSpelare].sense
		var spelarhastighet = ospelare[vilkenSpelare].speed

		// RINK
		pryl[3] = new objekt(0, 0, 600, 300, null, null, true, "rink", 0)
		// M�L
		pryl[4] = new objekt(null, null, 66, 160, null, null, false, "mal", 3)
		pryl[4].left = pryl[3].left + 20
		pryl[4].top = pryl[3].top + (pryl[3].height / 2) - (pryl[4].height / 2)

		// SPELARE
		pryl[0] = new objekt(500, 140, 61, 83, null, null, false, "spelare", 2)
		pryl[0].top = pryl[3].top + (pryl[3].height / 2) - (pryl[0].height / 2)

		// PUCK
		pryl[1] = new objekt(10, 40, 20, 10, null, null, false, "puck", 2)
		pryl[1].left = pryl[0].left
		pryl[1].top = pryl[0].top + pryl[0].height - pryl[1].height

		// M�LVAKT
		pryl[2] = new objekt(null, null, 49, 78, null, null, false, "malvakt", 2)
		pryl[2].left = pryl[3].left + 70
		pryl[2].top = pryl[3].top + (pryl[3].height / 2) - (pryl[2].height / 2)

		//Stolpar
		pryl[5] = new objekt(null, null, null, 15, null, null, false, "stolpe1", 2)
		pryl[6] = new objekt(null, null, null, 15, null, null, false, "stolpe2", 2)
		pryl[5].left = pryl[4].left
		pryl[6].left = pryl[4].left
		pryl[5].width = pryl[4].width
		pryl[6].width = pryl[4].width
		pryl[5].top = pryl[4].top - pryl[6].height + 10
		pryl[6].top = pryl[4].top + pryl[4].height - 10

		var musY = pryl[0].top
		var musX = pryl[0].left
		//////////////////////////////////////////////////////////////////////
		// KOLLAR VILKET OBJEKT SOM �R VILKET, TILLDELAR INDEX OCH HASTIGHET
		var puckIndex, rinkIndex, malIndex, spelarIndex, malvaktsIndex, stolpe1Index, stolpe2Index
		for (i = 0; i < pryl.length; i++) {
			if (pryl[i].type == "puck") {
				stegX[i] = -ospelare[vilkenSpelare].hard
				stegY[i] = 0
				puckIndex = i
			}
			if (pryl[i].type == "rink") {
				rinkIndex = i
			}
			if (pryl[i].type == "mal") {
				malIndex = i
			}
			if (pryl[i].type == "spelare") {
				stegX[i] = 0
				stegY[i] = 1
				spelarIndex = i
			}
			if (pryl[i].type == "malvakt") {
				stegX[i] = malvakthastighetX
				stegY[i] = malvakthastighetY
				malvaktsIndex = i
			}
			if (pryl[i].type == "stolpe1") {
				stolpe1Index = i
			}
			if (pryl[i].type == "stolpe2") {
				stolpe2Index = i
			}
		}


		function init() {
			for (i = 0; i < pryl.length; i++) {
				odiv[i] = eval('document.getElementById("lager' + i + '")')
				odiv[i].style.left = pryl[i].left
				odiv[i].style.top = pryl[i].top
				odiv[i].style.width = pryl[i].width
				odiv[i].style.height = pryl[i].height
				odiv[i].style.zIndex = pryl[i].index
				pryl[i].right = pryl[i].left + pryl[i].width
				pryl[i].bottom = pryl[i].top + pryl[i].height
				if (pryl[i].border) odiv[i].style.border = "1px solid #666666"
			}
			omissar = parent.frames[0].document.getElementById("missar")
			ostolptraffar = parent.frames[0].document.getElementById("stolptraffar")
			omal = parent.frames[0].document.getElementById("mal")
			oomgang = parent.frames[0].document.getElementById("omgang")
			omatch = parent.frames[0].document.getElementById("match")
			onamn = parent.frames[0].document.getElementById("namn")
			ospeed = parent.frames[0].document.getElementById("speed")
			ormiss = parent.frames[0].document.getElementById("rmiss")
			oskott = parent.frames[0].document.getElementById("skott")
			opoang = parent.frames[0].document.getElementById("poang")
			malcheck = parent.frames[0].document.getElementById("malcheck")
			alla = parent.frames[0].document.getElementById("alla")
			ospeed.innerHTML = ospelare[vilkenSpelare].speed * 30 + " km/h"
			oskott.innerHTML = ospelare[vilkenSpelare].hard * 30 + " km/h"
			onamn.innerHTML = namn
			parent.frames[0].document.images[0].src = ospelare[vilkenSpelare].image
			//////////////////
			//oomgang.innerHTML = grad
			//omatch.innerHTML = level
			//////////////////
			maltext = document.getElementById("maltext").style
			stolptext = document.getElementById("stolptext").style
			misstext = document.getElementById("misstext").style
			raddtext = document.getElementById("raddtext").style
			if (parseInt(alla.innerHTML) == 1) malcheck.innerHTML = 0
			else if (parseInt(alla.innerHTML) == 6) malcheck.innerHTML = 0
			else if (parseInt(alla.innerHTML) == 11) malcheck.innerHTML = 0
			document.onmousemove = musCoor
			document.onmousedown = skjut
			document.onkeypress = starta
			window.focus()
			motor()
			setTimeout("visa()", 2000)
		}
		//////////////////////////////
		// TIDGIVAREN
		function motor() {
			tidgivare = setTimeout("motor()", 10)
			flyttaPuck()
			flyttaSpelare()
			if (startad) {
				flyttaMalvakt()
				kollaTraff()
			}
			//window.status = "Level " + level + " Grad" + grad
		}
		// TIDGIVAREN
		//////////////////////////////
		////////////////////////

		function flyttaPuck() {

			///////////////////////////////
			/// KOLLAR RINKTR�FF
			if (pryl[puckIndex].left < pryl[rinkIndex].left) {
				stegX[puckIndex] = -stegX[puckIndex]
				hit = "miss"
			}
			if (pryl[puckIndex].right > pryl[rinkIndex].right) {
				stegX[puckIndex] = -stegX[puckIndex]
				hit = "miss"
			}
			///////////////////////////////
			/// KOLLAR M�LVAKTSTR�FF
			if ((pryl[puckIndex].left < pryl[malvaktsIndex].right) && (pryl[puckIndex].top < pryl[malvaktsIndex].bottom) && (pryl[puckIndex].bottom > pryl[malvaktsIndex].top) && (pryl[puckIndex].right > pryl[malvaktsIndex].left + 20)) {
				stegX[puckIndex] = -stegX[puckIndex]
				hit = "malvakt"
			}
			///////////////////////////////
			/// KOLLAR STOLPTR�FF
			if ((pryl[puckIndex].left < pryl[stolpe1Index].right) && (pryl[puckIndex].top < pryl[stolpe1Index].bottom) && (pryl[puckIndex].bottom > pryl[stolpe1Index].top) && (pryl[puckIndex].right > pryl[stolpe1Index].left)) {
				stegX[puckIndex] = -stegX[puckIndex]
				stegY[puckIndex] = -stegY[puckIndex]
				hit = "stolpe"
			}
			if ((pryl[puckIndex].left < pryl[stolpe2Index].right) && (pryl[puckIndex].top < pryl[stolpe2Index].bottom) && (pryl[puckIndex].bottom > pryl[stolpe2Index].top) && (pryl[puckIndex].right > pryl[stolpe2Index].left)) {
				stegX[puckIndex] = -stegX[puckIndex]
				stegY[puckIndex] = -stegY[puckIndex]
				hit = "stolpe"
			}
			///////////////////////////////
			/// KOLLAR M�L
			if ((pryl[puckIndex].right < pryl[malIndex].right - pryl[stolpe2Index].height) && (pryl[puckIndex].top > pryl[malIndex].top) && (pryl[puckIndex].bottom < pryl[malIndex].bottom)) {
				stegX[puckIndex] = -stegX[puckIndex]
				hit = "mal"
			}
			if (skott) {
				if (pryl[puckIndex].top < pryl[rinkIndex].top) {
					stegY[puckIndex] = -stegY[puckIndex]
					hit = "miss"
				}
				if (pryl[puckIndex].bottom > pryl[rinkIndex].bottom) {
					stegY[puckIndex] = -stegY[puckIndex]
					hit = "miss"
				}
				pryl[puckIndex].left += stegX[puckIndex]
				pryl[puckIndex].top += stegY[puckIndex]
			} else {
				stegY[puckIndex] = -stegY[spelarIndex]
				pryl[puckIndex].left = pryl[spelarIndex].left
				pryl[puckIndex].top = pryl[spelarIndex].bottom - pryl[puckIndex].height - 40
			}

			pryl[puckIndex].right = pryl[puckIndex].left + pryl[puckIndex].width
			pryl[puckIndex].bottom = pryl[puckIndex].top + pryl[puckIndex].height
			odiv[puckIndex].style.left = pryl[puckIndex].left
			odiv[puckIndex].style.top = pryl[puckIndex].top
		}
		//////////////////////////////
		// FLYTTAR SPELARE
		function musCoor(e) {
			if (IE) {
				musX = event.x
				musY = event.y - (pryl[spelarIndex].height / 2)
			} else if (NN) {
				musX = e.pageX
				musY = e.pageY - (pryl[spelarIndex].height / 2)
			}
		}

		function flyttaSpelare() {
			if (startad) {
				stegX[spelarIndex] = spelarhastighet
			} else {
				stegX[spelarIndex] = 0
			}
			if (musY + (pryl[spelarIndex].height / 2) > pryl[rinkIndex].bottom && pryl[spelarIndex].bottom - (pryl[spelarIndex].height / 2) > pryl[rinkIndex].bottom) stegY[spelarIndex] = 0
			if (musY - (pryl[spelarIndex].height / 4) < pryl[rinkIndex].top && pryl[spelarIndex].top - (pryl[spelarIndex].height / 4) < pryl[rinkIndex].top) stegY[spelarIndex] = 0
			pryl[spelarIndex].top -= stegY[spelarIndex]
			pryl[spelarIndex].left -= stegX[spelarIndex]
			stegY[spelarIndex] = (pryl[spelarIndex].top - musY) / sense
			odiv[spelarIndex].style.top = pryl[spelarIndex].top - 40
			odiv[spelarIndex].style.left = pryl[spelarIndex].left
			pryl[spelarIndex].bottom = pryl[spelarIndex].top + pryl[spelarIndex].height
		}

		function flyttaMalvakt() {
			if (startad) {
				if (level == 1) malvakt1()
				if (level == 2) malvakt2()
				if (level == 3) malvakt3()
			}
		}

		function skjut() {
			if (startad) skott = true
		}

		function starta(e) {
			document.getElementById("starta").style.visibility = "hidden"
			if (NN) tangent = e.which
			else if (IE) tangent = event.keyCode
			if (tangent == 32) startad = true
		}

		function kollaTraff() {
			if (hit == "miss") {
				clearTimeout(tidgivare)
				ormiss.innerHTML = parseInt(ormiss.innerHTML) + 1
				omissar.innerHTML = parseInt(omissar.innerHTML) + 1
				opoang.innerHTML = parseInt(opoang.innerHTML) - 10
				misstext.visibility = "visible"
				setTimeout("startaOm()", 1000)
			}
			if (hit == "malvakt") {
				clearTimeout(tidgivare)
				ormiss.innerHTML = parseInt(ormiss.innerHTML) + 1
				omissar.innerHTML = parseInt(omissar.innerHTML) + 1
				opoang.innerHTML = parseInt(opoang.innerHTML) - 10
				raddtext.visibility = "visible"
				setTimeout("startaOm()", 1000)
			}
			if (hit == "stolpe") {
				clearTimeout(tidgivare)
				ormiss.innerHTML = parseInt(ormiss.innerHTML) + 1
				ostolptraffar.innerHTML = parseInt(ostolptraffar.innerHTML) + 1
				opoang.innerHTML = parseInt(opoang.innerHTML) - 5
				stolptext.visibility = "visible"
				setTimeout("startaOm()", 1000)
			}
			if (hit == "mal") {
				clearTimeout(tidgivare)
				ormiss.innerHTML = 0
				malcheck.innerHTML = parseInt(malcheck.innerHTML) + 1
				omal.innerHTML = parseInt(omal.innerHTML) + 1
				opoang.innerHTML = parseInt(opoang.innerHTML) //+ 20
				maltext.visibility = "visible"
				setTimeout("startaOm('MAL')", 1000)
			}
		}

		function startaOm(Z) {
			//window.location = "motor3.php?level=3&grad=2&valnamn=<?php print $spelarensNamn . "&hidden1=" . $spelarensGrad . "&hidden2=" . $spelarensBild; ?>"

			if (Z == "clear") parent.location = "index.html"
			if (Z == "MAL") {
				opoang.innerHTML = parseInt(opoang.innerHTML) + 30
				alla.innerHTML = parseInt(alla.innerHTML) + 1
			}
			if (parseInt(ormiss.innerHTML) == 3) gameOver()

			else {
				//window.location = "motor3.php?level=1&grad=4&valnamn=<?php print $spelarensNamn . "&hidden1=" . $spelarensGrad . "&hidden2=" . $spelarensBild; ?>"
				//ormiss.innerHTML = 0
				if (parseInt(alla.innerHTML) == 1) window.location = "motor3.php?level=1&grad=1&valnamn=<?php print $spelarensNamn . "&hidden1=" . $spelarensGrad . "&hidden2=" . $spelarensBild; ?>"
				if (parseInt(alla.innerHTML) == 2) window.location = "motor3.php?level=2&grad=1&valnamn=<?php print $spelarensNamn . "&hidden1=" . $spelarensGrad . "&hidden2=" . $spelarensBild; ?>"
				if (parseInt(alla.innerHTML) == 3) window.location = "motor3.php?level=3&grad=1&valnamn=<?php print $spelarensNamn . "&hidden1=" . $spelarensGrad . "&hidden2=" . $spelarensBild; ?>"
				if (parseInt(alla.innerHTML) == 4) window.location = "motor3.php?level=1&grad=2&valnamn=<?php print $spelarensNamn . "&hidden1=" . $spelarensGrad . "&hidden2=" . $spelarensBild; ?>"
				if (parseInt(alla.innerHTML) == 5) window.location = "motor3.php?level=2&grad=2&valnamn=<?php print $spelarensNamn . "&hidden1=" . $spelarensGrad . "&hidden2=" . $spelarensBild; ?>"

				if (parseInt(alla.innerHTML) == 6) window.location = "motor3.php?level=3&grad=2&valnamn=<?php print $spelarensNamn . "&hidden1=" . $spelarensGrad . "&hidden2=" . $spelarensBild; ?>"
				if (parseInt(alla.innerHTML) == 7) window.location = "motor3.php?level=1&grad=3&valnamn=<?php print $spelarensNamn . "&hidden1=" . $spelarensGrad . "&hidden2=" . $spelarensBild; ?>"
				if (parseInt(alla.innerHTML) == 8) window.location = "motor3.php?level=2&grad=3&valnamn=<?php print $spelarensNamn . "&hidden1=" . $spelarensGrad . "&hidden2=" . $spelarensBild; ?>"
				if (parseInt(alla.innerHTML) == 9) window.location = "motor3.php?level=3&grad=3&valnamn=<?php print $spelarensNamn . "&hidden1=" . $spelarensGrad . "&hidden2=" . $spelarensBild; ?>"
				if (parseInt(alla.innerHTML) == 10) window.location = "motor3.php?level=1&grad=4&valnamn=<?php print $spelarensNamn . "&hidden1=" . $spelarensGrad . "&hidden2=" . $spelarensBild; ?>"

				if (parseInt(alla.innerHTML) == 11) window.location = "motor3.php?level=2&grad=4&valnamn=<?php print $spelarensNamn . "&hidden1=" . $spelarensGrad . "&hidden2=" . $spelarensBild; ?>"
				if (parseInt(alla.innerHTML) == 12) window.location = "motor3.php?level=3&grad=4&valnamn=<?php print $spelarensNamn . "&hidden1=" . $spelarensGrad . "&hidden2=" . $spelarensBild; ?>"
				if (parseInt(alla.innerHTML) == 13) window.location = "motor3.php?level=1&grad=5&valnamn=<?php print $spelarensNamn . "&hidden1=" . $spelarensGrad . "&hidden2=" . $spelarensBild; ?>"
				if (parseInt(alla.innerHTML) == 14) window.location = "motor3.php?level=2&grad=5&valnamn=<?php print $spelarensNamn . "&hidden1=" . $spelarensGrad . "&hidden2=" . $spelarensBild; ?>"

				if (parseInt(alla.innerHTML) == 15) window.location = "motor3.php?level=3&grad=5&valnamn=<?php print $spelarensNamn . "&hidden1=" . $spelarensGrad . "&hidden2=" . $spelarensBild; ?>"
				if (parseInt(alla.innerHTML) == 16) window.location = "motor3.php?level=1&grad=6&valnamn=<?php print $spelarensNamn . "&hidden1=" . $spelarensGrad . "&hidden2=" . $spelarensBild; ?>"
				if (parseInt(alla.innerHTML) == 17) window.location = "motor3.php?level=2&grad=6&valnamn=<?php print $spelarensNamn . "&hidden1=" . $spelarensGrad . "&hidden2=" . $spelarensBild; ?>"
				if (parseInt(alla.innerHTML) == 18) window.location = "motor3.php?level=3&grad=6&valnamn=<?php print $spelarensNamn . "&hidden1=" . $spelarensGrad . "&hidden2=" . $spelarensBild; ?>"
				if (parseInt(alla.innerHTML) == 19) window.location = "motor3.php?level=2&grad=7&valnamn=<?php print $spelarensNamn . "&hidden1=" . $spelarensGrad . "&hidden2=" . $spelarensBild; ?>"
				if (parseInt(alla.innerHTML) == 20) window.location = "motor3.php?level=1&grad=7&valnamn=<?php print $spelarensNamn . "&hidden1=" . $spelarensGrad . "&hidden2=" . $spelarensBild; ?>"
				if (parseInt(alla.innerHTML) == 21) resultera()
			}


		}

		function malvakt1() {
			if (pryl[malvaktsIndex].left > malvaktsutgang) {
				stegX[malvaktsIndex] = -stegX[malvaktsIndex]
				malvaktmoment = 1
			} else if (pryl[malvaktsIndex].left < pryl[malIndex].right && malvaktmoment == 1) {
				stegX[malvaktsIndex] = 0
				malvaktmoment = 2
			}

			if (!skott) stegY[malvaktsIndex] = (pryl[malvaktsIndex].top - musY) / malvaktsense

			if (musY + (pryl[malvaktsIndex].height) > pryl[malIndex].bottom && pryl[malvaktsIndex].top + slot > pryl[malIndex].bottom) stegY[malvaktsIndex] = 0
			if (musY + (pryl[malvaktsIndex].height) < pryl[malIndex].top && pryl[malvaktsIndex].bottom - slot < pryl[malIndex].top) stegY[malvaktsIndex] = 0

			pryl[malvaktsIndex].top -= stegY[malvaktsIndex]
			pryl[malvaktsIndex].left += stegX[malvaktsIndex]

			odiv[malvaktsIndex].style.top = pryl[malvaktsIndex].top
			odiv[malvaktsIndex].style.left = pryl[malvaktsIndex].left
			pryl[malvaktsIndex].right = pryl[malvaktsIndex].left + pryl[malvaktsIndex].width
			pryl[malvaktsIndex].bottom = pryl[malvaktsIndex].top + pryl[malvaktsIndex].height
		}

		function malvakt2() {
			if (pryl[malvaktsIndex].left > malvaktsutgang) {
				stegX[malvaktsIndex] = -stegX[malvaktsIndex]
				malvaktmoment = 1
			} else if (pryl[malvaktsIndex].left < pryl[malIndex].right && malvaktmoment == 1) {
				stegX[malvaktsIndex] = 0
				malvaktmoment = 2
			}
			if (pryl[malvaktsIndex].top < pryl[malIndex].top) stegY[malvaktsIndex] = -stegY[malvaktsIndex]
			else if (pryl[malvaktsIndex].bottom > pryl[malIndex].bottom) stegY[malvaktsIndex] = -stegY[malvaktsIndex]


			pryl[malvaktsIndex].top -= stegY[malvaktsIndex]
			pryl[malvaktsIndex].left += stegX[malvaktsIndex]

			odiv[malvaktsIndex].style.top = pryl[malvaktsIndex].top
			odiv[malvaktsIndex].style.left = pryl[malvaktsIndex].left
			pryl[malvaktsIndex].right = pryl[malvaktsIndex].left + pryl[malvaktsIndex].width
			pryl[malvaktsIndex].bottom = pryl[malvaktsIndex].top + pryl[malvaktsIndex].height
		}

		function malvakt3() {
			stegY[malvaktsIndex] = (pryl[malvaktsIndex].top - musY) / malvaktsense
			if (musY + (pryl[malvaktsIndex].height) > pryl[rinkIndex].bottom && pryl[malvaktsIndex].bottom > pryl[rinkIndex].bottom) stegY[malvaktsIndex] = 0
			if (musY - (pryl[malvaktsIndex].height / 2) < pryl[rinkIndex].top && pryl[malvaktsIndex].top < pryl[rinkIndex].top) stegY[malvaktsIndex] = 0
			if (pryl[puckIndex].left > pryl[rinkIndex].left + 300 || (pryl[spelarIndex].left + pryl[spelarIndex].width) < pryl[malvaktsIndex].left) {
				stegX[malvaktsIndex] = 0
				stegY[malvaktsIndex] = 0
			} else {

				stegX[malvaktsIndex] = steg1
			}


			pryl[malvaktsIndex].top -= stegY[malvaktsIndex]
			pryl[malvaktsIndex].left += stegX[malvaktsIndex]

			odiv[malvaktsIndex].style.top = pryl[malvaktsIndex].top
			odiv[malvaktsIndex].style.left = pryl[malvaktsIndex].left
			pryl[malvaktsIndex].right = pryl[malvaktsIndex].left + pryl[malvaktsIndex].width
			pryl[malvaktsIndex].bottom = pryl[malvaktsIndex].top + pryl[malvaktsIndex].height

		}

		function gameOver() {
			clearTimeout(tidgivare)
			misstext.visibility = "hidden"
			stolptext.visibility = "hidden"
			raddtext.visibility = "hidden"
			document.getElementById("gameover").style.visibility = "visible"
			setTimeout("resultera()", 1000)
		}
		var summering

		function resultera() {
			//alert("fitta!")
			parent.location.reload();
			summering = "resultat.php?namn=" + "<?php print $spelarensNamn; ?>" + "&points=" + parseInt(opoang.innerHTML) + "&level=" + parseInt(alla.innerHTML)
			parent.location = summering
		}

		function visa() {
			document.getElementById("starta").style.visibility = "visible"
			for (i = 0; i < pryl.length; i++) {
				odiv[i].style.visibility = "visible"
			}
		}
	</script>
</head>

<body onload="init()" style="cursor:crosshair;" onBlur="this.focus()">

	<div id=gameover class="info" style="z-index:20;position:absolute; left:250px; top:50px; visibility:hidden;">GAME OVER...</div>
	<div id=maltext class="info" style="z-index:20;position:absolute; left:260px; top:50px; visibility:hidden;">MÅÅÅL!!!</div>
	<div id=stolptext class="info" style=" z-index:20;position:absolute; left:260px; top:50px; visibility:hidden;">STOLPEN!!!</div>
	<div id=misstext class="info" style=" z-index:20;position:absolute; left:270px; top:50px; visibility:hidden;">MISS!!!</div>
	<div id=raddtext class="info" style=" z-index:20;position:absolute; left:250px; top:50px; visibility:hidden;">RÄDDNING!!!</div>
	<div id=starta class="info" style=" z-index:20;position:absolute; left:175px; top:50px; visibility:hidden;">Starta genom att trycka ned "space"</div>
	<div id="laddar1" style="width:600; height:100%; left:0px; top:0px; visibility:visible;z-index:25;" align=center>
		<br><br><br>
		<span class="info">Spelet laddar, ett ögonblick...</span>
	</div>
	<script>
		for (i = 0; i < pryl.length; i++) {
			document.write('<div id=lager' + i + ' style=position:absolute;background-image:url(' + bild[i] + ');background-repeat:no-repeat;background-position:center;visibility:hidden;><img src=trans.gif></div>')
		}
	</script>


</body>

</html>