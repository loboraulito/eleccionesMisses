		<script>
            $(function($) {

                $(".knob").knob({
                	height:110,
                    change : function (value) {
                        console.log("change : " + value);
                    },
                    release : function (value) {
                        //console.log(this.$.attr('value'));
                        var id = this.$.attr('data-entryid');
                        console.log("release : " + value);
                        $('#aux'+id).val(value);
                                                
                        $.ajax({
                            type: "POST",
                            url: '<?php echo base_url().'index.php/votacion/guardar_voto/'.$participante->idparticipante.'/';?>'+id+'/'+value,                            
                            success: function(response){ },
                            error: function(){alert('Formulario con errores');}
                        });
                    },
                    cancel : function () {
                        console.log("cancel : ", this);
                    },
                    /*format : function (value) {
                        return value + '%';
                    },*/
                    draw : function () {

                        // "tron" case
                        if(this.$.data('skin') == 'tron') {

                            this.cursorExt = 0.3;

                            var a = this.arc(this.cv)  // Arc
                                , pa                   // Previous arc
                                , r = 1;

                            this.g.lineWidth = this.lineWidth;

                            if (this.o.displayPrevious) {
                                pa = this.arc(this.v);
                                this.g.beginPath();
                                this.g.strokeStyle = this.pColor;
                                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, pa.s, pa.e, pa.d);
                                this.g.stroke();
                            }

                            this.g.beginPath();
                            this.g.strokeStyle = r ? this.o.fgColor : this.fgColor ;
                            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, a.s, a.e, a.d);
                            this.g.stroke();

                            this.g.lineWidth = 2;
                            this.g.beginPath();
                            this.g.strokeStyle = this.o.fgColor;
                            this.g.arc( this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                            this.g.stroke();

                            return false;
                        }
                    }
                }); 

                $('#aniimated-thumbnials').lightGallery({
			        thumbnail: true,
			        selector: 'a'
			    });               
            });
        </script>
<div class="container-fluid">
    <div class="block-header">
        <h2>Votación para la participante: <?php echo $participante->idparticipante.' '.$participante->apellidos.' '.$participante->nombres;?></h2>
    </div>
    <div> 
    <div class="row">
    <div class="fotos col-xs-4 col-md-4">
    	<div class="body">
            <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
            	<?php foreach ($fotos as $foto):?>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <a href="<?php echo base_url();?>images/participantes/<?php echo $foto->idparticipante;?>/<?php echo $foto->nombre_archivo.$foto->extension;?>" data-sub-html="Demo Description">
                        <img class="img-responsive thumbnail" src="<?php echo base_url();?>images/participantes/<?php echo $foto->idparticipante;?>/<?php echo $foto->nombre_archivo.$foto->extension;?>">
                    </a>
                </div>
                <?php endforeach;?>             
            </div>
        </div>
    </div>
	    <div class="fotos col-xs-8 col-md-8">
	    <?php foreach ($pasarelas as $pasarela):?>
			<div class="calificaciones col-xs-6 col-md-6">
				<p> <?php echo $pasarela->nombre.' ('.$pasarela->ponderacion.')';?></p>
				<input class="knob" data-width="120" data-angleOffset=-125 data-angleArc=250 data-bgColor="#FFFFFF" data-rotation="clockwise" value="<?php echo $pasarela->calificacion;?>" data-min="0" data-max="<?php echo $pasarela->ponderacion;?>" data-entryid="<?php echo $pasarela->idpasarela;?>">
				<input class="aux hide" type="text" id="aux<?php echo $pasarela->idpasarela;?>">
			</div>
		<?php endforeach;?>
	    </div>
    </div>
