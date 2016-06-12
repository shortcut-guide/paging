<?php
/**
 * The Template for displaying fudou archive posts.
 *
 * Template: archive-fudo.php
 *
 * @package WordPress4.1
 * @subpackage Fudousan Plugin
 * Version: 1.6.1
 */

/**
 * Extends the default WordPress body class 'sidebar' to archive-fudo:
 * @since Twenty Thirteen 1.0
 * @return array Filtered class values.
 */
function twentythirteen_body_class_add_sidebar($classes)
{
	$classes[] = 'sidebar';
	return $classes;
}

if (get_option('template') == 'twentythirteen') {
	add_filter('body_class', 'twentythirteen_body_class_add_sidebar');
}


/**** 検索 SQL ****/
require_once WP_PLUGIN_DIR . '/fudou/inc/inc-archive-fudo.php';

//カウント
$metas_co = 0;
if ($sql != '') {
	$sql = $wpdb->prepare($sql,'');
	$metas = $wpdb->get_row($sql);

	if (!empty($metas)) {
		$metas_co = $metas->co;
	}
} else {
	$metas_co = 0;
}

//ソート・ページナビ
$page_navigation = '';

if ($metas_co != 0) {
	$kak_img = '<img src="' . $plugin_url . 'img/sortbtms_.png" border="0" align="absmiddle">';
	if ($bukken_sort == 'kak' && $bukken_order == '')
		$kak_img = '<img src="' . $plugin_url . 'img/sortbtms_asc.png" border="0" align="absmiddle">';
	if ($bukken_sort == 'kak' && $bukken_order == 'd')
		$kak_img = '<img src="' . $plugin_url . 'img/sortbtms_desc.png" border="0" align="absmiddle">';


	if ($bukken_sort_data2 == "post_modified" && $bukken_sort == '')
		$kak_img = '<img src="' . $plugin_url . 'img/sortbtms_.png" border="0" align="absmiddle">';


	$tam_img = '<img src="' . $plugin_url . 'img/sortbtms_.png" border="0" align="absmiddle">';
	if ($bukken_sort == 'tam' && $bukken_order == '')
		$tam_img = '<img src="' . $plugin_url . 'img/sortbtms_asc.png" border="0" align="absmiddle">';
	if ($bukken_sort == 'tam' && $bukken_order == 'd')
		$tam_img = '<img src="' . $plugin_url . 'img/sortbtms_desc.png" border="0" align="absmiddle">';

	$mad_img = '<img src="' . $plugin_url . 'img/sortbtms_.png" border="0" align="absmiddle">';
	if ($bukken_sort == 'mad' && $bukken_order == '')
		$mad_img = '<img src="' . $plugin_url . 'img/sortbtms_asc.png" border="0" align="absmiddle">';
	if ($bukken_sort == 'mad' && $bukken_order == 'd')
		$mad_img = '<img src="' . $plugin_url . 'img/sortbtms_desc.png" border="0" align="absmiddle">';

	$sho_img = '<img src="' . $plugin_url . 'img/sortbtms_.png" border="0" align="absmiddle">';
	if ($bukken_sort == 'sho' && $bukken_order == '')
		$sho_img = '<img src="' . $plugin_url . 'img/sortbtms_asc.png" border="0" align="absmiddle">';
	if ($bukken_sort == 'sho' && $bukken_order == 'd')
		$sho_img = '<img src="' . $plugin_url . 'img/sortbtms_desc.png" border="0" align="absmiddle">';

	$tac_img = '<img src="' . $plugin_url . 'img/sortbtms_.png" border="0" align="absmiddle">';
	if ($bukken_sort == 'tac' && $bukken_order == '')
		$tac_img = '<img src="' . $plugin_url . 'img/sortbtms_asc.png" border="0" align="absmiddle">';
	if ($bukken_sort == 'tac' && $bukken_order == 'd')
		$tac_img = '<img src="' . $plugin_url . 'img/sortbtms_desc.png" border="0" align="absmiddle">';

	$page_navigation = '<div id="nav-above1" class="navigation">';
	$page_navigation .= '<div class="nav-previous">';


	//条件検索
	if ($bukken_slug_data == "jsearch") {

		//url生成

		//間取り
		$madori_url = '';
		if (!empty($madori_id)) {
			$i = 0;
			foreach ($madori_id as $meta_box) {
				$madori_url .= '&amp;mad[]=' . $madori_id[$i];
				$i++;
			}
		}

		//設備条件
		$setsubi_url = '';
		if (!empty($set_id)) {
			$i = 0;
			foreach ($set_id as $meta_box) {
				$setsubi_url .= '&amp;set[]=' . $set_id[$i];
				$i++;
			}
		}

		$add_url = '';

		//複数種別
		if ($shub != '') $add_url .= '&amp;shub=' . $shub;

		if (is_array($bukken_shubetsu)) {
			$i = 0;
			foreach ($bukken_shubetsu as $meta_set) {
				$add_url .= '&amp;shu[]=' . $bukken_shubetsu[$i];
				$i++;
			}

		} else {
			$add_url .= '&amp;shu=' . $bukken_shubetsu;
		}

		//    if($ken_id != '') $ken_id = intval($ken_id);

		$add_url .= '&amp;ros=' . $ros_id;
		$add_url .= '&amp;eki=' . $eki_id;
		$add_url .= apply_filters('fudoubus_add_url_archive', '');

		$add_url .= '&amp;ken=' . $ken_id;
		$add_url .= '&amp;sik=' . $sik_id;
		$add_url .= '&amp;kalc=' . $kalc_data;
		$add_url .= '&amp;kahc=' . $kahc_data;
		$add_url .= '&amp;kalb=' . $kalb_data;
		$add_url .= '&amp;kahb=' . $kahb_data;
		$add_url .= '&amp;hof=' . $hof_data;
		$add_url .= $madori_url;
		$add_url .= '&amp;tik=' . $tik_data;
		$add_url .= '&amp;mel=' . $mel_data;
		$add_url .= '&amp;meh=' . $meh_data;
		$add_url .= $setsubi_url;

		$joken_url = $site . '?bukken=jsearch';


		//複数市区
		if (is_array($ksik_id)) {
			$i = 0;
			foreach ($ksik_id as $meta_set) {
				$add_url .= '&amp;ksik[]=' . $ksik_id[$i];
				$i++;
			}
		}

		//複数駅
		if (is_array($rosen_eki)) {
			$i = 0;
			foreach ($rosen_eki as $meta_set) {
				$add_url .= '&amp;re[]=' . $rosen_eki[$i];
				$i++;
			}
		}

		$joken_url .= $add_url;
		//    $joken_url .= '&amp;btn=%E7%89%A9%E4%BB%B6%E6%A4%9C%E7%B4%A2';

		if ($bukken_sort == 'kak') $page_navigation .= '<b>';
		$page_navigation .= '<a href="' . $joken_url . '&amp;paged=' . $bukken_page_data . '&amp;so=kak&amp;ord=' . $bukken_order . '&amp;s=' . $s . '">' . $kak_img . '価格</a> ';
		if ($bukken_sort == 'kak') $page_navigation .= '</b>';

		if ($bukken_sort == 'tam') $page_navigation .= '<b>';
		$page_navigation .= '<a href="' . $joken_url . '&amp;paged=' . $bukken_page_data . '&amp;so=tam&amp;ord=' . $bukken_order . '&amp;s=' . $s . '">' . $tam_img . '面積</a> ';
		if ($bukken_sort == 'tam') $page_navigation .= '</b>';

		if ($bukken_sort == 'mad') $page_navigation .= '<b>';
		$page_navigation .= '<a href="' . $joken_url . '&amp;paged=' . $bukken_page_data . '&amp;so=mad&amp;ord=' . $bukken_order . '&amp;s=' . $s . '">' . $mad_img . '間取</a> ';
		if ($bukken_sort == 'mad') $page_navigation .= '</b>';

		if ($bukken_sort == 'sho') $page_navigation .= '<b>';
		$page_navigation .= '<a href="' . $joken_url . '&amp;paged=' . $bukken_page_data . '&amp;so=sho&amp;ord=' . $bukken_order . '&amp;s=' . $s . '">' . $sho_img . '住所</a> ';
		if ($bukken_sort == 'sho') $page_navigation .= '</b>';

		if ($bukken_sort == 'tac') $page_navigation .= '<b>';
		$page_navigation .= '<a href="' . $joken_url . '&amp;paged=' . $bukken_page_data . '&amp;so=tac&amp;ord=' . $bukken_order . '&amp;s=' . $s . '">' . $tac_img . '築年月</a>';
		if ($bukken_sort == 'tac') $page_navigation .= '</b>';

	} else {

		//カテゴリ・タグ
		if ($taxonomy_name == 'bukken_tag') {
			$joken_url = $site . '?bukken_tag=' . $slug_data . '';
		} else {
			$joken_url = $site . '?bukken=' . $slug_data . '';
		}

		if ($s != '') {
			$joken_url = $site . '?s=' . $s . '&bukken=search';

			if ($searchtype == 'id')
				$joken_url .= '&st=id';

			if ($searchtype == 'chou')
				$joken_url .= '&st=chou';
		}


		$bukken = isset($_GET['bukken']) ? $_GET['bukken'] : '';

		$bukken_slug_data = esc_attr(stripslashes($bukken));
		$add_url = '&amp;bk=' . $bukken;

		$add_url .= '&amp;shu=' . $bukken_shubetsu;
		$add_url .= '&amp;mid=' . $mid_id;
		$add_url .= '&amp;nor=' . $nor_id;
		$add_url .= apply_filters('fudoubus_add_url_archive', '');

		//    if( $searchtype !='' ) $add_url .= '&amp;st='.$searchtype;

		if ($taxonomy_name == '') $joken_url .= $add_url;

		if ($bukken_sort == 'kak') $page_navigation .= '<b>';
		//    $page_navigation .= '<a href="'.$joken_url.'&amp;paged='.$bukken_page_data.'&amp;so=kak&amp;ord='.$bukken_order.'&amp;s='.$s.'">'.$kak_img.'価格</a> ';
		$page_navigation .= '<a href="' . $joken_url . '&amp;paged=' . $bukken_page_data . '&amp;so=kak&amp;ord=' . $bukken_order . '">' . $kak_img . '価格</a> ';
		if ($bukken_sort == 'kak') $page_navigation .= '</b>';

		if ($bukken_sort == 'tam') $page_navigation .= '<b>';
		//    $page_navigation .= '<a href="'.$joken_url.'&amp;paged='.$bukken_page_data.'&amp;so=tam&amp;ord='.$bukken_order.'&amp;s='.$s.'">'.$tam_img.'面積</a> ';
		$page_navigation .= '<a href="' . $joken_url . '&amp;paged=' . $bukken_page_data . '&amp;so=tam&amp;ord=' . $bukken_order . '">' . $tam_img . '面積</a> ';
		if ($bukken_sort == 'tam') $page_navigation .= '</b>';

		if ($bukken_sort == 'mad') $page_navigation .= '<b>';
		//    $page_navigation .= '<a href="'.$joken_url.'&amp;paged='.$bukken_page_data.'&amp;so=mad&amp;ord='.$bukken_order.'&amp;s='.$s.'">'.$mad_img.'間取</a> ';
		$page_navigation .= '<a href="' . $joken_url . '&amp;paged=' . $bukken_page_data . '&amp;so=mad&amp;ord=' . $bukken_order . '">' . $mad_img . '間取</a> ';
		if ($bukken_sort == 'mad') $page_navigation .= '</b>';

		if ($bukken_sort == 'sho') $page_navigation .= '<b>';
		//    $page_navigation .= '<a href="'.$joken_url.'&amp;paged='.$bukken_page_data.'&amp;so=sho&amp;ord='.$bukken_order.'&amp;s='.$s.'">'.$sho_img.'住所</a> ';
		$page_navigation .= '<a href="' . $joken_url . '&amp;paged=' . $bukken_page_data . '&amp;so=sho&amp;ord=' . $bukken_order . '">' . $sho_img . '住所</a> ';
		if ($bukken_sort == 'sho') $page_navigation .= '</b>';

		if ($bukken_sort == 'tac') $page_navigation .= '<b>';
		//    $page_navigation .= '<a href="'.$joken_url.'&amp;paged='.$bukken_page_data.'&amp;so=tac&amp;ord='.$bukken_order.'&amp;s='.$s.'">'.$tac_img.'築年月</a>';
		$page_navigation .= '<a href="' . $joken_url . '&amp;paged=' . $bukken_page_data . '&amp;so=tac&amp;ord=' . $bukken_order . '">' . $tac_img . '築年月</a>';
		if ($bukken_sort == 'tac') $page_navigation .= '</b>';

	}


	$page_navigation .= '</div>';
	$page_navigation .= '<div class="nav-next">';

	if ($bukken_order == "d") {
		$bukken_order = "";
	} else {
		$bukken_order = "d";
	}

	//ページナビ
	$page_navigation .= f_page_navi($metas_co, $posts_per_page, $bukken_page_data, $bukken_sort, $bukken_order, $s, $joken_url);

	$page_navigation .= '</div>';
	$page_navigation .= '</div><!-- #nav-above -->';
}


//パーマリンクチェック
$permalink_structure = get_option('permalink_structure');
if ($permalink_structure != '') {
	$add_url_point = mb_strlen($add_url, "utf-8");
	if ($add_url_point > 5) {
		$add_url_point = $add_url_point - 5;
		$add_url = '?' . myRight($add_url, $add_url_point);
	} else {
		$add_url = '';
	}
}


/* Modify S.W Schoolarea search
 * 学区絞り込みのため結果を再度フィルタリング */
if ($sql != '' && $_GET['search_from'] == 'f102') {
	//$sql2 = $wpdb->prepare($sql2,'');
	$metas = $wpdb->get_results($sql2, ARRAY_A);

	$metas_temp = $metas;
	unset($metas);

	foreach ($metas_temp as $meta) {
		$meta_id = $meta['object_id']; //post_id
		if (has_term($_GET['schoolarea'], 'schoolarea', $meta_id)) {
			// 該当した検索結果を作成
			$metas[] = $meta;
		} else {
			// 除外した検索結果も保持する
			$metas_exclude[] = $meta;
		}
	}

} else {
	$metas = $wpdb->get_results($sql2, ARRAY_A);
}
/* End Schoolarea search */

/* Modify S.W Search from
 * 検索結果の表示テキスト作成 */
switch ($_GET['search_from']) {
	case 'f101':
		$search_from_label = 'マップ検索';
		$search_from_selected = '';
		$search_from_selected_child = '';

		//別途値 からタクソノミーの詳細取得
		//$swc_search_selected_label_parent;
		//$swc_search_selected_label_child;

		break;
	case 'f102':
		$search_from_label = '学区検索';
		$search_from_selected = '';
		$search_from_selected_child = '';

		//school_area からタクソノミーの詳細取得

		/* Modify S.W get custom station name */

		$swc_search_selected_label = array();

		foreach ($_GET['schoolarea'] as $schoolarea_id) {
			$schoolarea_detail = get_term($schoolarea_id, 'schoolarea');
			$swc_search_selected_label_parent[] = $schoolarea_detail->name;
		}

		$swc_search_selected_label_child = false;

		/* End get custom station name */


		break;
	case 'f103':
		$search_from_label = '路線・駅名検索';
		$search_from_selected = '選択された路線';
		$search_from_selected_child = '選択された駅';

		//inc-archive-fudo.php内で実装済みのため再定義しない


		break;
	case 'f104':
		$search_from_label = '地域検索';
		$search_from_selected = '選択された地域';
		$search_from_selected_child = '';

		//inc-archive-fudo.php内で実装済みのため再定義しない


		break;
	default:
		$search_from_label = '通常検索';
		$search_from_selected = '選択された項目';
		$search_from_selected_child = '';

		break;

}


//var_dump($sw_search_item_child);
/* End Schoolarea search */


//物件一覧ページ
get_header();


?>
<?php do_action('archive-fudo1'); ?>

<div id="breadcrumbsArea">
	<div class="breadcrumbs">
		<a href="http://www.palcohome.com">ホーム</a>&nbsp;&gt;&nbsp;<a href="http://search.palcohome.com/?page_id=6">土地検索システム</a>&nbsp;&gt;&nbsp;検索結果
	</div>
</div>

<div id="contents" class="clearfix">

	<article id="main" class="page">

		<section class="entry_content">

			<div id="__main">
				<div class="mainContent">
					<div class="mainContentHead">
						<h3 class="mainContentTtl">検索条件<span><?php echo $search_from_label; ?></span></h3>
						
						<?php
							$linkget = $_GET['search_from'];
							$linkstr = ltrim($linkget,'f');
							if($linkstr=='101'){
								$linkstr = 'http://search.palcohome.com/?page_id=6';
							}else if($linkstr=='102'){
								$linkstr = 'http://search.palcohome.com/?page_id=10';
							}else if($linkstr=='103'){
								$linkstr = 'http://search.palcohome.com/?page_id=12';
							}else if($linkstr=='104'){
								$linkstr = 'http://search.palcohome.com/?page_id=8';
							}
						?>

						<a href="<?php echo $linkstr; ?>" class="backSearch"><span>再検索</span></a>
					</div>
					<div class="mainContentSearchs">
						<?php if ($search_from_selected) { ?>
							<div class="mainContentSearch">
								<p class="mainContentSearchFont"><?php echo $search_from_selected; ?></p>
								<ul class="mainContentSearchList">
									<?php foreach ($swc_search_selected_label_parent as $key => $this_name) { ?>
										<li><?php echo $this_name; ?></li>
									<?php }; ?>
								</ul>
							</div>
						<?php } ?>

						<?php if ($search_from_selected_child) { ?>
							<div class="mainContentSearch"><p class="mainContentSearchFont"><?php echo $search_from_selected_child; ?></p>
								<ul class="mainContentSearchList">
									<?php foreach ($swc_search_selected_label_child as $this_childs) { ?>
										<?php foreach ($this_childs as $this_child) { ?>
											<li><?php echo $this_child['name']; ?></li>
										<?php }; ?>
									<?php } ?>
								</ul>
							</div>
						<?php } ?>
					</div>

				<input type="hidden" name="hash" value="test">
				<?php

					// 件数取得
					$max_cnt = count($metas);
				?>

				 <!-- #検索物件結果 -->
					<p class="mainContentSearchAns"><span class="mainContentSearchAnsSk">検索物件結果：<span class="mainContentSearchAnsFont"><span class="mainContentSearchAns1"></span>件〜<span class="mainContentSearchAns2"></span>件（<span class="plugin_settings_objElements_length"></span>件中）</span>
					</p></div>
					<div class="mainSearch">
						<div class="mainSearchTitle">検索並替:</div>
						<div class="mainSearchSpan">
							<button id="sortLand">土地代</button>
						</div>
						<div class="mainSearchSpan">
							<button id="sortFloor">容積率</button>
						</div>
						<div class="mainSearchSpan">
							<button id="sortArea">面積</button>
						</div>
						<div class="mainSearchSpan">
							<button id="sortBuild">建ぺい率</button>
						</div>
						<div class="mainSearchSpan">
							<button id="sortCondition">取引条件</button>
						</div>
					</div>

				<div class="pagination-holder clearfix">
					<div id="light-pagination" class="pagination"></div>
				</div>

				<div class="mainAns">

					<?php
					//loop SQL
					if ($sql != '') {

						if (!empty($metas)) {
							
							// class 生成用
							$cnt = 1;
							$cnt_page = 1;
							$metas_per_page = 10; // ページあたりの記事数

							foreach ($metas as $meta):

								$meta_id = $meta['object_id']; //post_id
								$meta_data = get_post($meta_id);
								$meta_title = $meta_data->post_title;

								if ( $cnt > $cnt_page * $metas_per_page ) $cnt_page++;
					?>
									<?php

										//ページネーションのためのCLASS生成
										//10件ごとに連続して同じ番号を付与

										echo sprintf( '<div
											class="page_%1$d mainAnsDt mix"
											data-price="%2$s"
											data-area="%3$s"
											data-bc="%4$s"
											data-ratio="%5$s"
											data-condition="%6$s">'
											, /*%1$d*/ $cnt_page
											, /*%2$s*/ htmlspecialchars( $sw_custom_extended_data_attr['price'], ENT_QUOTES, 'UTF-8' )
											, /*%3$s*/ htmlspecialchars( $sw_custom_extended_data_attr['area'], ENT_QUOTES, 'UTF-8' )
											, /*%4$s*/ htmlspecialchars( $sw_custom_extended_data_attr['bc'], ENT_QUOTES, 'UTF-8' )
											, /*%5$s*/ htmlspecialchars( $sw_custom_extended_data_attr['ratio'], ENT_QUOTES, 'UTF-8' )
											, /*%6$s*/ htmlspecialchars( $sw_custom_extended_data_attr['condition'], ENT_QUOTES, 'UTF-8' )
										);
									?>

									<?php require 'archive-fudo-loop.php'; ?>

								</div>
							<?php $cnt++; endforeach; ?>

					<?php

						} else {

							echo "物件がありませんでした。";

						}
					} else {
						echo "物件がありませんでした";
					}
					//loop SQL END
					?>
				</div>
				<div class="pagination-holder clearfix">
					<div id="light-pagination" class="pagination"></div>
				</div>
			</div>
		</section>
	</article>


	<?php do_action('archive-fudo2'); ?>

	<!-- ─────────────────────────── -->

	<?php get_sidebar(); ?>
	<?php get_footer(); ?>
