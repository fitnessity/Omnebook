/**
 * Profile Feed JQuery
 *
 * @author Anuj Y Jaha
 */
var ProfileFeed = {

	Utils: {
		init: function()
		{
			//Utils
		},

		runAjaxRequest: function(url, method, dataType, params, callBack)
		{
			jQuery.ajax(
			{
				url: 		url,
				method: 	method,
				dataType: 	dataType,
				data: 		params,
				success:  	callBack
			});
		}
	},

	/**
	 * Feed Post
	 *
	 */
	FeedPost: 
	{
		/**
		 * Selectors
		 *
		 */
		selectors: {
			videoPostTitle: 		jQuery("#videocontentPostTitle"),
			galleryPostTitle: 		jQuery("#imagecontentPostTitle"),
			modalBoxSelector: 		jQuery("#myModal"),
			modalBoxViewPart: 		jQuery("#modalBoxBody"),
			feedPostContainer: 	jQuery("#profileListMain")
		},

		/**
		 * Buttons
		 *
		 */
		buttons: {
			videoPostBtn: 			jQuery('.video-post-btn'),
			galleryPostBtn: 		jQuery('.gallery-post-btn'),
			postCommentsBtn:  		jQuery('.postComment'),
			editPostCommentsBtn:  	jQuery('.edit-post-comment')
		},

		/**
		 * Messages
		 *
		 */
		messages: {
			missingGalleryTitle: "Please Provide Gallery Title",
			missingVideoTitle:   "Please Provide Video Title"
		},

		/**
		 * Initalize Feed Post
		 *
		 */
		init: function()
		{
			this.addHandlers();
		},

		addHandlers: function()
		{
			var context = this;

			this.buttons.videoPostBtn.on('click', function(event)
			{
				context.uploadVideo(event);
			}); 

			this.buttons.galleryPostBtn.on('click', function(event)
			{
			    context.uploadGallery(event);
			});  

			this.bindPostClickEvent();

			jQuery(document).on('click', '.view-more-comments', function(event)
			{
				context.showAllComments(this);
			});

			jQuery(document).on('click', '.gallery-post-update-btn', function(event)
			{
				context.updateProfileGalleryFeed(this);
			});

			jQuery(document).on('click', '.content-post-update-btn', function(event)
			{
				context.updateProfileContentFeed(this);
			});

			jQuery(document).on('click', '.content-post-report-btn', function(event)
			{
				context.reportFeed(this);
			});


			jQuery(document).on('click', '.video-post-update-btn', function(event)
			{
				context.updateProfileVideoFeed(this);
			});
			

			jQuery("#myModal").on("hidden.bs.modal", function (event) 
			{
				var feedId = jQuery("#modalHelperId").val(),
					params  = {
						'_token': jQuery("#ajaxToken").val(),
						'close': 	true,
						'feed_id': feedId
					};

					ProfileFeed.Utils.runAjaxRequest(moduleConfig.showAllComments, 'POST', 'JSON', params, function(data)
					{
						if(data.status == true)
						{
							jQuery("#commentsContainer-" + feedId).html(data.html);
						}
					});
			});

			jQuery("#editFeedContainer").on("hidden.bs.modal", function (event) 
			{
				var feedId 	= jQuery("#editModalHelperId").val(),
					params  = {
						'_token': jQuery("#ajaxToken").val(),
						'close': 	true,
						'feed_id': feedId
					};

				if(feedId.length > 0)
				{
					ProfileFeed.Utils.runAjaxRequest(moduleConfig.getSingleProfileFeedURL, 'POST', 'JSON', params, function(data)
					{
						if(data.status == true)
						{
							// jQuery("#profileId-" + feedId).html(data.html);
							jQuery("#profileId-" + feedId).replaceWith(data.html);
							//jQuery("#feedId-" + feedId).replaceWith(data.html);+
						}
					});	
				}
			});

			jQuery("#reportFeedContainer").on("hidden.bs.modal", function (event)
			{
				
				$(this).removeData();
				$(this).find("#systemMessage_report").html('');
			});

			jQuery(document).on('click', '.content-post-share-btn', function(event)
			{
				context.shareFeed(this);
			});

			jQuery("#shareFeedContainer").on("hidden.bs.modal", function (event)
			{
				/*var feedId 	= jQuery("#shareModalHelperId").val(),
					params  = {
						'_token': jQuery("#ajaxToken").val(),
						'close': 	true,
						'feed_id': feedId
					};


				if(feedId.length > 0)
				{
					ProfileFeed.Utils.runAjaxRequest(moduleConfig.getSingleProfileFeedURL, 'POST', 'JSON', params, function(data)
					{
						if(data.status == true)
						{
							jQuery("#sharenotes_txt_box").val("");
							jQuery("#shareModalHelperId").val("");
							jQuery("#profileId-" + feedId).replaceWith(data.html);
						}
					});
				}*/
				jQuery("#description_txt_box").val("");
				jQuery("#sharenotes_txt_box").val("");
				jQuery("#shareModalHelperId").val("");
				$(this).removeData();
				$(this).find("#systemMessage_share").html('');
			});



		},

		updateProfileVideoFeed: function(element)
		{
			if(jQuery("#edit_video_txt_box").val().length < 1 )
		    {
		    	jQuery("#edit_video_txt_box").focus();
		      	alert("Title is Missing");

		      return false;
		    }

		    var feedId = jQuery("#editModalHelperId").val(),
		    	params  = {
		    	'_token': jQuery("#ajaxToken").val(),
		    	'feed_id': feedId,
		    	'content': jQuery("#edit_video_txt_box").val()
		    };

		    ProfileFeed.Utils.runAjaxRequest(moduleConfig.editUploadGalleryTitleURL, 'POST', 'JSON', params, function(data)
		    {
		    	if(data.status == true)
		    	{
		    		event.preventDefault();
		    		updateVideoDropZone.processQueue();

		    		setTimeout(function(){
		    			jQuery('#editFeedContainer').modal('hide');
		    		}, 10);
		    		if(data.refresh){
						setTimeout(function(){
							window.location.reload(true);
						},100);
					}
		    		
		    	}
				else
				{
					alert('Something went wrong. Please try again later');
					params  = {
							'_token': jQuery("#ajaxToken").val(),
							'close': 	true,
							'feed_id': feedId
						};
					ProfileFeed.Utils.runAjaxRequest(moduleConfig.getSingleProfileFeedURL, 'POST', 'JSON', params, function(data)
					{
						setTimeout(function(){
			    			jQuery('#editFeedContainer').modal('hide');
			    		}, 10);
						if(data.status == true)
						{
							jQuery("#profileId-" + feedId).replaceWith(data.html);
							if(feedId != "" && refresh == true) {
								setTimeout(function(){
									window.location.reload(true);
								}, 100);
							}
						}
					});
				}
		    });
		},

		updateProfileContentFeed: function(element)
		{
			if(jQuery("#edit_content_txt_box").val().length < 1 )
		    {
		    	jQuery("#edit_content_txt_box").focus();
		      	alert("Please enter some text to post");

		      return false;
		    }

		    var feedId = jQuery("#editModalHelperId").val(),
		    	params  = {
		    	'_token': jQuery("#ajaxToken").val(),
		    	'feed_id': feedId,
		    	'content': jQuery("#edit_content_txt_box").val()
		    };
		    ProfileFeed.Utils.runAjaxRequest(moduleConfig.editUploadGalleryTitleURL, 'POST', 'JSON', params, function(data)
		    {
		    	if(data.status == true)
		    	{
		    		setTimeout(function(){
		    			jQuery('#editFeedContainer').modal('hide');
		    		}, 10);
		    		if(data.refresh){
						setTimeout(function(){
							window.location.reload(true);
						},100);
					}
		    	}
				else
				{
					alert('Something went wrong. Please try again later');
					params  = {
							'_token': jQuery("#ajaxToken").val(),
							'close': 	true,
							'feed_id': feedId
						};
					ProfileFeed.Utils.runAjaxRequest(moduleConfig.getSingleProfileFeedURL, 'POST', 'JSON', params, function(data)
					{
						setTimeout(function(){
			    			jQuery('#editFeedContainer').modal('hide');
			    		}, 10);
						if(data.status == true)
						{
							jQuery("#profileId-" + feedId).replaceWith(data.html);
							if(feedId != "" && refresh == true) {
								setTimeout(function(){
									window.location.reload(true);
								}, 100);
							}
						}
					});
				}
		    });
		},

		reportFeed: function(element)
		{
			if(jQuery("#reportnotes_txt_box").val().length < 1 )
			{
				jQuery("#reportnotes_txt_box").focus();
				alert("Please enter description for reporting.");
				return false;
			}

			var feedId = jQuery("#reportModalHelperId").val(),
				commentId = jQuery("#reportModalCommentId").val(),
				params  = {
				'_token': jQuery("#ajaxToken").val(),
				'feed_id': feedId,
				'comment_id': commentId,
				'content': jQuery("#reportnotes_txt_box").val()
			};

			showSystemMessages('#systemMessage_report', 'info', 'Please wait while we save your report.');

			ProfileFeed.Utils.runAjaxRequest(moduleConfig.reportFeedURL, 'POST', 'JSON', params, function(data)
			{

				if(data.type == 'success')
				{
					var refresh = false;
					if(data.refresh){
						refresh = data.refresh
					}
					showSystemMessages('#systemMessage_report', 'success', 'Thank you for helping us improve your Fitnessity experience!');
					setTimeout(function(){
						var feedId 	= jQuery("#reportModalHelperId").val(),
						commentId = jQuery("#reportModalCommentId").val(),
						params  = {
							'_token': jQuery("#ajaxToken").val(),
							'close': 	true,
							'feed_id': feedId,
							'comment_id': commentId
						};


						if(feedId.length > 0)
						{
							ProfileFeed.Utils.runAjaxRequest(moduleConfig.getSingleProfileFeedURL, 'POST', 'JSON', params, function(data)
							{
								if(data.status == true)
								{
									jQuery("#reportnotes_txt_box").val("");
									jQuery("#reportModalHelperId").val("");
									jQuery("#reportModalCommentId").val("");
									jQuery("#profileId-" + feedId).replaceWith(data.html);
									jQuery('#reportFeedContainer').modal('hide');
									if(feedId != "" && commentId == "" && refresh == true) {
										setTimeout(function(){
											window.location.reload(true);
										}, 100);
									}
								}
							});
						}
					}, 2000);
				} else {
					alert(data.msg);
				}
			});
		},


		updateProfileGalleryFeed: function(element)
		{
			if(jQuery("#edit_gallery_txt_box").val().length < 1 )
		    {
		    	jQuery("#edit_gallery_txt_box").focus();
		      	alert(this.messages.missingGalleryTitle);

		      return false;
		    }

		    var feedId = jQuery("#editModalHelperId").val(),
		    	params  = {
		    	'_token': jQuery("#ajaxToken").val(),
		    	'feed_id': feedId,
		    	'content': jQuery("#edit_gallery_txt_box").val()
		    };

		    ProfileFeed.Utils.runAjaxRequest(moduleConfig.editUploadGalleryTitleURL, 'POST', 'JSON', params, function(data)
		    {
		    	if(data.status == true)
		    	{
		    		//event.preventDefault();
		    		if(updateGalleryDropZone.getQueuedFiles().length > 0)
		    		{
		    			updateGalleryDropZone.processQueue(); 	
		    		}
		    		else
		    		{
		    			setTimeout(function(){
		    				jQuery('#editFeedContainer').modal('hide');	
		    			}, 10);
		    			if(data.refresh){
							setTimeout(function(){
								window.location.reload(true);
							},100);
						}
		    		}
		    	}
				else 
				{
					alert('Something went wrong. Please try again later');
					params  = {
							'_token': jQuery("#ajaxToken").val(),
							'close': 	true,
							'feed_id': feedId
						};
					ProfileFeed.Utils.runAjaxRequest(moduleConfig.getSingleProfileFeedURL, 'POST', 'JSON', params, function(data)
					{
						setTimeout(function(){
		    				jQuery('#editFeedContainer').modal('hide');	
		    			}, 10);
						if(data.status == true)
						{
							jQuery("#profileId-" + feedId).replaceWith(data.html);
							if(feedId != "" && refresh == true) {
								setTimeout(function(){
									window.location.reload(true);
								}, 100);
							}
						}
					});
				}
		    });
		},

		/**
		 * Bind Post Click Event
		 * 
		 */
		bindPostClickEvent: function()
		{
			var context = this;

			jQuery(document).on('click', '.postComment', function(event)
			{
				context.postComment(this);
			});
			jQuery(document).on('click', '.replyComment', function(event)
			{
				context.replyComment(this);
			});

		},

		/**
		 * Show All Comments
		 * @param element
		 * @return html
		 */
		showAllComments: function(element)
		{
			var context = this,
				feedId 	= jQuery(element).attr('data-feed-id'),
				params  = {
					'_token': jQuery("#ajaxToken").val(),
					'feed_id': feedId
				};

				ProfileFeed.Utils.runAjaxRequest(moduleConfig.showAllComments, 'POST', 'JSON', params, function(data)
				{
					if(data.status == true)
					{
						context.selectors.modalBoxViewPart.html(data.html);
					}
				});
			
			context.selectors.modalBoxSelector.modal('show');
			jQuery("#modalHelperId").val(feedId);
			jQuery("#commentsContainer-" + feedId).html('');
		},

		postComment: function(element)
		{
			var context 			= this,
				feedId 				= jQuery(element).attr('data-feed-id'),
				commentTextLength 	= jQuery("#commentText-" + feedId).val().length,
				commentText 		= jQuery("#commentText-" + feedId).val(),
				params  = {
						'_token': jQuery("#ajaxToken").val(),
						'feed_id': feedId,
						'content': commentText
				};
			if(commentTextLength > 0 )
			{
				ProfileFeed.Utils.runAjaxRequest(moduleConfig.timeLineFeedComment, 'POST', 'JSON', params, function(data)
				{
					if(data.status == true)
					{
						var updateValue = parseInt(jQuery("#commentsCount-"+feedId)[0].innerText) + 1;
								
						jQuery("#commentsCount-"+ feedId ).html('<i class="fa fa-commenting" aria-hidden="true"></i> ' + updateValue);
						jQuery("#commentsContainer-" + feedId + " .last-box:last").before(data.html);
						jQuery("#commentText-" + feedId).val('');
						jQuery("#commentText-" + feedId).focus();
					} 
					else 
					{
						alert('Something went wrong. Please try again later');
						params  = {
							'_token': jQuery("#ajaxToken").val(),
							'close': 	true,
							'feed_id': feedId
						};
						ProfileFeed.Utils.runAjaxRequest(moduleConfig.getSingleProfileFeedURL, 'POST', 'JSON', params, function(data)
						{
							if(data.status == true)
							{
								jQuery("#profileId-" + feedId).replaceWith(data.html);
								if(feedId != "" && refresh == true) {
									setTimeout(function(){
										window.location.reload(true);
									}, 100);
								}
							}
						});
					}
				});
			}
		},

		uploadVideo: function(event)
		{   
    		if(this.selectors.videoPostTitle.val().length < 1 )
    		{
		    	this.selectors.videoPostTitle.focus();
		      	alert(this.messages.missingVideoTitle);
		      	
		      	return false;
    		}

    		event.preventDefault();
    		myDropzone.processQueue();  
		},

		uploadGallery: function(event)
		{
			if(this.selectors.galleryPostTitle.val().length < 1 )
		    {
		    	this.selectors.galleryPostTitle.focus();
		      	alert(this.messages.missingGalleryTitle);

		      return false;
		    }

		    event.preventDefault();
		    galleryDropZone.processQueue();  
		},

		shareFeed: function(element)
		{
			var context = this;
			if(jQuery("#description_txt_box").val().length < 1 )
			{
				jQuery("#description_txt_box").focus();
				alert("Please enter description for sharing the feed.");
				return false;
			}

			var feedId = jQuery("#shareModalHelperId").val(),
				params  = {
				'_token': jQuery("#ajaxToken").val(),
				'feed_id': feedId,
				'content': jQuery("#description_txt_box").val()
			};

			showSystemMessages('#systemMessage_share', 'info', 'Please wait while we save your post.');

			ProfileFeed.Utils.runAjaxRequest(moduleConfig.shareTimeLineFeed, 'POST', 'JSON', params, function(data)
			{
				if(data.status == true)
				{
					jQuery("#profileListMain").prepend(data.html);
					showSystemMessages('#systemMessage_share','success', 'Post shared to timeline successfully!');
					setTimeout(function(){
						jQuery('#shareFeedContainer').modal('hide');
					}, 2000);
				}
				else
				{
					alert(data.message);
					params  = {
						'_token': jQuery("#ajaxToken").val(),
						'close': 	true,
						'feed_id': feedId
					};

					ProfileFeed.Utils.runAjaxRequest(moduleConfig.getSingleProfileFeedURL, 'POST', 'JSON', params, function(data)
					{
						setTimeout(function(){
							jQuery('#shareFeedContainer').modal('hide');
						}, 2000);
						if(data.status == true)
						{
							jQuery("#profileId-" + feedId).replaceWith(data.html);
							if(feedId != "" && refresh == true) {
								setTimeout(function(){
									window.location.reload(true);
								}, 100);
							}
						}
					});
				}
			});
		},

		replyComment: function(element)
		{
			var context 			= this,
				feedId 				= jQuery(element).attr('data-feed-id'),
				commentId 				= jQuery(element).attr('data-comment-id'),
				replyCommentTextLength 	= jQuery("#replyCommentText-" + commentId).val().length,
				replyCommentText 		= jQuery("#replyCommentText-" + commentId).val(),
				params  = {
						'_token': jQuery("#ajaxToken").val(),
						'feed_id': feedId,
						'parent_id': commentId,
						'content': replyCommentText
				};

			if(replyCommentTextLength > 0 )
			{
				ProfileFeed.Utils.runAjaxRequest(moduleConfig.timeLineFeedComment, 'POST', 'JSON', params, function(data)
				{
					if(data.status == true)
					{
						var updateValue = parseInt(jQuery("#replyCommentsCount-"+commentId)[0].innerText) + 1;

						jQuery("#replyCommentsCount-"+ commentId ).html('<i class="fa fa-commenting" aria-hidden="true"></i> ' + updateValue);
						//jQuery("#view-more-reply-comments-"+ commentId ).text('View all ' + updateValue + ' replies');
						//jQuery("#replyCommentsContainer-" + commentId + " .last-box:last").before(data.html);
						jQuery("#replyCommentsContainer-" + commentId).find('.reply-comment-box:last').before(data.html);
						//alert("#replyCommentsContainer-" + commentId + " .last-box:last");
						jQuery("#replyCommentText-" + commentId).val('');
						jQuery("#replyCommentText-" + commentId).focus();
					} 
					else 
					{
						alert('Something went wrong. Please try again later');
						params  = {
							'_token': jQuery("#ajaxToken").val(),
							'close': 	true,
							'feed_id': feedId
						};
						ProfileFeed.Utils.runAjaxRequest(moduleConfig.getSingleProfileFeedURL, 'POST', 'JSON', params, function(data)
						{
							if(data.status == true)
							{
								jQuery("#profileId-" + feedId).replaceWith(data.html);
								if(feedId != "" && refresh == true) {
									setTimeout(function(){
										window.location.reload(true);
									}, 100);
								}
							}
						});
					}
				});
			}
		}
	},
	
	/**
	 * Profile Feed List
	 *
	 */
	ProfileFeedList: 
	{
		/**
		 * Selectors
		 */
		selectors: {
			feedPostContainer: 	jQuery("#profileListMain"),
			profileFeedLike: 	jQuery('.profile-feed-like'),
			createContentFeed: 	jQuery('.content-post-btn'),
			shareContentFeed:  	jQuery('.share-feed'),
			inputBox: {
				contentPostTitle: jQuery("#contentPostTitle")
			},
		},

		/**
		 * Intialize
		 */
		init: function()
		{
			this.addHandlers();
		},

		/**
		 * Add Handlers
		 *
		 */
		addHandlers: function()
		{
			var context = this;

			this.selectors.createContentFeed.on('click', function()
			{
				if(jQuery.trim(context.selectors.inputBox.contentPostTitle.val().length) > 0)
				{
					context.createNewContentFeed();
				}
			});

			jQuery(document).on('click', '.profile-feed-like', function()
			{
				context.userFeedLikeUnlikeEvent(this);
			});

			/*jQuery(document).on('click', '.share-feed', function()
			{
				context.userShareTimeLineFeed(this);
			});*/

			jQuery(document).on('click', '.profile-feed-edit-comment', function()
			{
				context.userEditComment(this);
			});

			jQuery(document).on('click', '.profile-feed-delete-comment', function()
			{
				context.userDeleteComment(this);
			});

			jQuery(document).on('click', '.edit-post-comment', function()
			{
				context.postUserEditComment(this);
			});

			jQuery(document).on('click', '.edit-feed', function()
			{
				context.prepareEditFeedLayout(this);
			});

			jQuery(document).on('click', '.report-feed', function()
			{
				context.prepareReportFeedLayout(this);
			});

			jQuery(document).on('click', '.delete-feed', function()
			{
				var details = this;
			
				context.removeFeedPost(details);	
			});

			jQuery(document).on('click', '.delete-gallery-file', function()
			{
				context.removeMediaImageFromGallery(this);
			});

			jQuery(document).on('click', '.share-feed', function()
			{
				context.prepareShareFeedLayout(this);
			});

			jQuery(document).on('click', '.profile-feed-reply-btn', function(event)
			{
				context.replyCommentBtnClick(this);
			});

			jQuery(document).on('click', '.profile-feed-edit-reply', function()
			{
				context.userEditReply(this);
			});

			jQuery(document).on('click', '.edit-post-reply', function()
			{
				context.postUserEditReply(this);
			});

			jQuery(document).on('click', '.view-more-reply-comments', function(event)
			{
				context.showAllReplyComments(this);
			});

			jQuery(document).on('click', '.delete-media-file', function()
			{
				context.removeMediaFromGallery(this);
			});

			jQuery(document).on('click', '.fav-icon', function()
			{
				context.addToFavoriteMedia(this);
			});

			jQuery(document).on('click', '.unfav-icon', function()
			{
				context.removeToFavoriteMedia(this);
			});
			

			jQuery(document).on('click', '.media-view-more', function()
			{
				context.viewMoreMedia(this);
			});
		},

		/**
		 * Remove Feed Post
		 * 
		 * @return {element}
		 */
		removeFeedPost: function(element)
		{
			if(!confirm('Are you sure you want to Delete Feed?')) {
				return;
			}
			//console.log(element);
			var context = this,
				feedId 	= jQuery(element).attr('data-feed-id'),
				params  = {
					'_token': 		jQuery("#ajaxToken").val(),
					'feed_id': 		feedId
				};

				jQuery("#profileId-" + feedId).remove();

				ProfileFeed.Utils.runAjaxRequest(moduleConfig.removeFeedPost, 'POST', 'JSON', params, function(data)
				{
					if(data.status == true)
					{
						console.log("Succesfuly Deleted");
						if(data.refresh){
							setTimeout(function(){
								window.location.reload(true);
							},100);
						}
					}
				});
		},

		/**
		 * Remove Media Image From Gallery
		 * 
		 * @param {element}
		 * @return
		 */
		removeMediaImageFromGallery: function(element)
		{
			var context = this,
				mediaId = jQuery(element).attr('data-id'),
				feedId  = jQuery("#editModalHelperId").val(),
				params  = {
					'_token': 		jQuery("#ajaxToken").val(),
					'media_id': 	mediaId	
				};

			ProfileFeed.Utils.runAjaxRequest(moduleConfig.removeMediaImageFromGalleryURL, 'POST', 'JSON', params, function(data)
			{
				if(data.status == true)
				{
					jQuery("#mediaId-" + mediaId).html('<div class="alert alert-success"><strong>Success!</strong> Successfully Post Image Deleted ! </div>');
					jQuery("#editModalHelperId").val(feedId);
				}
			});
		},

		/**
		 * Prepare Edit Feed Layout
		 * @param {element}
		 * @return 
		 */
		prepareEditFeedLayout: function(element)
		{
			var context 	= this,
				feedId 		= jQuery(element).attr('data-feed-id'),
				feedType 	= jQuery(element).attr('data-feed-type'),
				params  	= {
					'_token': 		jQuery("#ajaxToken").val(),
					'feed_id': 		feedId
				};

			switch(feedType)
			{
				case 'content':
					jQuery("#text-type").show();
					jQuery("#gallery-type").hide();
					jQuery("#video-type").hide();

					var feedContent = jQuery("#edit_content_txt_box");
				break;

				case 'gallery':
					jQuery("#text-type").hide();
					jQuery("#gallery-type").show();
					jQuery("#video-type").hide();

					var feedContent = jQuery("#edit_gallery_txt_box");
				break;

				case 'video':
					jQuery("#text-type").hide();
					jQuery("#gallery-type").hide();
					jQuery("#video-type").show();

					var feedContent = jQuery("#edit_video_txt_box");
				break;
			}
			
			ProfileFeed.Utils.runAjaxRequest(moduleConfig.getFeedURL, 'POST', 'JSON', params, function(data)
			{
				if(data.status == true)
				{
					jQuery("#editFeedBody").html(data.html);
					feedContent.val(data.title);
				}
			});

			jQuery("#editFeedContainer").modal('show');
			jQuery("#editModalHelperId").val(feedId);

			if(feedType == 'gallery')
			{
				updateGalleryDropZone.on('sending', function(file,xhr,data)
				{
					data.append("feed_id", feedId);
				});	
			}

			if(feedType == 'video')
			{
				updateVideoDropZone.on('sending', function(file,xhr,data)
				{
					data.append("feed_id", feedId);
				});		
			}
		},
				/**
		 * Prepare reportpost Feed Layout
		 * @param {element}
		 * @return 
		 */
		prepareReportFeedLayout: function(element)
		{
			var context 	= this,
				feedId 		= jQuery(element).attr('data-feed-id'),
				commentId	= jQuery(element).attr('data-comment-id'),
				params  	= {
					'_token': 		jQuery("#ajaxToken").val(),
					'feed_id': 		feedId
				};
			jQuery("#report-type").show();
			jQuery("#reportFeedContainer").modal('show');
			jQuery("#reportModalHelperId").val(feedId);
			jQuery("#reportModalCommentId").val(commentId);
		},


		/**
		 * Edit Comment
		 *
		 * @param element
		 */
		userEditComment: function(element)
		{
			var feedId 			= jQuery(element).attr('data-feed-id'),
				commentId 		= jQuery(element).attr('data-comment-id'),
				commentText 	= jQuery(element).attr('data-comment-text'),
				commentEditArea = '<div class="comment-con"><input type="text" value="'+ commentText +'" id="commentText-'+ commentId +'"><button class="edit-post-comment" data-feed-id="' +feedId+ '" data-comment-id="'+ commentId +'"><i class="fa fa-paper-plane" aria-hidden="true"></i></button></div>';

			jQuery("#userCommentManage-"+commentId).html(commentEditArea);
		},

		postUserEditComment: function(element)
		{
			var feedId 				= jQuery(element).attr('data-feed-id'),
				commentId 			= jQuery(element).attr('data-comment-id'),
				commentText 		= jQuery("#commentText-"+ commentId).val(),
				commentContainer 	= jQuery("#commentContainer-"+ commentId);
			
			var context = this,
				params  = {
					'_token': 		jQuery("#ajaxToken").val(),
					'feed_id': 		feedId,
					'comment_id': 	commentId,
					'comment_text': commentText
				};

			ProfileFeed.Utils.runAjaxRequest(moduleConfig.updateCommentText, 'POST', 'JSON', params, function(data)
			{
				if(data.status == true)
				{
					context.successCommentEditEvent(commentId, data);
				}
				else 
				{
					alert('Something went wrong. Please try again later');
					params  = {
							'_token': jQuery("#ajaxToken").val(),
							'close': 	true,
							'feed_id': feedId
					};
					ProfileFeed.Utils.runAjaxRequest(moduleConfig.getSingleProfileFeedURL, 'POST', 'JSON', params, function(data)
					{
						if(data.status == true)
						{
							jQuery("#profileId-" + feedId).replaceWith(data.html);
							if(feedId != "" && refresh == true) {
								setTimeout(function(){
									window.location.reload(true);
								}, 100);
							}
						}
					});
				}
			});
		},

		successCommentEditEvent: function(commentId, data)
		{
			jQuery("#commentContainer-"+ commentId).html(data.html);
		},

		/**
		 * Delete Comment
		 *
		 * @param element
		 */
		userDeleteComment: function(element)
		{
			var commentId 			= jQuery(element).attr('data-comment-id'),
				feedId 				= jQuery(element).attr('data-feed-id'),
				commentContainer 	= jQuery("#commentContainer-"+ commentId),
				replyId = jQuery(element).attr('data-reply-comment-id');


			var context = this,
				params  = {
					'_token': 		jQuery("#ajaxToken").val(),
					'feed_id': 		feedId,
					'comment_id': 	commentId,
					'reply_id': replyId
				};
			
			ProfileFeed.Utils.runAjaxRequest(moduleConfig.deleteCommentText, 'POST', 'JSON', params, function(data)
			{
				if(data.status == true)
				{
					if(!replyId) {
						var updateValue = parseInt(jQuery("#commentsCount-"+feedId)[0].innerText) - 1;
						jQuery("#commentsCount-"+ feedId ).html('<i class="fa fa-commenting" aria-hidden="true"></i> ' + updateValue);
						jQuery(commentContainer).remove();
					} else {
						var updateValue = parseInt(jQuery("#replyCommentsCount-"+commentId)[0].innerText) - 1;
						commentContainer 	= jQuery("#replyCommentContainer-"+ replyId);
						jQuery("#replyCommentsCount-"+ commentId ).html('<i class="fa fa-commenting" aria-hidden="true"></i> ' + updateValue);
						//jQuery("#view-more-reply-comments-"+ commentId ).text('View all ' + updateValue + ' replies');
						jQuery(commentContainer).remove();
					}
				}
				else 
				{
					alert('Something went wrong. Please try again later');
					params  = {
							'_token': jQuery("#ajaxToken").val(),
							'close': 	true,
							'feed_id': feedId
					};
					ProfileFeed.Utils.runAjaxRequest(moduleConfig.getSingleProfileFeedURL, 'POST', 'JSON', params, function(data)
					{
						if(data.status == true)
						{
							jQuery("#profileId-" + feedId).replaceWith(data.html);
							if(feedId != "" && refresh == true) {
								setTimeout(function(){
									window.location.reload(true);
								}, 100);
							}
						}
					});
				}
			});
		},

		/**
		 * Create New Content Type Feed
		 *
		 * @param element
		 */
		createNewContentFeed: function()
		{
			var context = this,
				params  = {
					'_token': jQuery("#ajaxToken").val(),
					'content': context.selectors.inputBox.contentPostTitle.val()
				};

			ProfileFeed.Utils.runAjaxRequest(moduleConfig.addTimeLineFeedContent, 'POST', 'JSON', params, function(data)
			{
				if(data.status == true)
				{
					context.successContentFeedEvent(data);
					$("#homesuccessdiv").addClass("booking-booked-text");
              $("#homesuccessdiv").html("Successfully Posted!");
              setTimeout(
                function() 
                {
                  $("#homesuccessdiv").html("&nbsp;");
                }, 1000);
				}
			});
		},

		/**
		 * User Share Timeline Feed 
		 *
		 * @param element
		 */
		userShareTimeLineFeed: function(element)
		{
			//console.log(this);
			var context = this,
				params  = {
					'_token': jQuery("#ajaxToken").val(),
					'user_id': jQuery(element).attr('data-user-id'),
					'feed_id': jQuery(element).attr('data-feed-id')
				};

			ProfileFeed.Utils.runAjaxRequest(moduleConfig.shareTimeLineFeed, 'POST', 'JSON', params, function(data)
			{
				if(data.status == true)
				{
					context.selectors.feedPostContainer.prepend(data.html);	
					context.userShareTimeLineFeedSuccess(element);

					showSystemMessages('#share-feed-response-message', 'success', 'Post shared to timeline successfully!');
					jQuery('#share-feed-responsediv').modal('show');
					setTimeout(
	                function() 
	                {
	                  jQuery('#share-feed-responsediv').modal('hide');
	                }, 1000);
				}
				else
				{
					alert(data.message);
					var feedId = jQuery(element).attr('data-feed-id');
					params  = {
						'_token': jQuery("#ajaxToken").val(),
						'close': 	true,
						'feed_id': feedId
					};
					ProfileFeed.Utils.runAjaxRequest(moduleConfig.getSingleProfileFeedURL, 'POST', 'JSON', params, function(data)
					{
						setTimeout(
		                function() 
		                {
		                  jQuery('#share-feed-responsediv').modal('hide');
		                }, 100);
						if(data.status == true)
						{
							jQuery("#profileId-" + feedId).replaceWith(data.html);
							if(feedId != "" && data.refresh == true) {
								setTimeout(function(){
									window.location.reload(true);
								}, 100);
							}
						}
					});
				}
			});
		},

		/**
		 * User Share Timeline Feed Count UPdate
		 *
		 * @param element
		 */
		userShareTimeLineFeedSuccess: function(element)
		{
			var key 			= jQuery(element).attr('data-feed-id'),
				updateValue 	= parseInt(jQuery("#shareCount-"+key)[0].innerText) + 1;
				
			jQuery("#shareCount-"+key).html('<i class="fa fa-share-alt" aria-hidden="true"></i> ' + updateValue);
		},

		/**
		 * Succesfully Content Feed Created
		 *
		 * @param element
		 */
		successContentFeedEvent: function(data)
		{
			this.selectors.inputBox.contentPostTitle.val('');
			this.selectors.feedPostContainer.prepend(data.html);
		},

		/**
		 * User Feed Like Unlike Event Handler
		 *
		 * @param element
		 */
		userFeedLikeUnlikeEvent: function(element)
		{
			var context = this;

			if(jQuery(element).attr('data-like-status') == 1)
			{
				context.addFeedLike(jQuery(element));
			}

			if(jQuery(element).attr('data-like-status') == 0)
			{
				context.removeFeedLike(jQuery(element));
			}
		},

		/**
		 * Add Feed Like
		 *
		 * @param element
		 * @return bool
		 */
		addFeedLike: function(element)
		{
			var context = this,
				params  = {
					'_token': jQuery("#ajaxToken").val(),
					'user_id': element.data('user-id'),
					'feed_id': element.data('feed-id')
				};

			ProfileFeed.Utils.runAjaxRequest(moduleConfig.feedLikeUrl, 'POST', 'JSON', params, function(data)
			{
				if(data.status == true)
				{
					context.feedLikeUnlikeHandle(element, 'Unlike', 0);
					context.updateLikeCount(element, 1);
				}
			});
		},	

		/**
		 * Remove Feed Like
		 *
		 * @param element
		 * @return bool
		 */
		removeFeedLike: function(element)
		{
			var context = this,
				params  = {
					'_token': jQuery("#ajaxToken").val(),
					'user_id': element.data('user-id'),
					'feed_id': element.data('feed-id')
				};

			ProfileFeed.Utils.runAjaxRequest(moduleConfig.feedUnlikeUrl, 'POST', 'JSON', params, function(data)
			{
				if(data.status == true)
				{
					context.feedLikeUnlikeHandle(element, 'Like', 1);
					context.updateLikeCount(element, 0);
				}
			});
		},

		/**
		 * Feed Like Unlike Handle
		 *
		 * @param elment
		 * @param label
		 * @param status
		 */
		feedLikeUnlikeHandle: function(element, label, status)
		{
			var context = this;

			jQuery(element).html(label);
			jQuery(element).attr('data-like-status', status);
		},

		/**
		 * Update Like Count
		 *
		 * @param elment
		 * @param status
		 */
		updateLikeCount: function(element, status)
		{
			var key 			= jQuery(element).attr('data-feed-id'),
				currentValue 	= jQuery("#likeCount-"+key)[0].innerText;

			if(status == 1)
			{
				currentValue = parseInt(currentValue) + 1;
			}
			else
			{
				currentValue = parseInt(currentValue) - 1;				
			}
			
			jQuery("#likeCount-"+key).html('<i class="fa fa-thumbs-up" aria-hidden="true"></i> ' + currentValue);
		},
		/* * Prepare reportpost Feed Layout
		 * @param {element}
		 * @return 
		 */
		prepareShareFeedLayout: function(element)
		{
			var context 	= this,
				feedId 		= jQuery(element).attr('data-feed-id'),
				params  	= {
					'_token': 		jQuery("#ajaxToken").val(),
					'feed_id': 		feedId
				};
			//jQuery("#share-type").show();
			jQuery("#shareFeedContainer").modal('show');
			jQuery("#shareModalHelperId").val(feedId);
		},

		replyCommentBtnClick: function(element)
		{
			var context = this,
				commentId = jQuery(element).attr('data-comment-id');

				jQuery("#replyCommentText-" + commentId).val('');
				jQuery("#replyCommentText-" + commentId).focus();
		},

		userEditReply:  function(element)
		{
			var feedId 			= jQuery(element).attr('data-feed-id'),
				commentId 		= jQuery(element).attr('data-comment-id'),
				commentText 	= jQuery(element).attr('data-reply-comment-text'),
				replyId 		= jQuery(element).attr('data-reply-comment-id')
				commentEditArea = '<div class="comment-con"><input type="text" value="'+ commentText +'" id="replyCommentText-'+ replyId +'"><button class="edit-post-reply" data-feed-id="' +feedId+ '" data-comment-id="'+ commentId +'" data-reply-comment-id="'+ replyId +'"><i class="fa fa-paper-plane" aria-hidden="true"></i></button></div>';

			jQuery("#userReplyCommentManage-"+replyId).html(commentEditArea);
		},

		postUserEditReply: function(element)
		{
			var feedId 				= jQuery(element).attr('data-feed-id'),
				commentId 			= jQuery(element).attr('data-comment-id'),
				replyId 			= jQuery(element).attr('data-reply-comment-id'),
				commentText 		= jQuery("#replyCommentText-"+ replyId).val(),
				commentContainer 	= jQuery("#replyCommentContainer-"+ replyId);

			var context = this,
				params  = {
					'_token': 		jQuery("#ajaxToken").val(),
					'feed_id': 		feedId,
					'comment_id': 	commentId,
					'comment_text': commentText,
					'reply_id': 	replyId,
				};

			ProfileFeed.Utils.runAjaxRequest(moduleConfig.updateCommentText, 'POST', 'JSON', params, function(data)
			{
				if(data.status == true)
				{
					jQuery("#replyCommentContainer-"+ replyId).html(data.html);
				}
				else 
				{
					alert('Something went wrong. Please try again later');
					params  = {
						'_token': jQuery("#ajaxToken").val(),
						'close': 	true,
						'feed_id': feedId
					};
					ProfileFeed.Utils.runAjaxRequest(moduleConfig.getSingleProfileFeedURL, 'POST', 'JSON', params, function(data)
					{
						if(data.status == true)
						{
							jQuery("#profileId-" + feedId).replaceWith(data.html);
							if(feedId != "" && refresh == true) {
								setTimeout(function(){
									window.location.reload(true);
								}, 100);
							}
						}
					});
				}
			});
		},

		/**
		 * Show All Reply Comments
		 * @param element
		 * @return html
		 */
		showAllReplyComments: function(element)
		{
			var context = this,
				commentId 	= jQuery(element).attr('data-comment-id'),
				feedId 	= jQuery(element).attr('data-feed-id'),
				offset = jQuery("#input-replycomment-offset-" + commentId).val(),
				params  = {
					'_token': jQuery("#ajaxToken").val(),
					'comment_id': commentId,
					'feed_id': feedId,
					'offset':offset
				};
				ProfileFeed.Utils.runAjaxRequest(moduleConfig.showAllReplies, 'POST', 'JSON', params, function(data)
				{
					if(data.status == true)
					{
						//jQuery("#commentContainer-"+ commentId).html(data.html);
						var newOffset = parseInt(jQuery("#input-replycomment-offset-" + commentId).val()) + parseInt(data.offset);
						if(parseInt(data.offset)<=0 || newOffset >= parseInt(jQuery("#replyCommentsCount-"+commentId)[0].innerText)){
							jQuery("#view-more-reply-comments-" + commentId).hide();
						}
						jQuery("#input-replycomment-offset-" + commentId).val(newOffset);
						jQuery("#replyCommentsContainer-" + commentId + " .reply-comment-box:first").before(data.html);
						//context.selectors.modalBoxViewPart.html(data.html);
					}
				});
			
			// context.selectors.modalBoxSelector.modal('show');
			// jQuery("#modalHelperId").val(feedId);
			// jQuery("#commentsContainer-" + feedId).html('');
		},
		/**
		 * Remove Media 
		 * 
		 * @param {element}
		 * @return
		 */
		removeMediaFromGallery: function(element)
		{
			var context = this,
				mediaId = jQuery(element).attr('data-id'),
				mediaType  = jQuery(element).attr('data-media-type'),
				params  = {
					'_token': 		jQuery("#ajaxToken").val(),
					'media_id': 	mediaId	
				};

			ProfileFeed.Utils.runAjaxRequest(moduleConfig.removeMediaImageFromGalleryURL, 'POST', 'JSON', params, function(data)
			{
				if(data.status == true)
				{
					if(mediaType == 1) {
						jQuery("#mediaId-" + mediaId).html('<div class="alert alert-success"><strong>Success!</strong> Successfully Post Image Deleted ! </div>');
					} else {
						jQuery("#mediaId-" + mediaId).html('<div class="alert alert-success"><strong>Success!</strong> Successfully Post Video Deleted ! </div>');
					}
				}
			});
		},


		/**
		 * Add to favorite Media 
		 * 
		 * @param {element}
		 * @return
		 */
		addToFavoriteMedia: function(element)
		{
			var context = this,
				mediaId = jQuery(element).attr('data-id'),
				mediaType  = jQuery(element).attr('data-media-type'),
				params  = {
					'_token': 		jQuery("#ajaxToken").val(),
					'media_id': 	mediaId
				};

			ProfileFeed.Utils.runAjaxRequest(moduleConfig.addToFavoriteMedia, 'POST', 'JSON', params, function(data)
			{
				if(data.status == true)
				{
					showSystemMessages("", "success", data.message, "")
					jQuery(element).removeClass('fav-icon');
					jQuery(element).addClass('unfav-icon');
					jQuery(element).html('<i class="fa fa-heart" aria-hidden="true" style="color:red">');
					// jQuery("#reponseMessage").html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">x</button> ' + data.message + ' </div>');
					// setTimeout( function(){
					// 	window.location.reload();
					// }, 900);

				} else {
					showSystemMessages("", "danger", data.message, "")
					// jQuery("#reponseMessage").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">x</button> ' + data.message + ' </div>');
					// setTimeout( function(){
					// 	window.location.reload();
					// }, 900);
				}
			});
		},

		
		/**
		 * Remove to favorite Media 
		 * 
		 * @param {element}
		 * @return
		 */
		removeToFavoriteMedia: function(element)
		{
			var context = this,
				mediaId = jQuery(element).attr('data-id'),
				mediaType  = jQuery(element).attr('data-media-type'),
				params  = {
					'_token': 		jQuery("#ajaxToken").val(),
					'media_id': 	mediaId
				};

			ProfileFeed.Utils.runAjaxRequest(moduleConfig.removeToFavoriteMedia, 'POST', 'JSON', params, function(data)
			{
				if(data.status == true)
				{
					showSystemMessages("", "success", data.message, "")
					jQuery(element).html('<i class="fa fa-heart-o" aria-hidden="true" style="color:red">');
					jQuery(element).removeClass('unfav-icon');
					jQuery(element).addClass('fav-icon');
					// jQuery("#reponseMessage").html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">x</button> ' + data.message + ' </div>');
					// setTimeout( function(){
					// 	window.location.reload();
					// }, 900);

				} else {
					showSystemMessages("", "danger", data.message, "")
					// jQuery("#reponseMessage").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">x</button> ' + data.message + ' </div>');
					// setTimeout( function(){
					// 	window.location.reload();
					// }, 900);
				}
			});
		},

		/**
		 * View more media
		 *
		 * @param element
		 */
		viewMoreMedia: function()
		{
			var context = this,
				params  = {
					'_token': jQuery("#ajaxToken").val(),
					'mediaOffset': jQuery("#mediaOffset").val(),
					'mediaSize': jQuery("#mediaSize").val(),
					'mediaType': jQuery("#mediaType").val()
				};

			ProfileFeed.Utils.runAjaxRequest(moduleConfig.viewMoreMedia, 'POST', 'JSON', params, function(data)
			{
				if(data.status == true)
				{
					jQuery("#mediaListMain").append(data.html);
					var offset = parseInt(jQuery("#mediaOffset").val())+parseInt(data.count);
					jQuery("#mediaOffset").val(offset);
					if(data.count <=0) {
						alert("No more media found.");
						$(".media-view-more").hide();
					} else 	if(offset>= parseInt(jQuery("#mediaTotalCount").val())){
						$(".media-view-more").hide();
					}
				}
			});
		},

	}
}