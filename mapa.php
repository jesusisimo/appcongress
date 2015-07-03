<div class="col-lg-12">
			<div id="accordion" class="panel-group m-bot20">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a class="accordion-toggle collapsed " href="#collapseOne" data-parent="#accordion" data-toggle="collapse"> 
								Toca para ver el plano
							</a>
						</h4>
					</div>
					<div id="collapseOne" class="panel-collapse collapse" style="height: 0px;">
						<div class="panel-body table-responsive"> 
						<?if(esMobil()){?>
							<img src="img/plano-vertical.jpg" style="width:100%;">
						<?}else{?>
						<img src="img/plano-horizontal.jpg" style="width:100%;">
						<?}?>
						</div>
					</div>
				</div>
			</div>
    <section class="panel">
        <header class="panel-heading">
            <h5 class="title">Ubicación <?if(esMobil()){?><small class="text-muted">(Para ver correctamente el mapa necesitas activar el GPS de tu dispositivo)</small><?}?></h5> 
        </header>
       
            <div id="gmap_marker" class="gmaps" style=""></div>
        
    </section>
</div>



