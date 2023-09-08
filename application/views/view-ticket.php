
<link href="<?= base_url('assets/datatables/css/dataTables.min.css') ?>" rel="stylesheet" type="text/css"/> 
        <script src="<?php echo base_url('assets/js/jquery.min.js') ?>" type="text/javascript"></script>
		<style>
<style>

  /* select2 css start*/
  .select2-container--default .select2-selection--single .select2-selection__arrow b:before {
    content: "";
  }
  /* select2 css end*/

.cbp_tmtimeline {
  margin: 30px 0 0 0;
  padding: 0;
  list-style: none;
  position: relative;
} 

/* The line */
.cbp_tmtimeline:before {
  content: '';
  position: absolute;
  top: 0;
  bottom: 0;
  width: 10px;
  background: #afdcf8;
  left: 20%;
  margin-left: -10px;
}

.cbp_tmtimeline > li {
  position: relative;
}

/* The date/time */
.cbp_tmtimeline > li .cbp_tmtime {
  display: block;
  width: 25%;
  padding-right: 100px;
  position: absolute;
}

.cbp_tmtimeline > li .cbp_tmtime span {
  display: block;
  text-align: right;
}

.cbp_tmtimeline > li .cbp_tmtime span:first-child {
  font-size: 0.9em;
  color: #bdd0db;
}

.cbp_tmtimeline > li .cbp_tmtime span:last-child {
  font-size: 2.9em;
  color: #3594cb;
}

.cbp_tmtimeline > li:nth-child(odd) .cbp_tmtime span:last-child {
  color: #6cbfee;
}

/* Right content */
.cbp_tmtimeline > li .cbp_tmlabel {
  margin: 0 0 15px 25%;
  background: #3594cb;
  color: #fff;
  padding: 10px;
  font-size: 1.2em;
  font-weight: 300;
  line-height: 1.4;
  position: relative;
  border-radius: 5px;
}

.cbp_tmtimeline > li:nth-child(odd) .cbp_tmlabel {
  background: #6cbfee;
}

.cbp_tmtimeline > li .cbp_tmlabel h2 { 
  margin-top: 0px;
  padding: 0 0 10px 0;
  border-bottom: 1px solid rgba(255,255,255,0.4);
}

/* The triangle */
.cbp_tmtimeline > li .cbp_tmlabel:after {
  right: 100%;
  border: solid transparent;
  content: " ";
  height: 0;
  width: 0;
  position: absolute;
  pointer-events: none;
  border-right-color: #3594cb;
  border-width: 10px;
  top: 10px;
}

.cbp_tmtimeline > li:nth-child(odd) .cbp_tmlabel:after {
  border-right-color: #6cbfee;
}

/* The icons */
.cbp_tmtimeline > li .cbp_tmicon {
  width: 40px;
  height: 40px;
  font-family: 'ecoico';
  speak: none;
  font-style: normal;
  font-weight: normal;
  font-variant: normal;
  text-transform: none;
  font-size: 1.4em;
  line-height: 40px;
  -webkit-font-smoothing: antialiased;
  position: absolute;
  color: #fff;
  background: #46a4da;
  border-radius: 50%;
  box-shadow: 0 0 0 8px #afdcf8;
  text-align: center;
  left: 20%;
  top: 0;
  margin: 0 0 0 -25px;
}

.cbp_tmicon-phone:before {
  content: "☣";
}

.cbp_tmicon-screen:before {
  content: "☣";
}

.cbp_tmicon-mail:before {
  content: "☣";
}

.cbp_tmicon-earth:before {
  content: "☣";
}

/* Example Media Queries */
@media screen and (max-width: 65.375em) {
  .cbp_tmtimeline > li .cbp_tmtime span:last-child {
    font-size: 1.5em;
  }
}

@media screen and (max-width: 47.2em) {
  .cbp_tmtimeline:before {
    display: none;
  }

  .cbp_tmtimeline > li .cbp_tmtime {
    width: 100%;
    position: relative;
    padding: 0 0 20px 0;
  }

  .cbp_tmtimeline > li .cbp_tmtime span {
    text-align: left;
  }

  .cbp_tmtimeline > li .cbp_tmlabel {
    margin: 0 0 30px 0;
    padding: 1em;
    font-weight: 400;
    font-size: 95%;
  }

  .cbp_tmtimeline > li .cbp_tmlabel:after {
    right: auto;
    left: 20px;
    border-right-color: transparent;
    border-bottom-color: #3594cb;
    top: -20px;
  }

  .cbp_tmtimeline > li:nth-child(odd) .cbp_tmlabel:after {
    border-right-color: transparent;
    border-bottom-color: #6cbfee;
  }

  .cbp_tmtimeline > li .cbp_tmicon {
    position: relative;
    float: right;
    left: auto;
    margin: -55px 5px 0 0px;
  } 
}
</style>
<style> 
    .avatar {
   position: relative;
   display: inline-block;
   width: 36px;
   height: 36px;
   }
   [data-lettersbig]:before {
   content: attr(data-lettersbig);
   display: inline-block;
   font-size: 1.5em;
   width: 4em;
   height: 4em;
   line-height: 4em;
   text-align: center;
   border-radius: 50%;
   background: #37a000;
   vertical-align: middle;
   margin-right: 1em;
   color: white;
   }
   [data-letters]:before {
   content: attr(data-letters);
   display: inline-block;
   font-size: 1em;
   width: 2.5em;
   height: 2.5em;
   line-height: 2.5em;
   text-align: center;
   border-radius: 50%;
   background: #37a000;
   vertical-align: middle;
   margin-right: 1em;
   color: white;
   }
   .card-body {
   -ms-flex: 1 1 auto;
   flex: 1 1 auto;
   padding: 1.25rem;
   }
   .card {
   position: relative;
   display: -ms-flexbox;
   display: flex;
   -ms-flex-direction: column;
   flex-direction: column;
   min-width: 0;
   word-wrap: break-word;
   background-color: #fff;
   background-clip: border-box;
   border: 1px solid #c8ced3;
   border-radius: 0.25rem;
   }
   .card {
   margin-bottom: 1.5rem;
   }
     .col-height{
    min-height: 700px;
    max-height: 700px;
    overflow-y: auto;
    border-bottom: solid #c8ced3 1px;
  }
		</style>
	
       	<div class="row">
				 <div class="panel panel-default pt-2"> 
				<div class="panel-heading no-print" style ="background-color: #fff;padding:7px;border-bottom: 1px solid #C8CED3;">
							<div class="row">
					<div class="col-md-12">
						<h4> Ticket <small><?php echo $ticket->ticketno; ?></small> 
						
						<div style="float:right">
            <div class="btn-group" role="group" aria-label="Button group">
               <a class="btn" onclick="window.location.reload();" title="Refresh">
               <i class="fa fa-refresh icon_color"></i>
               </a>  
            </div>
            <div class="btn-group" role="group" aria-label="Button group">
               <a class="dropdown-toggle" href="<?php echo base_url("ticket/add"); ?>" title="Add New Enquiry"> <i class="fa fa-plus" style="background:#fff !important;border:none!important;color:green;"></i></a>&nbsp;&nbsp;&nbsp;
            </div>
            
            <div class="btn-group" role="group" aria-label="Button group">
               <a class="btn" href="<?php echo base_url("ticket"); ?>" title="Refresh">
               <i class="fa fa-arrow-left icon_color"></i>
               </a>                                                    
            </div>
         </div>
						
						</h4>
					</div>
				</div>
				</div>
				<div class="panel-body" style = "padding-top:0px;">
					<div class="col-md-3 col-height" style = "text-align:center;background:#fff;">
					<div class="row">
						<?php echo form_open(base_url("ticket/view/".$ticket->ticketno)); ?>
						   <?php
            $string =  $ticket->	clientname;            
            function initials($str) {     
                $ret = '';
                foreach (explode(' ', $str) as $word)
                $ret .= strtoupper(substr($word,0,1));
                return $ret; 
            }       
            ?>
         <div class="avatar" style="margin-top:5%;margin-left:-15%;">
            <p data-lettersbig="<?php echo initials($string);?>"> </p>
         </div>
					<h5 style="text-align:center"><br><br><?php echo $ticket->	clientname; ?>  
						<br><?php echo $ticket->	gender; ?>            <br>
							<a href="javascript:void(0)" onclick="send_parameters(&quot;.<?php echo $ticket->	phone; ?>.&quot;)"><?php echo $ticket->	phone; ?></a>
							<br><?php echo $ticket->	email; ?>          
						 </h5>
						 <h4 class="col-md-12">Reply To Client</h4>
							<div class="col-md-12">
									<div class="form-group">
									
										<input  type ="text" name = "name" value ="<?php echo $ticket->	clientname; ?> " class="form-control" placeholder="Name">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
									
										<input  type ="text" name = "email" value ="<?php echo $ticket->	email; ?> " class="form-control"  placeholder="Email">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										
										<input  type ="text" name = "subjects" class="form-control"  placeholder="Subject">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										
										<textarea name="reply" class="form-control"  placeholder="Reply"></textarea>
									</div>
								</div>
								
								<div class = "col-md-12 text-center">
									<input type ="hidden" name = "ticketno" value = "<?php echo $ticket->id; ?>">
									<input type ="hidden" name = "client" value = "<?php echo $ticket->client; ?>">
									<button type ="submit" class="btn btn-success">Send</button>
								</div>
						<?php echo form_close(); ?>
						
						</div>
					</div>
				<div class="col-md-6 card card-body col-height" style ="    border: 1px solid #c8ced3;
    padding: 15px;
    border-top: none;">
		
				
			
			<div class="row col-height">
				<div class="col-md-4">
					<div class="form-group">
						<label>Name</label> 
						<span class="form-control"><?php echo $ticket->clientname; ?></span>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Email</label>
						<span class="form-control"><?php echo $ticket->email; ?></span>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Phone</label>
						<span class="form-control"><?php echo $ticket->clientname; ?></span>
					</div>
				</div>
		
				<div class="col-md-4">
					<div class="form-group">
						<label>Product</label>
						<span class="form-control"><?php echo $ticket->product; ?></span>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Related To</label>
						<span class="form-control"><?php echo $ticket->category; ?></span>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Priority</label>
					<?php
						if($ticket->	priority == 1){
							
							?><span class="badge badge-info">Low</span><?php
						}else if($ticket->	priority == 2){
							
							?><span class="badge badge-warning">Medium</span><?php
						}else if($ticket->	priority == 3){
							
							?><span class="badge badge-danger">High</span><?php
						}
						?>
						
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						
						
						<h4><?php echo $ticket->	message; ?></h4>
					</div>
				</div>
				<div class = "col-md-12">
										<div class="row">
					<div class="col-md-12" style  ="background: #f7f7f7;
    border: 1px solid #ccc;
    padding: 15px;
    border-radius: 10px;margin-bottom:25px;">
					<?php echo form_open(base_url("ticket/view/".$ticket->ticketno)); ?>
						<div class="row">
						
						<div class="col-md-4">
								<div class="form-group">
									<label>Issue </label>
									<select class="form-control" name = "issue">
										<option value = ""></option>
										<option value = "1" <?php echo ($ticket->	issue == 1) ? "selected" : "" ?>>Database slow issue</option>
										<option value = "2" <?php echo ($ticket->	issue == 2) ? "selected" : "" ?>>Not Understand</option>
									</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Solution </label>
									<select class="form-control" name = "solution">
										<option value = ""></option>
										<option value = "1"  <?php echo ($ticket->	solution == 1) ? "selected" : "" ?>>Done</option>
										<option value = "2" <?php echo ($ticket->	solution == 2) ? "selected" : "" ?>>Proccess</option>
										<option value = "3"  <?php echo ($ticket->	solution == 3) ? "selected" : "" ?>>Defer</option>
									</select>
								</div>
							</div>
							
							<div class="col-md-3">
								<div class="form-group">
									<label>Update Status </label>
									<select class="form-control" name = "status">
										<option value = ""></option>
										<option value = "0" <?php echo ($ticket->status == 0) ? "selected" : "" ?>>Unread</option>
										<option value = "1" <?php echo ($ticket->status == 1) ? "selected" : "" ?>>Proccess</option>
										<option value = "2" <?php echo ($ticket->status == 2) ? "selected" : "" ?>>Read</option>
										<option value = "3" <?php echo ($ticket->status == 3) ? "selected" : "" ?>>Dropped</option>
									</select>
								</div>
							</div>
							<div class="col-md-2 text-right">
							<br />
									<input type ="hidden" name = "ticketno" value = "<?php echo $ticket->id; ?>">
								<input type ="hidden" name = "client" value = "<?php echo $ticket->client; ?>">
								<button type = "submit" class="btn btn-success">Update</button>
							</div>
						</div>
						<?php echo form_close(); ?>
					</div>
					
						</div>	
		

				</div>
				</div>
				
			</div>
				<div class="col-md-3 col-height" >
					  <h3 class="text-center">Activity Timeline</h3><hr>
          <ul class="cbp_tmtimeline" style="margin-left:-30px;">

              <?php
			if(!empty($conversion)){		
              foreach($conversion as $cnv){ ?>
            
                <li>
                  <div class="cbp_tmicon cbp_tmicon-phone" style="background:#cb4335;"></div>
                  <div class="cbp_tmlabel"  style="background:#95a5a6;">
                    <span style="font-weight:900;font-size:15px;"><?php echo $cnv->subj; ?></span></br>
                   
                    <span style="font-weight:900;font-size:12px;"><?php echo $cnv->msg; ?></span>
                   
                   
                    <p><?php echo date("j-M-Y h:i:s a",strtotime($cnv->send_date)); ?><br>
                   </p>
                  </div>
                </li>
                <?php } 
              }
              ?>              
            </ul>
				
				</div>
			</div>
			</div>
        </div>            
          
<!-- jquery-ui js -->
<script src="<?php echo base_url('assets/js/jquery-ui.min.js') ?>" type="text/javascript"></script>      
<!-- DataTables JavaScript -->
<script src="<?php echo base_url("assets/datatables/js/dataTables.min.js") ?>"></script>  
<script src="<?php echo base_url() ?>assets/js/custom.js" type="text/javascript"></script>