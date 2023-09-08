<div class="panel panel-default thumbnail">
 
    <div class="panel-heading">
        <div class="btn-group">  
            <a class="btn btn-primary" href="<?php echo base_url("language") ?>"> <i class="fa fa-list"></i>  Language List </a> 
        </div> 
    </div>


    <div class="panel-body">				<div class="row">				<div class="col-md-4">						</div>			<div class="col-md-4">						</div>			<div class="col-md-4">						</div>		</div>
        <div class="row">
			<div class="col-sm-12">				                            <?= form_open('language/addPhrase', ' class="form-inline" ') ?>                                 <div class="form-group">                                    <label class="sr-only" for="addphrase"> <?php echo display("phrase_name"); ?></label>                                    <input name="phrase[]" type="text" class="form-control" id="addphrase" placeholder="Phrase Name">                                </div>								<div class="form-group">                                    <label class="sr-only" for="addvalue"> <?php echo display("phrase_value"); ?></label>                                    <input name="value[]" type="text" class="form-control" id="addvalue" placeholder=" <?php echo display("phrase_value"); ?>">                                </div>	                                                                  <button type="submit" class="btn btn-primary"><?php echo display("save"); ?></button>                            <?= form_close(); ?>							<br />			</div>		

            <!-- phrase -->		
            <div class="col-sm-12">
              <table class="table table-striped add-data-table">
                <thead>
                    <tr>
                        <th><i class="fa fa-th-list"></i></th>
                        <th>Phrase</th> 						<th><?php echo display("english"); ?></th> 
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($phrases)) {?>
                        <?php $sl = 1 ?>
                        <?php foreach ($phrases as $value) {?>
                        <tr>
                            <td><?= $sl++ ?></td>
                            <td><?= $value->phrase ?></td>							<td><?php echo $value->english; ?></td>						
                        </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>

              </table>
            </div>


        </div>
    </div>
 

</div>

