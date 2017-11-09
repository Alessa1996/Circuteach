$("#datatable").DataTable({});

function show(id) {
  var _token = $("input[name='_token']").val();
  $.ajax({
    url: "tdocumento/show",
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
    url: "tdocumento/delete",
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
