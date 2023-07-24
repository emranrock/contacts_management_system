<?php include('includes/top_header.php'); ?>
<main role="main">
	<div class="album py-5 bg-light mt-5">
		<div class="container-fluid">
			<div class="row products">
				<?php
					$filter = array();	
					foreach ($options as $key => $value) {
						
						if($value['option_name'] == "Fabric"){
							$Fabric = json_decode($value['option_values'],true);
							$Fabric = !empty($Fabric) ? $Fabric : [];
						}else if($value['option_name'] == "Season"){
							$Season = json_decode($value['option_values'],true);
							$Season = !empty($Season) ? $Season : [];
						}else if($value['option_name'] == "Occasion"){
							$Occasion = json_decode($value['option_values'],true);
							$Occasion = !empty($Occasion) ? $Occasion : [];
						}else{
							$Colors = json_decode($value['option_values'],true);
							$Colors = !empty($Colors) ? $Colors : [];
						}
					}
					if(!empty($Colors)){
						foreach ($Colors as $key => $value) {

							$Colors[]=$value;
						}
					}
					
					$filter = array_merge($Fabric,$Colors,$Season,$Occasion);
					sort($filter);
				if (!empty($products) && gettype($products) == 'array') {
					
					$store_name = '';
					$store_desc = '';
					$arr_for_js = [];
					foreach ($products as $key => $value) {
						$arr_for_js[] = array_column($value, 'body_html', 'id');
						$store_name = $key;
						foreach ($value as $k => $v) {
							if (isset($v['images'])) {
								$img_path = array_column($v, 'src');
								$img_url = reset($img_path);
							}
							if (empty($img_url)) {
								$img_url = 'uploads/images/no_image.png';
							}
							$store_desc = $v['body_html'];
							$tags2 = explode(',', $v['tags']);
							sort($tags2);
						
							if (isInArray($filter, $tags2)) {
								continue;
							}
				?>
							<div class="col-md-4 col-lg-4 col-sm-1 <?php echo $v['id']; ?>">
								<div class="card mb-2 box-shadow">
									<img class="card-img-top lazy" data-src="<?php echo $img_url; ?>" alt="<?php echo $v['handle']; ?>" src="<?php echo $img_url; ?>" class="img-responsive" height="250px" width="200px">
									<div class="card-body">
										<div class="d-flex justify-content-between align-items-center">
											<p class="card-text">Store:- <?php echo ucfirst($store_name); ?></p>
											<div class="btn-group pull-right">
												<?php if (isset($_SESSION['logged_in'])) { ?>
													<a class="btn btn-sm btn-outline-primary tags_btn" data-title="<?php echo $v['title']; ?>" data-store="<?php echo $store_name; ?>" data-id="<?php echo $v['id']; ?>" data-tags="<?php echo $v['tags']; ?>" data-desc="<?php echo strip_tags($store_desc); ?>" data-img="<?php echo $img_url; ?>" data-handle="<?php echo $v['handle']; ?>" data-toggle="modal" data-target="#myModal">Edit</a>
												<?php } ?>
											</div>
										</div>
										<span class="pull-right"><?php echo $v['title']; ?></span>
										<p>Tags:- <small class="text-muted"><?php echo $v['tags']; ?></small></p>
									</div>
								</div>
							</div>
					<?php }
					}
				} else { ?>
					<section class="jumbotron text-center">
						<div class="container">
							<p class="lead text-muted">Not able to load products please refresh and try again</p>
						</div>
					</section>
				<?php } ?>
			</div>
		</div>
	</div>
</main>
<script>
	var js_array = <?php //echo json_encode($arr_for_js); ?>;
	document.addEventListener("DOMContentLoaded", function() {
		var lazyloadImages = document.querySelectorAll("img.lazy");
		var lazyloadThrottleTimeout;

		function lazyload() {
			if (lazyloadThrottleTimeout) {
				clearTimeout(lazyloadThrottleTimeout);
			}

			lazyloadThrottleTimeout = setTimeout(function() {
				var scrollTop = window.pageYOffset;
				lazyloadImages.forEach(function(img) {
					if (img.offsetTop < (window.innerHeight + scrollTop)) {
						img.src = img.dataset.src;
						img.classList.remove('lazy');
					}
				});
				if (lazyloadImages.length == 0) {
					document.removeEventListener("scroll", lazyload);
					window.removeEventListener("resize", lazyload);
					window.removeEventListener("orientationChange", lazyload);
				}
			}, 20);
		}

		document.addEventListener("scroll", lazyload);
		window.addEventListener("resize", lazyload);
		window.addEventListener("orientationChange", lazyload);
	});
</script>