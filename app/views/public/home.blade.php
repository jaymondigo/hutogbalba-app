<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="{{URL::to('css/bootstrap.css')}}"/>
		<link rel="stylesheet" type="text/css" href="{{URL::to('css/font-awesome.css')}}"/>
		<link rel="stylesheet" type="text/css" href="{{URL::to('css/AdminLTE.css')}}"/>
		<link rel="stylesheet" type="text/css" href="{{URL::to('css/ionicons.css')}}"/>
		<link rel="stylesheet" type="text/css" href="{{URL::to('css/landing-page.css')}}"/>
		<title>Dream Builder Solutions Beta</title>
		<link id="page_favicon" href="{{URL::to('img/logo.png')}}" rel="icon" type="image/x-icon">
	</head>
	<body class="skin-blue">
		<div class="container-narrow">
			<header class="header">
				<nav class="navbar navbar-fixed-top" role="navigation">
			        <div class="navbar-header">
			          	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			            	<span class="sr-only">Toggle navigation</span>	
			            	<span class="icon-bar"></span>
			            	<span class="icon-bar"></span>
			            	<span class="icon-bar"></span>
			          	</button>
						<a href="#" class="logo navbar-brand">Dream Builder Solutions<sup>&nbsp;Beta</sup></a>
			        </div>
			        <div class="collapse navbar-collapse pull-right">
			          	<ul class="nav navbar-nav">
			            	<li class="active"><a href="#">Home</a></li>
			            	<li><a href="#about">About</a></li>
			            	<li><a href="#contact">Contact</a></li>
			            	<li><a href="#faqs">FAQS</a></li>
			          	</ul>
			        </div><!--/.nav-collapse -->
      			</nav>
			</header>
			<div class="jumbotron text-center background">
				<div class="con">
					<h2>DREAM . VISUALIZE . BUILD</h2>
					<p class="lead">
						Design your life the way you want it to be
					</p>
					<a class="btn btn-success btn-lg" href="{{URL::to('user/login')}}">Start Dreaming Now!</a>
				</div>
			</div>
			<section id="about" class="section">
				<h1 class="page-header">
					About us
					<small>Meet the team behind the app Dream Builder Solutions</small>
				</h1>
				<div class="jumbotron background-about">
					<div class="container">
						<div class="row boys">
							<div class="col-md-12">
								<img class="img-about img-circle jillberth" src="{{URL::to('img/jillberth.jpg')}}" data-toggle="popover" data-placement="right" data-content="Lead Developer" title="" data-original-title="Jillberth Estillore">
								<img class="img-about img-circle arnel" src="{{URL::to('img/arnel.jpg')}}" data-toggle="popover" data-placement="right" data-content="Lead Developer" title="" data-original-title="Arnel Lenteria">
								<img class="img-about img-circle ivan" src="{{URL::to('img/ivan.jpg')}}" data-toggle="popover" data-placement="right" data-content="Data Analyst" title="" data-original-title="Ivan Kirby Colina">
								<img class="img-about img-circle archie" src="{{URL::to('img/archie.jpg')}}" data-toggle="popover" data-placement="right" data-content="Researcher" title="" data-original-title="Archie Rapista">
							</div>
						</div>
						<div class="row girls">
							<div class="col-md-12">
								<img class="img-about img-circle angeline" src="{{URL::to('img/angeline.jpg')}}" data-toggle="popover" data-placement="right" data-content="Project Manager" title="" data-original-title="Angeline Ygrubay">
								<img class="img-about img-circle cheza" src="{{URL::to('img/cheza.jpg')}}" data-toggle="popover" data-placement="right" data-content="External Relation Officer" title="" data-original-title="Cheza Mae Dahuya">
								<img class="img-about img-circle christy" src="{{URL::to('img/christy.jpg')}}" data-toggle="popover" data-placement="right" data-content="Documentation" title="" data-original-title="Christy Adarna">
							</div>
						</div>
					</div>
				</div>
			</section>
			<section id="contact" class="section">
				<h1 class="page-header">
					Contact us
					<small>Stay in touch with us for more updates about the app Dream Builder Solutions</small>
				</h1>
				<div class="background-contact">
					<div class="container">
						<div class="row">
							<div class="col-md-5">
								<div class="box box-solid box-primary box-contact">
	                                <div class="box-header">
	                                    <h3 class="box-title">Contact Form</h3>
	                                    <div class="box-tools pull-right">
	                                    </div>
	                                </div>
	                                <div class="box-body">
	                                    <form class="form-contact" action="#" method="POST">
	                                    	<div class="input-group input-group-lg">
											  	<span class="input-group-addon">
											  		<span class="glyphicon glyphicon-envelope"></span>
											  	</span>
											  	<input type="text" class="form-control" placeholder="Your Email Address">
											</div>
											<br/>
											<textarea class="form-control input-lg" placeholder="Your Message" style="height: 250px"></textarea>
											<br/>
											<button class="btn btn-primary btn-block btn-lg">Submit</button>
	                                    </form>
                                    </div>
                                </div><!-- /.box-body -->
                            </div>
                            <div class="col-md-7">
                            	<br/>
                            	<span class="label bg-blue instruction-contact">If you have any concerns or suggestions you can: </span>
                            	<ul class="list-unstyled list-contact-number">
                            		<li>Contact at us</li>
                            		<li><span class="label bg-blue"><span class="glyphicon glyphicon-phone-alt"></span> +32-2-386841</span></li>
                            		<li><span class="label bg-blue"><span class="glyphicon glyphicon-phone-alt"></span> &nbsp;09167474514</span></li>
                            		<li><span class="label bg-blue"><span class="glyphicon glyphicon-phone-alt"></span> &nbsp;09309301912</span></li>
                            		<li><span class="label bg-blue"><span class="glyphicon glyphicon-phone-alt"></span> &nbsp;09321234567</span></li>
                        		</ul>
                        		<ul class="list-unstyled list-contact-email">
                            		<li>Email at us</li>
                            		<li><span class="label bg-blue"><span class="glyphicon glyphicon-envelope"></span> <a href="mailto:dreambuildersolutions@gmail.com">&nbsp;dreambuildersolutions@gmail.com</a></span></li>
                            	</ul> 
                            </div>
						</div>
					</div>
				</div>
			</section>
			<section id="faqs" class="section">
				<h1 class="page-header">
					FAQ
					<small>Here are the questions that are asked by the users about the app Dream Builder Solutions</small>
				</h1>
				<div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title"><i class="fa fa-comments-o"></i></h3>
                    </div>
                    <div class="box-body chat" id="chat-box">
                        <!-- chat item -->
                        <div class="item">
                            <p class="message">
                                <a href="#" class="name">
                                    <strong>What is Dream Builder Solutions?</strong>
                                </a>
                                It is a web app, which helps Dreamers visualize their dream house in a fun and easy way.
                                This displays 2D, 3D and floor plan view of the house design plus cost of materials to be used depending on the supplier price.
                            </p>
                        </div><!-- /.item -->
                        <!-- chat item -->
                        <div class="item">
                            <p class="message">
                                <a href="#" class="name">
                                    <strong>Is Dream Builder Solutions free?</strong>
                                </a>
                                Yes, this is absolutely free, what you need to do is just to Sign Up an account and start visualizing your dream.
                            </p>
                        </div><!-- /.item -->
                        <!-- chat item -->
                        <div class="item">
                            <p class="message">
                                <a href="#" class="name">
                                    <strong>Where did Dream Builder Solutions gathered the costing of the materials?</strong>
                                </a>
                                Researchers of this system gathered information from the hardware suppliers of Cebu City based on their current price.
                            </p>
                        </div><!-- /.item -->
                     	<div class="item">
                            <p class="message">
                                <a href="#" class="name">
                                    <strong>How do I get started?</strong>
                                </a>
                                Click on <a class="label bg-green" href="#">Sign Up</a>, complete the validation process... and you are free so enjoy using the app :)
                            </p>
                        </div><!-- /.item -->
                    </div><!-- /.chat -->
                    <div class="box-footer">
                        <div class="input-group">
                            <input class="form-control" placeholder="Type message...">
                            <div class="input-group-btn">
                                <button class="btn btn-success"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
			</section>
			<footer class="footer">
				<p class="text-center">&copy; Dream Builder Solutions <?php echo date('Y');?></p>
			</footer>
		</div>
	</body>
	<script type="text/javascript" src="{{URL::to('js/jquery-2.0.3.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::to('js/bootstrap.js')}}"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.img-about').popover({trigger: 'hover'});
			$('.img-about').hover(function(){
				$(this).css('opacity','1');
			},function(){
				$(this).css('opacity','0.5');
			});
		})
	</script>
</html>

<!-- Developer:
			Jillberth Estillore
			Arnel Lenteria	 \
			Ivan Kirby Colina
	 -->