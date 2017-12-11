
/*JVscript pour BBcode*/

function bbcode(bbdebut, bbfin)
{
	var input = window.document.formulaire.message;
	input.focus();
	if(typeof document.selection != 'undefined')
	{
		var range = document.selection.createRange();
		var insText = range.text;
		range.text = bbdebut + insText + bbfin;
		range = document.selection.createRange();
		if (insText.length == 0)
		{
		range.move('character', -bbfin.length);
		}
		else
		{
		range.moveStart('character', bbdebut.length + insText.length + bbfin.length);
		}
		range.select();
	}
	else if(typeof input.selectionStart != 'undefined')
	{
		var start = input.selectionStart;
		var end = input.selectionEnd;
		var insText = input.value.substring(start, end);
		input.value = input.value.substr(0, start) + bbdebut + insText + bbfin + input.value.substr(end);
		var pos;
		if (insText.length == 0)
		{
		pos = start + bbdebut.length;
		}
		else
		{
		pos = start + bbdebut.length + insText.length + bbfin.length;
		}
		input.selectionStart = pos;
		input.selectionEnd = pos;
	}
	 
	else
	{
		var pos;
		var re = new RegExp('^[0-9]{0,3}$');
		while(!re.test(pos))
		{
		pos = prompt("insertion (0.." + input.value.length + "):", "0");
		}
		if(pos > input.value.length)
		{
		pos = input.value.length;
		}
		var insText = prompt("Veuillez taper le texte");
		input.value = input.value.substr(0, pos) + bbdebut + insText + bbfin + input.value.substr(pos);
	}
}

function preview(textareaId, previewDiv) {
	var field = textareaId.value;
		
		document.getElementById(previewDiv).innerHTML = field;
	}

function getXMLHttpRequest() {
    var xhr = null;
    
    if (window.XMLHttpRequest || window.ActiveXObject) {
        if (window.ActiveXObject) {
            try {
                xhr = new ActiveXObject("Msxml2.XMLHTTP");
            } catch(e) {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
        } else {
            xhr = new XMLHttpRequest(); 
        }
    } else {
        alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
        return null;
    }
    
    return xhr;
}

var xhr = getXMLHttpRequest(); // Voyez la fonction getXMLHttpRequest() définie dans la partie précédente
var Titre= 'Titre'; //Titre du film

xhr.open("GET", "ajax.php?t=" + Titre + "", true); //envoie requête
xhr.send(null);



function request1(ID, callback) {
    var xhr = getXMLHttpRequest();
	var id = ID;
	
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            callback(xhr.responseText);
        }
    };
    
    xhr.open("GET", "ajax.php?f=" + id + "", true);
    xhr.send(null);
}

function request2(ID, callback) {
    var xhr = getXMLHttpRequest();
	var id = ID;
	
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            callback(xhr.responseText);
        }
    };
    
    xhr.open("GET", "ajax.php?n=" + id + "", true);
    xhr.send(null);
}

function readData(sData) {
    // On peut maintenant traiter les données sans encombrer l'objet XHR.
	bbcode(sData, '');
}


