
function status(id) {
  console.log(id);
  $.ajax({
    url: "/matricula/status",
    type: "POST",
    data: {
      _token:_token,
      mat_cont: id
    },
    success: function(data){
      table1.ajax.reload();
      table2.ajax.reload();
      new PNotify({
                title: 'Mensaje de Sistema',
                text: data["mensaje"],
                type: data["tipo"],
                styling: 'bootstrap3'
            });
    },
    error: function(data,error,type){
      console.log(data["responseText"]);
    }
  });

}

function matricula(cur_cont,est_cont) {

  $.ajax({
    url: "/matricula/save",
    type: "POST",
    data: {
      _token:_token,
      cur_cont: cur_cont,
      est_cont: est_cont,
    },
    success: function(data){

      table1.ajax.reload();
      table2.ajax.reload();
      new PNotify({
                title: 'Mensaje de Sistema',
                text: data["mensaje"],
                type: data["tipo"],
                styling: 'bootstrap3'
            });
    },
    error: function(data,error,type){
      console.log(data["responseText"]);
    }
  });

}

function del(id) {
  $.ajax({
    url: "/matricula/delete",
    type: "POST",
    data: {
      _token:_token,
      mat_cont: id
    },
    success: function(data){
      table1.ajax.reload();
      table2.ajax.reload();
      new PNotify({
                title: 'Mensaje de Sistema',
                text: data["mensaje"],
                type: data["tipo"],
                styling: 'bootstrap3'
            });
    },
    error: function(data,error,type){
      console.log(data["responseText"]);
    }
  });

}
