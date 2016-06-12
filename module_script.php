<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="http://maps.google.com/maps/api/js?sensor=true&libraries=places"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/original.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/wideslider.js"></script>
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js" type="text/javascript"></script>
<![endif]-->
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.simplePagination.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.sortElements.js"></script>
<script type="text/javascript" src="http://www.palcohome.com/wp/wp-content/themes/palcohome/js/original.js"></script>
<script type="text/javascript" src="http://www.palcohome.com/wp/wp-content/themes/palcohome/js/jquery.fs.boxer.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.colorbox.js"></script>
<script>
	$(document).ready(function(){
		//Examples of how to assign the Colorbox event to elements
		$(".group1").colorbox({rel:'group1'});
		$(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
		$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
		$(".inline").colorbox({inline:true, width:"50%"});
		//Example of preserving a JavaScript event for inline calls.
		$("#click").click(function(){
			$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
			return false;
		});

		var selectValue,selectItems,valueItems,selectval;
		var areaSelectorsList = $('.areaSelectorsList');
		var maxLength = $(".mainAnsDt").length;

		$(".boxer").boxer();

		// ページング設定用
		var settings = {
			items: maxLength/10,//全体のページング表示アイテム数を割る
			displayedPages: 3,
			cssStyle: "light-theme",
			// prevText: "<<",
			// nextText: ">>",
			onInit:function(){
				// 初期設定
				SearchResult(1);
				showPage(1);
			},
			onPageClick: function(currentPageNumber) {
				//クリック処理
				SearchResult(currentPageNumber);
				showPage(currentPageNumber);
			}
		};

		// ページング
		$(".pagination").pagination(settings);

		// ページングのアイテム表示処理
		function showPage(currentPageNumber) {
			var page=".page_" + currentPageNumber;
			$(".mainAnsDt").css({'display':'none'});
			$(page).css({'display':'block'});
		}

		// 検索物件結果表示
		function SearchResult(currentPageNumber){
			var mainContentSearchAns1 = $(".mainContentSearchAns1");
			var mainContentSearchAns2 = $(".mainContentSearchAns2");
			var plugin_settings_objElements_length = $(".plugin_settings_objElements_length");
			var cPNand1 = parseInt( currentPageNumber+"1" );

			mainContentSearchAns1.html(cPNand1);
			mainContentSearchAns2.html((cPNand1+9));
			plugin_settings_objElements_length.html(maxLength);

			if(currentPageNumber == 1){
				mainContentSearchAns1.html("1");
				mainContentSearchAns2.html("10");
			}
		}

			var entryTitle = $(".entry-title").text();
			var bukkenNum = $(".bukken_num").text();
			var formTitle = $("input[name='text-774']");

			formTitle.attr('disabled','disabled');
			entryTitle = entryTitle.trim();
			formTitle.val(entryTitle+'| '+bukkenNum);

			function selectItemClick(){

				selectval = $('.areaSelectorsList .selectval');

				//labelの値取得
				selectValue = $(":checkbox[name='ksik[]']:checked").map(function(){
					return $(this).val();
				}).get();

				var x = cleanArray(selectValue);
				console.log(x);
				createHtml(x);

			}


			function createHtml(x){

				areaSelectorsList.empty();

				$.each(x,function(i,val){
					console.log(val);
					areaSelectorsList.append('<div class="areaSelectorsListItem"></div>');
					$(".areaSelectorsListItem").eq(i).html('<div class="selectval">'+val+'</div>');
				});
			}

			function cleanArray(arr){
				// 重複削除
				var x = $.grep(arr, function(e){return e;});
				x = x.filter(function (x, i, self) {
				  return self.indexOf(x) === i;
			});

				var res = $.inArray(arr,x);

			//配列から、重複削除
			if( res != -1 ){
				x.pop("");
				x.pop(arr);
			}

			return x;
		}

		$('.areaSchool input').on('click',selectItemClick);


	});
</script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/swiper.jquery.min.js"></script>
<script>
if( window.matchMedia('(max-width:1024px)').matches ){
	window.onload = function() {
	var mySwiper = new Swiper('.swiper-container',{
		//Your options here:
		pagination: '.swiper-pagination',
		loop:true,
		autoplay:5000,
		paginationClickable:true,
		calculateHeight:true,
		touchRatio:0.6,
		slidesPerView: 3,
		spaceBetween: 30,
	});
	}
} else {
	window.onload = function() {
	var mySwiper = new Swiper('.swiper-container',{
		//Your options here:
		pagination: '.swiper-pagination',
		loop:true,
		autoplay:5000,
		paginationClickable:true,
		calculateHeight:true,
		touchRatio:0.6,
		slidesPerView: 5,
		spaceBetween: 30,
	});
	}
}

</script>

