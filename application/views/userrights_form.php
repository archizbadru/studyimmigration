<form class="form-horizontal" action="<?=base_url('Userrights/create')?>" method="post">
  <input type="hidden" name="rightid">
  <div class="form-group">
    <label class="control-label col-sm-2" for="email">Module : </label>
    <div class="col-sm-10">
      <select name="module" class="form-control">
        <option value="">Select Module</option>
        <?php foreach ($user_role as $department) { ?>
          <option value="<?=$department->id ?>"><?=$department->title ?></option>
        <?php } ?>
      </select>
    </div>
  </div>
  
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Right title : </label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="title" id="name" placeholder="Enter Right Title">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </div>
</form>