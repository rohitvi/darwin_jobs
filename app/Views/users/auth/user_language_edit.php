 <!-- add user languages collapse -->
    <form action="update_language" method='post'>
        <div class='row'>
        <input type="hidden" name="lang_id" value="<?= $userlang['id'] ?>">
            <div class='col-md-6'>
                <label for="Language">Language</label>
                <?php
                $educations = get_languages_list();
                $options = array('' => 'Select Option') + array_column($educations, 'lang_name', 'lang_id');
                echo form_dropdown('language', $options, $userlang['language'], 'class="form-control" required');
                ?>
            </div>

            <div class='col-md-6'>
                <label for="Language">Proficiency with this language</label>
                <?php
                $options = get_language_levels();
                echo form_dropdown('lang_level', $options, $userlang['proficiency'], 'class="form-control" required');
                ?>
            </div>

            <div class='col-md-12'>
                <div class="submit-field">
                    <button type="submit" class="btn-sm btn-primary" >Submit</button>
                    <button type="button" class="btn-sm btn-primary close_all_collapse">Cancel</button>
                </div>
            </div>
        </div>
    </form>
<!-- add user languages collapse -->