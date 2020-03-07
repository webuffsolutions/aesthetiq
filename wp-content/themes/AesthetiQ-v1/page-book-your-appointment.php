<?php get_header(); ?>

<style>
    label.error {
        margin-left: 0.25rem !important;
        margin-top: 0.25rem !important;
        margin-bottom: 0 !important;
        font-size: 14px !important;
    }
</style>

<!-- <div class="pt-5"></div> -->

<section id="our-signature-treatments" class="pb-5 bg-pink">
    <h1 class="header white-header p-5">
        <?php the_title(); ?>
    </h1>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-12 mx-auto">
                <div class="text-center">
                    <p class="text-white">
                        <?php echo get_post_field('post_content', get_the_ID()); ?>
                    </p>
                </div>
            </div>
        </div>

        <form class="book-appointment-form" novalidate autocomplete="off">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="row mb-0">
                        <div class="col-md-12 pb-3">
                            <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Full Name" />
                            <br />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 pb-3">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" />
                            <br />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 pb-3">
                            <small class="text-white d-md-inline-block d-none">&nbsp;</small>
                            <select name="gender" id="gender" class="form-control">
                                <option value="" selected>- Gender -</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <br />
                        </div>
                        <div class="col-md-6 pb-3">
                            <small class="text-white">*Enter your 10 digit mobile no.</small>
                            <input type="text" class="form-control" id="mobile_no" name="mobile_no" value="+63" />
                            <br />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 pb-3">
                            <select name="birth_month" id="birth_month" class="form-control">
                                <option value="" selected>- Birth Month -</option>
                            </select>
                            <br />
                        </div>

                        <div class="col-md-4 pb-3">
                            <select name="birth_date" id="birth_date" class="form-control">
                                <option value="" selected>- Birth Date -</option>
                            </select>
                            <br />
                        </div>

                        <div class="col-md-4 pb-3">
                            <select name="birth_year" id="birth_year" class="form-control">
                                <option value="" selected>- Birth Year -</option>
                            </select>
                            <br />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 pb-3">
                            <select name="treatment" id="treatment" class="form-control">
                                <option value="" selected>- Treatment -</option>
                            </select>
                            <br />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 pb-3">
                            <select name="preferred_branch" id="preferred_branch" class="form-control">
                                <option value="" selected>- Preferred Branch -</option>
                            </select>
                            <br />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 pb-3">
                            <small class="text-white">*Preferred Date</small>
                            <input type="text" name="preferred_date" id="preferred_date" placeholder="- Select Date -" class="form-control" data-position="bottom center" />
                            <br />
                        </div>
                        <div class="col-md-6 pb-3">
                            <small class="text-white">*Preferred Time</small>
                            <div class="row">
                                <div class="col-7">
                                    <select class="form-control" name="preferred_time" id="preferred_time">
                                        <option value="" selected>- Select Time -</option>
                                    </select>
                                    <br />
                                </div>
                                <div class="col-5">
                                    <select name="preferred_time_suffix" id="preferred_time_suffix" class="form-control">
                                        <option value="AM">AM</option>
                                        <option value="PM">PM</option>
                                    </select>
                                    <br />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 pb-3">
                            <textarea name="message" id="message" cols="30" rows="4" class="form-control" placeholder="Message"></textarea>
                            <br />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 pb-3"></div>
                        <div class="col-md-6 pb-3">
                            <button class="btn btn-lg px-5 pb-0 w-100 bg-header text-white submit-appointment-btn" type="submit" value="SUBMIT">Submit</button>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</section>

<!-- banners -->
<?php get_template_part('template-parts/redirects'); ?>
<?php get_template_part('template-parts/back-to-top'); ?>

<?php get_footer(); ?>