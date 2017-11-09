$("#datatable").DataTable({});
$("#asi_cont").select2({
  placeholder: "Seleccione una Asignatura"
});
$("#doc_cont").select2({
  placeholder: "Seleccione un Docente"
});

function show(id) {
  var _token = $("input[name='_token']").val();
  $.ajax({
    url: "catedra/show",
    type: "POST",
    data: {
      id: id,
      _token:_token
    },
    success: function(data){
      $("#cat_cont").val(data["cat_cont"]);
      $("#asi_cont").val(data["asi_cont"]).trigger("change");
      $("#doc_cont").val(data["doc_cont"]).trigger("change");
      $("#cat_esta").val(data["cat_esta"]);
      $("#nac_cont").val(data["nac_cont"]);
    },
    error: function(data,error,type){
      console.log(error);
    }
  });

}

function del(id) {
  var _token = $("input[name='_token']").val();
  $.ajax({
    url: "catedra/delete",
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
