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
  function updatePreview(){
    var previewFrame = document.getElementById('preview');
    var preview = previewFrame.contentDocument || previewFrame.contentWindow.document;
    preview.open();
    preview.write(editor.getValue());
    preview.close();
  }
  setTimeout(updatePreview, 300);