<form method="post" action="editor.php" name="formulaire">
<table>
<td>
<!--<tr><label for="fichier">Nom du fichier : </label><input type="text" id="fichier" name="fichier" placeholder="newsletter1"/></tr>-->
</td><br/><br/>
<td>
<tr><input type="button" id="gras" name="gras" value="G" onClick="javascript:bbcode('\<b\>', '\</b\>');return(false)" style="font-weight:bold"/></tr>
<tr><input type="button" id="italic" name="italic" value="I" onClick="javascript:bbcode('\<i\>', '\</i\>');return(false)"style="font-style:italic"/></tr>
<tr><input type="button" id="souligné" name="souligné" value="S" onClick="javascript:bbcode('\<u\>', '\</u\>');return(false)" style="text-decoration:underline"/></tr>
<tr><input type="button" id="chariot" name="chariot" value="Retour à la ligne" onClick="javascript:bbcode('\<br/\>', '\<br/\>');return(false)"/></tr>
<tr><input type="button" id="red" name="red" value="Rouge" onClick="javascript:bbcode('\<font color=\'red\'\>', '\</font\>');return(false)" /></tr>
<tr><input type="button" id="lien" name="lien" value="URL" onClick="javascript:bbcode('\<a href=\'', '\'\>titre du lien\</a\>');return(false)" /></tr>
<tr><input type="button" id="TitreNewsletter" name="TitreNewsletter" value="Titre Page" onClick="javascript:bbcode('\<h1\>', '\</h1\>');return(false)" /></tr>
<tr><input type="button" id="Titre" name="Titre" value="Titre" onClick="javascript:bbcode('\<h2\>', '\</h2\>');return(false)" /></tr>
<tr><input type="button" id="Button" name="Button" value="Bouton" onClick="javascript:bbcode('\<button\>', '\</button\>');return(false)" /></tr>
<tr><input type="button" id="img" name="img" value="Image" onClick="javascript:bbcode('\<im src=\'', '\'\/>');return(false)" /></tr>
<tr><input type="button" id="lim" name="lim" value="Limite avec News" onClick="javascript:bbcode('\<hr color=\'#BDBDBD\'/\>\<font face=\'Roboto\' style=\'text-align:justify;\'\>\<font style=\'font-size:26px; font-weight: normal; margin-bottom: 10px;\'\>Nouveaux films dans notre rubrique A l\'Affiche \</font\>\<p\>\<br/\>\</p\>', '');return(false)" /></tr>
<select onchange="javascript:bbcode('<font size=' + this.options[this.selectedIndex].value + '>', '</font>');">
                <option value="none" class="selected" selected="selected">Taille</option>
                <option value="1">Très petit</option>
                <option value="2">Assez petit</option>
                <option value="3">Petit</option>
                <option value="4">Normal</option>
                <option value="5">Gros</option>
                <option value="6">Assez gros</option>
				 <option value="7">Très gros</option>
            </select>
			
		<select onchange="javascript: request1(this.options[this.selectedIndex].value, readData);">
						<option value="none" class="selected" selected="selected">Films</option>
												<option value="204">Les 4 Fantastiques</option>
						 						<option value="203">Avengers : L&apos;&egrave;re d&apos;Ultron</option>
						 						<option value="202">American Sniper</option>
						 						<option value="201">Projet Almanac</option>
						 						<option value="200">It Follows</option>
						 						<option value="199">Jupiter : Le destin de l&apos;Univers</option>
						 						<option value="198">Into the Woods, Promenons-nous dans les bois</option>
						 						<option value="197">Une merveilleuse histoire du temps</option>
						 						<option value="196">The Imitation Game</option>
						 						<option value="195">Terminator: Genisys</option>
						 					</select>
		
		<select onchange="javascript: request2(this.options[this.selectedIndex].value, readData);">
						<option value="none" class="selected" selected="selected">Films de A l'Affiche</option>
												<option value="61">Deadpool </option>
						 						<option value="57">Suicide Squad</option>
						 						<option value="56">Batman v Superman : L&apos;Aube de la Justice</option>
						 						<option value="55">The Revenant</option>
						 					</select>
			
 </td><br/><br/>
<td>
<tr><textarea onkeyup="preview(this, 'previewDiv');" onselect="preview(this, 'previewDiv');" cols="150" rows="10" id="message" name="message"><div style="width:40%; margin:auto; padding: 10px; box-shadow: 2px 2px 2px 0px #656565; border: 1px solid #CDCDCD;">
<link href="http://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">

<font face="Roboto" style="text-align:justify;"><font style="font-size:56px; font-weight: bold;">Le Cin&eacute;phile<hr color="black"/></font>

<font style="font-size:20px; font-style:italic;"><p style="float:left;">Newsletter</p>                                 <p style="float:right;">11/12/2017<p></font><br/><br/>


<center><a href="#" style="font-size:18px; color: #109fff;">lien vers le site</a><br/><br/></textarea></tr>
<tr><div id="previewDiv"></div></tr>
<br />
</td>
<td>
<tr><input type="submit" name="submit" value="Envoyer" /></tr>
<tr><input type="reset" name ="Effacer" value ="Effacer" /></tr>
</td>
</table>
</form>

