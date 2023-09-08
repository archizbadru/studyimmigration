<div class="panel panel-default thumbnail">
 
    <div class="panel-heading">
        <div class="btn-group"> 
            <a class="btn btn-success" href="<?php echo base_url("language/phrase") ?>"> <i class="fa fa-plus"></i> <?php echo display("add_phrase"); ?></a>
            <a class="btn btn-primary" href="<?php echo base_url("language") ?>"> <i class="fa fa-list"></i>  <?php echo display("language_list"); ?> </a> 
        </div> 		<?php echo form_open(base_url("language/editPhrase/".$language), array("class" => "form-inline pull-right", "method" => "get")); ?>			<div class="form-group">				<input type="text" name="filter" value="<?php echo $filter; ?>" class="form-control">				<button type="submit" class="btn btn-success"><?php echo display("filter"); ?></button>			</div>		<?php echo form_close();  ?>	
    </div>


    <div class="panel-body">
        <div class="row">

            <!-- phrase -->
            <div class="col-sm-12">
 
                <?= form_open('language/addlebel') ?>				<div class="col-md-12">					 <button type="submit" class="btn btn-success">Save</button>				</div>
                <table class="table table-striped">
                    <thead> 
                        <tr>
                            <th><i class="fa fa-th-list"></i></th>
                            <th><?php echo display("phrase"); ?></th>
                            <th><?php echo display("label") ?></th> 
                        </tr>
                    </thead>

                    <tbody>
                        <?= form_hidden('language', $language) ?>
                            <?php if (!empty($phrases)) {?>
                                <?php $sl = 1;									$tmppage = ($page - 1)*$limit;												?>
                                <?php foreach ($phrases as $key =>  $value) {?>
                                <tr class="<?= (empty($value->$language)?"bg-danger":null) ?>">
                                
                                    <td><?= $tmppage += 1; ?></td>
                                    <td><input type="text" name="phrase[<?php echo $value->id; ?>]" value="<?= $value->phrase ?>" class="form-control" readonly></td>
                                    <td><input type="text" name="lang[<?php echo $value->id; ?>]" value="<?= $value->$language ?>" class="form-control"></td> 
                                </tr>
                                <?php } ?>
                            <?php } ?>

                    </tbody>
                </table>				<div class="col-md-12">				  <button type="submit" class="btn btn-success"><?php echo display("save") ?></button>								</div>                    <?= form_close() ?>
            </div> 			<div class="col-sm-12 text-center">			  <br />
			<?php if(!empty($total)) {				$tpage = ceil($total/$limit);				for($i = 1; $i< $tpage; $i++){										?><a class="btn btn-primary <?php echo ($page == $i) ? "active" :""; ?>" href="<?php echo base_url("language/editPhrase/english?page=".$i); ?>" > <?php echo $i; ?> </a> &nbsp;<?php				}							}  ?>				</div>
        </div>
    </div>
 

</div>