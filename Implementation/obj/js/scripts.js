$("#textarea_bt1").click(function() {

    var url = "obj/php/save.php"; // the script where you handle the form input.

    $.ajax({
           type: "POST",
           url: url,
           data: $("#textarea_form1").serialize(), // serializes the form's elements.
           success: function(data)
           {
               alert(data); // show response from the php script.
           }
         });

    return false; // avoid to execute the actual submit of the form.
});

$("#create_ftp_bt").click(function() {

    var url = "obj/php/create_ftp.php"; // the script where you handle the form input.

    $.ajax({
           type: "POST",
           url: url,
           data: $("#create_ftp").serialize(), // serializes the form's elements.
           success: function(data)
           {
               alert(data); // show response from the php script.
           }
         });

    return false; // avoid to execute the actual submit of the form.
});


function CreateFolder()
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    	
    alert(xmlhttp.responseText);	
   
    }
  }

	var nume_fisier = $('#nume_fisier').val();
	
xmlhttp.open("GET","obj/php/createfolder.php?nume="+nume_fisier,true);
xmlhttp.send();
}
function CreateFile()
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    	
    alert(xmlhttp.responseText);	
   
    }
  }

	var nume_fisier = $('#nume_fisier').val();
	var extensie = $('#extensie').val();
	var nume_ext = nume_fisier +"."+ extensie;
xmlhttp.open("GET","obj/php/createfile.php?nume="+nume_ext,true);
xmlhttp.send();
}

function showHint(str,e,id)
{
if (str.length==0)
  { 
  document.getElementById("txtHint").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    	var locatie;
    	locatie = "dd" + e;
    	//alert(locatie);
    document.getElementById(locatie).innerHTML=xmlhttp.responseText;
    }
  }

xmlhttp.open("GET","obj/php/directory_tree.php?path="+str +"&id=" + id,true);
xmlhttp.send();
}


function showFolder(str,e,id)
{
if (str.length==0)
  { 
  document.getElementById("folderHint").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    	var path;
    	path = "ddd" + e;
    	
    document.getElementById(path).innerHTML=xmlhttp.responseText;
    document.getElementById("path_folder").value=str;
    }
  }

xmlhttp.open("GET","obj/php/directory_tree_folders.php?path="+str +"&id=" + id,true);
xmlhttp.send();
}

function loadXMLDoc(str,id)
{
if (str.length==0)
  { 
  document.getElementById("loadXMLDoc").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    	//alert(str);
    	//alert(id);	
    	//alert(xmlhttp.responseText);
    document.getElementById("textarea1").innerHTML=xmlhttp.responseText;
    //alert(xmlhttp.responseText);
    document.getElementById("textarea1_input").value=str;
    }
  }
//alert(str);
xmlhttp.open("GET","obj/php/adu_fisier.php?path=" +str+ "&id="+id,true);
xmlhttp.send();
}
$("#schimba_fundalul").click(function(){
  //alert("sunt aucu");
  $('html').css({"background":"#CCC7BF",
    "color" :"#0e0e0e"});
  $(".arrow_box").css({
    "background": "#CCC7BF",
     "color" :"#0e0e0e"
  });
});

$('#add_todo').click(function(){
var todoDescription = $('#todo_description').val();
$('.todo_list').prepend('<div class ="todo">' + '<div>' + '<input class = "check_todo" name = "check_todo" type = "checkbox"/>' + "</div>" + '<div class="todo_description">' + todoDescription + '</div>' + '</div>');
$('#todo_form')[0].reset();
return false;
});
$('.check_todo').unbind('click');
$('.check_todo').click(function(){
	var todo = $(this).parent().parent();
	todo.toggleClass('checked');


});
var switch_button;
var Show_Hide = 0;
var dual = 0; // 0-monoscreen 1-dual screen
var dual_view = 0;


$("#HTML_class").click(function(){
	$("#CSS_select").removeClass().addClass("form_hidden");
	$("#HTML_select").removeClass();
})
$("#HTML_append").click(function(){
	$('#textarea1').load('obj/template/html4.html');
})
$("#XHTML_append").click(function(){
	$('#textarea1').load('obj/template/xhtml.html');
})
$("#HTML5_append").click(function(){
	$('#textarea1').load('obj/template/html5.html');
})
$("#Eric_Meyer").click(function(){
	$('#textarea1').load('obj/template/eric_meyer.css');
})
$("#HTML5_doctor").click(function(){
	$('#textarea1').load('obj/template/html5doctor.css');
})
$("#yahoo_reset").click(function(){
	$('#textarea1').load('obj/template/yahoo_reset.css');
})
$("#normalize").click(function(){
	$('#textarea1').load('obj/template/normalizare.css');
})


$("#CSS_class").click(function(){
	$("#CSS_select").removeClass();
	$("#HTML_select").removeClass().addClass("form_hidden");
})
$("#close_form").click(function(){
	$(".arrow_box").hide("fast");
})
$("#split").click(function(){
	switch_button = 1;
});
$("#create_file").click(function(){
	switch_button = 2;
});
$("#settings").click(function(){
	switch_button = 3;
});
$("#to_do_list").click(function(){
	switch_button = 4;
});
$("#master_password").click(function(){
	switch_button = 5;
});
$("#user_settings").click(function(){
  switch_button = 6;
});
$("#user_help").click(function(){
  switch_button = 7;
});
$("#preview_code").click(function(){
  switch_button = 8;
});



$(".funtionalities").click(function(){
	if(switch_button == 8)
  {
    if(dual_view == 0)
    {
      $(".big").removeClass().addClass("small");
      $("#preview_form").removeClass().addClass("small");
      $("#preview").removeClass().addClass("one_column");
      dual_view = 1; 
    }
    else
    {
      $(".small").removeClass().addClass("big");
      $("#preview_form").removeClass().addClass("hidden");  
      dual_view = 0;
    }
  }
else
{
  if(switch_button==1)
	{
		if(dual == 0)
		{
			$(".big").removeClass().addClass("small");
		$("#textarea_form1").removeClass().addClass("small");
		$("#textarea1").removeClass().addClass("one_column");
		dual = 1;	
		}
		else
		{
			$(".small").removeClass().addClass("big");
			$("#textarea_form1").removeClass().addClass("hidden");	
			dual = 0;
		}
	}
  else 
	 {
		if(Show_Hide%2==0){
			$(".arrow_box").show("slow");
			$(".form_hidden").hide("slow");
			switch(switch_button){
				case 2:
				$("#create_file_form").show("slow");break;
				case 3:
				$("#create_settings_form").show("slow"); break;
				case 4: 
				$("#create_to_do_list_form").show("slow"); break;
				case 5:
				$("#create_master_lock_form").show("slow"); break;
				case 6:
				$("#create_user_settings").show("slow");  break;
        case 7:
        $("#create_user_help").show("show");break;
        default: break; 
				
			}
			//alert(switch_button);
		}
		}
		
	}
});