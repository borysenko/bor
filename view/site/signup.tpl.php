<?php

    //print_r($errors->firstOfAll());
//print $errors->first('username');

?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registration</div>

                <div class="card-body">
                    <form method="POST" action="<?=$view->url('signup')?>">

                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">Email Address</label>

                            <div class="col-md-6">
                                <input id="username" type="username" class="form-control" name="username" value="<?=$view->old('username')?>" >

                                <?if($errors->first('username')):?>
                                    <span role="alert">
                                        <strong><?=$errors->first('username')?></strong>
                                    </span>
                                <?endif;?>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                <?if($errors->first('password')):?>
                                    <span role="alert">
                                        <strong><?=$errors->first('password')?></strong>
                                    </span>
                                <?endif;?>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    SignUp
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
