<html>
<head>
	<link rel="stylesheet" href="obj/codemirror/lib/codemirror.css">
	<link rel="stylesheet" href="obj/codemirror/addon/hint/show-hint.css">
	<link rel="stylesheet" type="text/css" href="obj/style/style.css">
	<link rel="stylesheet" type="text/css" src="obj/codemirror/addon/dialog/dialog.css">
	<link rel="stylesheet" type="text/css" src="obj/codemirror/doc/docs.css">
	<link rel="stylesheet" href="obj/codemirror/theme/neat.css">
    <link rel="stylesheet" href="obj/codemirror/theme/elegant.css">
    <link rel="stylesheet" href="obj/codemirror/theme/erlang-dark.css">
    <link rel="stylesheet" href="obj/codemirror/theme/night.css">
    <link rel="stylesheet" href="obj/codemirror/theme/monokai.css">
    <link rel="stylesheet" href="obj/codemirror/theme/cobalt.css">
    <link rel="stylesheet" href="obj/codemirror/theme/eclipse.css">
    <link rel="stylesheet" href="obj/codemirror/theme/rubyblue.css">
    <link rel="stylesheet" href="obj/codemirror/theme/lesser-dark.css">
    <link rel="stylesheet" href="obj/codemirror/theme/xq-dark.css">
    <link rel="stylesheet" href="obj/codemirror/theme/xq-light.css">
    <link rel="stylesheet" href="obj/codemirror/theme/ambiance.css">
    <link rel="stylesheet" href="obj/codemirror/theme/blackboard.css">
    <link rel="stylesheet" href="obj/codemirror/theme/vibrant-ink.css">

    <link href='http://fonts.googleapis.com/css?family=Sail|Paprika|Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>
</head>
<body>
<header>

</header>
<nav class="directory_tree" id="directory_tree_id">
	
	<?php

include "obj/php/functions.php";
sec_session_start();
redirect();
	
	$con = mysql_connect('localhost','root','');
	mysql_select_db("vlad_licenta") OR die("nu am gasit BD");
	$select = "SELECT * FROM ftp_info";
	$result = mysql_query($select);
	while ($row = mysql_fetch_array($result)) {
			$host = $row['HOST'];
			$username = $row['USERNAME'];
			$password = $row['PASSWORD'];
			$desierd_name = $row['DESIRED_NAME'];
			//$id_user = $row['ID_USER'];
			$id_ftp =  $row['ID_FTP'];
			
	
	$con = ftp_connect($host) or die("nu a mers");
	$login = ftp_login($con,$username,$password);
	ftp_pasv($con,true);
	$lista = adu_foldere($con,'/');
	echo "<ul>";
	$path = '/';
	$date = new DateTime();
	$nr=$date->getTimestamp()*1000+$id_ftp*100;

	echo "<li class=\"ftp\" onclick = \"showHint('".$path."',".$nr.",".$id_ftp.")\">" .$desierd_name."</li>"; 
	echo "<div id =\"dd".$nr."\"></div>";
	
	echo "</ul>";
	}
?>
 
 <div class ="arrow_box " id="create_file_options">
	<div id="create_file_form" class="form_hidden">
		
		<div class="left container">
			<input type="text" id="nume_fisier" name="nume_fisier"/>
			<select id ="extensie">
				<option value="html">HTML</option>
				<option value="css">CSS</option>
				<option value="php">PHP</option>
				<option value="js">JavaScript</option>
			</select>
			<input id="path_folder" type="hidden"/>
			<input type="submit" onclick ="CreateFile()"  id="creare_folder" name="adauga_fisier" value="Creare fisier"/>
			<input type="submit" onclick ="CreateFolder()"  id="creare_folder" name="adauga_fisier" value="Creare folder"/>
		</div>
		<div class="right container">
		<nav class="directory_tree">
	<?php
	$con = mysql_connect('localhost','root','');
	mysql_select_db("vlad_licenta") OR die("nu am gasit BD");
	$select = "SELECT * FROM ftp_info";
	$result = mysql_query($select);
	while ($row = mysql_fetch_array($result)) {
			
			$host = $row['HOST'];
			$username = $row['USERNAME'];
			$password = $row['PASSWORD'];
			$desierd_name = $row['DESIRED_NAME'];
			//$id_user = $row['ID_USER'];
			$id_ftp =  $row['ID_FTP'];
			
	
	$con = ftp_connect($host) or die("nu a mers");
	$login = ftp_login($con,$username,$password);
	ftp_pasv($con,true);
	$lista = adu_foldere($con,'/');
	echo "<ul>";
	$path = '/';
	$date = new DateTime();
	$nr=$date->getTimestamp()*1000 + $id_ftp*100;

	echo "<li class=\"ftp\" onclick = \"showFolder('".$path."',".$nr.",".$id_ftp.")\">" .$desierd_name."</li>"; 
	echo "<div id =\"ddd".$nr."\"></div>";
	
	echo "</ul>";
	}	
?>
		
		</nav>
		</div>
		
	</div>
	<div id="create_settings_form" class="form_hidden">
		<div class="left container">
			<div id="HTML_class" class="button">HTML </div>
			<div id="CSS_class" class="button">CSS</div>
			<div id="PHP_class" class="button">PHP</div>
		</div>
		<div  class="right container">
			<div  id="HTML_select" class = "form_hidden">
				<div id="HTML_append" class ="button">HTML 4.01</div>
				<div id="XHTML_append" class ="button">XHTML 4.01</div>
				<div id="HTML5_append" class ="button"> HTML 5</div>
			</div>
			<div id="CSS_select" class="form_hidden">
				<div id="Eric_Meyer" class="button">Eric Meyer</div>
				<div id="HTML5_doctor" class="button">HTML5 Doctor</div>
				<div id="yahoo_reset" class="button">Yahoo Reset</div>
				<div id="normalize" class="button">Normalize</div>
			</div>
		</div>
	</div>
	
	<div id="create_to_do_list_form" class="form_hidden">
		<form id="todo_form" action="#" method="POST">
			<input id="todo_description" name="todo_description" type="text" />
			<input id="add_todo" type="submit" value="Adauga task"/>
		</form>
		<div class="todo_list"></div>
	</div>
	<div id="create_master_lock_form" class="form_hidden">
		<form class="create_ftp" id="create_ftp">
			<div class="spatiu">
				<label for="nume_conexiune">Numele conexiuni</label>
				<input type="text"name="nume_conexiune"/>
			</div>
			<div class="spatiu">
				<label for="adresa_host" >Adresa host</label>
				<input type="text" name="adresa_host"/>
			</div>
			<div class="spatiu">
				<label for = "username">Username</label>
				<input type="text" name="username"/>
			</div>
			<div class="spatiu">
				<label for ="parola">Parola</label>
				<input type="password" name="parola"/>
			</div>
			<button id="create_ftp_bt" name="adauga_fisier">Creaza FTP</button>
		</form>
	</div>
	<div id = "create_user_settings" class="form_hidden">
		<form class="user_settings_form" id="user_settings_form">
			<div class="left">
<form id="user_settings_form" class="create_ftp">
	<div class="spatiu">
				<label for="nume_utilizator">Numele utilizator</label>
				<input type="text"name="nume_utilizator"/>
	</div>
	<div class="spatiu">
				<label for="prenume_utilizator">Prenume utilizator</label>
				<input type="text"name="prenume_utilizator"/>
	</div>
	<div class="spatiu">
				<label for="adresa_email">adresa email</label>
				<input type="email"name="adresa_email"/>
	</div>
	<div class="spatiu">
				<label for="parola_utilizator">parola utilizator</label>
				<input type="password"name="parola_utilizator"/>
	</div>
</form>
	</div>
	<div class="right">
		<!--<img src="obj/img/img_utilizator/1.png"/> 
		<p>Alege fontul<select></select></p>-->
		<button id="schimba_fundalul">Schimba fundalul</button>
		<button>Delogare</button>
		<p>Selecteaza o tema:
			 <select onchange="selectTheme()" id="select">
			    <option selected>default</option>
			    <option>ambiance</option>
			    <option>blackboard</option>
			    <option>cobalt</option>
			    <option>eclipse</option>
			    <option>elegant</option>
			    <option>erlang-dark</option>
			    <option>lesser-dark</option>
			    <option>midnight</option>
			    <option>monokai</option>
			    <option>neat</option>
			    <option>night</option>
			    <option>rubyblue</option>
			    <option>solarized dark</option>
			    <option>solarized light</option>
			    <option>twilight</option>
			    <option>vibrant-ink</option>
			    <option>xq-dark</option>
			    <option>xq-light</option>
			</select>
		</p>
	</div>
		</form>
	</div>
	<div id="create_user_help" class="form_hidden">
		<div class="column">
			<h2>Descrierea butoanelor</h2>
			<ul>
				<li><img src="obj/img/settings_black.png">Deschide pagina de setari a utilizatorului</li>
				<li><img src="obj/img/user_help_black.png">Deschide modulul de ajutor al utilizatoruilui</li>
				<li><img src="obj/img/split_black.png">Imparte zona de cod in doua parti pentru a putea folosii conectareasi lucrul pe server </li>
				<li><img src="obj/img/preview_code_black.png">Imparte zona in doua, una pentru scris cod, si una pentru vizualizarea acestuia</li>
				<li><img src="obj/img/create_file_black.png">Deschide un formular in care se poate crea un fisier nou</li>
				<li><img src="obj/img/settings_black.png">Deschide o interfata de unde se pot folosii diferite templaturi gata create</li>
				<li><img src="obj/img/to_do_list.png">Deschide o interfata unde se pot adauga noi takuri</li>
				<li><img src="obj/img/lock_black.png">Deschide o interfata unde se pot adauga noi conexiuni catre server</li>
			</ul>
		</div>
		<div class="column">
			<h2>Comenzi</h2>
			<ul>
				<li><span>F11</span> Intra in modul Full Screen</li>
				<li><span>ESC sau F11</span>Iesirea din modul Full Screen</li>
			</ul>
			<div class="descriere">
				<h3>WDT</h3>
				<p>Web Developement Tool este o aplicatie destinata oricarui dezvoltator web care doreste sa se afle in permanenta miscare si sa fie capabil sa modifice sau sa creeze documente fara a avea nevoie de un editor instalat</p>
			</div>
		</div>
	</div>
	<div id="close_form"></div>
</div>


</nav>
<div class="cod_area">
	<form id="hidden" class="big">
		<textarea id="textarea2" class="one_column"></textarea>
		<button  class="save" type="submit"><img src="obj/img/save_black.png"/></button>
	</form>
	<form  id ="textarea_form1" class="hidden" >
		<textarea id="textarea1" name="code" class="one_column"></textarea>
		<button  id="textarea_bt1" class="save" type="submit"><img src="obj/img/save_black.png"/></button> 
	<input type="hidden" id="textarea1_input" name="path"/>
	</form>
	<form id="preview_form" class="hidden">
		<iframe id="preview" class="one_column">
		</iframe>
	</form>
	
		

</div>
<div class="funtionalities">
	<div id="user_settings"></div>
	<div id="user_help"></div>
	<div id="split"></div>
	<div id="preview_code"></div>
	<div id="create_file"></div>
	<div id="settings"></div>
	<div id="to_do_list"></div>
	<div id="master_password"></div>
	
	
	
</div>


<script type="text/javascript" src="obj/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="obj/js/scripts.js"></script>

<script src="obj/codemirror/lib/codemirror.js"></script>
<script src="obj/codemirror/addon/hint/show-hint.js"></script>
<script src="obj/codemirror/addon/edit/closetag.js"></script>
<script src="obj/codemirror/addon/hint/html-hint.js"></script>
<script src="obj/codemirror/addon/search/search.js"></script>
<script src="obj/codemirror/addon/search/searchcursor.js"></script>
<script src="obj/codemirror/addon/search/match-highlighter.js"></script>
<script src="obj/codemirror/addon/dialog/dialog.js"></script>
<script src="obj/codemirror/addon/selection/active-line.js"></script>
<script src="obj/codemirror/mode/xml/xml.js"></script>
<script src="obj/codemirror/mode/javascript/javascript.js"></script>
<script src="obj/codemirror/mode/css/css.js"></script>
<script src="obj/codemirror/mode/htmlmixed/htmlmixed.js"></script>


<script type="text/javascript">
CodeMirror.commands.autocomplete = function(cm) {
		CodeMirror.showHint(cm, CodeMirror.htmlHint);
	}
       



    function isFullScreen(cm) {
      return /\bCodeMirror-fullscreen\b/.test(cm.getWrapperElement().className);
    }
    function winHeight() {
      return window.innerHeight || (document.documentElement || document.body).clientHeight;
    }
    function winWidth(){
    	 return window.innerWidth || (document.documentElement || document.body).clientWidth;
    }
    function setFullScreen(cm, full) {
      var wrap = cm.getWrapperElement();
      if (full) {
      	document.getElementById("directory_tree_id").style.display = "none";
      	document.getElementById("hidden").className = "";
        wrap.className += " CodeMirror-fullscreen";
        wrap.style.height = winHeight() + "px";
        wrap.style.width = winWidth() + "px";
        document.documentElement.style.overflow = "hidden";
      } else {
      	document.getElementById("directory_tree_id").style.display = "block";
      	document.getElementById("hidden").className = "big";
        wrap.className = wrap.className.replace(" CodeMirror-fullscreen", "");
        wrap.style.height = "";
        wrap.style.width = "";
        document.documentElement.style.overflow = "";
      }
      cm.refresh();
    }   

  

    var delay;
    CodeMirror.on(window, "resize", function() {
      var showing = document.body.getElementsByClassName("CodeMirror-fullscreen")[0];
      if (!showing) return;
      showing.CodeMirror.getWrapperElement().style.height = winHeight() + "px";
      showing.CodeMirror.getWrapperElement().style.width = winWidth() + "px";
    });


	var editor = CodeMirror.fromTextArea(document.getElementById("textarea2"), {
		mode: 'text/html',
		lineNumbers: true,
		styleActiveLine: true,
		lineWrapping: true,
		autoCloseTags: true,
		highlightSelectionMatches: true,
		extraKeys: {"Ctrl-Space": "autocomplete",
		"F11": function(cm){
			setFullScreen(cm, !isFullScreen(cm));
		},
		"ESC": function(cm){
			if(isFullScreen(cm)) setFullScreen(cm,false);
		}
		}
      });



	editor.on("change",function(){
		clearTimeout(delay);
		delay = setTimeout(updatePreview,300);
	});

	 var input = document.getElementById("select");
    function selectTheme(){
    	var theme = input.options[input.selectedIndex].innerHTML;
    	editor.setOption("theme",theme);
    }
    var choice = document.location.search && decodeURLComponent(document.location.search.slice(1));
    if(choice){
    	input.value = choice;
    	editor.setOption("theme",theme);
    }

	function updatePreview(){
		var previewFrame = document.getElementById('preview');
		var preview = previewFrame.contentDocument || previewFrame.contentWindow.document;
		preview.open();
		preview.write(editor.getValue());
		preview.close();
	}
	setTimeout(updatePreview, 300);
    </script>
</body>
</html>