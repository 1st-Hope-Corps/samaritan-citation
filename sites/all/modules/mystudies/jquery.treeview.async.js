/*
 * Async Treeview 0.1 - Lazy-loading extension for Treeview
 * 
 * http://bassistance.de/jquery-plugins/jquery-plugin-treeview/
 *
 * Copyright (c) 2007 Jörn Zaefferer
 *
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 *
 * Revision: $Id$
 *
 */

;(function($) {

function load(settings, root, child, container) {
	$.getJSON(settings.url, {root: root}, function(response) {
		function createNode(parent) {
			var current = $("<li/>").attr("id", this.id || "").html("<span id='" + (this.id || "") + "'>" + this.text + "</span>").appendTo(parent);
			var bHasChildren = this.hasChildren;
			
			if (this.id){
				$("li[id=" + this.id + "] span[id=" + this.id + "]")
					.unbind("click")
					.click(
						function(){
							iVolunteerCatId = this.id;
							sContainerId = $(container).attr("id");
							
							// Guide && Editor/Admin Existing Items && Ask a Question (HUD)
							if ($("#guides_sContentType").length == 1 || $("#editors_sContentType").length == 1 || $("#mystudies_editors_full_cat").length == 1 || $("#tutor_form_question_cost").length == 1){
								if (!bHasChildren){
									$("#" + sContainerId + " ul li span").each(
										function(){
											$(this).css("backgroundColor", "").css("padding", "0px");
										}
									);
									
									$("input[id^=volunteer_iGroupId]").each(
										function(){
											$(this).val(iVolunteerCatId);
										}
									);
									
									$(this).css("backgroundColor", "#000000").css("padding", "2px");
									
									// Guide
									if ($("#guides_sContentType").length == 1) $("#guides_sContentType").focus();
									
									// Editor && Admin
									if ($("#volunteer_iGroupId_edit").length == 1) $("#volunteer_iGroupId_edit").val(iVolunteerCatId);
									if ($("#editors_sContentType").length == 1 && $("#volunteer_iGroupId_edit").length == 0) $("#editors_sContentType").focus();
									if ($("#mystudies_editors_full_cat").length == 1) $("#mystudies_editors_full_cat").load(Drupal.settings.basePath+"mystudies/getinvolved/full/cat/"+iVolunteerCatId);
									
									// Ask a Question (HUD)
									if ($("#tutor_form_question_cost").length == 1){
										$(this).css("backgroundColor", "gray").css("padding", "3px");
										_Tutor_GetFilteredQuestions(iVolunteerCatId);
									}
								}
							}
							
							// Editor/Admin Existing Categories
							if ($("#mystudies_editors_cat_add").length == 1){
								if (bHasChildren){
									$("span").each(
										function(){
											$(this).css("backgroundColor", "").css("padding", "0px");
										}
									);
									
									$("input[id^=volunteer_iGroupId]").each(
										function(){
											$(this).val(iVolunteerCatId);
										}
									);
									
									$(this).css("backgroundColor", "#FFFFCC").css("padding", "3px");
									$("#mystudies_editors_cat_add").focus();
								}
							}
						}
					)
					.hover(
						function(){
							$(this).css("cursor", "pointer");
						},
						function(){
							$(this).css("cursor", "default");
						}
					);
			}
			
			if (this.classes) {
				current.children("span").addClass(this.classes);
			}
			if (this.expanded) {
				current.addClass("open");
			}
			if (this.hasChildren || this.children && this.children.length) {
				var branch = $("<ul/>").appendTo(current);
				if (this.hasChildren) {
					current.addClass("hasChildren");
					createNode.call({
						text:"placeholder",
						id:"placeholder",
						children:[]
					}, branch);
				}
				if (this.children && this.children.length) {
					$.each(this.children, createNode, [branch])
				}
			}else{
				current.addClass("hasChildren");
			}
		}
		$.each(response, createNode, [child]);
        $(container).treeview({add: child});
	});
}

var proxied = $.fn.treeview;
$.fn.treeview = function(settings) {
	if (!settings.url) {
		return proxied.apply(this, arguments);
	}
	var container = this;
	load(settings, "source", this, container);
	var userToggle = settings.toggle;
	return proxied.call(this, $.extend({}, settings, {
		collapsed: true,
		toggle: function() {
			var $this = $(this);
			if ($this.hasClass("hasChildren")) {
				var childList = $this.removeClass("hasChildren").find("ul");
				childList.empty();
				load(settings, this.id, childList, container);
			}
			if (userToggle) {
				userToggle.apply(this, arguments);
			}
		}
	}));
};

})(jQuery);