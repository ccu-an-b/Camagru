
<html>
  <head>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </head>
  <body>

  
  <h2> Client example </h2>
  <h3>Output: </h3>
  <div id="output">this element will be accessed by jquery and this text replaced</div>
  <input id="test" type="submit" title="2" value="submit">


  <script id="source" language="javascript" type="text/javascript">

  $(function () 
  {

    $("#test").click(function(){
      console.log('OK');
      id = $("#test").attr("title");

      $.ajax({   
          type: "POST",                                
          url: 'api.php',                  
          data: 'picture=' + id ,                                                    
          dataType: 'json', 

          success: function(data)          
          {            
            var source = data['img']; 

            $('#output').html("<b>id: </b>"+id+"<b> name: </b>"+source); //remplace
            $( "#output" ).append( "<img src='"+source+"' />"    ); // ajoute
       // $('#image').attr('src' , src); // source dans dossier
          } 
      });
    }); 
  });

  </script>


  </body>
</html>
