$("#datatable").DataTable({});

function show(id) {
  var _token = $("input[name='_token']").val();
  $.ajax({
    url: "asignatura/show",
    type: "POST",
    data: {
      id: id,
      _token:_token
    },
    success: function(data){
      $("#asi_cont").val(data["asi_cont"]);
      $("#asi_code").val(data["asi_code"]);
      $("#asi_desc").val(data["asi_desc"]);
      $("#asi_esta").val(data["asi_esta"]);
    },
    error: function(data,error,type){
      console.log(error);
    }
  });

}

function del(id) {
  var _token = $("input[name='_token']").val();
  $.ajax({
    url: "asignatura/delete",
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
