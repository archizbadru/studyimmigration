<div class="panel panel-default thumbnail">
 
    <div class="panel-heading">
        <div class="btn-group"> 
            <a class="btn btn-success" href="<?php echo base_url("language/phrase") ?>"> <i class="fa fa-plus"></i> <?php echo display("add_phrase"); ?></a>
            <a class="btn btn-primary" href="<?php echo base_url("language") ?>"> <i class="fa fa-list"></i>  <?php echo display("language_list"); ?> </a> 
        </div> 
    </div>


    <div class="panel-body">
        <div class="row">

            <!-- phrase -->
            <div class="col-sm-12">
 
                <?= form_open('language/addlebel') ?>
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
                                <?php $sl = 1;
                                <?php foreach ($phrases as $key =>  $value) {?>
                                <tr class="<?= (empty($value->$language)?"bg-danger":null) ?>">
                                
                                    <td><?= $tmppage += 1; ?></td>
                                    <td><input type="text" name="phrase[<?php echo $value->id; ?>]" value="<?= $value->phrase ?>" class="form-control" readonly></td>
                                    <td><input type="text" name="lang[<?php echo $value->id; ?>]" value="<?= $value->$language ?>" class="form-control"></td> 
                                </tr>
                                <?php } ?>
                            <?php } ?>

                    </tbody>
                </table>
            </div> 
			<?php if(!empty($total)) {
        </div>
    </div>
 

</div>