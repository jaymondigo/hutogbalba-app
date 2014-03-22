<!DOCTYPE html>
<html @yield('html_attr')>
    <head> 
    	<link id="page_favicon" href="{{URL::to('img/logo.png')}}" rel="icon" type="image/x-icon">
    
        @yield('head') 
    </head>
<body base-url="{{URL::to('')}}" @yield('body_attr')>

	@yield('header')

	@yield('body')

	@yield('footer')
	
	@yield('scripts')

</body>
</html>
 
 <!-- Developer:
			Jillberth Estillore
			Arnel Lenteria	 \
			Ivan Kirby Colina
	 -->
