
$(document).ready(function() {
  $("#ter_cont").select2({
    placeholder: "Seleccione o Digite un número de Documento"
  });
  $("#ter_cont").on("change",function(e){
    var _token = $("input[name='_token']").val();
    e.preventDefault();
    $.ajax({
      url: "persona/search",
      type: "POST",
      data: {
        id: this.value,
        _token:_token
      },
      success: function(data){
        $("#adm_usu").html(data["ter_iden"]);
      },
      error: function(data,error,type){
        console.log(error);
      }
    });
  });
});




function show(id) {
  var _token = $("input[name='_token']").val();
  $.ajax({
    url: "admin/show",
    type: "POST",
    data: {
      id: id,
      _token:_token
    },
    success: function(data){
      $("#adm_cont").val(data["adm_cont"]);
      $("#ter_cont").val(data["ter_cont"]).trigger("change");
      $("#adm_esta").val(data["adm_esta"]);
      // $("#adm_usu").html(data["adm_usu"]);
    },
    error: function(data,error,type){
      console.log(error);
    }
  });

}

function del(id) {
  var _token = $("input[name='_token']").val();
  $.ajax({
    url: "admin/delete",
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
$("#datatable").DataTable({});
