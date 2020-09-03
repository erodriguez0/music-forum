<?php
require_once('./modules/header.php');
$cat = getCategories($conn);
$_SESSION['last_page'] = $FILE.".php";
?>
<div class="container">
<div class="row">
<div class="col-12 col-md-8">
<div class="forum-table pt-3">
	<!-- HOT DISCUSSION -->
<!-- 	<div class="table-wrap">
	<div class="table-header">
	<div class="row py-1 stylish-color-dark text-white">
		<div class="col-12">
			<small><b>Hot Discussions</b></small>
		</div>
	</div>
	</div>

	<div class="table-inner">
	<div class="table-subheader pt-3">
	<div class="row custom-border">
		<div class="col-8">
			<small><b>Thread / Thread Starter</b></small>
		</div>
		<div class="col-4 text-center">
			<small><b>Forum</b></small>
		</div>
	</div>
	</div>

	<div class="row">
		<div class="col-8">
			<small class="d-block pt-1"><u><a href="">Welcome to the forum!</a></u></small>
			<small class="home-thread-info"><a href="">Esteban Rodriguez / Apr. 26, 2019 1:05pm</a></small>
		</div>
		<div class="col-4 text-center">
			<small><u><a href="">New Member's Sandbox</a></u></small>
		</div>
	</div>
	</div> -->
	<!-- / TABLE INNER -->
	<!-- </div> -->
	<!-- / TABLE WRAP -->
	<!-- / HOT DISCUSSIONS -->

	<!-- FORUMS -->
	<div class="table-wrap">
	<div class="table-header">
	<div class="row py-1 stylish-color-dark text-white">
		<div class="col-10">
			<small><b>Forum</b></small>
		</div>
		<div class="col-2 text-center">
			<small><b>Threads</b></small>
		</div>
<!-- 		<div class="col-2 text-center">
			<small><b>Posts</b></small>
		</div> -->
	</div>
	</div>

	<div class="table-inner">

	<!-- TOPICS -->
	<?php
	for($i = 0; $i < count($cat); $i++) {
	$cid = $cat[$i]['cat_id'];
	$top = getTopic($conn, $cid);
	$cname = htmlspecialchars($cat[$i]['cat_name']);
	// var_dump($top);
	?>
	<div class="table-subheader pt-3">
	<div class="row custom-border">
		<div class="col-12">
			<small><b><?php echo $cname; ?></b></small>
		</div>
	</div>
	</div>

	<?php
	for($j = 0; $j < count($top); $j++) {
	$tid = $top[$j]['top_id'];
	$tname = htmlspecialchars($top[$j]['top_name']);
	$tdesc = htmlspecialchars($top[$j]['top_desc']);
	$tcount = getCount($conn, $tid);
	?>
	<div class="row pt-2">
		<div class="col-10 home-top-title">
			<small class="d-block"><u><a href="./viewtopic.php?id=<?php echo $tid; ?>"><?php echo $tname; ?></a></u></small>
			<small class="home-top-desc"><?php echo $tdesc; ?></small>
		</div>
		<div class="col-2 text-center">
			<small><?php echo $tcount[0]; ?></small>
		</div>
<!-- 		<div class="col-2 text-center">
			<small>100,000</small>
		</div> -->
	</div>
	<?php 
	}
	} 
	?>
	</div>
	<!-- / TABLE INNER -->
	</div>
	<!-- / TABLE WRAP -->
</div>
</div>
<?php
require_once('./modules/sidebar.php');
?>
</div>
</div>
<?php
require_once('./modules/footer.php');
?>