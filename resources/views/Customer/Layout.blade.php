<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from caketheme.com/html/ruper/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 Dec 2024 15:47:59 GMT -->

<head>
	<!-- Meta Data -->
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ $title }}</title>

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="/Customer/media/favicon.png">

	<!-- Dependency Styles -->
	@yield("TemplateStyle")

	<!-- Site Stylesheet -->
	<link rel="stylesheet" href="/Customer/assets/css/app.css" type="text/css">
	<link rel="stylesheet" href="/Customer/assets/css/responsive.css" type="text/css">

	<!-- Google Web Fonts -->
	<link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:wght@100;200;300;400;500;600;700&amp;display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=EB+Garamond:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic&amp;display=swap" rel="stylesheet">

	@yield("Style")
</head>

<body class="page">
	<div id="page" class="hfeed page-wrapper">
		@include("Customer.Include.Header")

		@yield("Content")

		@include("Customer.Include.Footer", ["title" => $title])
	</div>

	<!-- Back Top button -->
	<div class="back-top button-show">
		<i class="arrow_carrot-up"></i>
	</div>

	<!-- Search -->
	<div class="search-overlay">
		<div class="close-search"></div>
		<div class="wrapper-search">
			<form role="search" method="get" class="search-from ajax-search" action="#">
				<div class="search-box">
					<button id="searchsubmit" class="btn" type="submit">
						<i class="icon-search"></i>
					</button>
					<input id="myInput" type="text" autocomplete="off" value="" name="s" class="input-search s"
						placeholder="Search...">
					<div class="search-top">
						<div class="close-search">Cancel</div>
					</div>
					<div class="content-menu_search">
						<label>Suggested</label>
						<ul id="menu_search" class="menu">
							<li><a href="#">Furniture</a></li>
							<li><a href="#">Home Décor</a></li>
							<li><a href="#">Industrial</a></li>
							<li><a href="#">Kitchen</a></li>
						</ul>
					</div>
				</div>
			</form>
		</div>
	</div>

	<!-- Page Loader -->
	<div class="page-preloader">
		<div class="loader">
			<div></div>
			<div></div>
		</div>
	</div>

	<!-- Dependency Scripts -->
	@yield("TemplateScript")

	<!-- Site Scripts -->
	<script src="/Customer/assets/js/app.js"></script>
	<script>
		function escapeXml(unsafe){
			return unsafe.replaceAll("<", "&lt;")
				.replaceAll(">", "&gt;")
				.replaceAll("&", "&amp;")
				.replaceAll("'", "&apos;")
				.replaceAll("\"", "&quot;");
		}
		function toCustomDateString(strDate, format){
			let date = new Date(strDate.replaceAll(" ", "T"));
			let months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

			switch (format){
				case("M d, Y"):
					return months[date.getMonth()] + " " + (date.getDate() < 10 ? "0" : "") + date.getDate() + ", " + date.getFullYear();
			}
		}
		function formatCurrency(num){
			return Math.round(num).toLocaleString("vi-VN");
		}

		window.addEventListener("load", () => {

			setTimeout(() => {
				let removeEventList = document.querySelectorAll(".removeEvent");
				removeEventList.forEach((item) => {
					item.outerHTML = item.outerHTML;
				});
			}, 1000);

			@php
				$titles = [
					"Home Page",
					"Product Category Page",
					"Product Detail Page",
					"Wishlist Page",
				];
			@endphp
			@if(in_array($title, $titles))
				
				setTimeout(() => {
					let addToWishlistList = document.querySelectorAll(".addToWishlist");
					addToWishlistList.forEach((item) => {
						item.addEventListener("click", () => {
							$.ajax({
								url: "/Customer/Wishlist/AddProductToWishlist",
								type: "post",
								data: {
									productId: parseInt(item.getAttribute("productId")),
									_token: "{{ csrf_token() }}"
								},
								dataType: "json",
								beforeSend: () => {
									document.querySelector(".page-preloader").style.display = "flex";
								},
								success: (data) => {
									if(typeof data.error != "undefined"){
										window.location.replace(data.error);
										return;
									}

									alert(data.message);
									if(data.message == "Added successfully!"){
										let wishlistCount = document.querySelector(".wishlistCount");
										if(wishlistCount.innerHTML != "9+"){
											let wishlistCountNum = parseInt(wishlistCount.innerHTML) + 1;
											wishlistCount.innerHTML = wishlistCountNum <= 9 ? String(wishlistCountNum) : "9+";
										}
									}

									if(typeof data.success != "undefined"){
										window.location.replace(data.success);
									}
								},
								complete: () => {
									document.querySelector(".page-preloader").style.display = "none";
								},
								error: (jqXHR, textStatus, errorThrown) => {
									console.log(jqXHR);
									console.log(textStatus);
									console.log(errorThrown);
								}
							});
						});
					});
				}, 1500);

				setTimeout(() => {
					let addToCartList = document.querySelectorAll(".addToCart");
					addToCartList.forEach((item) => {
						item.addEventListener("click", () => {
							$.ajax({
								url: "/Customer/Cart/AddProductToCart",
								type: "post",
								data: {
									productId: parseInt(item.getAttribute("productId")),
									_token: "{{ csrf_token() }}"
								},
								dataType: "json",
								beforeSend: () => {
									document.querySelector(".page-preloader").style.display = "flex";
								},
								success: (data) => {
									if(typeof data.error != "undefined"){
										window.location.replace(data.error);
										return;
									}

									alert(data.message);
									if(data.message == "Added successfully!"){
										document.querySelector(".cartCount").innerHTML = data.cartCount <= 9 ? String(data.cartCount) : "9+";
									}

									if(typeof data.success != "undefined"){
										window.location.replace(data.success);
									}
								},
								complete: () => {
									document.querySelector(".page-preloader").style.display = "none";
								},
								error: (jqXHR, textStatus, errorThrown) => {
									console.log(jqXHR);
									console.log(textStatus);
									console.log(errorThrown);
								}
							});
						});
					});
				}, 1500);
			@endif

			
		});
	</script>

	@yield("Script")
</body>

<!-- Mirrored from caketheme.com/html/ruper/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 Dec 2024 15:47:59 GMT -->

</html>