tinyMCEPopup.requireLangPack();

var CimageDialog = {
  init : function(ed) {;
    tinyMCEPopup.resizeToInnerSize();
	},
 	insert : function(file,title) {
		var ed = tinyMCEPopup.editor, dom = ed.dom;
    tinyMCEPopup.execCommand('mceInsertContent', false, dom.createHTML('img', {
			src : file,
			alt : title,
			title : title,
			border : 0
		}));
	}

};

tinyMCEPopup.onInit.add(CimageDialog.init, CimageDialog);
