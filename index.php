<?php include "connect.php"; ?>
<!DOCTYPE html>
<html>
<head>
<title>Visual Link Tracker</title>
<style>
* {
	margin: 0 auto;
	box-sizing: border-box;
}
body {
	padding: 0;
	margin: 0;
	font-family: Arial;
}
h1 {
	padding-bottom: 20px;
}
p {
	padding-bottom: 15px;
	line-height: 1.3em;
}
.btn {
	background: #ff9000;
	padding: 10px;
	display: block;
	text-align: center;
	border-radius: 5px;
	font-weight: bold;
	color: #fff;
	text-decoration: none;
}
.wrapper {
	max-width: 960px;
	padding: 15px;
	margin: 0 auto;
}
.click-data {
	position: absolute;
	background: rgba(0,0,0,.2);
	color: #fff;
	border: 1px solid #000;
	transition-property: top, left;
	transition-duration: .5s;
	text-align: center;
	font-size: 18px;
}
.click-data span {
	display: none;
}
.click-data:hover {
	background: rgba(0,0,0,1);
}
.click-data:hover span {
	display: block;
}
.copyright {
	position: fixed;
	left: 10px;
	bottom: 10px;
	color: #ccc;
	font-size: 12px;
	padding: 0;
}
#total-clicks {
	display: none;
}
</style>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
$(document).ready(function() {
	$("a").click(function(e) {
		e.preventDefault();
		var linkID = $(this).attr("id"),
			linkHref = $(this).attr("href"),
			linkText = $(this).text();

		$.ajax({
		  url: "add-click.php",
		  type: "POST",
		  data: { linkID: linkID, linkHref: linkHref, linkText: linkText },
		  success: function(data) {
			console.log(data);
		  }
		});
	});
	
	function clickData() {
		var countArray = [],
			totalClicks = 0,
			browserWidth = $(window).width(),
			halfBrowserWidth = browserWidth/2,
			quarterBrowserWidth = browserWidth/4,
			totalLinks = $(".click-data").length,
			totalClicks = parseInt($("#total-clicks").text());
		
		$("div.click-data").each(function() {
			var id = $(this).data("id"),
				clickCount = $(this).data("count"),
				width = $("#"+id).outerWidth(),
				height = $("#"+id).outerHeight(),
				left = $("#"+id).offset().left,
				top = $("#"+id).offset().top;
			
			//countArray.push( {'id': anchorID, 'count': clickCount, 'widthHeight': ''} );
			
			/*$("div[data-id='"+anchorID+"']").css({
				"left": left+"px",
				"top": top+"px",
				"width": 
			});*/
			
			/*if (clickCount < 5) {
				$("div[data-id='"+anchorID+"']").css({
					"left": left+"px",
					"top": top+"px",
					"width": "100px",
					"height": "100px",
					"margin-top": (height/2)-(50)+"px",
					"margin-left": (width/2)-(50)+"px",
					"border-radius": "50px",
					"line-height": "100px"
				});
			} else if (clickCount > 5 && clickCount < 10) {
				$(".click-data[data-id='"+anchorID+"']").css({
					"left": left+"px",
					"top": top+"px",
					"width": "200px",
					"height": "200px",
					"margin-top": (height/2)-(100)+"px",
					"margin-left": (width/2)-(100)+"px",
					"border-radius": "100px",
					"line-height": "200px"
				});
			} else if (clickCount > 10 && clickCount < 15) {
				$(".click-data[data-id='"+anchorID+"']").css({
					"left": left+"px",
					"top": top+"px",
					"width": "300px",
					"height": "300px",
					"margin-top": (height/2)-(150)+"px",
					"margin-left": (width/2)-(150)+"px",
					"border-radius": "150px",
					"line-height": "300px"
				});
			}*/
			
			if (browserWidth > 980) {
				var size = halfBrowserWidth;
			} else {
				var size = browserWidth;
			}
			
			var ratio = clickCount/totalClicks;
			
			$(this).css({
				"left": left+"px",
				"top": top+"px",
				"width": Math.round(size*ratio)+"px",
				"height": Math.round(size*ratio)+"px",
				"margin-top": Math.round((height/2)-(size*ratio/2))+"px",
				"margin-left": Math.round((width/2)-(size*ratio/2))+"px",
				"border-radius": Math.round(size*ratio/2)+"px",
				"line-height": Math.round(size*ratio)+"px"
			});
		});
		
		/*countArray.sort(function(a,b) {
			return a.count-b.count;
		});*/
		
	}
	
	clickData();
	
	var timer;
	
	function startResize() {
		timer = setTimeout(function() {
			clickData();
		}, 300);
	}
	
	$(".turn-on").on("click",function() {
		$(".click-data").fadeIn();
	});
	
	$(".turn-off").on("click",function() {
		$(".click-data").fadeOut();
	});
	
	$(window).resize(function() {
		clearTimeout(timer);
	},function() {
		startResize();
	});
});
</script>
</head>
<body>
<?php include "get-all.php"; ?>
<div class="wrapper">
	<h1>Visual Link Tracker</h1>
	<p><a class="turn-on" href="#">On</a> / <a class="turn-off" href="#">Off</a></p>
	<p>Lorem ipsum dolor sit amet, <a id="consectetur" href="#">consectetur</a> adipiscing elit. Vivamus eu sagittis nunc, sed consectetur risus. Donec non risus vitae nunc tempor cursus. Nunc et odio a nunc rutrum scelerisque. Ut dictum imperdiet neque, in elementum nibh tincidunt eu. Donec fermentum pharetra rutrum. Mauris in neque ultricies, malesuada justo id, interdum leo. Nullam semper pharetra molestie. Ut at tortor urna.</p>

	<p>Nullam eget felis quis nunc dapibus feugiat. Quisque vel lacus turpis. Donec sit amet rutrum tellus, at consectetur lorem. Cras nulla nisl, fermentum ac accumsan sed, dapibus id felis. Mauris at <a id="fermentum" href="#">risus fermentum</a>, tempor nulla vitae, rutrum ligula. Cras blandit erat id ipsum euismod, non luctus massa vulputate. Aenean nisi neque, pretium non ultricies non, suscipit et ex.</p>

	<p>Mauris euismod, turpis consequat venenatis blandit, nisi erat pharetra est, at egestas lorem turpis nec lectus. Fusce nec varius leo, sit amet pharetra nunc. Ut consectetur, ipsum id faucibus suscipit, lorem lacus suscipit ligula, eu feugiat metus turpis nec lorem. Nullam placerat lectus et lorem <a id="elementum" href="#">elementum tempor</a>. Phasellus aliquet viverra purus at posuere. Curabitur eget hendrerit erat. Aliquam id magna vel orci porta dictum. Sed eget elit sit amet urna posuere vulputate tristique vitae metus. Fusce ac tortor in elit elementum fringilla vitae et erat. Cras justo orci, sollicitudin sit amet erat a, mattis posuere dolor.</p>

	<p>Suspendisse quis gravida tellus. Duis ipsum lorem, efficitur a accumsan eu, semper a velit. Cras at tempus metus. Pellentesque in maximus erat. Integer vulputate magna pharetra neque pellentesque varius. Duis ac odio suscipit, vulputate leo eu, vulputate sem. Nullam condimentum at sapien id placerat. Aliquam cursus dolor id quam fringilla, eget auctor metus suscipit. <a id="pellentesque" href="#">Pellentesque</a> in dui eget ante accumsan euismod id at turpis.rem tincidunt euismod. Ut turpis ex, posuere ut tempus pretium, viverra quis dui. Quisque elementum consectetur elit quis rhoncus.

	<p>Quisque venenatis lobortis dolor in rutrum. Nunc quis euismod massa. Nulla suscipit ante eu metus suscipit aliquet. Phasellus vitae erat sagittis, ullamcorper risus et, facilisis arcu. Donec ligula magna, volutpat sed lacinia quis, vulputate vel felis. Duis at elit erat. In bibendum risus nec fermentum placerat. Curabitur iaculis ligula ac lorem tincidunt euismod. Ut turpis ex, posuere ut tempus pretium, viverra quis dui. Quisque elementum consectetur <a id="rhoncus" href="#">elit quis rhoncus</a>.</p>
	
	<p><a id="btn" class="btn" href="#">Learn More</a></p>
	
	<p class="copyright">Copyright &copy;2014 Eric Winton. All Rights Reserved.</p>
</div>
</body>
</html>