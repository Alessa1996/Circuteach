$("#datatable").DataTable({});

function show(id) {
  var _token = $("input[name='_token']").val();
  $.ajax({
    url: "actividad/show",
    type: "POST",
    data: {
      id: id,
      _token:_token
    },
    success: function(data){
      $("#tdo_cont").val(data["tdo_cont"]);
      $("#tdo_desc").val(data["tdo_desc"]);
    },
    error: function(data,error,type){
      console.log(error);
    }
  });

}

function del(id) {
  var _token = $("input[name='_token']").val();
  $.ajax({
    url: "actividad/delete",
    type: "POST",
    data: {
      id: id,
      _token:_token
    },
    success: function(data){
      console.log(data);
      resp = "<p class='alert alert-"+data["tipo"]+"'>"+ data["mensaje"]+"<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></p>";
      $("#messages").html("");
      $("#messages").html(resp);
      setTimeout(function(){
          location.reload();
      }, 500);
    },
    error: function(data,error,type){
      console.log(error);
    }
  });

}

$('.filestyle').on('change',function(e){
  var file = e.target.files[0];
  var reader = new FileReader();
  reader.onload = function(c){
    $('#image').attr('src',c.target.result);
    $('#image').attr('height',"350px");
    $('#image').attr('width',"100%");
    $('#image').css("visibility","visible");
    }
  reader.readAsDataURL(this.files[0]);

});

$('.video').on('change',function(e){
  console.log("hola");

  var $source = $("#video");

  $source[0].src = URL.createObjectURL(this.files[0]);


});

function limpiarImagen() {
  $('#image').attr('src',"#");
  $('#art_img').val("")
  $('#image').css("visibility","hidden");
}

function limpiarVideo() {
  var $source = $("#video");
  $source[0].src = "#";
}
