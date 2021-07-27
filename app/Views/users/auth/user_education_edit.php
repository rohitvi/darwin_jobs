<form action="update_education" method='post'>
    <div class="row">
    <input type="hidden" name="edu_id" value="<?= $edu['id'] ?>">
        <div class="col-md-6">
            <label>Degree Level</label>
            <?php 
            $educations = get_education_list();
            $options = array('' => 'Select Option') + array_column($educations,'type','id');
            echo form_dropdown('level',$options,$edu['degree'],'class="form-control" required');
        ?>
        </div>

        <div class="col-md-6">
            <label>Degree Title</label>
            <input class="form-control" name="title" value="<?= $edu['degree_title'] ?>" type="text" placeholder="e.g., Computer Science" required>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label>Major Subjects</label>
            <input class="form-control" name="majors" value="<?= $edu['major_subjects'] ?>" type="text" placeholder="please specify your major subjects" required>
        </div>

        <div class="col-md-6">
            <label>Institution</label>
            <input class="form-control" name="institution" value="<?= $edu['institution'] ?>" type="text" placeholder="Institution" required>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label>Country</label>
                    <select class="form-control select" id="country" name="country" required>
                        <option value="">Select Country</option>
                        <?php foreach($countries as $country):?>
                        <?php if($edu['country'] == $country['id']): ?>
                        <option value="<?= $country['id']; ?>" selected> <?= $country['name']; ?> </option>
                        <?php else: ?>
                        <option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
                        <?php endif; endforeach; ?>
                    </select>
        </div>

        <div class="col-md-6">
            <label>Completion Year</label>
            <?= year_dropdown('year', '1985', $edu['completion_year']); ?>
        </div>
    </div><br>

    <div class="row">
        <div class='col-md-12'>
            <div class="submit-field">
                <button type="submit" class="btn-sm btn-primary" >Submit</button>
                <button type="button" class="btn-sm btn-primary close_all_collapse">Cancel</button>
            </div>
        </div>
        </div>
</form>