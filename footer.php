		<!-- basic scripts -->

		<!--[if !IE]> -->

		 <script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		 </script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		 <script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		 </script>
		 <script src="assets/js/bootstrap.min.js"></script>
		 <script src="assets/js/typeahead-bs2.min.js"></script>

		<!-- page specific plugin scripts -->
		<script src="assets/js/jquery-ui-1.10.3.full.min.js"></script>
		<script src="assets/js/bootstrap-colorpicker.min.js"></script>
		<script src="assets/js/jquery.ui.touch-punch.min.js"></script>

		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->
		
		<script src="assets/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="assets/js/jquery.gritter.min.js"></script>
		<script src="assets/js/bootbox.min.js"></script>
		<script src="assets/js/jquery.slimscroll.min.js"></script>
		<script src="assets/js/jquery.easy-pie-chart.min.js"></script>
		<script src="assets/js/jquery.hotkeys.min.js"></script>
		<script src="assets/js/bootstrap-wysiwyg.min.js"></script>
		<script src="assets/js/select2.min.js"></script>
		<script src="assets/js/bootstrap-colorpicker.min.js"></script>
		<script src="assets/js/date-time/bootstrap-datepicker.min.js"></script>
		<!--<script src="assets/js/fuelux/fuelux.spinner.min.js"></script>-->
		<script src="assets/js/x-editable/bootstrap-editable.min.js"></script>
		<script src="assets/js/x-editable/ace-editable.min.js"></script>
		<script src="assets/js/jquery.maskedinput.min.js"></script>
		
		<script src="assets/js/chosen.jquery.min.js"></script>

		<!--Heigh Chart-->
	     <script src="assets/js/highcharts.js"></script>
		<script src="assets/js/charting.js"></script>
		<!--Heigh Chart-->
		
		<script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/jquery.dataTables.bootstrap.js"></script>


		<!-- ace scripts -->

		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->

		<script type="text/javascript">
			jQuery(function($) {
			
				//editables on first profile page
				$.fn.editable.defaults.mode = 'inline';
				$.fn.editableform.loading = "<div class='editableform-loading'><i class='light-blue icon-2x icon-spinner icon-spin'></i></div>";
			    $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="icon-ok icon-white"></i></button>'+
			                                '<button type="button" class="btn editable-cancel"><i class="icon-remove"></i></button>';    
				
				//editables 
			    $('#username').editable({
					type: 'text',
					name: 'username'
			    });
			
			
				var countries = [];
			    $.each({ "CA": "Canada", "IN": "India", "NL": "Netherlands", "TR": "Turkey", "US": "United States"}, function(k, v) {
			        countries.push({id: k, text: v});
			    });
			
				var cities = [];
				cities["CA"] = [];
				$.each(["Toronto", "Ottawa", "Calgary", "Vancouver"] , function(k, v){
					cities["CA"].push({id: v, text: v});
				});
				cities["IN"] = [];
				$.each(["Delhi", "Mumbai", "Bangalore"] , function(k, v){
					cities["IN"].push({id: v, text: v});
				});
				cities["NL"] = [];
				$.each(["Amsterdam", "Rotterdam", "The Hague"] , function(k, v){
					cities["NL"].push({id: v, text: v});
				});
				cities["TR"] = [];
				$.each(["Ankara", "Istanbul", "Izmir"] , function(k, v){
					cities["TR"].push({id: v, text: v});
				});
				cities["US"] = [];
				$.each(["New York", "Miami", "Los Angeles", "Chicago", "Wysconsin"] , function(k, v){
					cities["US"].push({id: v, text: v});
				});
				
				var currentValue = "NL";
			    $('#country').editable({
					type: 'select2',
					value : 'NL',
			        source: countries,
					success: function(response, newValue) {
						if(currentValue == newValue) return;
						currentValue = newValue;
						
						var new_source = (!newValue || newValue == "") ? [] : cities[newValue];
						
						//the destroy method is causing errors in x-editable v1.4.6
						//it worked fine in v1.4.5
						/**			
						$('#city').editable('destroy').editable({
							type: 'select2',
							source: new_source
						}).editable('setValue', null);
						*/
						
						//so we remove it altogether and create a new element
						var city = $('#city').removeAttr('id').get(0);
						$(city).clone().attr('id', 'city').text('Select City').editable({
							type: 'select2',
							value : null,
							source: new_source
						}).insertAfter(city);//insert it after previous instance
						$(city).remove();//remove previous instance
						
					}
			    });
			
				$('#city').editable({
					type: 'select2',
					value : 'Amsterdam',
			        source: cities[currentValue]
			    });
			
			
			
				$('#signup').editable({
					type: 'date',
					format: 'yyyy-mm-dd',
					viewformat: 'dd/mm/yyyy',
					datepicker: {
						weekStart: 1
					}
				});
			
			    $('#age').editable({
			        type: 'spinner',
					name : 'age',
					spinner : {
						min : 16, max:99, step:1
					}
				});
				
				//var $range = document.createElement("INPUT");
				//$range.type = 'range';
			    $('#login').editable({
			        type: 'slider',//$range.type == 'range' ? 'range' : 'slider',
					name : 'login',
					slider : {
						min : 1, max:50, width:100
					},
					success: function(response, newValue) {
						if(parseInt(newValue) == 1)
							$(this).html(newValue + " hour ago");
						else $(this).html(newValue + " hours ago");
					}
				});
			
				$('#about').editable({
					mode: 'inline',
			        type: 'wysiwyg',
					name : 'about',
					wysiwyg : {
						//css : {'max-width':'300px'}
					},
					success: function(response, newValue) {
					}
				});
				
				
				
				
			
				//another option is using modals
				$('#avatar2').on('click', function(){
					var modal = 
					'<div class="modal hide fade">\
						<div class="modal-header">\
							<button type="button" class="close" data-dismiss="modal">&times;</button>\
							<h4 class="blue">Change Avatar</h4>\
						</div>\
						\
						<form class="no-margin">\
						<div class="modal-body">\
							<div class="space-4"></div>\
							<div style="width:75%;margin-left:12%;"><input type="file" name="file-input" /></div>\
						</div>\
						\
						<div class="modal-footer center">\
							<button type="submit" class="btn btn-small btn-success"><i class="icon-ok"></i> Submit</button>\
							<button type="button" class="btn btn-small" data-dismiss="modal"><i class="icon-remove"></i> Cancel</button>\
						</div>\
						</form>\
					</div>';
					
					
					var modal = $(modal);
					modal.modal("show").on("hidden", function(){
						modal.remove();
					});
			
					var working = false;
			
					var form = modal.find('form:eq(0)');
					var file = form.find('input[type=file]').eq(0);
					file.ace_file_input({
						style:'well',
						btn_choose:'Click to choose new avatar',
						btn_change:null,
						no_icon:'icon-picture',
						thumbnail:'small',
						before_remove: function() {
							//don't remove/reset files while being uploaded
							return !working;
						},
						before_change: function(files, dropped) {
							var file = files[0];
							if(typeof file === "string") {
								//file is just a file name here (in browsers that don't support FileReader API)
								if(! (/\.(jpe?g|png|gif)$/i).test(file) ) return false;
							}
							else {//file is a File object
								var type = $.trim(file.type);
								if( ( type.length > 0 && ! (/^image\/(jpe?g|png|gif)$/i).test(type) )
										|| ( type.length == 0 && ! (/\.(jpe?g|png|gif)$/i).test(file.name) )//for android default browser!
									) return false;
			
								if( file.size > 110000 ) {//~100Kb
									return false;
								}
							}
			
							return true;
						}
					});
			
					form.on('submit', function(){
						if(!file.data('ace_input_files')) return false;
						
						file.ace_file_input('disable');
						form.find('button').attr('disabled', 'disabled');
						form.find('.modal-body').append("<div class='center'><i class='icon-spinner icon-spin bigger-150 orange'></i></div>");
						
						var deferred = new $.Deferred;
						working = true;
						deferred.done(function() {
							form.find('button').removeAttr('disabled');
							form.find('input[type=file]').ace_file_input('enable');
							form.find('.modal-body > :last-child').remove();
							
							modal.modal("hide");
			
							var thumb = file.next().find('img').data('thumb');
							if(thumb) $('#avatar2').get(0).src = thumb;
			
							working = false;
						});
						
						
						setTimeout(function(){
							deferred.resolve();
						} , parseInt(Math.random() * 800 + 800));
			
						return false;
					});
							
				});
				$('#colorpicker1').colorpicker();
				$('#colorpicker2').colorpicker();
				$('#colorpicker3').colorpicker();
				$('#colorpicker4').colorpicker();
				$('#colorpicker5').colorpicker();
				$('#colorpicker6').colorpicker();
				
				
				$('#colorpicker7').colorpicker();
				$('#colorpicker8').colorpicker();
				$('#colorpicker9').colorpicker();
				$('#colorpicker10').colorpicker();
				$('#colorpicker11').colorpicker();
				$('#colorpicker12').colorpicker();
				
				$('#colorpicker13').colorpicker();
				$('#colorpicker14').colorpicker();
				$('#colorpicker15').colorpicker();
				$('#colorpicker16').colorpicker();
				$('#colorpicker17').colorpicker();
				$('#colorpicker18').colorpicker();
				
				$( "#colorpicker1,#colorpicker2,#colorpicker3,#colorpicker4,#colorpicker5,#colorpicker6,#colorpicker7,#colorpicker8,#colorpicker9,#colorpicker10,#colorpicker11,#colorpicker12,#colorpicker13,#colorpicker14,#colorpicker14,#colorpicker15,#colorpicker16,#colorpicker17,#colorpicker18" ).blur(function() {
					var color_val  = $(this).val();
				  $(this).css("background-color",color_val)
				});
					
/* Discard button */
	 var colorArray = ['#b8e4ff','#2d97bf','#fcca11','#ff6600','#8db401','#cdcdcd','#82b6b2','#45738a','#eaa422','#e44f2f','#5e7f54','#a6a6a6','#a3c5c4','#6b9db6','#ffdf88','#ff9a66','#c9e169','#7f7f7f'];

	$('#discardButton').click(function(){
	for(var i=0;i<colorArray.length;i++)
	{
	var id = "#colorpicker" + (i+1);
	$(id).colorpicker('setValue', colorArray[i]);
	$(id).val(colorArray[i]);
	$(id).css('background-color',colorArray[i]);
	} 
	}); 


	$('#discardButtonDays').click(function(){
	$('#spinner').val(30);
	}); 
	
	
	
/* Discard button */ 				
							
				//////////////////////////////
				$('#profile-feed-1').slimScroll({
				height: '250px',
				alwaysVisible : true
				});
			
				$('.profile-social-links > a').tooltip();
			
				$('.easy-pie-chart.percentage').each(function(){
				var barColor = $(this).data('color') || '#555';
				var trackColor = '#E2E2E2';
				var size = parseInt($(this).data('size')) || 72;
				$(this).easyPieChart({
					barColor: barColor,
					trackColor: trackColor,
					scaleColor: false,
					lineCap: 'butt',
					lineWidth: parseInt(size/10),
					animate:false,
					size: size
				}).css('color', barColor);
				});
			  
				///////////////////////////////////////////
			
				//show the user info on right or left depending on its position
				$('#user-profile-2 .memberdiv').on('mouseenter', function(){
					var $this = $(this);
					var $parent = $this.closest('.tab-pane');
			
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $this.offset();
					var w2 = $this.width();
			
					var place = 'left';
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) place = 'right';
					
					$this.find('.popover').removeClass('right left').addClass(place);
				}).on('click', function() {
					return false;
				});
			
			
				///////////////////////////////////////////
				$('#user-profile-3')
				.find('input[type=file]').ace_file_input({
					style:'well',
					btn_choose:'Change avatar',
					btn_change:null,
					no_icon:'icon-picture',
					thumbnail:'large',
					droppable:true,
					before_change: function(files, dropped) {
						var file = files[0];
						if(typeof file === "string") {//files is just a file name here (in browsers that don't support FileReader API)
							if(! (/\.(jpe?g|png|gif)$/i).test(file) ) return false;
						}
						else {//file is a File object
							var type = $.trim(file.type);
							if( ( type.length > 0 && ! (/^image\/(jpe?g|png|gif)$/i).test(type) )
									|| ( type.length == 0 && ! (/\.(jpe?g|png|gif)$/i).test(file.name) )//for android default browser!
								) return false;
			
							if( file.size > 110000 ) {//~100Kb
								return false;
							}
						}
			
						return true;
					}
				})
				.end().find('button[type=reset]').on(ace.click_event, function(){
					$('#user-profile-3 input[type=file]').ace_file_input('reset_input');
				})
				.end().find('.date-picker').datepicker().next().on(ace.click_event, function(){
					$(this).prev().focus();
				})
				$('.input-mask-phone').mask('(999) 999-9999');
			
			
			
				////////////////////
				//change profile
				$('[data-toggle="buttons"] .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					$('.user-profile').parent().addClass('hide');
					$('#user-profile-'+which).parent().removeClass('hide');
				});
			});
			
			//spinner
				var spinner = $( "#spinner" ).spinner({value:30,min:1,max:10000,step:1,
					create: function( event, ui ) {
						//add custom classes and icons
						$(this)
						.next().addClass('btn btn-success').html('<i class="icon-plus"></i>')
						.next().addClass('btn btn-danger').html('<i class="icon-minus"></i>')
						
						//larger buttons on touch devices
						if(ace.click_event == "tap") $(this).closest('.ui-spinner').addClass('ui-spinner-touch');
					}
				});
			</script>
			<script type="text/javascript">
			$(function() {
				var $form = $('#myform');
				var file_input = $form.find('input[type=file]');
				var upload_in_progress = false;
				
				file_input.ace_file_input({
					style : 'well',
					btn_choose : 'Change avatar',
					btn_change: null,
					droppable: true,
					thumbnail: 'large',

					before_remove: function() {
						if(upload_in_progress)
							return false;//if we are in the middle of uploading a file, don't allow resetting file input
						return true;
					},

					before_change: function(files, dropped) {
						var file = files[0];
						if(typeof file == "string") {//files is just a file name here (in browsers that don't support FileReader API)
							if(! (/\.(jpe?g|png|gif)$/i).test(file) ) {
								alert('Please select an image file!');
								return false;
							}
						}
						else {
							var type = $.trim(file.type);
							if( ( type.length > 0 && ! (/^image\/(jpe?g|png|gif)$/i).test(type) )
									|| ( type.length == 0 && ! (/\.(jpe?g|png|gif)$/i).test(file.name) )//for android's default browser!
								) {
									alert('Please select an image file!');
									return false;
								}

							if( file.size > 101965 ) {//~100Kb
								alert('File size should not exceed 100Kb!');
								return false;
							}
						}
						//alert(file.size);
						return true;
					}
				});
				
				
				$form.on('submit', function() {
					var submit_url = $form.attr('action');
					if(!file_input.data('ace_input_files')) return false;//no files selected
					
					var deferred ;
					if( "FormData" in window ) {
						//for modern browsers that support FormData and uploading files via ajax
						var fd = new FormData($form.get(0));
					
						//if file has been drag&dropped , append it to FormData
						if(file_input.data('ace_input_method') == 'drop') {
							var files = file_input.data('ace_input_files');
							if(files && files.length > 0) {
								fd.append(file_input.attr('name'), files[0]);
								//to upload multiple files, the 'name' attribute should be something like this: myfile[]
							}
						}

						upload_in_progress = true;
						deferred = $.ajax({
							url: submit_url,
							type: $form.attr('method'),
							processData: false,
							contentType: false,
							dataType: 'json',
							data: fd,
							xhr: function() {
								var req = $.ajaxSettings.xhr();
								if (req && req.upload) {
									req.upload.addEventListener('progress', function(e) {
										if(e.lengthComputable) {	
											var done = e.loaded || e.position, total = e.total || e.totalSize;
											var percent = parseInt((done/total)*100) + '%';
											//percentage of uploaded file
										}
									}, false);
								}
								return req;
							},
							beforeSend : function() {
							},
							success : function() {
								
							}
						})

					}
					else {
						//for older browsers that don't support FormData and uploading files via ajax
						//we use an iframe to upload the form(file) without leaving the page
						upload_in_progress = true;
						deferred = new $.Deferred
						
						var iframe_id = 'temporary-iframe-'+(new Date()).getTime()+'-'+(parseInt(Math.random()*1000));
						$form.after('<iframe id="'+iframe_id+'" name="'+iframe_id+'" frameborder="0" width="0" height="0" src="about:blank" style="position:absolute;z-index:-1;"></iframe>');
						$form.append('<input type="hidden" name="temporary-iframe-id" value="'+iframe_id+'" />');
						$form.next().data('deferrer' , deferred);//save the deferred object to the iframe
						$form.attr({'method' : 'POST', 'enctype' : 'multipart/form-data',
									'target':iframe_id, 'action':submit_url});

						$form.get(0).submit();
						
						//if we don't receive the response after 60 seconds, declare it as failed!
						setTimeout(function(){
							var iframe = document.getElementById(iframe_id);
							if(iframe != null) {
								iframe.src = "about:blank";
								$(iframe).remove();
								
								deferred.reject({'status':'fail','message':'Timeout!'});
							}
						} , 60000);
					}
					
					
					////////////////////////////
					deferred.done(function(result){
						upload_in_progress = false;
						
						if(result.status == 'OK') {
						//	alert("File successfully saved. Thumbnail is: " + result.img_url)
							var img_url = '<img class="img-responsive" src="'+result.img_url+'" width="180px" height="200px" alt="user image"  />';
							$('#user_img').css({'display':'block'});
							$('#user_img_form').css({'display':'none'});
							$('#user_img').html(img_url);
							alert("File successfully saved")
						}
						else {
							alert("File not saved. " + result.message);
						}
					}).fail(function(res){
						upload_in_progress = false;
						alert("There was an error");						
						//console.log(result.responseText);
					});

					deferred.promise();
					return false;
				});
				
				$form.on('reset', function() {
					file_input.ace_file_input('reset_input');
				});


				if(location.protocol == 'file:') alert("For uploading to server, you should access this page using a webserver.");

			});
		</script>
		<script type="text/javascript">
		$(function() {
			var frm = $('#profile_days');
			frm.submit(function (ev) {
				$.ajax({
					type: frm.attr('method'),
					url: frm.attr('action'),
					data: frm.serialize(),
					success: function (data) {
						$('#profile_days_form_msg').html(data);
					}
				});
		
				ev.preventDefault();
			});
			
			
			

	});
	
		$(function() {
		var frm = $('#profile_color_code');
		frm.submit(function (ev) {
			$.ajax({
				type: frm.attr('method'),
				url: frm.attr('action'),
				data: frm.serialize(),
				success: function (data) {
					$('#profile_color_code_msg').html(data);
				}
			});
		
			ev.preventDefault();
		});
		
		});	
		
		$('#user_img').click(function () {
			$('#user_img').hide();
			$('#user_img_form').show();
        });
		$('#user_img_reset').click(function () {
			$('#user_img').show();
			$('#user_img_form').hide();
        });



			// update unread message on all pages
			
			$('.uread_msg_popup').on('click', function(ev){
			var msgID = $(this).attr("msg-id");
			$("#subject"+msgID).css({"color":"#000000"});		
			 $.post( 
				 "ajax/msgCountAjax.php",
				 { messageID: msgID},
				 function(data) {
					$('#unread-1').text(data);
					$('#unread-2').text('('+data+' unread messages)');
					$('#unread-3').text(data);
					window.location.href = "message.php?id="+msgID;
				 }
			  );
			});	
				

		$(document).ready(function(){
		$.post( 
				 "ajax/notificationsAjax.php",
				 { formID: 0},
				 function(data) {
					$('#notifications').html(data);
				 }
			  );

		$('[data-rel=tooltip]').tooltip({container:'body'});
		}); 


		</script>
			</div>
			</body>
			</html>
