$(function() {
    $("#exporttable").click(function(e){
      var table = $("#htmltable");
      if(table && table.length){
        $(table).table2excel({
          exclude: ".noExl",
          name: "Excel Document Name",
          filename: "exported_file_" + new Date().toJSON().slice(0,10).replace(/-/g,'/') + ".xls",
          fileext: ".xls",
          exclude_img: true,
          exclude_links: true,
          exclude_inputs: true,
          preserveColors: false
        });
      }
    });
    
  });