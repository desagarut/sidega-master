/* ------------------------------------------------------------------------------
*
*  # PNotify notifications
*
*  Specific JS code additions for components_notifications_pnotify.html page
*
*  Version: 1.1
*  Latest update: Feb 1, 2016
*
* ---------------------------------------------------------------------------- */

$(function() {


    // Popup notifications
    // ------------------------------

    //
    // Notification styles
    //

    // Default style
    $('#pnotify-default').on('click', function () {
       new PNotify.alert({
            title: 'Default notice',
            text: 'Check me out! I\'m a notice.',
        });
    });

    // primary style
    $('#pnotify-primary').on('click', function () {
       new PNotify.alert({
            title: 'Primary notice',
            text: 'Check me out! I\'m a notice.',
        });
    });

    // Success notification
    $('#pnotify-success').on('click', function () {
       new PNotify.alert({
            title: 'Success notice',
            text: 'Check me out! I\'m a notice.',
            type: 'success'
        });
    });

    // Info notification
    $('#pnotify-info').on('click', function () {
       new PNotify.alert({
            title: 'Info notice',
            text: 'Check me out! I\'m a notice.',
            type: 'info'
        });
    });

    // Danger notification
    $('#pnotify-danger').on('click', function () {
       new PNotify.alert({
            title: 'Danger notice',
            text: 'Check me out! I\'m a notice.',
            type: 'error'
        });
    });

    // Styled left
    $('#pnotify-styled-left').on('click', function () {
       new PNotify.alert({
            title: 'Left icon',
            text: 'Check me out! I\'m a notice.',
            type: 'info'
        });
    });

    // Styled right
    $('#pnotify-styled-right').on('click', function () {
       new PNotify.alert({
            title: 'Right icon',
            text: 'Check me out! I\'m a notice.',
            addclass: 'alert alert-warning alert-styled-right',
            type: 'error'
        });
    });

    // Styled with arrow
    $('#pnotify-styled-arrow').on('click', function () {
       new PNotify.alert({
            title: 'Notice with arrow',
            text: 'Check me out! I\'m a notice.',
            addclass: 'alert alert-styled-left alert-arrow-left',
            type: 'info'
        });
    });

    // Custom style
    $('#pnotify-custom-styled').on('click', function () {
       new PNotify.alert({
            title: 'Custom color notice',
            text: 'Check me out! I\'m a notice.',
            addclass: 'alert alert-styled-left alert-styled-custom alert-arrow-left alpha-teal text-teal-800'
        });
    });

    //
    // Solid color style
    //

    // Solid default
    $('#pnotify-solid-default').on('click', function () {
       new PNotify.alert({
            title: 'default notice',
            text: 'Check me out! I\'m a notice.',
            addclass: 'bg-basic-default'
        });
    });

    // Solid primary
    $('#pnotify-solid-primary').on('click', function () {
       new PNotify.alert({
            title: 'Primary notice',
            text: 'Check me out! I\'m a notice.',
            addclass: 'bg-primary'
        });
    });

    // Solid danger
    $('#pnotify-solid-danger').on('click', function () {
       new PNotify.alert({
            title: 'Danger notice',
            text: 'Check me out! I\'m a notice.',
            addclass: 'bg-danger'
        });
    });

    // Solid success
    $('#pnotify-solid-success').on('click', function () {
       new PNotify.alert({
            title: 'Success notice',
            text: 'Check me out! I\'m a notice.',
            addclass: 'bg-success'
        });
    });

    // Solid warning
    $('#pnotify-solid-warning').on('click', function () {
       new PNotify.alert({
            title: 'Warning notice',
            text: 'Check me out! I\'m a notice.',
            addclass: 'bg-warning'
        });
    });

    // Solid info
    $('#pnotify-solid-info').on('click', function () {
       new PNotify.alert({
            title: 'Info notice',
            text: 'Check me out! I\'m a notice.',
            addclass: 'bg-info'
        });
    });

     // Solid inverse
    $('#pnotify-solid-inverse').on('click', function () {
       new PNotify.alert({
            title: 'Info notice',
            text: 'Check me out! I\'m a notice.',
            addclass: 'bg-inverse'
        });
    });


    // Custom solid color
    $('#pnotify-solid-custom').on('click', function () {
       new PNotify.alert({
            title: 'Custom color notice',
            text: 'Check me out! I\'m a notice.',
            addclass: 'bg-teal'
        });
    });

    // Solid styled left
    $('#pnotify-solid-styled-left').on('click', function () {
       new PNotify.alert({
            title: 'Left icon',
            text: 'Check me out! I\'m a notice.',
            addclass: 'alert bg-primary alert-styled-left'
        });
    });

    // Solid styled right
    $('#pnotify-solid-styled-right').on('click', function () {
       new PNotify.alert({
            title: 'Right icon',
            text: 'Check me out! I\'m a notice.',
            addclass: 'alert bg-danger alert-styled-right',
            type: 'error'
        });
    });



    // Desktop notifications
    // ------------------------------

	// Danger
    $('#pnotify-desktop-notice').on('click', function () {
		PNotify.notice({
		  title: 'Desktop Notice',
		  text: 'I\'ll appear as a desktop notification. Unless I can\'t. I\'ll still appear as a regular PNotify notice then.',
		  modules: {
			Desktop: {
			  desktop: true
			}
		  }
		});
    });
	
    // Danger
    $('#pnotify-desktop-danger').on('click', function () {
		PNotify.error({
		  title: 'Desktop danger',
		  text: 'All done! Come back to my tab!',
		  modules: {
			Desktop: {
			  desktop: true
			}
		  }
		});
    });

    // Success
    $('#pnotify-desktop-success').on('click', function () {
		PNotify.success({
		  title: 'Desktop Success',
		  text: 'All done! Come back to my tab!',
		  modules: {
			Desktop: {
			  desktop: true
			}
		  }
		});
    });

    // Info
    $('#pnotify-desktop-info').on('click', function () {
		PNotify.info({
		  title: 'Desktop Info',
		  text: 'Hey there. Something happened.',
		  modules: {
			Desktop: {
			  desktop: true
			}
		  }
		});
    });



    // Options
    // ------------------------------

    // No title
    $('#pnotify-no-title').on('click', function () {
       new PNotify.alert({
            text: 'Check me out! I\'m a notice without title.',
            addclass: 'bg-primary',
            icon: 'none'
        });
    });

    // Rich content
    $('#pnotify-rich').on('click', function () {
         PNotify.notice({
			title: '<span style="color: green;">Rich Content Notice</' + 'span>',
			titleTrusted: true,
			text: '<span style="color: blue;">Look at my beautiful <strong>strong</' + 'strong>, <em>emphasized</' + 'em>, and <span style="font-size: 1.5em;">large</' + 'span> text.</' + 'span>',
			textTrusted: true
		  });
    });

    // Close on click
    $('#pnotify-click').on('click', function () {
        var notice = PNotify.notice({
		  title: 'Click Close Notice',
		  text: 'Click me anywhere to dismiss me.',
		  modules: {
			Buttons: {
			  closer: false,
			  sticker: false
			}
		  }
		});
		notice.on('click', function() {
		  notice.close();
		});
    });

    // Form
    $('#pnotify-form').on('click', function () {
        var notice =new PNotify.alert({
            text: $('#form_notice').html(),
            width: '300px',
            hide: false,
            addclass: 'bg-slate',
            buttons: {
                closer: false,
                sticker: false
            },
            insert_brs: false
        });

        // Remove if cancelled
        notice.get().find('button[name=cancel]').on('click', function() {
            notice.remove();
        })

        // Submit form
        notice.get().submit(function() {
            var username = $(this).find('input[name=username]').val();
            if (!username) {
                alert('Please provide a username.');
                return false;
            }
            notice.update({
                title: 'Welcome',
                text: 'Successfully logged in as ' + username,
                addclass: 'bg-teal',
                icon: true,
                width: PNotify.prototype.options.width,
                hide: true,
                buttons: {
                    closer: true,
                    sticker: true
                }
            });
            return false;
        });
    });

    // Sticky notice
    $('#pnotify-sticky').on('click', function () {
		PNotify.notice({
		  title: 'Sticky Notice',
		  text: 'Check me out! I\'m a sticky notice. You\'ll have to close me yourself.',
		  hide: false
		});
    });

    // Sticky buttons
    $('#pnotify-sticky-buttons').on('click', function () {
       new PNotify.alert({
            title: 'No sticky button notice',
            text: 'I\'m a sticky notice with no unsticky button. You\'ll have to close me yourself.',
            addclass: 'bg-primary',
            hide: false,
            buttons: {
                sticker: false
            }
        });
    });

    // Permanent buttons
    $('#pnotify-permanent-buttons').on('click', function () {
		PNotify.notice({
		  title: 'Permanent Buttons Notice',
		  text: 'My buttons are really lonely, so they\'re gonna hang out with us.',
		  modules: {
			Buttons: {
			  closerHover: false,
			  stickerHover: false
			}
		  }
		});
    });



    // Modules
    // ------------------------------

    // Confirm
    $('#pnotify-confirm').on('click', function () {
		var notice = PNotify.notice({
		  title: 'Confirmation Needed',
		  text: 'Are you sure?',
		  icon: 'fas fa-question-circle',
		  hide: false,
		  modules: {
			Confirm: {
			  confirm: true
			},
			Buttons: {
			  closer: false,
			  sticker: false
			},
			History: {
			  history: false
			}
		  }
		});
		notice.on('pnotify.confirm', function() {
		  alert('Ok, cool.');
		});
		notice.on('pnotify.cancel', function() {
		  alert('Oh ok. Chicken, I see.');
		});
    });


    // Prompt
    $('#pnotify-prompt').on('click', function () {
		var notice = PNotify.notice({
		  title: 'Input Needed',
		  text: 'What side would you like?',
		  icon: 'fas fa-question-circle',
		  hide: false,
		  modules: {
			Confirm: {
			  prompt: true
			},
			Buttons: {
			  closer: false,
			  sticker: false
			},
			History: {
			  history: false
			}
		  }
		});
		notice.on('pnotify.confirm', function(e) {
		  notice.cancelClose().update({
			title: 'You\'ve Chosen a Side',
			text: 'You want ' + e.value + '.',
			icon: true,
			type: 'info',
			hide: true,
			modules: {
			  Confirm: {
				prompt: false
			  },
			  Buttons: {
				closer: true,
				sticker: true
			  }
			}
		  });
		});
		notice.on('pnotify.cancel', function(e) {
		  notice.cancelClose().update({
			title: 'You Don\'t Want a Side',
			text: 'No soup for you!',
			icon: true,
			type: 'info',
			hide: true,
			modules: {
			  Confirm: {
				prompt: false
			  },
			  Buttons: {
				closer: true,
				sticker: true
			  }
			}
		  });
		});
    });


    // Multiline prompt
    $('#pnotify-multiline').on('click', function () {
		var notice = PNotify.notice({
		  title: 'Input Needed',
		  text: 'Write me a poem, please.',
		  icon: 'fas fa-question-circle',
		  hide: false,
		  modules: {
			Confirm: {
			  prompt: true,
			  promptMultiLine: true,
			  promptValue: 'Roses are red,\nViolets are blue,\n'
			},
			Buttons: {
			  closer: false,
			  sticker: false
			},
			History: {
			  history: false
			}
		  }
		});
		notice.on('pnotify.confirm', function(e) {
		  notice.cancelClose().update({
			title: 'Your Poem',
			text: e.value,
			icon: true,
			type: 'info',
			hide: true,
			modules: {
			  Confirm: {
				prompt: false
			  },
			  Buttons: {
				closer: true,
				sticker: true
			  }
			}
		  });
		});
		notice.on('pnotify.cancel', function(e) {
		  notice.cancelClose().update({
			title: 'You Don\'t Like Poetry',
			text: 'Roses are dead,\nViolets are dead,\nI suck at gardening.',
			icon: true,
			type: 'info',
			hide: true,
			modules: {
			  Confirm: {
				prompt: false
			  },
			  Buttons: {
				closer: true,
				sticker: true
			  }
			}
		  });
		});
    });


    // Custom buttons
    $('#pnotify-buttons').on('click', function () {
		PNotify.notice({
		  title: 'Choose a Side',
		  text: 'You have three options to choose from.',
		  icon: 'fas fa-question-circle',
		  hide: false,
		  modules: {
			Confirm: {
			  confirm: true,
			  buttons: [{
				  text: 'Fries',
				  primary: true,
				  click: function(notice) {
					notice.update({
					  title: 'You\'ve Chosen a Side',
					  text: 'You want fries.',
					  icon: true,
					  type: 'info',
					  hide: true,
					  modules: {
						Confirm: {
						  confirm: false
						},
						Buttons: {
						  closer: true,
						  sticker: true
						}
					  }
					});
				  }
				},
				{
				  text: 'Mash',
				  click: function(notice) {
					notice.update({
					  title: 'You\'ve Chosen a Side',
					  text: 'You want mashed potatoes.',
					  icon: true,
					  type: 'info',
					  hide: true,
					  modules: {
						Confirm: {
						  confirm: false
						},
						Buttons: {
						  closer: true,
						  sticker: true
						}
					  }
					});
				  }
				},
				{
				  text: 'Fruit',
				  click: function(notice) {
					notice.update({
					  title: 'You\'ve Chosen a Side',
					  text: 'You want fruit.',
					  icon: true,
					  type: 'info',
					  hide: true,
					  modules: {
						Confirm: {
						  confirm: false
						},
						Buttons: {
						  closer: true,
						  sticker: true
						}
					  }
					});
				  }
				}
			  ]
			},
			Buttons: {
			  closer: false,
			  sticker: false
			},
			History: {
			  history: false
			}
		  }
		});
    });


    // Permanotice
    $('#pnotify-permanotice').on('click', function () {
        var permanotice;
        if (permanotice) {
            permanotice.open();
        }
        else {
            permanotice =new PNotify.alert({
                title: 'Now look here',
                text: 'There\'s something you need to know, and I won\'t go away until you come to grips with it.',
                addclass: 'bg-danger',
                hide: false,
                buttons: {
                    closer: false,
                    sticker: false
                }
            });
        }
    });


    // Callbacks
	
    $('#pnotify-callbacks').on('click', function () {
		var dontAlert = function() {};
			PNotify.notice({
			  title: 'I\'m Here',
			  text: 'I have a callback for each of my events. I\'ll call all my callbacks while I change states.',
			  modules: {
				Callbacks: {
				  beforeInit: function(opts) {
					console.log('beforeInit', opts);
					alert('I\'m called before the notice initializes. I\'m passed the options used to make the notice. I can modify them. Watch me replace the word callback with tire iron!');
					opts.text = opts.text.replace(/callback/g, 'tire iron');
				  },
				  afterInit: function(notice) {
					console.log('afterInit', notice);
					alert('I\'m called after the notice initializes. I\'m passed the PNotify object for the current notice: ' + notice + '\n\nThere are more callbacks you can assign, but this is the last notice you\'ll see. Check the code to see them all.');
				  },
				  beforeOpen: function(notice) {
					console.log('beforeOpen', notice);
					// Return false to cancel opening.
					dontAlert('I\'m called before the notice opens. I\'m passed the PNotify object for the current notice: ' + notice);
				  },
				  afterOpen: function(notice) {
					console.log('afterOpen', notice);
					dontAlert('I\'m called after the notice opens. I\'m passed the PNotify object for the current notice: ' + notice);
				  },
				  beforeClose: function(notice, timerHide) {
					console.log('beforeClose', notice, timerHide);
					// Return false to cancel close. Use PNotify.queueClose() to set the close timer again.
					dontAlert('I\'m called before the notice closes. I\'m passed the PNotify object for the current notice: ' + notice);
					dontAlert('I also have an argument called timerHide, which is true if the notice was closed because the timer ran down. Value: ' + timerHide);
				  },
				  afterClose: function(notice, timerHide) {
					console.log('afterClose', notice, timerHide);
					dontAlert('I\'m called after the notice closes. I\'m passed the PNotify object for the current notice: ' + notice);
					dontAlert('I also have an argument called timerHide, which is true if the notice was closed because the timer ran down. Value: ' + timerHide);
				  }
				}
			  }
			});
    });


    // Switching notices
    $('#pnotify-switching').on('click', function () {
       new PNotify.alert({
            title: 'Notice',
            text: 'Right now I\'m a notice.',
            addclass: 'alert bg-primary alert-styled-right',
            before_close: function(PNotify) {
                PNotify.update({
                    title: 'Error',
                    text: 'Uh oh. Now I\'ve become an error.',
                    addclass: 'alert bg-danger alert-styled-right',
                    type: 'error',
                    before_close: function(PNotify) {
                        PNotify.update({
                            title: 'Success',
                            text: 'I fixed the error!',
                            addclass: 'alert bg-success alert-styled-right',
                            type: 'success',
                            before_close: function(PNotify) {
                                PNotify.update({
                                    title: 'Info',
                                    text: 'Everything\'s cool now.',
                                    addclass: 'alert bg-info alert-styled-right',
                                    type: 'info',
                                    before_close: null
                                });
                                PNotify.queueRemove();
                                return false;
                            }
                        });
                        PNotify.queueRemove();
                        return false;
                    }
                });
                PNotify.queueRemove();
                return false;
            }
        });
    });


    // Progress loader
	function fakeLoad() {
	  var curValue = 1;
	  var progress;

	  // Make a loader.
	  var loader = PNotify.notice({
		title: 'Creating series of tubes',
		text: '<div class="progress ">\n' +
		  '  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></' + 'div>\n' +
		  '</' + 'div>',
		textTrusted: true,
		icon: 'fas fa-cog fa-spin',
		hide: false,
		modules: {
		  Buttons: {
			closer: false,
			sticker: false
		  },
		  History: {
			history: false
		  },
		  Callbacks: {
			beforeOpen: function(notice) {
			  progress = $(notice.refs.elem).find('div.progress-bar');
			  progress.width(curValue + '%').attr('aria-valuenow', curValue);
			  // Pretend to do something.
			  var plus = 1;
			  var timer = setInterval(function() {
				if (curValue === 70) {
				  plus = 0.25;
				  loader.update({
					title: 'Aligning discrete worms',
					icon: 'fas fa-circle-notch fa-spin'
				  });
				}
				if (curValue === 80) {
				  loader.update({
					title: 'Connecting end points',
					icon: 'fas fa-sync fa-spin'
				  });
				}
				if (curValue === 90) {
				  loader.update({
					title: 'Dividing and conquering',
					icon: 'fas fa-spinner fa-pulse'
				  });
				}
				if (curValue >= 100) {
				  // Clean up the interval.
				  window.clearInterval(timer);
				  loader.close();
				  return;
				}
				curValue += plus;
				progress.width(curValue + '%').attr('aria-valuenow', curValue);
			  }, 65);
			}
		  }
		}
	  });
	}
    $('#pnotify-progress').on('click', function () {
        fakeLoad();
    });


    // Dynamic loader
    $('#pnotify-dynamic').on('click', function () {
        var percent = 0;
        var notice =new PNotify.alert({
            text: "Please wait",
            addclass: 'bg-primary',
            type: 'info',
            icon: 'icon-spinner4 spinner',
            hide: false,
            buttons: {
                closer: false,
                sticker: false
            },
            opacity: .9,
            width: "170px"
        });

        setTimeout(function() {
        notice.update({
            title: false
        });
        var interval = setInterval(function() {
            percent += 2;
            var options = {
                text: percent + "% complete."
            };
            if (percent == 80) options.title = "Almost There";
            if (percent >= 100) {
                window.clearInterval(interval);
                options.title = "Done!";
                options.addclass = "bg-success";
                options.type = "success";
                options.hide = true;
                options.buttons = {
                    closer: true,
                    sticker: true
                };
                options.icon = 'icon-checkmark3';
                options.opacity = 1;
                options.width = PNotify.prototype.options.width;
            }
            notice.update(options);
            }, 120);
        }, 2000);
    });

    // Stacks
    // ------------------------------

    // Define directions
    var stack_top_left = {"dir1": "down", "dir2": "right", "push": "top"};
    var stack_bottom_left = {"dir1": "right", "dir2": "up", "push": "top"};
    var stack_bottom_right = {"dir1": "up", "dir2": "left", "firstpos1": 25, "firstpos2": 25};
    var stack_custom_left = {"dir1": "right", "dir2": "down"};
    var stack_custom_right = {"dir1": "left", "dir2": "up", "push": "top"};
    var stack_custom_top = {"dir1": "down", "dir2": "right", "push": "top", "spacing1": 1};
    var stack_custom_bottom = {"dir1": "up", "dir2": "right", "spacing1": 1};


    //
    // Setup options for positions
    //
	

    // Top left
    function show_stack_top_left(type) {
		  if (typeof window.stackTopLeft === 'undefined') {
			window.stackTopLeft = {
			  'dir1': 'down',
			  'dir2': 'right',
			  'firstpos1': 25,
			  'firstpos2': 25,
			  'push': 'top'
			};
		  }
        var opts = {
            title: "Over here",
            text: "Check me out. I'm in a different stack.",
            addclass: "stack-top-left bg-primary",
            stack: window.stackTopLeft
        };
        switch (type) {
            case 'error':
            opts.title = "Oh No";
            opts.text = "Watch out for that water tower!";
            opts.addclass = "stack-top-left bg-danger";
            opts.type = "error";
            break;

            case 'info':
            opts.title = "Breaking News";
            opts.text = "Have you met Ted?";
            opts.addclass = "stack-top-left bg-info";
            opts.type = "info";
            break;

            case 'success':
            opts.title = "Good News Everyone";
            opts.text = "I've invented a device that bites shiny metal asses.";
            opts.addclass = "stack-top-left bg-success";
            opts.type = "success";
            break;
        }
       new PNotify.alert(opts);
    }

    // Bottom left
    function show_stack_bottom_left(type) {
		if (typeof window.stackBottomLeft === 'undefined') {
			window.stackBottomLeft = {
			  'dir1': 'right',
			  'dir2': 'up',
			  'firstpos1': 25,
			  'firstpos2': 25,
			  'push': 'top'
			};
		  }
        var opts = {
            title: "Over here",
            text: "Check me out. I'm in a different stack.",
            addclass: "stack-bottom-left bg-primary",
            stack: window.stackBottomLeft
        };
        switch (type) {
            case 'error':
            opts.title = "Oh No";
            opts.text = "Watch out for that water tower!";
            opts.addclass = "stack-bottom-left bg-danger";
            opts.type = "error";
            break;

            case 'info':
            opts.title = "Breaking News";
            opts.text = "Have you met Ted?";
            opts.addclass = "stack-bottom-left bg-info";
            opts.type = "info";
            break;

            case 'success':
            opts.title = "Good News Everyone";
            opts.text = "I've invented a device that bites shiny metal asses.";
            opts.addclass = "stack-bottom-left bg-success";
            opts.type = "success";
            break;
        }
       new PNotify.alert(opts);
    }

    // Bottom right
    function show_stack_bottom_right(type) {
		  if (typeof window.stackBottomRight === 'undefined') {
			window.stackBottomRight = {
			  'dir1': 'up',
			  'dir2': 'left',
			  'firstpos1': 25,
			  'firstpos2': 25
			};
		  }
        var opts = {
            title: "Over here",
            text: "Check me out. I'm in a different stack.",
            addclass: "stack-bottom-right bg-primary",
            stack: window.stackBottomRight
        };
        switch (type) {
            case 'error':
            opts.title = "Oh No";
            opts.text = "Watch out for that water tower!";
            opts.addclass = "stack-bottom-right bg-danger";
            opts.type = "error";
            break;

            case 'info':
            opts.title = "Breaking News";
            opts.text = "Have you met Ted?";
            opts.addclass = "stack-bottom-right bg-info";
            opts.type = "info";
            break;

            case 'success':
            opts.title = "Good News Everyone";
            opts.text = "I've invented a device that bites shiny metal asses.";
            opts.addclass = "stack-bottom-right bg-success";
            opts.type = "success";
            break;
        }
       new PNotify.alert(opts);
    }

    // Custom left position
    function show_stack_custom_left(type) {
		 if (typeof window.stackcustleft === 'undefined') {
			window.stackcustleft = {
			  'dir1': 'down',
			  'dir2': 'right',
			  'firstpos1': 80,
			  'firstpos2': 200
			};
		  }
        var opts = {
            title: "Over here",
            text: "Check me out. I'm in a different stack.",
            addclass: "stack-custom-left bg-primary alert-styled-right",
            stack: window.stackcustleft
        };
        switch (type) {
            case 'error':
            opts.title = "Oh No";
            opts.text = "Watch out for that water tower!";
            opts.addclass = "stack-custom-left bg-danger";
            opts.type = "error";
            break;

            case 'info':
            opts.title = "Breaking News";
            opts.text = "Have you met Ted?";
            opts.addclass = "stack-custom-left bg-info";
            opts.type = "info";
            break;

            case 'success':
            opts.title = "Good News Everyone";
            opts.text = "I've invented a device that bites shiny metal asses.";
            opts.addclass = "stack-custom-left bg-success";
            opts.type = "success";
            break;
        }
       new PNotify.alert(opts);
    }

    // Custom right position
    function show_stack_custom_right(type) {
		if (typeof window.stackcustright === 'undefined') {
			window.stackcustright = {
			  'dir1': 'up',
			  'dir2': 'left',
			  'firstpos1': 80,
			  'firstpos2': 200
			};
		  }
        var opts = {
            title: "Over here",
            text: "Check me out. I'm in a different stack.",
            addclass: "stack-custom-right bg-primary",
            stack: stackcustright
        };
        switch (type) {
            case 'error':
            opts.title = "Oh No";
            opts.text = "Watch out for that water tower!";
            opts.addclass = "stack-custom-right bg-danger";
            opts.type = "error";
            break;

            case 'info':
            opts.title = "Breaking News";
            opts.text = "Have you met Ted?";
            opts.addclass = "stack-custom-right bg-info";
            opts.type = "info";
            break;

            case 'success':
            opts.title = "Good News Everyone";
            opts.text = "I've invented a device that bites shiny metal asses.";
            opts.addclass = "stack-custom-right bg-success";
            opts.type = "success";
            break;
        }
       new PNotify.alert(opts);
    }

    // Custom top position
    function show_stack_custom_top(type) {
		  if (typeof window.stackBarTop === 'undefined') {
			window.stackBarTop = {
			  'dir1': 'down',
			  'firstpos1': 0,
			  'spacing1': 0,
			  'push': 'top'
			};
		  }
        var opts = {
            title: "Over here",
            text: "Check me out. I'm in a different stack.",
            width: "100%",
			addClass: 'stack-bar-top',
			shadow: false,
            cornerclass: "ui-pnotify-sharp",
            addclass: "stack-custom-top bg-primary",
            stack: window.stackBarTop
        };
        switch (type) {
            case 'error':
            opts.title = "Oh No";
            opts.text = "Watch out for that water tower!";
            opts.addclass = "stack-custom-top bg-danger";
            opts.type = "error";
            break;

            case 'info':
            opts.title = "Breaking News";
            opts.text = "Have you met Ted?";
            opts.addclass = "stack-custom-top bg-info";
            opts.type = "info";
            break;

            case 'success':
            opts.title = "Good News Everyone";
            opts.text = "I've invented a device that bites shiny metal asses.";
            opts.addclass = "stack-custom-top bg-success";
            opts.type = "success";
            break;
        }
       new PNotify.alert(opts);
    }

    // Custom bottom position
    function show_stack_custom_bottom(type) {
		  if (typeof window.stackBarBottom === 'undefined') {
			window.stackBarBottom = {
			  'dir1': 'up',
			  'firstpos1': 0,
			  'spacing1': 0
			};
		  }
        var opts = {
            title: "Over here",
            text: "Check me out. I'm in a different stack.",
            width: "100%",
			addClass: 'stack-bar-bottom',
			cornerClass: 'ui-pnotify-sharp',
            stack: window.stackBarBottom
        };
        switch (type) {
            case 'error':
            opts.title = "Oh No";
            opts.text = "Watch out for that water tower!";
            opts.addclass = "stack-custom-bottom bg-danger";
            opts.type = "error";
            break;

            case 'info':
            opts.title = "Breaking News";
            opts.text = "Have you met Ted?";
            opts.addclass = "stack-custom-bottom bg-info";
            opts.type = "info";
            break;

            case 'success':
            opts.title = "Good News Everyone";
            opts.text = "I've invented a device that bites shiny metal asses.";
            opts.addclass = "stack-custom-bottom bg-success";
            opts.type = "success";
            break;
        }
       new PNotify.alert(opts);
    }


    //
    // Initialize
    //

    // Top left
    $('#pnotify-stack-top-left').on('click', function () {
        show_stack_top_left('primary');
    });

    // Bottom left
    $('#pnotify-stack-bottom-left').on('click', function () {
        show_stack_bottom_left('primary');
    });

    // Bottom right
    $('#pnotify-stack-bottom-right').on('click', function () {
        show_stack_bottom_right('danger');
    });

    // Custom left
    $('#pnotify-stack-custom-left').on('click', function () {
        show_stack_custom_left('success');
    });

    // Custom right
    $('#pnotify-stack-custom-right').on('click', function () {
        show_stack_custom_right('success');
    });

    // Custom top
    $('#pnotify-stack-custom-top').on('click', function () {
        show_stack_custom_top('info');
    });

    // Custom bottom
    $('#pnotify-stack-custom-bottom').on('click', function () {
        show_stack_custom_bottom('info');
    });

});
