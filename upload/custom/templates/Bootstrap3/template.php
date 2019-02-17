<?php
/*
 *	Made by Samerton
 *  https://github.com/NamelessMC/Nameless/
 *  NamelessMC version 2.0.0-pr5
 *
 *  License: MIT
 *
 *  Bootstrap 3 template
 */

class Bootstrap3_Template extends TemplateBase {
	// Private variable to store language + user
	private $_language, $_user, $_pages;

	// Constructor - set template name, version, Nameless version and author here
	public function __construct($cache, $smarty, $language, $user, $pages){
		$this->_language = $language;
		$this->_user = $user;
		$this->_pages = $pages;

		parent::__construct(
			'Bootstrap 3',
			'1.2.0',
			'2.0.0-pr5',
			'<a href="https://samerton.me/" target="_blank">Samerton</a>'
		);

		// Theme
		$cache->setCache('bs3_template');
		if($cache->isCached('bootswatch')){
			$theme = $cache->retrieve('bootswatch');
		} else {
			$theme = 'default';
			$cache->store('bootswatch', 'default');
		}

		if($cache->isCached('nav_style')){
			$nav_style = $cache->retrieve('nav_style');
		} else {
			$nav_style = 'default';
			$cache->store('nav_style', 'default');
		}

		// Add any CSS files here
		$this->addCSSFiles(array(
			(defined('CONFIG_PATH') ? CONFIG_PATH : '') . '/custom/templates/Bootstrap3/css/' . $theme . '.min.css' => array(),
			(defined('CONFIG_PATH') ? CONFIG_PATH : '') . '/core/assets/css/custom.css' => array(),
			(defined('CONFIG_PATH') ? CONFIG_PATH : '') . '/core/assets/css/font-awesome.min.css' => array(),
			(defined('CONFIG_PATH') ? CONFIG_PATH : '') . '/core/assets/plugins/toastr/toastr.min.css' => array(),
			(defined('CONFIG_PATH') ? CONFIG_PATH : '') . '/custom/templates/Bootstrap3/css/custom.css' => array()
		));

		// Add any JS files here
		$this->addJSFiles(array(
			(defined('CONFIG_PATH') ? CONFIG_PATH : '') . '/custom/templates/Bootstrap3/js/jquery.min.js' => array(),
			(defined('CONFIG_PATH') ? CONFIG_PATH : '') . '/custom/templates/Bootstrap3/js/bootstrap.min.js' => array(),
			(defined('CONFIG_PATH') ? CONFIG_PATH : '') . '/core/assets/plugins/toastr/toastr.min.js' => array(),
			(defined('CONFIG_PATH') ? CONFIG_PATH : '') . '/core/assets/js/jquery.cookie.js' => array()
		));

		// Add any JS code here
		$this->addJSScript(
			'
			    $(function () {
			       $(".pop").popover({ trigger: "manual" , html: true, animation:false, placement: "top" })
				    .on("mouseenter", function () {
				        var _this = this;
				        $(this).popover("show");
				        $(".popover").on("mouseleave", function () {
				            $(_this).popover(\'hide\');
				        });
				    }).on("mouseleave", function () {
				        var _this = this;
				        setTimeout(function () {
				            if (!$(".popover:hover").length) {
				                $(_this).popover(\'hide\');
				            }
				        }, 300);
				   });
			    });

				$(function () {
				      $(\'[data-toggle="tooltip"]\').tooltip()
				});
				$(function () {
				      $(\'[rel="tooltip"]\').tooltip()
				});

				$(\'[data-toggle="popover"]\').popover({ trigger: "manual" , html: true, animation:false}).on("mouseenter", function () {
				      var _this = this;
				      $(this).popover("show");
				      $(".popover").on("mouseleave", function () {
				        $(_this).popover(\'hide\');
				      });
				      }).on("mouseleave", function () {
				      var _this = this;
				      setTimeout(function () {
				        if (!$(".popover:hover").length) {
				          $(_this).popover("hide");
				        }
				      }, 300);
			    });
				
				$(document).ready(function(){
					var cachedUsers = {};
					var timeoutId;

				   $(\'*[data-poload]\').mouseenter(function (){
				   	var elem = this;
				   	if(!timeoutId){
				        timeoutId = window.setTimeout(function() {
				            timeoutId = null;
						    var data = cachedUsers[$(elem).data(\'poload\')];
						    $(elem).popover({trigger:"manual",animation:false,content:data.html}).popover("show");
						    $(\'.popover\').mouseleave(function (){
						        if(!$(".popover:hover").length){
						          $(this).popover("hide");
						        }
						    });
				       }, 1000);
				       
				       // Get data now
				       $.get($(elem).data(\'poload\'), function(d) {
				            ' . ((defined('DEBUGGING') && DEBUGGING == 1) ? 'console.log(d);' : '') . '
				            var data = JSON.parse(d);
					        cachedUsers[$(elem).data(\'poload\')] = data;
					        // Preload image
					        var tmp = document.createElement(\'div\');
					        tmp.innerHTML = data.html;
					        var img = tmp.getElementsByTagName(\'img\')[0];
					        var image = new Image();
					        image.src = img.src;
				       });
				    }
				   }).mouseleave(function (){
					   var elem = this;
					   if(timeoutId){
					        window.clearTimeout(timeoutId);
					        timeoutId = null;
					   } else {
					      setTimeout(function () {
					        if(!$(".popover:hover").length){
					          $(elem).popover("hide");
					        }
					      }, 200);
					   }
				   });
				});
				
			    function copyToClipboard(element) {
			      var $temp = $("<input>");
			      $("body").append($temp);
			      $temp.val($(element).text()).select();
			      document.execCommand("copy");
			      $temp.remove();

			      toastr.options.onclick = function () {};
			      toastr.options.progressBar = true;
			      toastr.options.closeButton = true;
			      toastr.options.positionClass = \'toast-bottom-left\'
			      toastr.success("' . $this->_language->get('general', 'copied') . '");
			    }
			'
		);

		// Check to see if the user is logged in, and if so, add any JS/CSS
		if($this->_user->isLoggedIn()){
			$this->addJSScript(
				'
				    <!-- Alerts -->
				    $(document).ready(function() {
				      // Request permission for browser notifications
				      if(Notification){
				        if (Notification.permission !== "granted")
				        Notification.requestPermission();
				      }

				      toastr.options.closeButton = true;
				      toastr.options.positionClass = \'toast-bottom-left\';

				      // Get alerts and messages, and then set them to refresh every 20 seconds
				      $.getJSON(\'' . URL::build('/queries/pms') . '\', function(data) {
				        var pm_dropdown = document.getElementById(\'pm_dropdown\');
				
				        if(data.value > 0){
				          $("#pms").html(\' <i class="fa fa-exclamation-circle custom-nav-exclaim"></i>\');
				
						  $("#pm_dropdown").children().get(0).remove();
				
						  for(i in data.pms){
							$("#pm_dropdown").prepend(\'<li><a href="' . URL::build('/user/messaging/', 'action=view&amp;message=') . '\' + data.pms[i].id + \'">\' + data.pms[i].title + \'</a></li>\');
						  }
				
				        } else {
				          document.getElementById(\'pm_loading\').innerHTML = "<a>' . $language->get('user', 'no_messages') . '</a>";
				        }
				      });
				      $.getJSON(\'' . URL::build('/queries/alerts'). '\', function(data) {
				        var alert_dropdown = document.getElementById(\'alert_dropdown\');
				
				        if(data.value > 0){
				          $("#alerts").html(\' <i class="fa fa-exclamation-circle custom-nav-exclaim"></i>\');
				
				          $("#alert_dropdown").children().get(0).remove();
				
				          for(i in data.alerts){
							$("#alert_dropdown").prepend(\'<li><a href="' . URL::build('/user/alerts/', 'view=') . '\' + data.alerts[i].id + \'">\' + data.alerts[i].content_short + \'</a></li>\');
				          }
				
				        } else {
				          document.getElementById(\'alert_loading\').innerHTML = "<a>' . $language->get('user', 'no_alerts') . '</a>";
				        }
				      });
				
				      $.getJSON(\'' . URL::build('/queries/servers'). '\', function(data) {});
				
				      window.setInterval(function(){
				        $.getJSON(\'' . URL::build('/queries/pms') . '\', function(data) {
				        if(data.value > 0 && $(\'#pms\').is(\':empty\')){
				          $("#pms").html(\' <i class="fa fa-exclamation-circle custom-nav-exclaim"></i>\');
				          toastr.options.onclick = function () {
				            window.location.href = "' . URL::build('/user/messaging') . '";
				          };
				
				          var x_messages = \'' . $language->get('user', 'x_new_messages') . '\';
				          toastr.info(x_messages.replace("{x}", data.value));
				
				          // Update navbar dropdown
				          $("#pms").html(\' <i class="fa fa-exclamation-circle custom-nav-exclaim"></i>\');
				
						  if($(\'#pm_loading\').length){
							  $("#pm_dropdown").children().get(0).remove();
						  }
				
				          for(i in data.pms){
				            $("#pm_dropdown").prepend(\'<li><a href="' . URL::build('/user/messaging/', 'action=view&amp;message=') . '\' + data.pms[i].id + \'">\' + data.pms[i].title + \'</a></li>\');
				          }
				
				          // Desktop notification
				          if (Notification.permission !== "granted")
				            Notification.requestPermission();
				          else {
				            var notification = new Notification(\'' . SITE_NAME . '\', {
				              body: x_messages.replace("{x}", data.value),
				            });
				
				            notification.onclick = function () {
				              window.open("' . Output::getClean(rtrim(Util::getSelfURL(), '/')) . URL::build('/user/messaging') . '");
				            };
				
				          }
				        }
				        });
				        $.getJSON(\'' . URL::build('/queries/alerts') . '\', function(data) {
				        if(data.value > 0 && $(\'#alerts\').is(\':empty\')){
				          $("#alerts").html(\' <i class="fa fa-exclamation-circle custom-nav-exclaim"></i>\');
				          toastr.options.onclick = function () {
				            window.location.href = "' . URL::build('/user/alerts') . '";
				          };
				
				          var x_alerts = \'' . $language->get('user', 'x_new_alerts') . '\';
				          toastr.info(x_alerts.replace("{x}", data.value));
				
				          // Update navbar dropdown
				          $("#alerts").html(\' <i class="fa fa-exclamation-circle custom-nav-exclaim"></i>\');
				
						  if($(\'#alert_loading\').length){
							  $("#alert_dropdown").children().get(0).remove();
						  }
				
				          for(i in data.alerts){
				            $("#alert_dropdown").prepend(\'<li><a href="' . URL::build('/user/alerts/', 'view=') . '\' + data.alerts[i].id + \'">\' + data.alerts[i].content_short + \'</a></li>\');
				          }
				
				          // Desktop notification
				          if (Notification.permission !== "granted")
				            Notification.requestPermission();
				          else {
				            var notification = new Notification(\'' . SITE_NAME . '\', {
				              body: x_alerts.replace("{x}", data.value),
				            });
				
				            notification.onclick = function () {
				              window.open("' . Output::getClean(rtrim(Util::getSelfURL(), '/')) . URL::build('/user/alerts') . '");
				            };
				
				          }
				        }
				        });
				      }, 20000);
				    });
				
				    $(\'.alert-dropdown, .pm-dropdown\').hover(
				          function() {
				              $(this).find(\'.dropdown-menu\').stop(true, true).delay(25).fadeIn();
				          },
				          function() {
				              $(this).find(\'.dropdown-menu\').stop(true, true).delay(25).fadeOut();
				          }
				    );
				
				    $(\'.alert-dropdown-menu, .pm-dropdown-menu\').hover(
				          function() {
				              $(this).stop(true, true);
				          },
				          function() {
				              $(this).stop(true, true).delay(25).fadeOut();
				          }
				    );
				      
				      // Warnings
				    if($(\'div.show-punishment\').length){
				        $(\'.show-punishment\').modal(\'show\');
				    }
				'
			);
		} else {
			// User is not logged in - display cookie notice
			if(defined('COOKIE_NOTICE')){
				$this->addJSScript(
					'
					toastr.options.timeOut = 0;
		            toastr.options.extendedTimeOut = 0;
		            toastr.options.closeButton = true;

		            toastr.options.onclick = function() { $(\'.toast .toast-close-button\').focus(); }
		            toastr.options.onHidden = function() { $.cookie(\'accept\', \'accepted\', { path: \'/\' }); }

		            toastr.options.positionClass = \'toast-bottom-left\';

		            toastr.info(\'' . $this->_language->get('general', 'cookie_notice') . '\');
					'
				);
			}
		}

		// Editor skin (moono-lisa or moono-dark)
		define('TEMPLATE_EDITOR_STYLE', 'moono-lisa');

		// Assign any Smarty variables
		$smarty->assign('NAV_STYLE', Output::getClean($nav_style));
	}

	// Add any CSS/JS as the page is about to be loaded - here we can get the page name that we are on
	public function onPageLoad(){
		if(defined('PAGE_LOADING') && PAGE_LOADING == 1){
			$this->addJSScript(
				'
				  	var timer = \'' . PAGE_LOAD_TIME . '\';
  	                $(\'#page_load_tooltip\').attr(\'title\', timer).tooltip();
				'
			);
		}

		if(defined('PAGE')){
			if(PAGE == 'cc_messaging'){ // cc_messaging = UserCP -> Messaging
				$this->addCSSFiles(array(
					(defined('CONFIG_PATH') ? CONFIG_PATH : '') . '/core/assets/css/jquery-ui.min.css' => array()
				));

				$this->addJSFiles(array(
					(defined('CONFIG_PATH') ? CONFIG_PATH : '') . '/custom/templates/Bootstrap3/js/bootstrap3-typeahead.min.js' => array(),
					(defined('CONFIG_PATH') ? CONFIG_PATH : '') . '/core/assets/js/jquery-ui.min.js' => array()
				));

			} else if(PAGE == 'login' || PAGE == 'register' || PAGE == 'complete_signup'){ // checkbox for login/register/complete_signup pages
				$this->addJSScript(
					'
					  	$(function () {
					        $(\'.button-checkbox\').each(function () {
					            // Settings
					            var $widget = $(this),
					                $button = $widget.find(\'button\'),
					                $checkbox = $widget.find(\'input:checkbox\'),
					                color = $button.data(\'color\'),
					                settings = {
					                    on: {
					                        icon: \'fa fa-check-square-o\'
					                    },
					                    off: {
					                        icon: \'fa fa-square-o\'
					                    }
					                };
					            // Event Handlers
					            $button.on(\'click\', function () {
					                $checkbox.prop(\'checked\', !$checkbox.is(\':checked\'));
					                $checkbox.triggerHandler(\'change\');
					                updateDisplay();
					            });
					            $checkbox.on(\'change\', function () {
					                updateDisplay();
					            });
					            // Actions
					            function updateDisplay() {
					                var isChecked = $checkbox.is(\':checked\');
					                // Set the button\'s state
					                $button.data(\'state\', (isChecked) ? "on" : "off");
					                // Set the button\'s icon
					                $button.find(\'.state-icon\')
					                    .removeClass()
					                    .addClass(\'state-icon \' + settings[$button.data(\'state\')].icon);
					                // Update the button\'s colour
					                if (isChecked) {
					                    $button
					                        .removeClass(\'btn-default\')
					                        .addClass(\'btn-\' + color + \' active\');
					                }
					                else {
					                    $button
					                        .removeClass(\'btn-\' + color + \' active\')
					                        .addClass(\'btn-default\');
					                }
					            }
					            // Initialisation
					            function init() {
					                updateDisplay();
					                // Inject the icon if applicable
					                if ($button.find(\'.state-icon\').length == 0) {
					                    $button.prepend(\'<i class="state-icon \' + settings[$button.data(\'state\')].icon + \'"></i>\');
					                }
					            }
					            init();
					        });
					    });
					'
				);
			} else if(PAGE == 'status'){ // Server status page
				$this->addJSScript(
					'
					  	$(document).ready(function(){
					        $(".server").each(function(){
					            let serverId = $(this).data("id");
					            let serverBungee = $(this).data("bungee");
					            let serverPlayerList = $(this).data("players");
					            $.getJSON("' . URL::build('/queries/server/', 'id=') . '" + serverId, function(data){
									var html = "";
									if(data.status_value == 1){
										$("#server" + serverId).addClass("bg-success text-white");
										html = "<p>" + data.player_count + "/" + data.player_count_max + "</p>";
										if(serverBungee == 1){
									        html += "<p>' . $this->_language->get('general', 'bungee_instance') . '</p>";
										} else {
										    if(serverPlayerList == 1){
										        if(data.player_list.length > 0){
										            html += "<p>";
										            let avatarSource = "' . Util::getAvatarSource() . '";
										            for(var i = 0; i < data.player_list.length; i++){
										                html += "<a href=\"' . URL::build('/profile/') . '" + data.player_list[i].name + "\"><img style=\"margin-bottom:3px;max-width:32px;max-height:32px;\" data-toggle=\"tooltip\" title=\"" + data.player_list[i].name + "\" src=\"" + avatarSource.replace("{x}", data.player_list[i].id).replace("{y}", 64) + "\" class=\"rounded\" alt=\"" + data.player_list[i].name + "\"></a> ";
										            }
										            html += "</p>";
										            
										            if(data.player_list.length < data.player_count){
										                let andXMore = "' . $this->_language->get('general', 'and_x_more') . '";
										                html += "<p><span class=\"badge badge-secondary\">" + andXMore.replace("{x}", (data.player_count - data.player_list.length)) + "</span></p>";
										            }
										        } else {
										            html += "<p>' . $this->_language->get('general', 'no_players_online') . '</p>";
										        }
										    }
										}
									} else {
										$("#server" + serverId).addClass("bg-danger text-white");
										html = "<p>0/0</p><p>' . $this->_language->get('general', 'offline') . '</p>";
									}
									
									$("#content" + serverId).html(html);
									$(\'[data-toggle="tooltip"]\').tooltip();
								});
					        });
					    });
					'
				);
			} else if(PAGE == 'profile'){
				$this->addJSScript('
				  $(\'#imageModal\').on(\'show.bs.modal\', function (e) {
					$("select").imagepicker();
				  });
				');

				if($this->_user->isLoggedIn()){
					$this->addJSScript('
					    function deletePost(post) {
				            if(confirm("' . $this->_language->get('user', 'confirm_delete') . '")){
				                document.getElementById("delete" + post).submit();
				            }
				        }
				        function deleteReply(post) {
				            if(confirm("' . $this->_language->get('user', 'confirm_delete') . '")){
				                document.getElementById("deleteReply" + post).submit();
				            }
				        }
					');
				}
			}
		}

		// View topic highlight
		if(isset($_GET['route']))
			$route = rtrim($_GET['route'], '/');
		else
			$route = '/';

		if(strpos($route, '/forum/topic/') !== false){
			$this->addJSFiles(array(
				(defined('CONFIG_PATH') ? CONFIG_PATH : '') . '/core/assets/js/jquery-ui.min.js' => array()
			));

			$this->addJSScript(
				'
				  $(document).ready(function(){
					var hash = window.location.hash.substring(1);
					$("#" + hash).effect("highlight", {}, 2000);
					(function() {
					    if (document.location.hash) {
					        setTimeout(function() {
					            window.scrollTo(window.scrollX, window.scrollY - 110);
					        }, 10);
					    }
					})();
			      });
				'
			);
		}

		// Any AJAX scripts to load?
		if(count($this->_pages->getAjaxScripts())){
			$js = '';
			foreach($this->_pages->getAjaxScripts() as $ajax_script){
				$js .= '$.getJSON(\'' . $ajax_script . '\', function(data) {});';
			}
			$this->addJSScript($js);
		}
	}
}

$template = new Bootstrap3_Template($cache, $smarty, $language, $user, $pages);

