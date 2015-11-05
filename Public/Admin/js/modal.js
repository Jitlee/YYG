$(function(){
	var modalConfirmCancelButton = $("#modalConfirmCancelButton");
	var modalConfirmOKButton = $("#modalConfirmOKButton");
	var modalConfirmContent = $("#modalConfirmContent");
	var modalConfirm = $("#modalConfirm");
	var ui = {};
	var cancel = null;
	var ok = null;
	
	modalConfirmOKButton.click(function() {
		if(ok) {
			ok();
			ok = null;
		}
	});
	
	modalConfirmCancelButton.click(function() {
		if(cancel) {
			cancel();
			cancel = null;
		}
	});
	
	ui.confirm = function(text, options){
		modalConfirmContent.text(text);
		if(options){
			ok = options.ok;
			cancel = options.cancel;
		}
		modalConfirm.modal();
	};
	
	window.UI = ui;
});
