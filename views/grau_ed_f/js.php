<script type="text/javascript">
  (function($) {
  var sp="",folder="<?=$folder?>";
  CaptionModal=$.trim($("#cHeader").text()).toLowerCase();
  $(document).ready(function(e) {
    var id_nstudus = "foun";
    modalMainLoad=$("#main_menu").text();
    CaptionModal =CaptionModal.replace(/\s/g, ""); currentCaptionModal=hex_md5(hex_md5(CaptionModal));
    main = "admin/<?=$folder?>/data";
    function loaddadus(){
      var v_jum = $('select[name=kadapagina]').val();
      $.post(main,{vjum: v_jum,folder:"<?=$folder?>"},function(data) {
        $("#data-<?=$folder?>").html(data);
      });
    }
    loaddadus();  
    
    LoadFormToContainerWindow();  
    $('select[name=kadapagina]').on('change',function(e){
        v_jum = $('select[name=kadapagina]').val();
        $.post(main, {vjum: v_jum,folder:"<?=$folder?>"} ,function(data) {
        $("#data-<?=$folder?>").html(data);
      })
    });  
    $('input:text[name=buka]').on('input',function(e){
      var v_buka = $('input:text[name=buka]').val();
      var v_jum = $('select[name=kadapagina]').val();
      if(v_buka!="") {
        $.post(main, {buka: v_buka,vjum: v_jum,folder:"<?=$folder?>"} ,function(data) {
          $("#data-<?=$folder?>").html(data).show();
        });
      } else {
        var v_jum = $('select[name=kadapagina]').val();
        $.post(main, {vjum: v_jum,folder:"<?=$folder?>"} ,function(data) {
          $("#data-<?=$folder?>").html(data);
        })
      }
    });
    $('#reset').click(function(){
      loaddadus();
    })
    if(captionContent==currentCaptionModal){
    $('.aumenta').click(function(){
      sp="foun";
      $(".modal-body").html("");
      var url = "admin/<?=$folder?>/form";
      id_nstudus ="foun";
      $("#myModalLabel").html("<i class='glyphicon glyphicon-folder-close'></i> Aumenta Dadus <?=$n_data?>");
      $.post(url, {id: id_nstudus, capWin :captionContent} ,function(data) {
        $(".modal-body").html(data).show();
      });
    });
    $('body').delegate('.renova','click', function(){
      $(".modal-body").html("");
      sp="hadia";
      var ssd = $(this).attr("ttour");
      var url = "admin/<?=$folder?>/form";
      id_nstudus = this.id;
      $("#myModalLabel").html("<i class='glyphicon glyphicon-folder-open'></i><span class='text-capitalize'> Renova Dadus <?=$n_data;?></span>");
      $.post(url, {id: id_nstudus, capWin :captionContent, ttour : ssd} ,function(data) {
        $(".modal-body").html(data).show();
      });
    });
    $('body').delegate('.pagina',"click", function(event){
      id_pag = this.id;
      v_jum = $('select[name=kadapagina]').val();
      $.post(main, {pagina: id_pag,vjum: v_jum,folder:"<?=$folder?>"} ,function(data) {
        $("#data-<?=$folder?>").html(data).show();
      });
    });
    
    $("#form-<?=$folder?>").bind("submit", function(ev) {
      var url   = "admin/<?=$folder?>/prosesu";
      var dadus   = new FormData(this);
        $.ajax({
          type    : "POST",
          url     : url,
          data    : dadus,
          cashe   : false,
          mimeType  : "multipart/form-data",
          contentType : false,
          processData : false,
          success   : function(ff){
             x = JSON.parse(ff);
            $(x.id_name).val(x.id_update);
           
                var v_jum = $('select[name=kadapagina]').val();
            $.post(main,{vjum: v_jum,folder:"<?=$folder?>"},function(data) {
              $("#data-<?=$folder?>").html(data);
            })
            $.post("<?=base_url('admin/grau_ed_f/loadformador')?>",function(data) {
              $("#id_formador").html(data);
            })
          }
        });
        if(sp=="foun"){
          var url = "admin/<?=$folder?>/form";
          $(".modal-body").html("");
          id_nstudus ="foun";
          $("#myModalLabel").html("<i class='glyphicon glyphicon-folder-close'></i> Aumenta Dadus");
          $.post(url, {id: id_nstudus, capWin :captionContent} ,function(data) {
            $(".modal-body").html('');
            $(".modal-body").html(data);
          });
          
        }else if(sp=="hadia"){
          $("#dialog-<?=$folder?>").modal('hide');
          $("#myModalLabel").html("Renova Aumenta Dadus");
          ev.preventDefault();
        }
      ev.preventDefault();
    });
    }
  });
  
  $('.modal-dialog').addClass('animated bounceInDown');
  var hideDelay = true;
  $("#dialog-<?=$folder?>").on('hide.bs.modal',function(e){
    if(hideDelay){
      $('.modal-dialog').removeClass('animated bounceInDown').addClass('animated bounceOutUp');
      hideDelay = false;
      setTimeout(function(){
        $("#dialog-<?=$folder?>").modal('hide');
        $('.modal-dialog').removeClass('animated bounceOutUp').addClass('animated bounceInDown');
      },700);
      return false;
    }
    hideDelay = true;
    return true;
  });
  
  $(function ($){
      $("#data-<?=$folder?>").delegate('.apaga','click', function() {
        var url  = "admin/<?=$folder?>/prosesu";
        var data = "admin/<?=$folder?>/data";
        // var v_jum = $('select[name=kadapagina]').val();
        var va   = this.id;
        var vb   = $(this).attr("naran");
        var naranFak ='ATENSAUN..! Ita boot hakarak apaga duni Dadus <br>Formador <b>'+vb+'</b> Husi Base de Dadus?';
        var pesanFak =  naranFak;
        modal({
          type: 'confirm', 
          title: '<i class="glyphicon glyphicon-question-sign"></i> Konfirmasaun..!',
          theme: 'atlant', 
          text: pesanFak,
          size: 'small', 
          buttons: [{
            text: 'OK',
            val: 'ok', 
            eKey: true, 
            addClass: 'btn-red', 
            onClick: function(argument) 
            {
              console.log(argument);
              return true
            }
          }, ],
          center: true, 
          autoclose: false, 
          callback: function(k)
          {
            if(k==true)
            {
              $.post(url, {apaga: va, sobre :'apagadadus'} ,function(ref) {
                var v_jum = $('select[name=kadapagina]').val();
                $.post(main,{vjum: v_jum,folder:"<?=$folder?>"},function(data) {
                  $("#data-<?=$folder?>").html(data);
                  $("#deler").html(ref);
                })
              });
            }
          },
          onShow: function(r) {}, 
          closeClick: true, 
          closable: true, 
          theme: 'atlant', 
          animate: true, 
          background: 'rgba(0,0,0,0.35)', 
          zIndex: 1050, 
          buttonText: 
            {
              ok: 'Okey',
              yes: '<i class="glyphicon glyphicon-ok-sign"></i> Sim',
              cancel: '<i class="glyphicon glyphicon-remove-sign"></i> Lae'
            },
            template: '<div class="modal-box" style="background : rgba(38,50,56,0.9);"><div class="modal-inner"><div class="modal-title"></a></div><div class="modal-text"  style="color : #fff;"></div><div class="modal-buttons"></div></div></div>',
          _classes: 
          {
            box: '.modal-box',
            boxInner: ".modal-inner",
            title: '.modal-title',
            content: '.modal-text',
            buttons: '.modal-buttons',
            closebtn: '.modal-close-btn'
          }
        });
      });
    
    })
  }) (jQuery);

</script>
