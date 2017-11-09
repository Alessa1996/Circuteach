$(document).ready(function(){
  var table = $("#datatable").dataTable();
  $("#asi_cont").select2({
    placeholder: "Seleccione una Asignatura"
  });
  $("#doc_cont").select2({
    placeholder: "Seleccione un Docente"
  });

  $("#cat_cont").change(function(){
    var _token = $("input[name='_token']").val();
    $.ajax({
      url: "catedra/search",
      type: "POST",
      data: {
        id: this.value,
        _token:_token
      },
      success: function(data){
        console.log(data);
        $("#doc_cont").val(data["ter_cont"]).trigger("change");
      },
      error: function(data,error,type){
        console.log(data["responseText"]);
      }
    });
  });

});
function show(id) {
  var _token = $("input[name='_token']").val();
  $.ajax({
    url: "curso/show",
    type: "POST",
    data: {
      id: id,
      _token:_token
    },
    success: function(data){
      $("#cur_cont").val(data["cur_cont"]);
      $("#cur_desc").val(data["cur_desc"]);
      $("#cur_fini").val(data["cur_fini"]);
      $("#cur_fina").val(data["cur_fina"]);
      $("#cur_esta").val(data["cur_esta"]);
      $("#cat_cont").val(data["cat_cont"]);
      $("#cur_obge").val(data["cur_obge"]);
      $("#cur_obes").val(data["cur_obes"]);

    },
    error: function(data,error,type){
      console.log(error);
    },
    complete: function() {
      var _token = $("input[name='_token']").val();
      $.ajax({
        url: "catedra/search",
        type: "POST",
        data: {
          id: $("#cat_cont").val(),
          _token:_token
        },
        success: function(data){
          console.log(data);
          $("#doc_cont").val(data["ter_cont"]).trigger("change");
        },
        error: function(data,error,type){
          console.log(data["responseText"]);
        }
      });
    }
  });

}

function del(id) {
  var _token = $("input[name='_token']").val();
  $.ajax({
    url: "curso/delete",
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
