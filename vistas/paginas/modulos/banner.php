<!--=====================================
BANNER
======================================-->
<?php
$banner = ControladorBlog::ctrTraerBanners("inicio");
?>
<div class="bannerEstatico"></div>

<section class="jd-slider fade-slider">
	
	<div class="slide-inner">
		
		<ul class="slide-area">

			<?php foreach ($banner as $key => $value) :?>

				<?php if ($value["pagina_banner"] === 'inicio') : ?>
					<li>				
						<img src="<?php echo $blog["servidor"].$value["img_banner"];?>" class="img-fluid">

					</li>
				<?php endif; ?>
	
			<?php endforeach; ?>

		</ul>

	</div>

	<div class="controller d-none">
		
		<a class="auto" href="#">
			
			<i class="fas fa-play fa-xs"></i>
			<i class="fas fa-pause fa-xs"></i>

		</a>

		<div class="indicate-area"></div>

	</div>

</section>