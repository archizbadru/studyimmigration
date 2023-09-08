   <style>
         table th {
        padding: 4px 20px 6px 20px;
        background: #3D599A;
        color: white;
        padding: 3px;
        text-align: center;
        border-right: 1px solid #777777;
        font-size: 12px;
        font-family: Arial,sans-serif,Verdana;
    }
    table td {
    padding: 3px; border-right: 1px solid #777777;
    text-align: center;
    font-size: 12px;color: #000000;
    font-family: Arial,sans-serif,Verdana;
    white-space: unset;
    }
	table tr:nth-child(odd){ 
	
		background: #e4e7ed;
	}
	table td:nth-last-child(1){ 
	
		border-right: none !important;
	}
	/*  Define the background color for all the EVEN background rows  */
	table tr:nth-child(even){
		background: #ffffff;
	}
    
    
    table.dataTable.no-footer {
        border-top: 2px solid #ebeff2;
        border-bottom: 2px solid #ebeff2;
    }
    table tbody td {
        vertical-align: middle;
    }
    tablethead th.sorting::after, table thead th.sorting_asc::after, table thead th.sorting_desc::after {
        top: 5px;
        right: 5px;
    }
    </style>
  <div  class="panel panel-default thumbnail">
        <div class="panel-body panel-form">
                            <div class="row ">
                                    <div class="col-md-12 col-sm-12">
 

														
                            <div class="row "> 
                               	
                                    <form   action='' method="post" id="login">
                                     
                                <?php echo $detail;?>
                                      
                                    </form>
                               
                            </div>
                            
<div class="row col-md-12"><br><br><br>
                                     
                                      <input type="hidden" value="<?php echo $this->uri->segment(2);?>" name="boq_id" >
                                     &nbsp;&nbsp; <input type="submit" class="btn btn-success"  value="Save">
                                      &nbsp;&nbsp; <a class="btn btn-success" href="<?php echo $this->agent->referrer();?>">Back</a>
							</div>

                      
                </div>
            </div>
        </div>
</div>
  
<script type="text/javascript">
$(function () {
    $("#btnPrint").click(function () {
        var contents = $("#dvContents").html();
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({ "position": "absolute", "top": "-1000000px" });
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html><head><title>BOQ SHEET</title>');
        frameDoc.document.write('</head><body>');
        //Append the external CSS file.
         frameDoc.document.write('<link href="<?php echo base_url();?>css/print.css" rel="stylesheet" type="text/css" />');
        //Append the DIV contents.
        frameDoc.document.write(contents);
        frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);
    });
});
</script>
</body>
</html>
