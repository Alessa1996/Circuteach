$("#datatable").DataTable({});

function show(id) {
  var _token = $("input[name='_token']").val();
  $.ajax({
    url: "persona/show",
    type: "POST",
    data: {
      id: id,
      _token:_token
    },
    success: function(data){
      $("#ter_cont").val(data["ter_cont"]);
      $("#tdo_cont").val(data["tdo_cont"]);
      $("#tus_cont").val(data["tus_cont"]);
      $("#ter_iden").val(data["ter_iden"]);
      $("#ter_pnom").val(data["ter_pnom"]);
      $("#ter_snom").val(data["ter_snom"]);
      $("#ter_pape").val(data["ter_pape"]);
      $("#ter_sape").val(data["ter_sape"]);
      $("#ter_corre").val(data["ter_corre"]);
      $("#ter_tel").val(data["ter_tel"]);
    },
    error: function(data,error,type){
      console.log(error);
    }
  });

}

function del(id) {
  var _token = $("input[name='_token']").val();
  $.ajax({
    url: "persona/delete",
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
