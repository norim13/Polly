<? function abc($divName, $item) { ?>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
   
      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});
     
      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);


      // Callback that creates and populates a data table, 
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

      // Create the data table.
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Choices');
      data.addColumn('number', 'Votes');

      <?        

              $poll_options = getPollOptions($item['title']);
               foreach($poll_options as $poll_option){
                  ?>
                  data.addRow(['<?=$poll_option['optionText']?>',<?=$poll_option['counter']?>]);
                  <?
               }

      ?>

      // Set chart options
      var options = {'title': "<?=$divName?>",
                     'width':500,
                     'height':300, 'backgroundColor': { fill:'transparent' },'legend.alignment':"center"};

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById("<?=$item['title']?>"));
      chart.draw(data, options);
    }
    </script>
    
    <div  class="poll_item_stat" id="<?=$divName?>" style="background-color:# width:400; height:300"></div>

<? } ?>



