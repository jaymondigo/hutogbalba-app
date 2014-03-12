<!DOCTYPE html>
<html @yield('html_attr')>
    <head> 

        @yield('head') 
    </head>
<body base-url="{{URL::to('')}}" @yield('body_attr')>

	@yield('header')

	@yield('body')

	@yield('footer')
	
	@yield('scripts')
	<!-- Developer:
			Jillberth Estillore
			Arnel Lenteria	 
	 -->
</body>
</html>
 
