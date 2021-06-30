<form action="user_experience_update" method="post">
    <div class="row">
        <input type="hidden" name="exp_id" value="<?= $expedit['id'] ?>">
        <div class="col-md-6">
            <label>Job Title</label>
            <input class="form-control valid" name="job_title" type="text" value="<?= $expedit['job_title'] ?>" placeholder='test' required>
        </div>

        <div class="col-md-6">
            <label>Company</label>         
            <input class="form-control valid" name="company" value="<?= $expedit['company'] ?>"  type="text" required>        
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label>Country</label>
            <select class="form-control select" id="country" name="country" required=''>
                    <option value="">Select Country</option>
                    <?php foreach($countries as $country):?>
                        <?php if($expedit['country'] == $country['id']): ?>
                        <option value="<?= $country['id']; ?>" selected> <?= $country['name']; ?> </option>
                        <?php else: ?>
                        <option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
                        <?php endif; endforeach; ?>
                    </select>
        </div>

        <div class="col-md-3">
            <label>Start Month</label>         
            <?php 
            $options = get_months_list();
            echo form_dropdown('starting_month',$options,$expedit['starting_month'],'class="form-control" required');
            ?>    
        </div>
        <div class="col-md-3">
            <label>Start Year</label>         
            <?php 
            $options = get_years_list();
            echo form_dropdown('starting_year',$options,$expedit['starting_year'],'class="form-control" required');
            ?> 
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <label>End  Month</label>         
            <?php 
            $options = get_months_list();
            echo form_dropdown('ending_month',$options,$expedit['ending_month'],'class="form-control " required');
            ?>        
        </div>
        <div class="col-md-3">
            <label>End  Year</label>         
            <?php 
        $options = get_years_list();
        echo form_dropdown('ending_year',$options,$expedit['ending_year'],'class="form-control " required');
        ?>        
        </div>
        <div class="col-md-6">
        <label>Currently Working Here</label><br>
        <input type="checkbox" name="currently_working_here" class="currently_working_here" value="1">
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
        <h5>Description</h5>
        <textarea name="description" class="form-control" rows="5"><?= $expedit['description'] ?></textarea>
        </div>
    </div>
    <div class="row">
    <div class="col-md-12">
        <div class="submit-field">
        <!-- <input type="submit" class="genric-btn danger circle"value="Submit"> -->
        <button class='genric-btn danger circle' type='submit'>Submit</button>
        <button type="button" class="genric-btn danger circle close_all_collapse">Cancel</button>
        </div>
    </div>
    </div>
    </form>  