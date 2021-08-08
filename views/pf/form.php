
<?php
  $DB=&get_instance()->t;
  $id = $_POST['id'];
  $data = $DB->get("v_pf","id_formador='$id'",'row');
  if($id=="foun") { 
      $sobre                 = "foun";
      $id_posisaun        = "";
      $nrn_posisaun        = "Hili-Pozisaun";
      $id_formador        = "";
      $nrn_formador        = "Hili-Formador";
      $data_pformador          = date("Y-m-d");
	} else{
      $reqfoto              = "";
		  $sobre				        = "renova";
      $id_posisaun        = $data->id_posisaun;
      $nrn_posisaun        = $data->nrn_posisaun;
      $id_formador        = $data->id_formador;
      $nrn_formador        = $data->nrn_formador;
      $data_pformador          = $data->data_pformador;
  }

	?>
<input type="hidden" name="sobre" value="<?=$sobre;?>">
<input type="hidden" name="id" value="<?=$id_formador;?>">
<div class="row">
  <div class="col-md-12">
    <div class="form-group">
                <label>Naran Formador</label>
                <select name='id_formador'  id='id_formador' class='form-control custom-select' style='width : 100%;' required>
                          <option selected value='<?=$id_formador;?>' readonly> <?=$nrn_formador;?>  </option>
                          <?php foreach($DB->get('t_formador','t_formador.id_formador NOT IN(SELECT t_pf.id_formador FROM t_pf)') as $d): ?>
                          <option value='<?=$d->id_formador;?>'> <?=$d->nrn_formador;?> </option>
                          <?php endforeach;?>
                        </select>
              </div>
  </div>
  <div class="col-md-12">
    <div class="form-group">
                <label>Naran posisaun</label>
                <select name='id_posisaun'  id='id_posisaun' class='form-control custom-select' style='width : 100%;' required>
                          <option selected value='<?=$id_posisaun;?>' readonly> <?=$nrn_posisaun;?>  </option>
                          <?php foreach($DB->get('t_posisaun','t_posisaun.id_posisaun NOT IN(SELECT t_pf.id_posisaun FROM t_pf)') as $d): ?>
                          <option value='<?=$d->id_posisaun;?>'> <?=$d->nrn_posisaun;?> </option>
                          <?php endforeach;?>
                        </select>
              </div>
  </div> 
  <div class="col-md-12">
    <div class="form-group">
                <label>Data posisaun formador</label>
                <input type="text" id="data_pformador" class="form-control col-xs-4 date" placeholder="Input Data posisaun....."  name="data_pformador" value="<?=$data_pformador;?>">
              </div>
  </div> 
  

</div>

<script type="text/javascript">
   $(function(){
  $("select").select2();
      $.fn.select2.defaults.set( "theme", "bootstrap");

  $(".date").datepicker({
      format: 'yyyy-mm-dd',
      clearBtn: true,
      closeBtn: true,
      todayBtn: "linked",
      todayHighlight: true,
      orientation: "auto"
    }).on('hide', function(event) {
        event.preventDefault();
        event.stopPropagation();
    });
    });
</script>




	
