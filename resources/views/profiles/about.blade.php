
@inject('request', 'Illuminate\Http\Request')
<!--@extends('layouts.header')-->
@section('content')

<style>
.sidebar {
  display: inline-block;
  float: none;
  margin: 0 auto;
  width: 100%;
  padding: 103px 24px 0px 1px;
}
.central-meta {
  background: #fff none repeat scroll 0 0;
  border: 1px solid #ede9e9;
  border-radius: 5px;
  display: inline-block;
  width: 100%;
  margin-bottom: 20px;
  padding: 20px;
  position: relative;
}
.create-post {
  border-bottom: 1px solid #e6ecf5;
  display: block;
  font-weight: 500;
  font-size: 15px;
  line-height: 15px;
  margin-bottom: 20px;
  padding-bottom: 12px;
  text-transform: capitalize;
  width: 100%;
  color: #515365;
  position: relative;
  background: #fff;
}
.create-post::before{
	background: #f91942;;
}
.create-post::before {
  content: "";
  height: 90%;
  left: -20px;
  position: absolute;
  top: -5px;
  width: 3px;
}
.personal-head {
  display: inline-block;
  width: 100%;
}
.f-title {
  color: #515365;
  display: inline-block;
  font-size: 13px;
  font-weight: 500;
  margin-bottom: 5px;
  width: 100%;
  text-transform: capitalize;
}
.f-title i{
	color: #f91942;
	 margin-right: 5px;
}
.personal-head > p {
  font-size: 13px;
  line-height: 20px;
  margin-bottom: 20px;
  padding-left: 20px;
}
.personal-head > p a{color: #f91942;}
.about-top{
	padding: 103px 102px 0px 0px;
}
.create-post > a{
	color: #f91942;
	float: right;
	font-size: 11px;
	font-weight: normal;
}
.fav-play {
  display: inline-block;
  width: 100%;
}
figure {
  margin: 0 0 1rem;
}
.fav-play > figure img {
  border-radius: 4px;
  width: 100%;
}
.tv-play-title{
	font-size: 17px;
	display: block;
}
.tv-play-sub-title{
	font-size: 13px;
	display: block;
}

/*slider*/
.owl-carousel.owl-loaded {
  display: block;
}
ul.owl-carousel {
  padding-left: 0;
  list-style: none;
  float: left;
  width: 100%;
}
.owl-carousel {
  position: relative;
  z-index: 1;
}
.owl-carousel .owl-stage-outer {
  position: relative;
  overflow: hidden;
  -webkit-transform: translate3d(0,0,0);
}
ul.owl-carousel {
  list-style: none;
}
.owl-prev {
  color: transparent;
}
.owl-prev, .owl-next {
  left: 0;
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
}
.owl-prev::before, .owl-next::before {
  background: #fff;
  border-radius: 50%;
  color: #f91942;
  content: "\f0d9";
  display: inline-block;
  font-family: fontawesome;
  font-size: 18px;
  left: -15px;
  line-height: 30px;
  position: absolute;
  text-align: center;
  top: 50%;
  transform: translateY(-50%);
  width: 30px;
  box-shadow: 0 3px 7px rgba(0,0,0,.5);
  transition: all 0.2s linear 0s;
}
.owl-next::before {
  content: "\f0da";
  left: auto;
  right: -15px;
}
.sugtd-frnd-meta {
  display: inline-block;
  margin-top: 10px;
  text-align: center;
  width: 100%;
}
.sugtd-frnd-meta > a {
  color: #515365;
  display: inline-block;
  font-size: 13.5px;
  font-weight: 500;
  width: 100%;
  transition: all 0.2s linear 0s;
}
.sugtd-frnd-meta > span {
  display: inline-block;
  font-size: 11px;
  width: 100%;
}
.add-remove-frnd {
  display: inline-block;
  list-style: outside none none;
  margin: 5px 0 0;
  padding: 0 10px;
  text-align: center;
  width: 100%;
}
.add-remove-frnd > li {
  display: inline-block;
  margin-right: 6px;
}
.add-remove-frnd > li a {
  border-radius: 4px;
  color: #fff;
  display: inline-block;
  padding: 2px 10px;
  transition: all 0.2s linear 0s;
  font-size: 13px;
}
.add-tofrndlist > a {
  background: #23d2e2 none repeat scroll 0 0;
}
.add-remove-frnd > li a > i {
  font-size: 14px;
}
.fa-commenting::before {
  content: "\f27a";
}
.add-remove-frnd > li:last-child {
  margin-right: 0;
}
.add-remove-frnd > li {
  display: inline-block;
}
.add-remove-frnd > li a {
  border-radius: 4px;
  color: #fff;
  display: inline-block;
  padding: 2px 10px;
  transition: all 0.2s linear 0s;
  font-size: 13px;
}
.remove-frnd > a {
  background: #a8adcd none repeat scroll 0 0;
}
.add-remove-frnd > li a > i {
  font-size: 14px;
}
.fa-user-times::before {
  content: "\f235";
}
.frndz-list .owl-item > li {
  background: #f2f7fb none repeat scroll 0 0;
  border: 1px solid #ede9e9;
  border-radius: 3px;
  padding-bottom: 7px;
}
.frndz-list .owl-item > li img {
  border-radius: 3px 3px 0 0;
}

.owl-nav .owl-prev {
  left: 1px;
}

.owl-nav .owl-next {
  right: 1px;
}
.owl-next {
  left: auto;
  right: 0;
}
.owl-prev:hover::before{background: #f91942;}
.owl-next:hover::before{background: #f91942;}
.owl-prev:hover::before, .owl-next:hover::before {
  color: #fff;
}
/*siderbar*/
.fixed-sidebar.right {
  left: auto;
  right: 0;
}
.fixed-sidebar {
  background: #fff none repeat scroll 0 0;
  height: 100vh;
  left: 0;
  padding-bottom: 30px;
  padding-top: 30px;
  position: fixed;
  top: 59px;
  width: 70px;
  z-index: 8;
  box-shadow: 0 0 34px 0 rgba(63, 66, 87, 0.1);
}
.chat-friendz {
  display: inline-block;
  text-align: center;
  width: 100%;
  position: relative;
}
.chat-users {
  display: inline-block;
  list-style: outside none none;
  margin-bottom: 0;
  padding-left: 0;
  width: 100%;
  position: relative;
  max-height: 79vh;
}
.chat-friendz {
  text-align: center;
}
.chat-users > li {
  display: inline-block;
  margin-bottom: 20px;
  position: relative;
  cursor: pointer;
}
.author-thmb {
  display: inline-block;
  position: relative;
  width: 100%;
}
.chat-users > li .author-thmb img {
  border-radius: 100%;
}
span.status.f-online {
  background: #7FBA00;
}
span.status {
  background: #bebebe none repeat scroll 0 0;
  border-radius: 50%;
  bottom: 0;
  display: inline-block;
  height: 10px;
  padding: 2px;
  position: absolute;
  right: 0;
  width: 10px;
}
.chat-users > li {
  cursor: pointer;
}
.chat-users {
  list-style: outside none none;
}



.owl-item .item-box {
  margin-bottom: 0;
}
.item-box {
  float: left;
  overflow: hidden;
  position: relative;
  width: 100%;
}
.item-box > a {
  display: inline-block;
  width: 100%;
}
.strip {
  position: relative;
}
.item-box:hover > a img {
  transform: scale(1.1);
}
.item-box > a img {
  border-radius: 5px;
  transition: all 0.2s linear 0s;
}
.item-box:hover .over-photo {
  bottom: 10px;
  opacity: 1;
  visibility: visible;
}
.over-photo {
  bottom: -10px;
  color: #fff;
  display: inline-block;
  left: 0;
  opacity: 0;
  padding: 0 10px;
  position: absolute;
  transition: all 0.2s linear 0s;
  visibility: hidden;
  width: 100%;
  z-index: 2;
}
.photos-list .over-photo .likes.heart {
  margin-right: 6px;
}
.over-photo .likes.heart {
  font-size: 16px;
  margin-right: 15px;
  vertical-align: middle;
}
.over-photo > a, .over-photo > div {
  display: inline-block;
  margin-right: 10px;
  vertical-align: middle;
}
.heart {
  height: 20px;
  transform: translateZ(0);
  color: #b3b1c5;
  font-size: 16px;
  cursor: pointer;
  position: relative;
  transition: all .3s ease;
}
.heart.happy::before {
  opacity: 0;
  transform: translateY(-30px) rotateZ(5deg);
  animation: fly 1s ease;
}
.heart::before {
  content: "❤";
  position: absolute;
  color: #A12B2B;
  opacity: 0;
}
.over-photo .likes.heart {
  font-size: 16px;
}
.item-box:hover .over-photo {
  visibility: visible;
}
.photos-list .over-photo .likes.heart > span {
  font-size: 12px;
}
.heart > span {
  color: #fff;
  display: inline-block;
  font-size: 13px;
  vertical-align: text-top;
}
.over-photo > span {
  color: #eee;
  float: right;
  font-size: 11.4px;
  margin-top: 5px;
  letter-spacing: -0.6px;
}
.heart.broken {
  color: #aaa;
  position: relative;
  transition: all .3s ease;
}
.heart.broken::after {
  clip: rect(0, 50px, 200px, 25px);
  animation: break-right 1s ease forwards;
}
.heart.broken::before, .heart.broken::after {
  content: "❤";
  opacity: 1;
  color: #ccc;
  position: absolute;
  top: -150px;
  transform: scale(3) rotateZ(0);
}
.item-box:hover::after {
  opacity: 1;
  visibility: visible;
}
.item-box::after, .feature-video::after {
  background: linear-gradient(to bottom, rgba(0,0,0,0) 0%,rgba(0,0,0,0.65) 83%);
  border-radius: 0 0 6px 6px;
  bottom: 0;
  content: "";
  height: 45px;
  left: 0;
  opacity: 0;
  position: absolute;
  transition: all 0.2s linear 0s;
  visibility: hidden;
  width: 100%;
  z-index: 1;
}
.play {
  cursor: pointer;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translateY(-50%) translateX(-50%);
}
svg {
  stroke: #fff;
}
svg {
  display: block;
  margin: 0 auto;
  overflow: visible !important;
}
.play {
  cursor: pointer;
}
.stroke-solid {
  fill: #f91942;
}
.stroke-solid {
  stroke-dashoffset: 0;
  stroke-dashArray: 300;
  stroke-width: 4px;
  transition: stroke-dashoffset 1s ease, opacity 1s ease;
  opacity: 0.7;
}
.play:hover .stroke-solid {
  opacity: 1;
  stroke-dashoffset: 300;
}
path.icon {
  fill: #fff;
}

@media screen and (max-width: 400px){
.fixed-sidebar {display: none;}
.sidebar{padding: 253px 0px 0px 0px;}
.about-top {padding: 0px;}
.fav-play{margin-bottom: 20px;}
.col-sm-12{padding-right: 0px; padding-left: 0px;}
}
@media screen and (min-width: 401px) and (max-width: 767px){
.fixed-sidebar {display: none;}
.sidebar{padding: 253px 0px 0px 0px;}
.about-top {padding: 0px;}
.fav-play{margin-bottom: 20px;}
.col-sm-12{padding-right: 0px; padding-left: 0px;}
}
@media screen and (min-width: 768px) and (max-width: 992px){
.fixed-sidebar {display: none;}
.sidebar{padding: 253px 0px 0px 0px;}
.about-top {padding: 0px;}
.col-sm-12{padding-right: 0px; padding-left: 0px;}
.fav-play{margin-bottom: 20px;}
}
</style>
			
<div class="fixed-sidebar right">
		<div class="chat-friendz">
			<ul class="chat-users">
				<li>
					<div class="author-thmb">
						<img src="/images/newimage/side-friend1.jpg" alt="">
						<span class="status f-online"></span>
					</div>
				</li>
				<li>
					<div class="author-thmb">
						<img src="/images/newimage/side-friend2.jpg" alt="">
						<span class="status f-away"></span>
					</div>
				</li>
				<li>
					<div class="author-thmb">
						<img src="/images/newimage/side-friend3.jpg" alt="">
						<span class="status f-online"></span>
					</div>
				</li>
				<li>
					<div class="author-thmb">
						<img src="/images/newimage/side-friend4.jpg" alt="">
						<span class="status f-offline"></span>
					</div>
				</li>
				<li>
					<div class="author-thmb">
						<img src="/images/newimage/side-friend5.jpg" alt="">
						<span class="status f-online"></span>
					</div>
				</li>
				<li>
					<div class="author-thmb">
						<img src="/images/newimage/side-friend6.jpg" alt="">
						<span class="status f-online"></span>
					</div>
				</li>
				<li>
					<div class="author-thmb">
						<img src="/images/newimage/side-friend7.jpg" alt="">
						<span class="status f-offline"></span>
					</div>
				</li>
				<li>
					<div class="author-thmb">
						<img src="/images/newimage/side-friend8.jpg" alt="">
						<span class="status f-online"></span>
					</div>
				</li>
				<li>
					<div class="author-thmb">
						<img src="/images/newimage/side-friend9.jpg" alt="">
						<span class="status f-away"></span>
					</div>
				</li>
				<li>
					<div class="author-thmb">
						<img src="/images/newimage/side-friend10.jpg" alt="">
						<span class="status f-away"></span>
					</div>
				</li>
				<li>
					<div class="author-thmb">
						<img src="/images/newimage/side-friend8.jpg" alt="">
						<span class="status f-online"></span>
					</div>
				</li>
			</ul>
		
		</div>
	</div> 
	
	<div class="container">
		<div class="col-sm-12 col-lg-4 col-md-4">
								<aside class="sidebar">
								<div class="central-meta stick-widget">
									<span class="create-post">Personal Info</span>
									<div class="personal-head">
										<span class="f-title"><i class="fa fa-user"></i> About Me:</span>
										<p>
											Hi, I’m John Carter, I’m 36 and I work as a Digital Designer for the “dewwater” Agency in Ontario, Canada
										</p>
										<span class="f-title"><i class="fa fa-birthday-cake"></i> Birthday:</span>
										<p>
											December 17, 1985 
										</p>
										<span class="f-title"><i class="fa fa-phone"></i> Phone Number:</span>
										<p>
											+1-989-232435234 
										</p>
										
										<span class="f-title"><i class="fa fa-male"></i> Gender:</span>
										<p>
											Male 
										</p>
										<span class="f-title"><i class="fa fa-globe"></i> Country:</span>
										<p>
											San Francisco, California, USA 
										</p>
										
										<span class="f-title"><i class="fa fa-handshake-o"></i> Joined:</span>
										<p>
											December 20, 2001  
										</p>
										
									</div>
								</div>
								</aside>	
							</div>	
						
		<div class="col-sm-12 col-lg-8 col-md-8 about-top">
				<div class="central-meta">
									<span class="create-post">Booked Activities (100) <a href="#" title="">See All</a></span>
									<div class="row">
										<div class="col-lg-4 col-md-6 col-sm-3">
											<div class="fav-play">
												<figure>
													<img src="/images/newimage/tvplay1.jpg" alt="">
												</figure>	
												<span class="tv-play-title">Kickboxing for Adults</span>
												<span class="tv-play-sub-title">Valor Mixed Martial Arts</span>
												<span class="tv-play-sub-title">New York, NY United States</span>
											</div>
										</div>
										<div class="col-lg-4 col-md-6 col-sm-3">
											<div class="fav-play">
												<figure>
													<img src="/images/newimage/tvplay2.jpg" alt="">
												</figure>	
												<span class="tv-play-title">Family Adventures</span>
												<span class="tv-play-sub-title">England Tour Group</span>
												<span class="tv-play-sub-title">London, England United Kingdom</span>
											</div>
										</div>
										<div class="col-lg-4 col-md-6 col-sm-3">
											<div class="fav-play">
												<figure>
													<img src="/images/newimage/tvplay3.jpg" alt="">
												</figure>	
												<span class="tv-play-title">Yoga In Nature Experience</span>
												<span class="tv-play-sub-title">Pure Yoga</span>
												<span class="tv-play-sub-title">Austin, Tx United Stated</span>
											</div>
										</div>
									</div>
								</div>
								
								<div class="central-meta">
									<span class="create-post">Followers (1.3m) <a href="#" title="">See All</a></span>
									<ul class="frndz-list owl-carousel owl-theme owl-responsive-1000 owl-loaded">
										<li>
											<img src="/images/newimage/recent1.jpg" alt="">
											<div class="sugtd-frnd-meta">
												<a href="#" title="">Olivia</a>
												<span>1 mutual friend</span>
												<ul class="add-remove-frnd">
													<li class="add-tofrndlist"><a class="send-mesg" href="#" title="Send Message"><i class="fa fa-commenting"></i></a></li>
													<li class="remove-frnd"><a href="#" title="remove friend"><i class="fa fa-user-times"></i></a></li>
												</ul>
											</div>
										</li>
										<li>
											<img src="/images/newimage/recent2.jpg" alt="">
											<div class="sugtd-frnd-meta">
												<a href="#" title="">Emma watson</a>
												<span>2 mutual friend</span>
												<ul class="add-remove-frnd">
													<li class="add-tofrndlist"><a class="send-mesg" href="#" title="Send Message"><i class="fa fa-commenting"></i></a></li>
													<li class="remove-frnd"><a href="#" title="remove friend"><i class="fa fa-user-times"></i></a></li>
												</ul>
											</div>
										</li>
										<li>
											<img src="/images/newimage/recent3.jpg" alt="">
											<div class="sugtd-frnd-meta">
												<a href="#" title="">Isabella</a>
												<span><a href="#" title="">Emmy</a> is mutual friend</span>
												<ul class="add-remove-frnd">
													<li class="add-tofrndlist"><a class="send-mesg" href="#" title="Send Message"><i class="fa fa-commenting"></i></a></li>
													<li class="remove-frnd"><a href="#" title="remove friend"><i class="fa fa-user-times"></i></a></li>
												</ul>
											</div>
										</li>
										<li>
											<img src="/images/newimage/recent4.jpg" alt="">
											<div class="sugtd-frnd-meta">
												<a href="#" title="">Amelia</a>
												<span>5 mutual friend</span>
												<ul class="add-remove-frnd">
													<li class="add-tofrndlist"><a class="send-mesg" href="#" title="Send Message"><i class="fa fa-commenting"></i></a></li>
													<li class="remove-frnd"><a href="#" title="remove friend"><i class="fa fa-user-times"></i></a></li>
												</ul>
											</div>
										</li>
										<li>
											<img src="/images/newimage/recent5.jpg" alt="">
											<div class="sugtd-frnd-meta">
												<a href="#" title="">Sophia</a>
												<span>1 mutual friend</span>
												<ul class="add-remove-frnd">
													<li class="add-tofrndlist"><a class="send-mesg" href="#" title="Send Message"><i class="fa fa-commenting"></i></a></li>
													<li class="remove-frnd"><a href="#" title="remove friend"><i class="fa fa-user-times"></i></a></li>
												</ul>
											</div>
										</li>
										<li>
											<img src="/images/newimage/recent6.jpg" alt="">
											<div class="sugtd-frnd-meta">
												<a href="#" title="">Amelia</a>
												<span>3 mutual friend</span>
												<ul class="add-remove-frnd">
													<li class="add-tofrndlist"><a class="send-mesg" href="#" title="Send Message"><i class="fa fa-commenting"></i></a></li>
													<li class="remove-frnd"><a href="#" title="remove friend"><i class="fa fa-user-times"></i></a></li>
												</ul>
											</div>
										</li>
									</ul>
								</div><!-- friends list -->
								
			<div class="central-meta">
									<span class="create-post">Photos (580) <a href="index.html" title="">See All</a></span>
									<ul class="photos-list owl-carousel owl-theme owl-responsive-1000 owl-loaded">
										<li>
											<div class="item-box">
												<a class="strip" href="/images/newimage/photo-22.jpg" title="" data-strip-group="mygroup" data-strip-group-options="loop: false">
												<img src="/images/newimage/photo2.jpg" alt=""></a>
												<div class="over-photo">
													<div class="likes heart" title="Like/Dislike">❤ <span>15</span></div>
													<span>20 hours ago</span>
												</div>
											</div>
										</li>
										<li>
											<div class="item-box">
												<a class="strip" href="/images/newimage/photo-33.jpg" title="" data-strip-group="mygroup" data-strip-group-options="loop: false">
												<img src="/images/newimage/photo3.jpg" alt=""></a>
												<div class="over-photo">
													<div class="likes heart" title="Like/Dislike">❤ <span>20</span></div>
													<span>20 days ago</span>
												</div>
											</div>
										</li>
										<li>
											<div class="item-box">
												<a class="strip" href="/images/newimage/photo-44.jpg" title="" data-strip-group="mygroup" data-strip-group-options="loop: false">
												<img src="/images/newimage/photo4.jpg" alt=""></a>
												<div class="over-photo">
													<div class="likes heart" title="Like/Dislike">❤ <span>155</span></div>
													<span>Yesterday</span>
												</div>
											</div>
										</li>
										<li>
											<div class="item-box">
												<a class="strip" href="/images/newimage/photo-55.jpg" title="" data-strip-group="mygroup" data-strip-group-options="loop: false">
												<img src="/images/newimage/photo5.jpg" alt=""></a>
												<div class="over-photo">
													<div class="likes heart" title="Like/Dislike">❤ <span>201</span></div>
													<span>3 weeks ago</span>
												</div>
											</div>
										</li>
										<li>
											<div class="item-box">
												<a class="strip" href="/images/newimage/photo-66.jpg" title="" data-strip-group="mygroup" data-strip-group-options="loop: false">
												<img src="/images/newimage/photo6.jpg" alt=""></a>
												<div class="over-photo">
													<div class="likes heart" title="Like/Dislike">❤ <span>81</span></div>
													<span>2 months ago</span>
												</div>
											</div>
										</li>
										<li>
											<div class="item-box">
												<a class="strip" href="/images/newimage/photo-77.jpg" title="" data-strip-group="mygroup" data-strip-group-options="loop: false">
												<img src="/images/newimage/photo7.jpg" alt=""></a>
												<div class="over-photo">
													<div class="likes heart" title="Like/Dislike">❤ <span>98</span></div>
													<span>1 day</span>
												</div>
											</div>
										</li>
										<li>
											<div class="item-box">
												<a class="strip" href="/images/newimage/photo-88.jpg" title="" data-strip-group="mygroup" data-strip-group-options="loop: false">
												<img src="/images/newimage/photo8.jpg" alt=""></a> 
												<div class="over-photo">
													<div class="likes heart" title="Like/Dislike">❤ <span>87</span></div>
													<span>23 hours ago</span>
												</div>
											</div>
										</li>
									</ul>
			</div>
			
			<div class="central-meta">
									<span class="create-post">Videos (33) <a href="index.html" title="">See All</a></span>
									<ul class="videos-list owl-carousel owl-theme owl-responsive-1000 owl-loaded">
										<li>
											<div class="item-box">
												<a href="https://www.youtube.com/watch?v=fF382gwEnG8&t=1s" title="" data-strip-group="mygroup" class="strip" data-strip-options="width: 700,height: 450,youtube: { autoplay: 1 }"><img src="/images/newimage/vid-11.jpg" alt="">
												<i>
													<svg version="1.1" class="play" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="50px" width="50px"
													 viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
												  <path class="stroke-solid" fill="none" stroke=""  d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7
													C97.3,23.7,75.7,2.3,49.9,2.5"/>
												  <path class="icon" fill="" d="M38,69c-1,0.5-1.8,0-1.8-1.1V32.1c0-1.1,0.8-1.6,1.8-1.1l34,18c1,0.5,1,1.4,0,1.9L38,69z"/>
													</svg>
												</i>
												</a>
												<div class="over-photo">
													<div class="likes heart" title="Like/Dislike">❤ <span>15</span></div>
													<span>20 hours ago</span>
												</div>
											</div>	
										</li>
										<li>
											<div class="item-box">
												<a href="https://www.youtube.com/watch?v=fF382gwEnG8&t=1s" title="" data-strip-group="mygroup" class="strip" data-strip-options="width: 700,height: 450,youtube: { autoplay: 1 }"><img src="/images/newimage/vid-12.jpg" alt="">
												<i>
													<svg version="1.1" class="play" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="50px" width="50px"
													 viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
													  <path class="stroke-solid" fill="none" stroke=""  d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7
														C97.3,23.7,75.7,2.3,49.9,2.5"/>
													  <path class="icon" fill="" d="M38,69c-1,0.5-1.8,0-1.8-1.1V32.1c0-1.1,0.8-1.6,1.8-1.1l34,18c1,0.5,1,1.4,0,1.9L38,69z"/>
														</svg>
													</i>
												</a>
												<div class="over-photo">
													<div class="likes heart" title="Like/Dislike">❤ <span>20</span></div>
													<span>20 hours ago</span>
												</div>
											</div>
										</li>
										<li>
											<div class="item-box">
												<a href="https://www.youtube.com/watch?v=fF382gwEnG8&t=1s" title="" data-strip-group="mygroup" class="strip" data-strip-options="width: 700,height: 450,youtube: { autoplay: 1 }"><img src="/images/newimage/vid-10.jpg" alt="">
													<i>
														<svg version="1.1" class="play" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="50px" width="50px"
														 viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
													  <path class="stroke-solid" fill="none" stroke=""  d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7
														C97.3,23.7,75.7,2.3,49.9,2.5"/>
													  <path class="icon" fill="" d="M38,69c-1,0.5-1.8,0-1.8-1.1V32.1c0-1.1,0.8-1.6,1.8-1.1l34,18c1,0.5,1,1.4,0,1.9L38,69z"/>
														</svg>
													</i>
												</a>
												<div class="over-photo">
													<div class="likes heart" title="Like/Dislike">❤ <span>49</span></div>
													<span>20 days ago</span>
												</div>
											</div>
										</li>
										<li>
											<div class="item-box">
												<a href="https://www.youtube.com/watch?v=fF382gwEnG8&t=1s" title="" data-strip-group="mygroup" class="strip" data-strip-options="width: 700,height: 450,youtube: { autoplay: 1 }"><img src="/images/newimage/vid-9.jpg" alt="">
													<i>
														<svg version="1.1" class="play" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="50px" width="50px"
														 viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
													  <path class="stroke-solid" fill="none" stroke=""  d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7
														C97.3,23.7,75.7,2.3,49.9,2.5"/>
													  <path class="icon" fill="" d="M38,69c-1,0.5-1.8,0-1.8-1.1V32.1c0-1.1,0.8-1.6,1.8-1.1l34,18c1,0.5,1,1.4,0,1.9L38,69z"/>
														</svg>
													</i>
												</a>
												<div class="over-photo">
													<div class="likes heart" title="Like/Dislike">❤ <span>156</span></div>
													<span>Yesterday</span>
												</div>
											</div>
										</li>
										<li>
											<div class="item-box">
												<a href="https://www.youtube.com/watch?v=fF382gwEnG8&t=1s" title="" data-strip-group="mygroup" class="strip" data-strip-options="width: 700,height: 450,youtube: { autoplay: 1 }"><img src="/images/newimage/vid-6.jpg" alt="">
													<i>
														<svg version="1.1" class="play" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="50px" width="50px"
														 viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
													  <path class="stroke-solid" fill="none" stroke=""  d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7
														C97.3,23.7,75.7,2.3,49.9,2.5"/>
													  <path class="icon" fill="" d="M38,69c-1,0.5-1.8,0-1.8-1.1V32.1c0-1.1,0.8-1.6,1.8-1.1l34,18c1,0.5,1,1.4,0,1.9L38,69z"/>
														</svg>
													</i>
												</a>
												<div class="over-photo">
													<div class="likes heart" title="Like/Dislike">❤ <span>202</span></div>
													<span>3 weeks ago</span>
												</div>
											</div>
										</li>
									</ul>
								</div>
			</div>
		</div>



<script src="{{ url('public/js/new/main.min.js') }}"></script>  
<script src="{{ url('public/js/new/script.js') }}"></script>
<script>$('.owl-carousel').owlCarousel({
  loop: true,
  margin: 10,
  nav: true,
  navText: [
    "<i class='fa fa-caret-left'></i>",
    "<i class='fa fa-caret-right'></i>"
  ],
  autoplay: true,
  autoplayHoverPause: true,
  responsive: {
    0: {
      items: 1
    },
    600: {
      items: 3
    },
    1000: {
      items: 5
    }
  }
})</script>
@endsection
