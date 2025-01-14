<!--=====================================
BANNER
======================================-->

<?php
$banner = ControladorBlog::ctrTraerBanners("interno");
?>

<div class="bannerEstatico"></div>

<section class="jd-slider fade-slider">
	
	<div class="slide-inner">
		
		<ul class="slide-area">
			
			<?php foreach ($banner as $key => $value) :?>

				<?php if($value["pagina_banner"] == "interno") : ?>  

					<li>
						<div class="d-none d-md-block textoBanner">
							
							<h1><?php echo $value["titulo_banner"]; ?></h1>
							<h5><?php echo $value["descripcion_banner"]; ?></h5>

						</div>
						
						<img src="<?php echo $blog["servidor"].$value["img_banner"]; ?>" class="img-fluid">

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