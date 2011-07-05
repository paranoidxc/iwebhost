tinyMCEPopup.requireLangPack();

var CimageDialog = {
  init : function(ed) {;
    tinyMCEPopup.resizeToInnerSize();
	},
 	insert : function(file,title) {
		var ed = tinyMCEPopup.editor, dom = ed.dom;
    var h = "<p><img src='"+file+"' title='"+title+"' alt='"+title+"'/></p>";
    tinyMCEPopup.execCommand('mceInsertContent', false, h );
	}
};

tinyMCEPopup.onInit.add(CimageDialog.init, CimageDialog);
