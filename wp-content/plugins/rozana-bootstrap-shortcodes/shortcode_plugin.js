(function() {
    tinymce.PluginManager.add('SamaShortcodes', function( editor, url ) {
        editor.addButton( 'sama_shortcodes_button', {
            text: 'Bootstrap',
            icon: false,
			type: 'menubutton',
            menu: [
				{
					text: 'General',
					type: 'menuitem',
					menu:[
						{
							text: 'Clear',
							value: '[sama_clear]',
							onclick: function() {
								editor.insertContent(this.value());
							}
						},
						{
							text: 'Divider',
							onclick: function() {
								editor.windowManager.open({
									title: 'Add Divider',
									body: [
									{
										type: 'container',
										html: '<p>Add number only ex: 30 don\'t add px',
									},
									{
										type: 'listbox',
										name: 'style',
										label: 'Number Of Columns',
										'values': [
											{text: 'Style 1', value: 'divider-dashed alizarin-divider'},
											{text: 'Style 2', value: 'divider-solid'},
											{text: 'Style 3', value: 'divider-dotted'},
											{text: 'Style 4', value: 'divider-solid divider-3'},
											{text: 'Style 5', value: 'divider-img-1'},
											{text: 'Style 6', value: 'divider-img-2'},
										]
									},
									{
										type: 'textbox',
										name: 'height',
										label: 'Height'
									},
									{
										type: 'textbox',
										name: 'cssclass',
										label: 'CssClass',
									},
									{
										type: 'checkbox',
										name: 'hideline',
										label: 'Hide Line',
										tooltip: 'This option depend on your theme if divider line have background'
									}],
									onsubmit: function( e ) {
										//editor.insertContent(this.value());
										var output      = '[sama_divider';
										var height    	= e.data.height;
										var style 		= e.data.style;
										var cssclass 	= e.data.cssclass;
										var hide		= e.data.hideline;
										if( height != '' ) output += ' height="'+ height + '"';
										output += ' cssclass="'+ cssclass + " " + style + '"';
										if( hide == true) output += ' hide="yes"';
										output += ']';
										editor.insertContent( output );
									}
								});
							}
						},
						{
							text: 'Icons',
							onclick: function() {
								editor.windowManager.open({
									title: 'Add Icons',
									body: [
									{
										type: 'container',
										html: '<p>Add Full css class for icon on field icon name like <br/>fa fa-flag</p><br/><ul><li>- <a target="_blank" href="http://fortawesome.github.io/Font-Awesome/">Icon name for Font Awesome</a></li></ul>',
									},
									{
										type: 'textbox',
										name: 'name',
										label: 'Icon Name'
									},
									{
										type: 'textbox',
										name: 'cssclass',
										label: 'Custom CSS Class',
										tooltip: 'Optional'
									}],
									onsubmit: function( e ) {
										var name = e.data.name;
										var font =  e.data.font;
										var cssclass =  e.data.cssclass;
										var output = '[sama_icon';
										if(name != '') output += ' name="'+ name + '"';
										output += ' font="fontawesome"';
										if(cssclass != '') {
											output += ' cssclass="' + cssclass + '"';
										}
										output += ']';
										editor.insertContent( output );
									}
								});
							}
						},
						{
							text: 'Float Left',
							value: '[sama_left cssclass=""]<br class="removebr" />Your Content Here<br class="removebr" />[/sama_left]',
							onclick: function() {
								editor.insertContent(this.value());
							}
						},
						{
							text: 'Float Right',
							value: '[sama_right cssclass=""]<br class="removebr" />Your Content Here<br class="removebr" />[/sama_right]',
							onclick: function() {
								editor.insertContent(this.value());
							}
						},
						{
							text: 'Pricing column',
							onclick: function() {
								editor.windowManager.open({
									title: 'Add Pricing column',
									body: [
									{
										type: 'textbox',
										name: 'title',
										label: 'Title'
									},
									{
										type: 'listbox',
										name: 'hoticon',
										label: 'Display hot icon',
										'values': [
											{text: 'No', value: 'no'},
											{text: 'Yes', value: 'yes'},
										]
									},
									{
										type: 'listbox',
										name: 'style',
										label: 'Column Style',
										'values': [
											{text: 'Dark', value: 'dark'},
											{text: 'Theme Color', value: 'active'},
											{text: 'Green', value: 'green-price'},
											{text: 'Dark Blue', value: 'wet-asphelt-price'},
										]
									},
									{
										type: 'textbox',
										name: 'price',
										label: 'Price'
									},
									{
										type: 'textbox',
										name: 'currency',
										label: 'Currency',
										tooltip: 'Ex $',
									},
									{
										type: 'textbox',
										name: 'subtitle',
										label: 'Price subtitle',
										tooltip: 'Ex per month',
									},
									{
										type: 'textbox',
										name: 'features',
										label: 'Pricing Features',
										minHeight:100,
										multiline: true,
										tooltip: 'Input price column features here. Divide values with comma ,',
									},
									{
										type: 'textbox',
										name: 'btntitle',
										label: 'Button Text'
									},
									{
										type: 'textbox',
										name: 'btnurl',
										label: 'Button URL'
									},
									{
										type: 'listbox',
										name: 'target',
										label: 'Target',
										tooltip: 'This if use type link',
										'values': [
											{text: 'Self', value: '_self'},
											{text: 'Blank', value: '_blank'},
										]
									},
									{
										type: 'textbox',
										name: 'cssclass',
										label: 'CssClass',
									}],
									onsubmit: function( e ) {
										var title 		= e.data.title;
										var hoticon		= e.data.hoticon;
										var style		= e.data.style;
										var price		= e.data.price;
										var currency	= e.data.currency;
										var subtitle	= e.data.subtitle;
										var features    = e.data.features;
										var btntitle    = e.data.btntitle;
										var btnurl    	= e.data.btnurl;
										var target    	= e.data.target;
										var cssclass 	= e.data.cssclass;
										
										var output      = '[sama_pricing_table';
										if( title != '') {
											output += ' title="' + title + '"';
										} else {
											output += ' title=""';
										}
										if( hoticon != '') {
											output += ' hoticon="' + hoticon + '"';
										} else {
											output += ' hoticon="no"';
										}
										if( style != '') {
											output += ' style="' + style + '"';
										} else {
											output += ' style="dark"';
										}
										if( price != '') {
											output += ' price="' + price + '"';
										} else {
											output += ' price=""';
										}
										if( currency != '') {
											output += ' currency="' + currency + '"';
										} else {
											output += ' currency=""';
										}
										if( subtitle != '') {
											output += ' subtitle="' + subtitle + '"';
										} else {
											output += ' subtitle=""';
										}
										if( features != '') {
											output += ' features="' + features + '"';
										} else {
											output += ' features=""';
										}
										if( btntitle != '') {
											output += ' btntitle="' + btntitle + '"';
										} else {
											output += ' btntitle=""';
										}
										if( btnurl != '') {
											output += ' btnurl="' + btnurl + '"';
										} else {
											output += ' btnurl=""';
										}
										if( target != '') {
											output += ' target="' + target + '"';
										} else {
											output += ' target=""';
										}
										if( cssclass != '') {
											output += ' cssclass="' + cssclass + '"';
										} else {
											output += ' cssclass=""';
										}
										output += ']';
										editor.insertContent( output );
									}
								});
							}
						},
						{
							text: 'Team member',
							onclick: function() {
								editor.windowManager.open({
									title: 'Add Team Member',
									body: [
									{
										type: 'listbox',
										name: 'style',
										label: 'Display hot icon',
										'values': [
											{text: 'Style 1', value: 'style1'},
											{text: 'Style 2', value: 'style2'},
											{text: 'Style 3', value: 'style3'},
										]
									},
									{
										type: 'textbox',
										name: 'membername',
										label: 'Member Name'
									},
									{
										type: 'textbox',
										name: 'role',
										label: 'Member Role',
										tooltip: 'Enter a byline for the team member (for example: "Director of Production")',
									},
									{
										type: 'textbox',
										name: 'desc',
										label: 'Member description',
										minHeight:100,
										multiline: true,
									},
									{
										type: 'textbox',
										name: 'image',
										label: 'Member image URL'
									},
									{
										type: 'textbox',
										name: 'facebook',
										label: 'Facebook URL'
									},
									{
										type: 'textbox',
										name: 'twitter',
										label: 'Twitter URL'
									},
									{
										type: 'textbox',
										name: 'linkedin',
										label: 'Linkedin URL'
									},
									{
										type: 'textbox',
										name: 'gplus',
										label: 'Google plus URL'
									},
									{
										type: 'textbox',
										name: 'cssclass',
										label: 'CssClass',
									}],
									onsubmit: function( e ) {
										var style 		= e.data.style;
										var membername	= e.data.membername;
										var role		= e.data.role;
										var desc		= e.data.desc;
										var image		= e.data.image;
										var facebook	= e.data.facebook;
										var twitter    	= e.data.twitter;
										var linkedin    = e.data.linkedin;
										var gplus    	= e.data.gplus;
										var cssclass 	= e.data.cssclass;
										
										var output      = '[sama_team_member';
										if( style != '') {
											output += ' style="' + style + '"';
										} else {
											output += ' style="style1"';
										}
										if( membername != '') {
											output += ' name="' + membername + '"';
										} else {
											output += ' name="no"';
										}
										if( role != '') {
											output += ' role="' + role + '"';
										} else {
											output += ' role=""';
										}
										if( image != '') {
											output += ' image="' + image + '"';
										} else {
											output += ' image=""';
										}
										if( facebook != '') {
											output += ' facebook="' + facebook + '"';
										} else {
											output += ' facebook=""';
										}
										if( twitter != '') {
											output += ' twitter="' + twitter + '"';
										} else {
											output += ' twitter=""';
										}
										if( linkedin != '') {
											output += ' linkedin="' + linkedin + '"';
										} else {
											output += ' linkedin=""';
										}
										if( gplus != '') {
											output += ' gplus="' + gplus + '"';
										} else {
											output += ' gplus=""';
										}
										if( cssclass != '') {
											output += ' cssclass="' + cssclass + '"';
										} else {
											output += ' cssclass=""';
										}
										output += ']<br class="removebr" />';
										if( desc == '' ) desc = 'Enter Your Content Here !';
										
										output += desc + '<br class="removebr" />[/sama_team_member]';
										editor.insertContent( output );
									}
								});
							}
						},
						{
							text: 'Counter',
							onclick: function() {
								editor.windowManager.open({
									title: 'Add Counter',
									body: [
									{
										type: 'textbox',
										name: 'title',
										label: 'Title'
									},
									{
										type: 'listbox',
										name: 'type',
										label: 'Display hot icon',
										'values': [
											{text: 'Box', value: 'box'},
											{text: 'Circle', value: 'circle'},
											{text: 'Line', value: 'line'},
										]
									},
									{
										type: 'textbox',
										name: 'icon',
										label: 'Font Awesome icon CSS class',
										tooltip: 'Optional full css class for icon from Font Awesome',
									},
									{
										type: 'textbox',
										name: 'value',
										label: 'Value',
										tooltip: 'Value to count',
									},
									{
										type: 'textbox',
										name: 'unit',
										label: 'Unit',
										tooltip: 'Ex %',
									},
									{
										type: 'textbox',
										name: 'cssclass',
										label: 'CssClass',
									}],
									onsubmit: function( e ) {
										var title 		= e.data.title;
										var type		= e.data.type;
										var icon		= e.data.icon;
										var value		= e.data.value;
										var unit		= e.data.unit;
										var cssclass 	= e.data.cssclass;
										
										var output      = '[sama_counter';
										if( title != '') {
											output += ' title="' + title + '"';
										} else {
											output += ' title=""';
										}
										if( type != '') {
											output += ' type="' + type + '"';
										} else {
											output += ' type="box"';
										}
										if( icon != '') {
											output += ' icon="' + icon + '"';
										} else {
											output += ' icon=""';
										}
										if( value != '') {
											output += ' value="' + value + '"';
										} else {
											output += ' value=""';
										}
										if( unit != '') {
											output += ' unit="' + unit + '"';
										} else {
											output += ' unit=""';
										}
										if( cssclass != '') {
											output += ' cssclass="' + cssclass + '"';
										} else {
											output += ' cssclass=""';
										}
										output += ']';										
										editor.insertContent( output );
									}
								});
							}
						},
						{
							text: 'Google maps',
							onclick: function() {
								editor.windowManager.open({
									title: 'Add Custom Google maps',
									body: [
									{
										type: 'textbox',
										name: 'title',
										label: 'Title'
									},
									{
										type: 'textbox',
										name: 'latlang',
										label: 'Coordinates',
										tooltip: 'Ex: 30.068476, 31.311973',
									},
									{
										type: 'textbox',
										name: 'zoom',
										label: 'Zoom',
										tooltip: 'Ex: 17',
									},
									{
										type: 'textbox',
										name: 'image',
										label: 'Image URL',
										tooltip: 'to display in google map',
									},
									{
										type: 'textbox',
										name: 'cssclass',
										label: 'CssClass',
									}],
									onsubmit: function( e ) {
										var title 		= e.data.title;
										var latlang		= e.data.latlang;
										var zoom		= e.data.zoom;
										var image		= e.data.image;
										var cssclass 	= e.data.cssclass;
										
										var output      = '[sama_gmaps';
										if( title != '') {
											output += ' title="' + title + '"';
										} else {
											output += ' title=""';
										}
										if( latlang != '') {
											output += ' latlang="' + latlang + '"';
										} else {
											output += ' latlang=""';
										}
										if( zoom != '') {
											output += ' zoom="' + zoom + '"';
										} else {
											output += ' zoom=""';
										}
										if( image != '') {
											output += ' image="' + image + '"';
										} else {
											output += ' image=""';
										}
										if( cssclass != '') {
											output += ' cssclass="' + cssclass + '"';
										} else {
											output += ' cssclass=""';
										}
										output += ']';										
										editor.insertContent( output );
									}
								});
							}
						},
						{
							text: 'Progress bars',
							onclick: function() {
								editor.windowManager.open({
									title: 'Add Progress bars',
									body: [
									{
										type: 'textbox',
										name: 'title',
										label: 'Title'
									},
									{
										type: 'textbox',
										name: 'value',
										label: 'Value',
										tooltip: 'Insert Number From 1 to 100'
									},
									{
										type: 'textbox',
										name: 'unit',
										label: 'Value',
										value:'%',
										tooltip: 'Enter measurement units (if needed) Eg. %, px, points, etc. Graph value and unit will be appended to the graph title.'
									},
									{
										type: 'listbox',
										name: 'style',
										label: 'Style',
										'values': [
											{text: 'default', value: ''},
											{text: 'violet', value: 'violet-bar'},
											{text: 'Blue', value: 'blue-bar'},
											{text: 'Orange', value: 'orange-bar'},
											{text: 'Red', value: 'red-bar'},
											{text: 'Dark green', value: 'dark-green-bar'},
											{text: 'Light green', value: 'light-green-bar'},
											{text: 'Bootstrap green', value: 'progress-bar-success'},
											{text: 'Bootstrap Viking', value: 'progress-bar-info'},
											{text: 'Bootstrap Red', value: 'progress-bar-danger'},
											{text: 'Bootstrap Sandy brown', value: 'progress-bar-warning'},
										]
									},
									{
										type: 'textbox',
										name: 'cssclass',
										label: 'Custom CSS Class',
										tooltip: 'Optional',
									},
									{
										type: 'checkbox',
										name: 'striped',
										label:'Striped'
									},
									{
										type: 'checkbox',
										name: 'animated',
										label:'Animated'
									}
									],
									onsubmit: function( e ) {
										var title 		= e.data.title;
										var value 		= e.data.value;
										var unit		= e.data.unit;
										var striped 	= e.data.striped;
										var animated 	= e.data.animated;
										var cssclass 	=  e.data.cssclass;
										var style  	 	= e.data.style;
										var output 		 = '[sama_progressbar';
										if( title != '') output += ' title="'+ title + '"';
										if( value != '') output += ' value="'+ value + '"';
										if( style != '' ) output += ' style="'+ style + '"';
										if( striped == true) output += ' striped="yes"';
										if( animated == true) output += ' animated="yes"';
										if( cssclass != '') {
											output += ' cssclass="' + cssclass + '"';
										}
										output += ']';
										editor.insertContent( output );
									}
								});
							}
						},
						{
							text: 'Social Icon',
							scrollbars:true,
							onclick: function() {
								editor.windowManager.open({
									title: 'Add Social Icon',
									type:'scrollbars',
									scrollbars: true,
									//height: 100%,
									//width:500,
									body: [
									{
										type: 'listbox',
										name: 'type',
										label: 'Type',
										'values': [
											{text: 'fontawesome', value: 'fontawesome'},
											{text: 'image', value: 'image'},
										]
									},
									{
										type: 'listbox',
										name: 'style',
										label: 'style',
										'values': [
											{text: 'Default', value: ''},
											{text: 'Circle', value: 'circle'},
											{text: 'Corner', value: 'corner'},
										]
									},
									{
										type: 'textbox',
										name: 'facebook',
										label: 'Facebook URL',
									},
									{
										type: 'textbox',
										name: 'twitter',
										label: 'Twitter URL',
									},
									{
										type: 'textbox',
										name: 'dribbble',
										label: 'Dribbble URL',
									},
									{
										type: 'textbox',
										name: 'linkedin',
										label: 'Linkedin URL',
									},
									{
										type: 'textbox',
										name: 'gplus',
										label: 'Google Plus URL',
									},
									{
										type: 'textbox',
										name: 'youtube',
										label: 'Youtube Plus URL',
									},
									{
										type: 'textbox',
										name: 'soundcloud',
										label: 'Sound cloud URL',
									},
									{
										type: 'textbox',
										name: 'behance',
										label: 'Behance URL',
									},
									{
										type: 'textbox',
										name: 'vimeo',
										label: 'Viemo URL',
									},
									{
										type: 'textbox',
										name: 'instagram',
										label: 'Instagram URL',
									},
									{
										type: 'textbox',
										name: 'pinterest',
										label: 'Pinterest URL',
									},
									{
										type: 'textbox',
										name: 'tumblr',
										label: 'Tumblr URL',
									},
									{
										type: 'textbox',
										name: 'digg',
										label: 'Digg URL',
									},
									{
										type: 'textbox',
										name: 'lastfm',
										label: 'LastFM URL',
									},
									{
										type: 'textbox',
										name: 'rss',
										label: 'RSS URL',
									},
									{
										type: 'textbox',
										name: 'cssclass',
										label: 'Custom CSS Class',
										tooltip: 'Optional',
									}
									],
									onsubmit: function( e ) {
										var type 		=  e.data.type;
										var style 		=  e.data.style;
										var cssclass 	=  e.data.cssclass;
										var facebook 	= e.data.facebook;
										var twitter 	= e.data.twitter;
										var dribbble 	= e.data.dribbble;
										var linkedin 	= e.data.linkedin;
										var gplus 		= e.data.gplus;
										var youtube 	= e.data.youtube;
										var soundcloud 	= e.data.soundcloud;
										var behance 	= e.data.behance;
										var vimeo 		= e.data.vimeo;
										var instagram 	= e.data.instagram;
										var pinterest 	= e.data.pinterest;
										var tumblr 		= e.data.tumblr;
										var digg 		= e.data.digg;
										var lastfm 		= e.data.lastfm;
										var rss 		= e.data.rss;
										
										var output 		 = '[sama_socialicons';
										if( type != '') {
											output += ' type="' + type + '"';
										}
										if( style != '') {
											output += ' style="' + style + '"';
										} else {
											output += ' style=""';
										}
										if( cssclass != '') {
											output += ' cssclass="' + cssclass + '"';
										}
										if( facebook != '') {
											output += ' facebook="' + facebook + '"';
										} else {
											output += ' facebook=""';
										}
										if( twitter != '') {
											output += ' twitter="' + twitter + '"';
										} else {
											output += ' twitter=""';
										}
										if( dribbble != '') {
											output += ' dribbble="' + dribbble + '"';
										} else {
											output += ' dribbble=""';
										}
										if( linkedin != '') {
											output += ' linkedin="' + linkedin + '"';
										} else {
											output += ' linkedin=""';
										}
										if( gplus != '') {
											output += ' gplus="' + gplus + '"';
										} else {
											output += ' gplus=""';
										}
										if( youtube != '') {
											output += ' youtube="' + youtube + '"';
										} else {
											output += ' youtube=""';
										}
										if( soundcloud != '') {
											output += ' soundcloud="' + soundcloud + '"';
										} else {
											output += ' soundcloud=""';
										}
										if( behance != '') {
											output += ' behance="' + behance + '"';
										} else {
											output += ' behance=""';
										}
										if( vimeo != '') {
											output += ' vimeo="' + vimeo + '"';
										} else {
											output += ' vimeo=""';
										}
										if( instagram != '') {
											output += ' instagram="' + instagram + '"';
										} else {
											output += ' instagram=""';
										}
										if( pinterest != '') {
											output += ' pinterest="' + pinterest + '"';
										} else {
											output += ' pinterest=""';
										}
										if( tumblr != '') {
											output += ' tumblr="' + tumblr + '"';
										} else {
											output += ' tumblr=""';
										}
										if( digg != '') {
											output += ' digg="' + digg + '"';
										} else {
											output += ' digg=""';
										}
										if( lastfm != '') {
											output += ' lastfm="' + lastfm + '"';
										} else {
											output += ' lastfm=""';
										}
										if( rss != '') {
											output += ' rss="' + rss + '"';
										} else {
											output += ' rss=""';
										}
										output += ']';
										editor.insertContent( output );
									}
								});
							}
						},
					]
				},
				{
					text: 'Layout',
					type: 'menuitem',
					menu:[
						{
							text: 'Grid',
							onclick: function() {
								editor.windowManager.open({
									title: 'Add Grid',
									body: [
									{
										type: 'container',
										html: '<p>For more info about <i><a target="_blank" href="http://getbootstrap.com/css/#grid">grid layout</a></i>.</p>',
										
									},
									{
										type: 'listbox',
										name: 'type',
										label: 'Grid type',
										'values': [
											{text: 'Default Fixed Width', value: 'fixed-width'},
											{text: 'Full Width', value: 'full-width'},
										]
									},
									{
										type: 'listbox',
										name: 'columns',
										label: 'Number Of Columns',
										'values': [
											{text: '1', value: '1'},
											{text: '2', value: '2'},
											{text: '3', value: '3'},
											{text: '4', value: '4'},
										]
									},
									{
										type: 'textbox',
										name: 'cssclass',
										label: 'Custom CSS Class'
									}],
									onsubmit: function( e ) {
										var columns = e.data.columns;
										var type = e.data.type;
										var cssclass =  e.data.cssclass;
										var output = '[sama_row';
										if(cssclass != '') {
											output += ' cssclass="' + cssclass + '"';
										}
										if(type != '') {
											output += ' type="' + type + '"';
										} else {
											output += ' type="fixed-width"';
										}
										output += ']';
										var i = 1;
										if ( columns < 1 ) columns = 1;
										if ( columns == 1 ) {
											output +='<br class="removebr" />[sama_column cssclass="col-md-12"]<br class="removebr" />Enter Your Content Here<br class="removebr" />[/sama_column]';
										} else if ( columns == 2 ) {
											output +='<br class="removebr" />[sama_column cssclass="col-md-6"]<br class="removebr" />Enter Your Content Here<br class="removebr" />[/sama_column]<br class="removebr" />[sama_column cssclass="col-md-6"]<br class="removebr" />Enter Your Content Here<br class="removebr" />[/sama_column]';
										} else if ( columns == 3 ) {
											output +='<br class="removebr" />[sama_column cssclass="col-md-4"]<br class="removebr" />Enter Your Content Here<br class="removebr" />[/sama_column]<br class="removebr" />[sama_column cssclass="col-md-4"]<br class="removebr" />Enter Your Content Here<br class="removebr" />[/sama_column]<br class="removebr" />[sama_column cssclass="col-md-4"]<br class="removebr" />Enter Your Content Here <br class="removebr" />[/sama_column]';
										} else if ( columns == 4 ) {
											output +='<br class="removebr" />[sama_column cssclass="col-md-3"]<br class="removebr" />Enter Your Content Here<br class="removebr" />[/sama_column]<br class="removebr" />[sama_column cssclass="col-md-3"]<br class="removebr" />Enter Your Content Here<br class="removebr" />[/sama_column]<br class="removebr" />[sama_column cssclass="col-md-3"]<br class="removebr" />Enter Your Content Here<br class="removebr" />[/sama_column]<br class="removebr" />[sama_column cssclass="col-md-3"]<br class="removebr" />Enter Your Content Here<br class="removebr" />[/sama_column]';
										}
										output += '<br class="removebr" />[/sama_row]';
										editor.insertContent( output );
									}
								});
							}
						},
						{
							text: 'Columns',
							onclick: function() {
								editor.windowManager.open({
									title: 'Add Columns',
									body: [
									{
										type: 'listbox',
										name: 'columns',
										label: 'Number Of Columns',
										'values': [
											{text: '1', value: '1'},
											{text: '2', value: '2'},
											{text: '3', value: '3'},
											{text: '4', value: '4'},
										]
									}],
									onsubmit: function( e ) {
										var columns = e.data.columns;
										var output = '';
						
										var i = 1;
										if ( columns < 1 ) columns = 1;
										if ( columns == 1 ) {
											output +='[sama_column cssclass="col-md-12"]<br class="removebr" />Enter Your Content Here<br class="removebr" />[/sama_column]';
										} else if ( columns == 2 ) {
											output +='[sama_column cssclass="col-md-6"]<br class="removebr" />Enter Your Content Here<br class="removebr" />[/sama_column][sama_column cssclass="col-md-6"]<br class="removebr" />Enter Your Content Here<br class="removebr" />[/sama_column]';
										} else if ( columns == 3 ) {
											output +='[sama_column cssclass="col-md-4"]<br class="removebr" />Enter Your Content Here<br class="removebr" />[/sama_column][sama_column cssclass="col-md-4"]<br class="removebr" />Enter Your Content Here<br class="removebr" />[/sama_column][sama_column cssclass="col-md-4"]<br class="removebr" />Enter Your Content Here <br class="removebr" />[/sama_column]';
										} else if ( columns == 4 ) {
											output +='[sama_column cssclass="col-md-3"]<br class="removebr" />Enter Your Content Here<br class="removebr" />[/sama_column][sama_column cssclass="col-md-3"]<br class="removebr" />Enter Your Content Here<br class="removebr" />[/sama_column][sama_column cssclass="col-md-3"]<br class="removebr" />Enter Your Content Here<br class="removebr" />[/sama_column][sama_column cssclass="col-md-3"]<br class="removebr" />Enter Your Content Here<br class="removebr" />[/sama_column]';
										}
										editor.insertContent( output );
									}
								});
							}
						},
					]
				},
				{
					text: 'Components',
					type: 'menuitem',
					menu:[
						{
							text: 'Alert & Box',
							onclick: function() {
								editor.windowManager.open({
									title: 'Add Alert & Box',
									body: [
									{
										type: 'listbox',
										name: 'type',
										label: 'Alert Type',
										'values': [
											{text: 'Success', value: 'alert-success'},
											{text: 'Info', value: 'alert-info'},
											{text: 'Warning', value: 'alert-warning'},
											{text: 'danger', value: 'alert-danger'},
										]
									},
									{
										type: 'checkbox',
										name: 'close',
										label: 'Add Close Button'
									},
									{
										type: 'textbox',
										name: 'cssclass',
										label: 'Custom CSS Class'
									}],
									onsubmit: function( e ) {
										var boxclose = e.data.close;
										var type =  e.data.type;
										var boxcssclass =  e.data.cssclass;
										var output = '[sama_alert';
										if( type == '' ) type = 'alert-warning';
										output += ' type="'+ type + '"';
										
										if( boxclose != '' ) {
											boxclose = 'yes';
										} else {
											boxclose = 'no';
										}
										output += ' close="'+ boxclose + '"';
																						
										if(boxcssclass != '') {
											output += ' cssclass="' + boxcssclass + '"';
										}
										
										output += ']<br class="removebr" />';
										var boxcontent = ' Enter your content here.';
										output += boxcontent + '<br class="removebr" />[/sama_alert]';
										editor.insertContent( output );
									}
								});
							}
						},
						{
							text: 'Badges',
							onclick: function() {
								editor.windowManager.open({
									title: 'Add Badges',
									body: [
									{
										type: 'textbox',
										name: 'title',
										label: 'Badges Text'
									},
									{
										type: 'listbox',
										name: 'style',
										label: 'Badges Style',
										'values': [
											{text: 'Style 1', value: 'dropcap'},
											{text: 'Style 2', value: 'dropcap2'},
											{text: 'Style 3', value: 'dropcap3'},
										]
									},
									{
										type: 'textbox',
										name: 'cssclass',
										label: 'Custom CSS Class'
									}],
									onsubmit: function( e ) {
										var title    = e.data.title;
										var cssclass =  e.data.cssclass;
										var style 	 = e.data.style;
										var output = '[sama_badge';
										if(title != '') output += ' title="'+ title + '"';
										output += ' cssclass="'+ cssclass + " " + style + '"';
										output += ']';
										editor.insertContent( output );
									}
								});
							}
						},
						{
							text: 'Blockquote',
							onclick: function() {
								editor.windowManager.open({
									title: 'Add Blockquote',
									body: [
									{
										type: 'listbox',
										name: 'float',
										label: 'Float',
										'values': [
											{text: 'Left', value: 'left'},
											{text: 'Right', value: 'right'},
										]
									},
									{
										type: 'listbox',
										name: 'style',
										label: 'Blockquote Style',
										'values': [
											{text: 'Default', value: 'syyle1'},
											{text: 'Background Gray', value: 'style2'},
											{text: 'Background Color', value: 'style3'},
										]
									},
									{
										type: 'textbox',
										multiline: true,
										minHeight: 50,
										name: 'content',
										label: 'Content'
									},
									{
										type: 'textbox',
										name: 'author',
										label: 'Author [optional]',
										tooltip: 'Optional'
									},
									{
										type: 'textbox',
										name: 'beforsource',
										label: 'Befor Author [optional]',
										tooltip: 'Optional'
									},
									{
										type: 'textbox',
										name: 'cssclass',
										label: 'Custom CSS Class',
										tooltip: 'Optional'
									}],
									onsubmit: function( e ) {
										var quotefloat = e.data.float;
										var content = e.data.content;
										var source = e.data.author;
										var beforsource = e.data.beforsource;
										var cssclass =  e.data.cssclass;
										var style 	 = e.data.style;
										var output = '[sama_blockquote';
										if( quotefloat != '' ) output += ' float="'+ quotefloat + '"';
										if( source != '' ) output += ' source="'+ source + '"';
										if( beforsource != '' ) output += ' beforsource="'+ beforsource + '"';
										if( style != '') {
											output += ' style="' + style + '"';
										} else {
											output += ' style="style1"';
										}
										if( cssclass != '') {
											output += ' cssclass="' + cssclass + '"';
										}
										output += ']';
										
										if( content == '' ) content = '<br class="removebr" />Enter Your Content Here !<br class="removebr" />';
										output += content + '[/sama_blockquote]';
										editor.insertContent( output );
									}
								});
							}
						},
						{
							text: 'Button',
							onclick: function() {
								editor.windowManager.open({
									title: 'Add Button',
									body: [
									{
										type: 'textbox',
										name: 'title',
										label: 'Button Title'
									},
									{
										type: 'textbox',
										name: 'url',
										label: 'URL',
										tooltip: 'This if use type link'
									},
									{
										type: 'textbox',
										name: 'icon',
										label: 'Icon name',
										tooltip: 'Optional full css class for icon from Font Awesome',
									},
									{
										type: 'listbox',
										name: 'target',
										label: 'Target',
										tooltip: 'This if use type link',
										'values': [
											{text: 'Self', value: '_self'},
											{text: 'Blank', value: '_blank'},
										]
									},
									{
										type: 'listbox',
										name: 'bgcolor',
										label: 'Style',
										'values': [
											{text: 'Pomegranate', value: 'alizarin-btn'},
											{text: 'Red light', value: 'pomegranate-btn'},
											{text: 'Turquoise', value: 'turqioise-btn'},
											{text: 'Green Sea', value: 'green_sea-btn'},
											{text: 'emerald', value: 'emerald-btn'},
											{text: 'nephritis', value: 'nephritis-btn'},													
											{text: 'peter river', value: 'peter_river-btn'},
											{text: 'belize hole', value: 'belize_hole-btn'},
											{text: 'amethyst', value: 'amethyst-btn'},
											{text: 'wisteria', value: 'wisteria-btn'},
											{text: 'wet asphalt', value: 'wet_asphalt-btn'},
											{text: 'Midnight blue', value: 'midnight_blue-btn'},
											{text: 'sun flower', value: 'sun_flower-btn'},
											{text: 'Orange', value: 'orange-btn'},
											{text: 'Carrot', value: 'carrot-btn'},
											{text: 'Pumpkin', value: 'pumpkin-btn'},
											{text: 'Brown', value: 'brown-btn'},
											{text: 'Concrete', value: 'concrete-btn'},
											{text: 'Asbestos', value: 'asbestos-btn'},
											{text: 'Silver', value: 'silver-btn'},
										]
									},
									{
										type: 'listbox',
										name: 'size',
										label: 'Size',
										'values': [
											{text: 'small', value: 'small-btn'},
											{text: 'Medium', value: 'medium-btn'},
											{text: 'Large', value: 'big-btn'},
											{text: 'Full Width', value: 'medium-btn full-width-btn'},
										]
									},
									{
										type: 'listbox',
										name: 'border',
										label: 'Display Border',
										'values': [
											{text: 'No', value: 'no'},
											{text: 'Yes', value: 'yes'},
										]
									},
									{
										type: 'listbox',
										name: 'corner',
										label: 'Display Corner',
										'values': [
											{text: 'No', value: 'no'},
											{text: 'Yes', value: 'yes'},
										]
									},
									{
										type: 'textbox',
										name: 'cssclass',
										label: 'Custom CSS Class',
										tooltip: 'Optional'
									}],
									onsubmit: function( e ) {
										var content 	= e.data.title;
										var url 		= e.data.url;
										var icon 		= e.data.icon;
										var target 		= e.data.target;												
										var bgcolor 	= e.data.bgcolor;
										var size 		= e.data.size;
										var border 		= e.data.border;
										var corner 		= e.data.corner;
										var cssclass =  e.data.cssclass;
										
										var output = '[sama_button';
										if( url != '' ) {
											output += ' url="'+ url + '"';
										} else {
											output += ' url="#"';
										}
										if( icon != '' ) {
											output += ' icon="'+ icon + '"';
										} else {
											output += ' icon=""';
										}
										if( target != '' ) output += ' target="'+ target + '"';
										if( bgcolor != '' ) {
											output += ' bgcolor="'+ bgcolor + '"';
										} else {
											output += ' bgcolor=""';
										}
										if( size != '' ) {
											output += ' size="'+ size + '"';
										} else {
											output += ' size="small-btn"';
										}
										if( border != '' ) {
											output += ' border="'+ border + '"';
										} else {
											output += ' border="no"';
										}
										if( corner != '' ) {
											output += ' corner="'+ corner + '"';
										} else {
											output += ' corner="no"';
										}
										if( cssclass != '') {
											output += ' cssclass="' + cssclass + '"';
										}
										output += ']';
										if(content == '') content = " Enter your content here.";
										output += content + "[/sama_button]";
										editor.insertContent( output );
									}
								});
							}
						},
						{
							text: 'Code',
							onclick: function() {
								editor.windowManager.open({
									title: 'Code',
									body: [
									{
										type: 'listbox',
										name: 'type',
										label: 'Type',
										'values': [
											{text: 'Inline', value: 'inline'},
											{text: 'Block', value: 'block'},
										]
									}],
									
									onsubmit: function( e ) {
										var type = e.data.type;
										var output = '[sama_code';
										output += ' type="'+ type + '"';
										output += ']';
										if ( type == 'inline' ) {
											output += ' Enter Your Code Here [/sama_code]';
										} else {
											output += '<br class="removebr" />Enter Your Code Here<br class="removebr" />[/sama_code]';
										}
										output += '[/sama_code]';
										editor.insertContent( output );
									}
								});
							}
						},
						{
							text: 'Label',
							onclick: function() {
								editor.windowManager.open({
									title: 'Add Label',
									body: [
									{
										type: 'textbox',
										name: 'title',
										label: 'Label Text',
									},
									{
										type: 'listbox',
										name: 'style',
										label: 'Style',
										'values': [
											{text: 'Default', value: 'label-default'},
											{text: 'Primary', value: 'label-primary'},
											{text: 'Success', value: 'label-success'},
											{text: 'Info', value: 'label-info'},
											{text: 'Warning', value: 'label-warning'},
											{text: 'Danger', value: 'label-danger'},
										]
									},
									{
										type: 'textbox',
										name: 'cssclass',
										label: 'Custom CSS Class',
										tooltip: 'Optional'
									}],
									onsubmit: function( e ) {
										var title = e.data.title;
										var style = e.data.style;
										var cssclass =  e.data.cssclass;
										
										var output = '[sama_label';
										if(title != '') output += ' title="'+ title + '"';
										if(style != '') output += ' style="'+ style + '"';
										if( cssclass != '') {
											output += ' cssclass="' + cssclass + '"';
										}
										output += ']';
										editor.insertContent( output );
									}
								});
							}
						},
						{
							text: 'Well',
							onclick: function() {
								editor.windowManager.open({
									title: 'Add Well',
									body: [
									{
										type: 'listbox',
										name: 'size',
										label: 'Size',
										'values': [
											{text: 'Large', value: 'well-lg'},
											{text: 'Small', value: 'well-sm'},
										]
									},
									{
										type: 'textbox',
										name: 'cssclass',
										label: 'Custom CSS Class',
										tooltip: 'Optional'
									}],
									onsubmit: function( e ) {
										var size = e.data.size;
										var cssclass =  e.data.cssclass;
										var output = '[sama_well';
										if(size != '') output += ' size="'+ size + '"';
										if( cssclass != '') {
											output += ' cssclass="' + cssclass + '"';
										}
										output += ']<br class="removebr" />Enter Your Content Here<br class="removebr" />[/sama_well]';
										editor.insertContent( output );
									}
								});
							}
						},
						{
							text: 'Panels',
							onclick: function() {
								editor.windowManager.open({
									title: 'Add Panels',
									body: [
									{
										type: 'textbox',
										name: 'title',
										label: 'Panel Header',
									},
									{
										type: 'textbox',
										name: 'icon',
										label: 'Full CSS class for Font Awesome ex "fa fa-eye"',
									},
									{
										type: 'textbox',
										name: 'content',
										label: 'Content',
										tooltip: '',
										multiline: true,
										minHeight: 50,
										minWidth: 250,
									},
									{
										type: 'textbox',
										name: 'footer_content',
										label: 'Footer Content',
										tooltip: 'Display As Footer Optional',
										multiline: true,
										minHeight: 50,
										minWidth: 250,
									},
									{
										type: 'listbox',
										name: 'style',
										label: 'Title Style',
										'values': [
											{text: 'Default', value: 'panel-default'},
											{text: 'Primary', value: 'panel-primary'},
											{text: 'Success', value: 'panel-success'},
											{text: 'Info', value: 'panel-info'},
											{text: 'Warning', value: 'panel-warning'},
											{text: 'Danger', value: 'panel-danger'},													
										]
									},
									{
										type: 'textbox',
										name: 'cssclass',
										label: 'Custom CSS Class',
										tooltip: 'Optional',
									}],
									onsubmit: function( e ) {
										var title 		= e.data.title;
										var icon 		= e.data.icon;
										var content 	= e.data.content;
										var footer_content 	= e.data.footer_content;
										var cssclass 	=  e.data.cssclass;
										var style  	 	= e.data.style;
										var output 		 = '[sama_panel';
										if( title != '') output += ' title="'+ title + '"';
										if( style != '' ) output += ' style="'+ style + '"';
										if( icon != '') {
											output += ' icon="' + icon + '"';
										} else {
											output += ' icon=""';
										}
										if( cssclass != '') {
											output += ' cssclass="' + cssclass + '"';
										}
										output += ']<br class="removebr" />';
										if( content == '') content = ' Enter your title here. ';
										output += '[sama_panel_body]<br class="removebr" />' + content + '<br class="removebr" />[/sama_panel_body]';
										if ( footer_content != '' ) {
											output += '<br class="removebr" />[sama_panel_footer]<br class="removebr" />"' + footer_content + '"<br class="removebr" />[/sama_panel_footer]';
										}
										output += '<br class="removebr" />[/sama_panel]';
										editor.insertContent( output );
									}
								});
							}
						},
						{
							text: 'Jumbotron',
							onclick: function() {
								editor.windowManager.open({
									title: 'Add Jumbotron',
									body: [
									{
										type: 'textbox',
										name: 'cssclass',
										label: 'Custom CSS Class',
										tooltip: 'Optional',
									}],
									onsubmit: function( e ) {
										var cssclass 	=  e.data.cssclass;
										var output 		 = '[sama_jumbotron';
										if( cssclass != '') {
											output += ' cssclass="' + cssclass + '"';
										}
										output += ']<br class="removebr" />Add Your Content Here<br class="removebr" />[/sama_jumbotron]';
										editor.insertContent( output );
									}
								});
							}
						},
					]
				},
				{
					text: 'Java Script',
					type: 'menuitem',
					menu:[
						{
							text: 'Accordions',
							onclick: function() {
								editor.windowManager.open({
									title: 'Add Accordions',
									body: [
									{
										type: 'textbox',
										name: 'nums',
										label: 'Number of Accordions'
									},
									{
										type: 'listbox',
										name: 'style',
										label: 'Style',
										'values': [
											{text: 'Light', value: 'light'},
											{text: 'Dark', value:  'dark'},
										]
									},
									{
										type: 'textbox',
										name: 'cssclass',
										label: 'Custom CSS Class',
										tooltip: 'Optional',
									}],
									onsubmit: function( e ) {
										var numtabs 	= e.data.nums;
										var style 	= e.data.style;
										var cssclass 	=  e.data.cssclass;
										var output = '[sama_accordions';
										if( style != '') {
											output += ' style="' + style + '"';
										} else {
											output += ' style="light"';
										}
										if( cssclass != '') {
											output += ' cssclass="' + cssclass + '"';
										}
										output += ']';
										var i = 1;
										if ( numtabs < 1 ) numtabs = 1;
										for ( i = 1; i <= numtabs; i++ ) {
											if( i== 1 ) {
												output += '<br class="removebr" />[sama_accordion title="Accordions '+i+'" active="in"]<br class="removebr" />* Accordions '+i+' content goes here. *<br class="removebr" />[/sama_accordion]';
											} else {
												output += '<br class="removebr" />[sama_accordion title="Accordions '+i+'" ]<br class="removebr" />* Accordions '+i+' content goes here. *<br class="removebr" />[/sama_accordion]';
											}
										}
										output += '<br class="removebr" />[/sama_accordions]';
										editor.insertContent( output );
									}
								});
							}
						},
						{
							text: 'Popovers',
							onclick: function() {
								editor.windowManager.open({
									title: 'Add Popovers',
									body: [
									{
										type: 'textbox',
										name: 'title',
										label: 'Popovers Text'
									},
									{
										type: 'textbox',
										name: 'titleheader',
										label: 'Popovers Title header',
										tooltip: 'Header Of Popovers display on mouse over',
									},
									{
										type: 'textbox',
										name: 'desc',
										label: 'Popovers Content',
										tooltip: 'display on mouse over',
										multiline: true,
										minHeight: 50,
										minWidth: 250,
									},
									{
										type: 'listbox',
										name: 'direction',
										label: 'Direction',
										'values': [
											{text: 'Top', value: 'top'},
											{text: 'Right', value: 'right'},
											{text: 'Bottom', value: 'bottom'},
											{text: 'Left', value: 'left'},
										]
									},
									{
										type: 'listbox',
										name: 'style',
										label: 'Style',
										tooltip: 'Optional',
										'values': [
											{text: '', value: ''},
											{text: 'Default', value: 'btn-default'},
											{text: 'Primary', value: 'btn-primary'},
											{text: 'Success', value: 'btn-success'},
											{text: 'Info', value: 'btn-info'},
											{text: 'Warning', value: 'btn-warning'},
											{text: 'Danger', value: 'btn-danger'},													
											{text: 'link', value: 'btn-link'},
										]
									},
									{
										type: 'textbox',
										name: 'cssclass',
										label: 'Custom CSS Class',
										tooltip: 'Optional',
									}],
									onsubmit: function( e ) {
										var title 		= e.data.title;
										var header 		= e.data.titleheader;
										var desc 		= e.data.desc;
										var direction 	= e.data.direction;
										var cssclass 	=  e.data.cssclass;
										var size  	 	= e.data.size;
										var style  	 	= e.data.style;
										var output 		 = '[sama_popovers';
										if(header != '') output += ' title="'+ header + '"';
										if(desc != '') output += ' desc="'+ desc + '"';
										if(direction != '') output += ' direction="'+ direction + '"';
										if( style != '' ) output += ' style="'+ style + '"';
										if( cssclass != '') {
											output += ' cssclass="' + cssclass + '"';
										}
										output += ']';
										if(title == '') title = ' Enter your title here.';
										output += title + "[/sama_popovers]";
										editor.insertContent( output );
									}
								});
							}
						},
						{
							text: 'Tabs',
							onclick: function() {
								editor.windowManager.open({
									title: 'Add Tabs',
									body: [
									{
										type: 'textbox',
										name: 'nums',
										label: 'Number of Tabs'
									},
									{
										type: 'listbox',
										name: 'style',
										label: 'Style',
										'values': [
											{text: 'Light', value: 'light'},
											{text: 'Dark', value:  'dark'},
										]
									},
									{
										type: 'textbox',
										name: 'cssclass',
										label: 'Custom CSS Class',
										tooltip: 'Optional',
									}],
									onsubmit: function( e ) {
										var numtabs = e.data.nums;
										var style 	= e.data.style;
										var cssclass =  e.data.cssclass;
										var output = '[sama_tabs';
										if( style != '') {
											output += ' style="' + style + '"';
										} else {
											output += ' style="light"';
										}
										if( cssclass != '') {
											output += ' cssclass="' + cssclass + '"';
										}
										output += ']';
										var i = 1;
										if ( numtabs < 1 ) numtabs = 1;
										for ( i = 1; i <= numtabs; i++)
										{
											output += '<br class="removebr" />[sama_tab title="Tab '+i+'" icon_name="" icon_font="fontawesome"]<br class="removebr" /> Tab '+i+' content goes here.<br class="removebr" />[/sama_tab]';
										}
										output += '<br class="removebr" />[/sama_tabs]';
										editor.insertContent( output );
									}
								});
							}
						},
						{
							text: 'ToolTip',
							onclick: function() {
								editor.windowManager.open({
									title: 'Add ToolTip',
									body: [
									{
										type: 'textbox',
										name: 'title',
										label: 'Tooltip Text'
									},
									{
										type: 'textbox',
										name: 'content',
										label: 'Tooltip Content',
										tooltip: 'display on mouse over',
										multiline: true,
										minHeight: 50,
										minWidth: 250,
									},
									{
										type: 'listbox',
										name: 'direction',
										label: 'Direction',
										'values': [
											{text: 'Top', value: 'top'},
											{text: 'Right', value: 'right'},
											{text: 'Bottom', value: 'bottom'},
											{text: 'Left', value: 'left'},
										]
									},
									{
										type: 'textbox',
										name: 'cssclass',
										label: 'Custom CSS Class',
										tooltip: 'Optional',
									}],
									onsubmit: function( e ) {
										var title 		= e.data.title;
										var content 	= e.data.content;
										var direction 	= e.data.direction;
										var cssclass 	=  e.data.cssclass;
										//var type  	 	= e.data.type;
										//var size  	 	= e.data.size;
										//var style  	 	= e.data.style;
										var output 		 = '[sama_tooltip';
										if(content != '') output += ' desc="'+ content + '"';
										if(direction != '') output += ' direction="'+ direction + '"';
										//if( type != '' ) output += ' type="'+ type + '"';
										//if( style != '' ) output += ' style="'+ style + '"';
										//if( size != '' ) output += ' size="'+ size + '"';
										if( cssclass != '') {
											output += ' cssclass="' + cssclass + '"';
										}
										output += ']';
										if(title == '') title = ' Enter your title here.';
										output += title + "[/sama_tooltip]";
										editor.insertContent( output );
									}
								});
							}
						},


					]
				},
			]
		});
	});

})();