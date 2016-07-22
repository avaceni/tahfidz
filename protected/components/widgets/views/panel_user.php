<panel panel-class="panel-primary" heading="Button Variants" class="ng-isolate-scope">
    <div class="panel panel-indigo">
        <div class="panel-heading">
            <div class="clear"></div>
        </div>
        <div class="panel-body" id="crop-avatar">
            <div class="clear"></div>
            <div class="col-sm-2 profile-image avatar-view c-image-upload" title="" data-original-title="Ganti Foto">
                <!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#avatar-modal">Open Modal</button>-->
                <img data-target="#avatar-modal" src="<?php echo $this->santri_array['image'] ?>" class="avatar img-thumbnail c-make-pointer" height="105.44px" width="82.24px" alt="Avatar">
                <!--<h6>Foto</h6>-->
                <!--<input type="file" class="form-control" >-->
            </div>
            <!-- Cropping modal -->
            <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1" style="display: none;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form class="avatar-form dont-validate" action="<?php echo $this->santri_array['action'] ?>" enctype="multipart/form-data" method="post">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">×</button>
                                <h4 class="modal-title" id="avatar-modal-label">Ubah Foto Profil</h4>
                            </div>
                            <div class="modal-body">
                                <div class="avatar-body">

                                    <!-- Upload image and data -->
                                    <div class="avatar-upload">
                                        <input type="hidden" class="avatar-src" name="avatar_src">
                                        <input type="hidden" class="avatar-data" name="avatar_data">
                                        <label for="avatarInput">Local upload</label>
                                        <input type="file" class="avatar-input" id="avatarInput" name="avatar_file">
                                    </div>

                                    <!-- Crop and preview -->
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="avatar-wrapper"></div>
                                        </div>
                                        <div class="col-md-3">
                                            <!--                    <div class="avatar-preview preview-lg"></div>
                                                                <div class="avatar-preview preview-md"></div>
                                                                <div class="avatar-preview preview-sm"></div>-->
                                        </div>
                                    </div>

                                    <div class="row avatar-btns">
                                        <div class="col-md-9">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary" data-method="rotate" data-option="-90" title="Rotate -90 degrees">Rotate Left</button>
                                                <button type="button" class="btn btn-primary" data-method="rotate" data-option="-15">-15deg</button>
                                                <button type="button" class="btn btn-primary" data-method="rotate" data-option="-30">-30deg</button>
                                                <button type="button" class="btn btn-primary" data-method="rotate" data-option="-45">-45deg</button>
                                            </div>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary" data-method="rotate" data-option="90" title="Rotate 90 degrees">Rotate Right</button>
                                                <button type="button" class="btn btn-primary" data-method="rotate" data-option="15">15deg</button>
                                                <button type="button" class="btn btn-primary" data-method="rotate" data-option="30">30deg</button>
                                                <button type="button" class="btn btn-primary" data-method="rotate" data-option="45">45deg</button>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="submit" class="btn btn-primary btn-block avatar-save">Done</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div> -->
                        </form>
                    </div>
                </div>
            </div><!-- /.modal -->
            <div class="col-sm-10">
                <div class="form-group profile-head">
                    <div class="col-sm-3 control-label">
                        <?php echo $this->santri_array['nama_lengkap'] ?></div>
                    <div class="col-sm-7 control-label">
                        <?php echo $this->santri_array['juz'] ?>
                    </div>
                    <div class="panel-ctrls" style="float:right">
                        <div class="right">
                            <div class="btn-group">
                                <a class="btn-success btn" href="<?php echo $this->link['url'] ?>">
                                    <i class="glyphicon glyphicon-tasks"></i>
                                    <span><?php echo $this->link['title'] ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-3 control-label">
                        <?php echo $this->santri_array['sekolah'] . $this->santri_array['umur'] ?>th
                    </div>
                    <div class="col-sm-2 control-label">
                        Pembimbing
                    </div>
                    <div class="col-sm-5 control-label">
                        <?php echo $this->santri_array['ustadz'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-3 control-label">
                        <?php echo $this->santri_array['pondok'] ?>                                        </div>
                    <div class="col-sm-2 control-label">
                        Hafalan sekarang
                    </div>
                    <div class="col-sm-5 control-label">
                        <?php echo $this->santri_array['hafalan'] ?>                                        </div>
                </div>
            </div>
        </div>
    </div>
</panel>